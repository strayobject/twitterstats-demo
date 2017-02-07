<?php
declare(strict_types=1);

namespace Strayobject\TwitterstatsBundle\Controller;

use DateTime;
use Strayobject\TwitterstatsBundle\Entity\Account;
use Strayobject\TwitterstatsBundle\Entity\Follower;
use Strayobject\TwitterstatsBundle\Entity\Like;
use Strayobject\TwitterstatsBundle\Entity\Retweet;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TwitterController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function indexAction(Request $request): Response
    {
        $twitterUser = $request->query->get('account', 'glasgowphp');
        $twitter = $this->get('endroid.twitter');
        $account = $this->getDoctrine()->getRepository('StrayobjectTwitterstatsBundle:Account')->findOneBy(['screenName' => $twitterUser]);
        $retweetOptions = [
            'screen_name' => $twitterUser,
            'count' => 200,
            'include_entities' => true,
            'include_rts' => true,

        ];

        if ($account) {
            $lastRetweet = $this->getDoctrine()->getRepository('StrayobjectTwitterstatsBundle:Retweet')->findMostRecentRetweetForAccount($account);

            if ($lastRetweet) {
                $retweetOptions['since_id'] = $lastRetweet->getTweetId();
            }
        }

        try {
            $userReq = $twitter->query('/users/show', 'GET', 'json', [
                'screen_name' => $twitterUser,
            ]);
            $retweetReq = $twitter->query('/statuses/user_timeline', 'GET', 'json', $retweetOptions);
        } catch (Exception $e) {
            /**
             * @todo add logging
             */
            $this->addFlash('error', sprintf('Error trying to fetch data from Twitter: %s', $e->getMessage()));
        }


        $userData = json_decode($userReq->getContent());
        $retweetData = json_decode($retweetReq->getContent());
        $em = $this->getDoctrine()->getManager();


        if (!$account) {
            $account = (new Account())->setScreenName($twitterUser);
            $em->persist($account);
        }

        if ($userData) {
            $account
                ->setName($userData->name)
                ->setDescription($userData->description)
                ->setRecentFollowerCount($userData->followers_count)
                ->setRecentLikeCount($userData->favourites_count)
            ;
            $follower = (new Follower())->setAccount($account)->setCount($userData->followers_count);
            $like = (new Like())->setAccount($account)->setCount($userData->favourites_count);
            $em->persist($follower);
            $em->persist($like);
        }

        if ($retweetData) {
            $rCount = 0;
            foreach ($retweetData as $rd) {
                $retweet = new Retweet();
                $retweet
                    ->setAccount($account)
                    ->setTweetId($rd->id_str)
                    ->setTweetDate(new DateTime($rd->created_at))
                    ->setCount($rd->retweet_count)
                ;
                $em->persist($retweet);
                $rCount += $rd->retweet_count;
            }
            $account->setRecentRetweetCount($account->getRecentRetweetCount() + $rCount);
            $em->persist($account);
        }

        $em->flush();

        return $this->render('StrayobjectTwitterstatsBundle:Twitter:index.html.twig', ['account' => $account]);
    }
}
