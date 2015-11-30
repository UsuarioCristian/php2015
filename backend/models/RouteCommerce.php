<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "route_commerce".
 *
 * @property integer $route_id
 * @property integer $commerce_id
 * @property integer $position
 * @property integer $visited
 *
 * @property Route $route
 * @property Commerce $commerce
 */
class RouteCommerce extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'route_commerce';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['route_id', 'commerce_id', 'visited'], 'required'],
            [['route_id', 'commerce_id', 'position', 'visited'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'route_id' => Yii::t('app', 'Route ID'),
            'commerce_id' => Yii::t('app', 'Commerce ID'),
            'position' => Yii::t('app', 'Position'),
            'visited' => Yii::t('app', 'Visited'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoute()
    {
        return $this->hasOne(Route::className(), ['id' => 'route_id']);
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
     * @return RouteCommerceQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RouteCommerceQuery(get_called_class());
    }
}
