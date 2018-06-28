<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "prices".
 *
 * @property integer $id
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $price
 * @property integer $old_price
 * @property integer $is_sales
 * @property integer $http_code
 * @property string $city
 * @property integer $store_id
 * @property integer $product_id
 *
 * @property Products $product
 * @property Stores $store
 */
class Prices extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'prices';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    \yii\db\ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    \yii\db\ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                // если вместо метки времени UNIX используется datetime:
                // 'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at', 'price', 'old_price', 'is_sales', 'http_code', 'store_id', 'product_id'], 'integer'],
            [['city'], 'string', 'max' => 50],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Products::className(), 'targetAttribute' => ['product_id' => 'id']],
            [['store_id'], 'exist', 'skipOnError' => true, 'targetClass' => Stores::className(), 'targetAttribute' => ['store_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'price' => 'Price',
            'old_price' => 'Old Price',
            'is_sales' => 'Is Sales',
            'http_code' => 'Http Code',
            'city' => 'City',
            'store_id' => 'Store ID',
            'product_id' => 'Product ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Products::className(), ['id' => 'product_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStore()
    {
        return $this->hasOne(Stores::className(), ['id' => 'store_id']);
    }

    /**
     * @return string
     */
    public function getStoreName()
    {
        $store = $this->store;
        return ($store)? $store->name : '';
    }

    /**
     * @inheritdoc
     * @return PricesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PricesQuery(get_called_class());
    }
}
