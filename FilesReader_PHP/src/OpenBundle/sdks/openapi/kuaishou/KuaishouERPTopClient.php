<?php


namespace sdks\openapi\kuaishou;

use GuzzleHttp\RequestOptions;
use http\Client;
use sdks\openapi\kuaishou\Request\SkuDetailRequest;

class KuaishouERPTopClient
{
    private $appKey = '';

    private $appSecret = '';

    private $signSecret = '';

    private $version;

    private $uri = '';

    private $messageSecret = '';

    private $oauthUri = '';
    /**
     * @var \GuzzleHttp\Client
     */
    private $client;

    private $sellers;

    public $generalSellers = [];

    public $crossBorderSellers = [];

    private $_products = [];

    public function __construct(){}

    private $configProvider = <<<JSON
{"api_host":"https://openapi.kwaixiaodian.com","oauth_api":"https://openapi.kwaixiaodian.com","app_key":"ks664562423415146762","app_secret":"BGViE43M5B8RjE2BtHmp7Q","sign_secret":"63c16f1b30ab1cc1c5964288b5ca9200","message_secret":"ulAi5RKyv2zQSFzmXKqwdQ==","version":"1","sellers":{"general_sellers":{"汉高家清旗舰店":"快手汉高大贸旗舰店","BC极选":"快手BC极选","深屹美妆专营店":"快手深屹美妆专营店","欧臻廷旗舰店":"快手欧臻廷旗舰店","名亨美妆专营店":"快手名亨美妆专营店"},"cross_border_sellers":{"NEWELEMENTS美妆海外专营店":"NEWELEMENTS美妆海外专营店"},"warehouse_brand_match":[{"brand_name":["SUQQU","CHANTECAILLE","RMK","ARGENTUM"],"warehouse_code":"CNGGC01"}]}}
JSON;


    /**
     * @required
     */
    public function setConfigProvider()
    {
        $config = json_decode($this->configProvider, true);
        $this->uri        = $config['api_host'];
        $this->appKey     = $config['app_key'];
        $this->appSecret  = $config['app_secret'];
        $this->signSecret = $config['sign_secret'];
        $this->oauthUri   = $config['oauth_api'];
        $this->version    = $config['version'];
        $this->sellers    = $config['sellers'];
        $this->generalSellers     = $this->sellers['general_sellers']; //大贸店
        $this->crossBorderSellers = $this->sellers['cross_border_sellers']; //跨境店
        $this->messageSecret = $config['message_secret'];
        $this->client = new \GuzzleHttp\Client([
            'base_uri' => $this->uri,
            'Content-Type' => 'application/x-www-form-urlencoded'
        ]);
    }

    public function execute(KuaishouRequestInterface $request, $accessToken = "")
    {
        $accessToken = $this->getToken();

        $apiName = str_replace('.', '/', $request->apiName());

        $params = [
            'appkey' => $this->appKey,
            'method' => $request->apiName(),
            'version' => $this->version,
            'param' => json_encode($request->getApiParas()),
            'access_token' => $accessToken,
            'timestamp' => (int)getMillisecond(),
            'signMethod' => 'MD5',
        ];
        $params['sign'] = $this->signature($params);

        print_r( $params );

        $res = $this->client->request($request->getApiMethod(), $apiName, [
            RequestOptions::QUERY => $params
        ])->getBody()->getContents();

        $response =  json_decode($res, true);

        print_r( $response );

        return $response;
    }

    public function getToken()
    {
        return "ChFvYXV0aC5hY2Nlc3NUb2tlbhJg0P4V7XWCf8JnbV8gqUrp_2QCdbo-Z_Tv8KR1PCzpD9sS0XaxV-oM6pSxrQGc8mqoe9QS_hTceSWArnbYO_NYI3-qXfQlOvRQ6cI-UdLHIs3gAL6WJ4VzI7EyRH0YaSuyGhJ0lNpl9NtFt7jM9LzyFTTPFEciIMJSzcDYFZcZh4Pp_acZJx1BfRei3UxfugUbPTQy66G5KAUwAQ";

        $uri = vsprintf('%s/oauth2/refresh_token?app_id=%s&app_secret=%s&refresh_token=%s&grant_type=refresh_token',
            [
                $this->oauthUri,
                $this->appKey,
                $this->appSecret,
                'refresh token'
            ]);

        $res = json_decode(curl_get($uri), true);

        if (1 !== (int)$res['result']) {
            throw new \Exception($res['error_msg']);
        }
        return $res['access_token'];
    }

    private function signature($params)
    {
        $params = array_filter($params);

        ksort($params);
        $sign = '';
        foreach ($params as $k => $v) {
            if (is_string($v) || is_numeric($v)) {
                $sign .= "$k=" . $v . "&";
            }
        }
        unset($k, $v);
        $sign .= "signSecret={$this->signSecret}";
        return MD5($sign);
    }

    public function getRealBarcode($itemId, $skuId, $token)
    {
        $res = $this->execute((new SkuDetailRequest())->setKwaiItemId($itemId), $token);
        if (1 !== (int)$res['result']) {
            throw new \Exception('快手商品信息接口异常:[%s]', $res['error_msg']);
        }

        foreach ($res['data']['skuList'] as $i) {
            if ($i['kwaiSkuId'] == $skuId && $i['kwaiItemId'] == $itemId) {
                $barcode = $i['gtinCode'];
                break;
            }
        }
        return $barcode ?? '';
    }

    public function matchProduct($sellerNick, $itemId, $skuId)
    {
        $hsCode = hash('crc32b',$sellerNick . $itemId . $skuId);

        if (!isset($this->_products[$hsCode])) {
            $barcode = $this->_em->getRepository(KuaishouSku::class)->createQueryBuilder('kp')
                ->select('kp.matched_code')
                ->where('kp.seller_nick = :seller_nick')
                ->andWhere('kp.item_id = :item_id')
                ->andWhere('kp.sku_id = :sku_id')
                ->setParameters([
                    'seller_nick' => $sellerNick,
                    'item_id'     => $itemId,
                    'sku_id'      => $skuId,
                ])
                ->getQuery()->getOneOrNullResult();

//            if (is_null($barcode)) {
//                throw new \Exception(sprintf('快手商品信息匹配失败, 店铺:%s, itemId:%s, skuId:%s', $sellerNick, $itemId, $skuId));
//            }

            $this->_products[$hsCode] = $barcode['matched_code'] ?? '';
        }

        return $this->_products[$hsCode];
    }
}
