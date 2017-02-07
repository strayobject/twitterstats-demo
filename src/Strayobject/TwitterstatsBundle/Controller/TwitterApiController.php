<?php
declare(strict_types=1);

namespace Strayobject\TwitterstatsBundle\Controller;

use DateTime;
use NilPortugues\Symfony\JsonApiBundle\Serializer\JsonApiResponseTrait;
use Strayobject\TwitterstatsBundle\Provider\LinkProvider;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TwitterApiController extends Controller
{
    use JsonApiResponseTrait;

    /**
     * @Route("/api/accounts/", name="strayobject_twitter_api_accounts_get")
     * Method({"OPTIONS","GET"})
     */
    public function getAccountsAction(Request $request): Response
    {
        $accounts = $this->getDoctrine()->getRepository('StrayobjectTwitterstatsBundle:Account')->findAll();
        $links = new LinkProvider(
            $this->generateUrl('strayobject_twitter_api_accounts_get')
        );
        $data = $this->get('strayobject.twitterstats.provider.serialized_data')->serializeData('account', $accounts, $links);
        $response = $this->response($data);

        return $response;
    }

    /**
     * @Route("/api/accounts/{screenName}/retweets", name="strayobject_twitter_api_retweets_get")
     * Method({"OPTIONS","GET"})
     */
    public function getStatsAction(Request $request): Response
    {
        $twitterUser = $request->attributes->get('screenName', 'glasgowphp');
        $startTime = $request->query->get('start', 0);
        $endTime = $request->query->get('end', 0);
        $account = $this->getDoctrine()->getRepository('StrayobjectTwitterstatsBundle:Account')->findOneBy(['screenName' => $twitterUser]);

        if (empty($startTime) || empty($endTime)) {
            $retweets = $this->getDoctrine()->getRepository('StrayobjectTwitterstatsBundle:Retweet')->findBy(['account' => $account]);
        } else {
            $dateFrom = new DateTime($startTime);
            $dateUntil = new DateTime($endTime);
            $retweets = $this->getDoctrine()->getRepository('StrayobjectTwitterstatsBundle:Retweet')->findForAccountFromUntil($account, $dateFrom, $dateUntil);
        }

        $links = new LinkProvider(
            $this->generateUrl('strayobject_twitter_api_accounts_get')
        );
        $data = $this->get('strayobject.twitterstats.provider.serialized_data')->serializeData('retweet', $retweets, $links);
        $response = $this->response($data);

        return $response;
    }
}
