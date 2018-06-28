<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product_store".
 *
 * @property integer $store_id
 * @property integer $product_id
 * @property string $product_uri
 * @property integer $active
 *
 * @property Stores $store
 * @property Products $product
 */
class ProductStore extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_store';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['store_id', 'product_id', 'active'], 'integer'],
            [['product_uri'], 'string', 'max' => 255],
            [['store_id'], 'exist', 'skipOnError' => true, 'targetClass' => Stores::className(), 'targetAttribute' => ['store_id' => 'id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Products::className(), 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'store_id' => 'Store ID',
            'product_id' => 'Product ID',
            'product_uri' => 'Product Uri',
            'active' => 'Active',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStore()
    {
        return $this->hasOne(Stores::className(), ['id' => 'store_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Products::className(), ['id' => 'product_id']);
    }

    /**
     * @inheritdoc
     * @return ProductStoreQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProductStoreQuery(get_called_class());
    }
}
