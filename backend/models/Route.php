<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "route".
 *
 * @property integer $id
 * @property integer $employee_id
 * @property string $date
 *
 * @property Employee $employee
 * @property RouteCommerce[] $routeCommerces
 * @property Commerce[] $commerces
 */
class Route extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'route';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['employee_id'], 'required'],
            [['employee_id'], 'integer'],
            [['date'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'employee_id' => Yii::t('app', 'Employee ID'),
            'date' => Yii::t('app', 'Date'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmployee()
    {
        return $this->hasOne(Employee::className(), ['id' => 'employee_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRouteCommerces()
    {
        return $this->hasMany(RouteCommerce::className(), ['route_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCommerces()
    {
        return $this->hasMany(Commerce::className(), ['id' => 'commerce_id'])->viaTable('route_commerce', ['route_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return RouteQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RouteQuery(get_called_class());
    }
}
