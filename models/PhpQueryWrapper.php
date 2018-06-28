<?php

namespace app\models;

use Yii;
use yii\base\Model;
use PhpQuery\PhpQuery;

/**
 * ContactForm is the model behind the contact form.
 */
class PhpQueryWrapper extends Model
{
    public $page;
    public $price_selector;
    public $price_old_selector;
    public $sale_selector;
    public $city_selector;
    public $ip_selector;

    public function parse()
    {
        /*
         * todo: Сделать проверку на акции
         */
        $pqu = \phpQuery::newDocumentHTML($this->page);
        $result = [];
        $result['price_raw'] = ($this->price_selector)? pq($this->price_selector)->text(): '';
        $result['old_price_raw'] = ($this->price_old_selector)? pq($this->price_old_selector)->text(): '';
        $result['city'] = trim(($this->city_selector) ? pq($this->city_selector)->text(): '');
        $result['price'] = $this->prepareNum($result['price_raw']);
        $result['old_price'] = $this->prepareNum($result['old_price_raw']);
        var_dump($this->price_selector);
        var_dump($this->price_old_selector);
        var_dump($this->city_selector);
        return $result;
    }

    public function parseIp()
    {
        $pqu = \phpQuery::newDocumentHTML($this->page);
        $result = '';
        $result = pq($this->ip_selector)->text();
        return $result;
    }

    private function prepareNum($string)
    {
        $result = trim($string);
        $result = mb_ereg_replace("\D*", '', $result);
        $result = (int)$result;
        return $result;
    }
}
