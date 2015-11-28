<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "commerce_product".
 *
 * @property integer $commerce_id
 * @property integer $product_id
 * @property integer $stock
 * @property integer $sold
 *
 * @property Product $product
 * @property Commerce $commerce
 */
class CommerceProduct extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'commerce_product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['commerce_id', 'product_id'], 'required'],
            [['commerce_id', 'product_id', 'stock', 'sold'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'commerce_id' => Yii::t('app', 'Commerce ID'),
            'product_id' => Yii::t('app', 'Product ID'),
            'stock' => Yii::t('app', 'Stock'),
            'sold' => Yii::t('app', 'Sold'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCommerce()
    {
        return $this->hasOne(Commerce::className(), ['id' => 'commerce_id']);
    }

    /**
     * @inheritdoc
     * @return CommerceProductQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CommerceProductQuery(get_called_class());
    }
}
