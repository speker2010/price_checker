<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use app\components\SeleniumParser;
use Yii;
use app\models\CurlWrapper;
use app\models\PhpQueryWrapper;
use app\models\Prices;
use app\models\ProductStore;
use yii\console\Controller;
use app\models\Stores;
use app\models\Products;
use yii\helpers\ArrayHelper;

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
                $prices->save();
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

        $email = ArrayHelper::getValue(Yii::$app->params, 'reports-email');
        $emailFrom = ArrayHelper::getValue(Yii::$app->params, 'from-email');
        if ($email === null || $emailFrom == null) {
            return;
        }
        $subject = 'Спарсились товары';
        Yii::$app->mailer->compose(
            'report',
            [
                'mail' => $mail,
                'raw_data' => print_r($mail, true)
            ]
        )
          ->setTo($email)
          ->setFrom([$emailFrom => 'price_checker'])
          ->setSubject($subject)
          ->send();
    }
}
