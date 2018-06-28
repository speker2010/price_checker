<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use Yii;
use app\models\CurlWrapper;
use app\models\PhpQueryWrapper;
use app\models\Prices;
use app\models\ProductStore;
use yii\console\Controller;
use app\models\Stores;
use app\models\Products;
/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class ParseController extends Controller
{
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     */
    public function actionIndex($message = 'hello world')
    {
        $url = 'https://technopoint.ru/product/888f427316763330/korpus-deepcool-wave-v2-cernyj-sale/?p=1&i=1';
        $city_id = 'GA1.2.1983272262.1505508796';
        $data = '_gid='.$city_id;
        $user_agent = 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36';

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_USERAGENT, $user_agent);
        //curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_COOKIE, $data);
        $page = curl_exec($curl);


        /*$url = 'https://technopoint.ru/product/8cd1841661593330/videokarta-gainward-geforce-gtx-1070-426018336-3750-sale/?p=1&i=2&f[mv]=boxh';

        $curl = curl_init($url);
        curl_setopt($curl,CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_USERAGENT, $user_agent);
        $page = curl_exec($curl);*/
        $pqu = \phpQuery::newDocumentHTML($page);
        var_dump(pq('.n-product-summary__default-offer .n-product-default-offer__price-value .price')->text());
        var_dump(pq('.b-product-card__price .b-price_old .b-price__num')->text());
        var_dump(pq('.city-select.w-choose-city-widget')->text());
        //опции curl CURLOPT_POST (bool), CURLOPT_USERAGENT(string), CURLOPT_POSTFIELDS (array|string) если array то formdata, а если urlEncode string то urlencode
        /*ini_set('user_agent','Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36');
        $url = 'https://technopoint.ru/product/8cd1841661593330/videokarta-gainward-geforce-gtx-1070-426018336-3750-sale/?p=1&i=2&f[mv]=boxh';
        $city_id = '55506b53-0565-11df-9cf0-00151716f9f5';
        ///ajax/change-city/",dataType:"json",cache:!1,data:{city_guid:a}
        $mode = 'r';
        $site = fopen($url, $mode);
        $document = stream_get_contents($site);
        $pqu = \phpQuery::newDocumentHTML($document);
        var_dump(pq('.price-block span[data-role=current-price-value]')->attr('data-price-value'));
        echo "\n";
        var_dump(pq('.price-block [data-role=previous-price-value]')->attr('data-price-value'));
        var_dump(pq('.city-select.w-choose-city-widget')->html());
        //var_dump($pqu);*/
        /*
         * dns
         * текущая цена '.price-block span[data-role=current-price-value]' ->attr('data-price-value')
         * старая цена '.price-block [data-role=previous-price-value]' ->attr('data-price-value')
         */
    }

    public function actionRegex() {
        $string = '2 444';
        $string1 = "2&nbsp;444";


        $string = mb_convert_encoding($string, 'HTML-ENTITIES', 'UTF-8');
        $string1 = mb_convert_encoding($string1, 'HTML-ENTITIES', 'UTF-8');
        var_dump(mb_ereg_replace("\D*", '', $string));
        var_dump(mb_ereg_replace("\D*", '', $string1, 'm'));
    }

    public function actionAdd() {
        $stores = [
            [
                'name' => 'citilink',
                'protocol' => '1',
                'host' => 'www.citilink.ru',
                'price_selector' => '.product-sidebar__line .price_break ins.num',
                'price_old_selector' => '.product-sidebar__line .old-price ins.num',
                'sale_selector' => '',
                'active' => true,
                'city_selector' => '.header_inner__first-floor .city.col > span'
            ],
            [
                'name' => 'dns',
                'protocol' => '1',
                'host' => 'www.dns-shop.ru',
                'price_selector' => '.price-block:eq(0) .price_g span[data-role]',
                'price_old_selector' => '.price-block:eq(0) .previous-price .prev-price-total',
                'sale_selector' => '',
                'active' => true,
                'city_selector' => '.city-select.w-choose-city-widget:eq(0)'
            ],
            [
                'name' => 'technopoint',
                'protocol' => '1',
                'host' => 'technopoint.ru',
                'price_selector' => '.price-block:eq(0) .price_g span[data-role]',
                'price_old_selector' => '.price-block:eq(0) .previous-price .prev-price-total',
                'sale_selector' => '',
                'active' => true,
                'city_selector' => '.city-select.w-choose-city-widget:eq(0)'
            ],
            [
                'name' => 'ulmart',
                'protocol' => '1',
                'host' => 'www.ulmart.ru',
                'price_selector' => '.b-product-card__price [itemprop="offers"] .b-price__num',
                'price_old_selector' => '.b-product-card__price .b-price_old .b-price__num',
                'sale_selector' => '',
                'active' => true,
                'city_selector' => '.b-page__header #load-cities'
            ],
            [
                'name' => 'yandex market',
                'protocol' => '1',
                'host' => 'market.yandex.ru',
                'price_selector' => '.n-product-summary__default-offer .n-product-default-offer__price-value .price',
                'price_old_selector' => '',
                'sale_selector' => '',
                'active' => true,
                'city_selector' => '.header2-menu__item_type_region .header2-menu__text'
            ],
        ];
        foreach ($stores as $store) {
            $model = new Stores();
            $model->scenario = 'init';
            $model->attributes = $store;
            if ($model->validate()) {
                $model->save();
            } else {
                var_dump($model->errors);
            }
        }
    }

    public function actionAddProducts() {
        $products = [
            [
                'name' => 'Видеокарта Asus GeForce GTX 1070 ROG STRIX [STRIX-GTX1070-8G-GAMING]',
                'active' => true
            ],
            [
                'name' => 'Корпус пк Zalman Z3 черный',
                'active' => true
            ]
        ];
        foreach ($products as $product) {
            $model = new Products();
            $model->attributes = $product;
            $model->save(false);
        }
    }

    public function actionAddProductStore() {
        $productStore = [
            [
                'store_id' => 27,
                'product_id' => 2,
                'product_uri' => '/product/32945f4f3a1f3120/korpus-zalman-z3-cernyj/',
                'active' => true
            ],
            [
                'store_id' => 28,
                'product_id' => 2,
                'product_uri' => '/product/32945f4f3a1f3120/korpus-zalman-z3-cernyj-sale/?p=3&i=16',
                'active' => true
            ],
            [
                'store_id' => 29,
                'product_id' => 2,
                'product_uri' => '/goods/4240002',
                'active' => true
            ],
        ]
         ;

        foreach ($productStore as $itemData) {
            $model = new ProductStore();
            $model->attributes = $itemData;
            $model->save(false);
        }
    }

    public function actionModels() {
        $products = Products::find()
            ->with('stores', 'productStores')
            ->indexBy('id')
            ->all();
        foreach ($products as $product) {
            $productStore = $product->productStores;
            foreach ($productStore as $items) {
                var_dump($items->store->name . ' ' . $items->product_uri);
            }
        }

    }

    public function actionParse()
    {
        $mail = [];
        $products = Products::find()
            ->with('stores', 'productStores')
            ->indexBy('id')
            ->all();
        foreach ($products as $product) {
            var_dump($product->name);
            $productStore = $product->productStores;
            foreach ($productStore as $items) {
                echo "--------------------step------------\n";
                echo $items->store->name;
                $curl = new CurlWrapper();
                $curl->product_uri = $items->product_uri;
                $curl->host = $items->store->host;
                $curl->protocol = $items->store->protocol;
                $curl->cookies = $items->store->cookies;
                $httpData = $curl->execute();
                $parser = new PhpQueryWrapper();
                $parser->price_selector = $items->store->price_selector;
                $parser->price_old_selector = $items->store->price_old_selector;
                $parser->city_selector = $items->store->city_selector;
                $parser->sale_selector = $items->store->sale_selector;
                $parser->page = $httpData['page'];
                $result = $parser->parse();
                $result['http_code'] = $httpData['http_code'];
                $prices = new Prices();
                $prices->attributes = $result;
                $prices->save(false);
                $prices->link('product', $product);
                $prices->link('store', $items->store);
                $result['store_name'] = $items->store->name;
                $result['product_name'] = $product->name;
                if (empty($mail[$product->name])) {
                    $mail[$product->name] = [$result['store_name']=>$result];
                } else {
                    $mail[$product->name][$result['store_name']] = $result;
                }
                var_dump($result);
            }
        }

        $email = 'speker@mail.ru';
        $subject = 'Спарсились товары';
        Yii::$app->mailer->compose(
            'report',
            [
                'mail' => $mail,
                'raw_data' => print_r($mail, true)
            ]
        )
          ->setTo($email)
          ->setFrom(['spekersoft@yandex.ru' => 'price_checker'])
          ->setSubject($subject)
          ->send();
    }
}
