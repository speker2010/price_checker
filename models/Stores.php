<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "stores".
 *
 * @property integer $id
 * @property string $name
 * @property integer $protocol
 * @property string $host
 * @property string $price_selector
 * @property string $price_old_selector
 * @property string $sale_selector
 * @property string $cookies
 * @property integer $active
 * @property string $city_selector
 *
 * @property Prices[] $prices
 * @property ProductStore[] $productStores
 */
class Stores extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'stores';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['protocol', 'active'], 'integer'],
            [['name', 'price_selector', 'price_old_selector', 'sale_selector', 'city_selector', 'cookies'], 'string', 'max' => 255],
            [['host'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'protocol' => 'Protocol',
            'host' => 'Host',
            'price_selector' => 'Price Selector',
            'price_old_selector' => 'Price Old Selector',
            'sale_selector' => 'Sale Selector',
            'cookies' => 'Cookies',
            'active' => 'Active',
            'city_selector' => 'City Selector',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrices()
    {
        return $this->hasMany(Prices::className(), ['store_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductStores()
    {
        return $this->hasMany(ProductStore::className(), ['store_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return StoresQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new StoresQuery(get_called_class());
    }
}
