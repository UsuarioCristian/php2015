<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "commerce".
 *
 * @property integer $id
 * @property string $name
 * @property double $lat
 * @property double $long
 * @property integer $priority
 *
 * @property CommerceEmployee[] $commerceEmployees
 * @property Employee[] $employees
 * @property CommerceProduct[] $commerceProducts
 * @property Product[] $products
 * @property Order[] $orders
 * @property RouteCommerce[] $routeCommerces
 * @property Route[] $routes
 */
class Commerce extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'commerce';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'priority'], 'required'],
            [['lat', 'long'], 'number'],
            [['priority'], 'integer'],
            [['name'], 'string', 'max' => 40]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'lat' => Yii::t('app', 'Lat'),
            'long' => Yii::t('app', 'Long'),
            'priority' => Yii::t('app', 'Priority'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCommerceEmployees()
    {
        return $this->hasMany(CommerceEmployee::className(), ['commerce_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmployees()
    {
        return $this->hasMany(Employee::className(), ['id' => 'employee_id'])->viaTable('commerce_employee', ['commerce_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCommerceProducts()
    {
        return $this->hasMany(CommerceProduct::className(), ['commerce_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['id' => 'product_id'])->viaTable('commerce_product', ['commerce_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['commerce_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRouteCommerces()
    {
        return $this->hasMany(RouteCommerce::className(), ['commerce_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoutes()
    {
        return $this->hasMany(Route::className(), ['id' => 'route_id'])->viaTable('route_commerce', ['commerce_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return CommerceQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CommerceQuery(get_called_class());
    }
}
