<?php
declare(strict_types=1);

namespace Strayobject\TwitterstatsBundle\Controller;

use DateTime;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use NilPortugues\Symfony\JsonApiBundle\Serializer\JsonApiResponseTrait;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Strayobject\TwitterstatsBundle\Provider\LinkProvider;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class TwitterApiController extends Controller
{
    use JsonApiResponseTrait;

    /**
     * ### Example Response: ###
     *     {
     *         "data": [
     *             {
     *                 "type": "account",
     *                 "id": "175f06f7-ecec-11e6-bd1c-0242ac130007",
     *                 "attributes": {
     *                     "created_at": {
     *                         "date": "2017-02-07 04:15:42.000000",
     *                         "timezone_type": 3,
     *                         "timezone": "UTC"
     *                     },
     *                     "description": "Monthly meetup of PHP developers from Glasgow and surrounding areas.",
     *                     "id": "175f06f7-ecec-11e6-bd1c-0242ac130007",
     *                     "name": "Glasgow PHP",
     *                     "recent_follower_count": 600,
     *                     "recent_like_count": 131,
     *                     "recent_retweet_count": 9293,
     *                     "screen_name": "glasgowphp",
     *                     "updated_at": {
     *                         "date": "2017-02-07 04:15:42.000000",
     *                         "timezone_type": 3,
     *                         "timezone": "UTC"
     *                     }
     *                 }
     *             }
     *         ],
     *         "links": {
     *             "self": {
     *                 "href": "/app_dev.php/api/accounts/"
     *             }
     *         },
     *         "jsonapi": {
     *             "version": "1.0"
     *         }
     *     }
     *
     * @ApiDoc(
     *  resource=true,
     *  description="Fetch any accounts we store data for.",
     *  statusCodes={
     *      200="On success",
     *  },
     *  requirements={
     *      {
     *          "name"="account",
     *          "dataType"="string",
     *          "requirement"="false",
     *          "description"="Twitter account handle"
     *      }
     *  }
     * )
     * @Route("/api/accounts/", name="strayobject_twitter_api_accounts_get")
     * @Method({"GET"})
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
     * ### Example Response: ###
     *     {
     *          "data": [
     *              {
     *                  "type": "retweet",
     *                  "id": "176153dc-ecec-11e6-bd1c-0242ac130007",
     *                  "attributes": {
     *                      "count": 2,
     *                      "created_at": {
     *                      "date": "2017-02-07 04:15:43.000000",
     *                      "timezone_type": 3,
     *                      "timezone": "UTC"
     *                  },
     *                  "id": "176153dc-ecec-11e6-bd1c-0242ac130007",
     *                  "tweet_date": {
     *                      "date": "2017-01-28 11:23:47.000000",
     *                      "timezone_type": 3,
     *                      "timezone": "UTC"
     *                  },
     *                  "tweet_id": "825303353664163841",
     *                  "updated_at": {
     *                      "date": "2017-02-07 04:15:43.000000",
     *                      "timezone_type": 3,
     *                      "timezone": "UTC"
     *                  }
     *              }
     *          ],
     *          "links": {
     *              "self": {
     *                  "href": "/app_dev.php/api/accounts/"
     *              }
     *          },
     *          "jsonapi": {
     *              "version": "1.0"
     *          }
     *      }
     *
     * @ApiDoc(
     *  resource=true,
     *  description="Fetch any retweets we have stored for a particular account.",
     *  statusCodes={
     *      200="On success",
     *      404="Account not found"
     *  },
     *  requirements={
     *      {
     *          "name"="screenName",
     *          "dataType"="string",
     *          "requirement"="true",
     *          "description"="Twitter Handle"
     *      },
     *      {
     *          "name"="start",
     *          "dataType"="string",
     *          "requirement"="false",
     *          "description"="Start date to search for retweets from. Date in any format taken by the \DateTime() constructor, preferred format: 2017-01-01"
     *      },
     *      {
     *          "name"="end",
     *          "dataType"="string",
     *          "requirement"="false",
     *          "description"="End date to search for retweets until. Date in any format taken by the \DateTime() constructor, preferred format: 2017-01-01"
     *      }
     *  }
     * )
     *
     * @Route("/api/accounts/{screenName}/retweets", name="strayobject_twitter_api_retweets_get")
     * @Method({"GET"})
     */
    public function getStatsAction(Request $request): Response
    {
        $twitterUser = $request->attributes->get('screenName', 'glasgowphp');
        $startTime = $request->query->get('start', 0);
        $endTime = $request->query->get('end', 0);
        $account = $this->getDoctrine()->getRepository('StrayobjectTwitterstatsBundle:Account')->findOneBy(['screenName' => $twitterUser]);

        if (!$account) {
            $res = [
                'message' => sprintf('Account not found. Perhaps you can try opening %s', $this->generateUrl('home', ['account' => $twitterUser], UrlGeneratorInterface::ABSOLUTE_URL)),
            ];

            return $this->json($res, 404);
        }

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
