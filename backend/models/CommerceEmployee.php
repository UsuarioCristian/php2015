<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "commerce_employee".
 *
 * @property integer $commerce_id
 * @property integer $employee_id
 *
 * @property Commerce $commerce
 * @property Employee $employee
 */
class CommerceEmployee extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'commerce_employee';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['commerce_id', 'employee_id'], 'required'],
            [['commerce_id', 'employee_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'commerce_id' => Yii::t('app', 'Commerce ID'),
            'employee_id' => Yii::t('app', 'Employee ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCommerce()
    {
        return $this->hasOne(Commerce::className(), ['id' => 'commerce_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmployee()
    {
        return $this->hasOne(Employee::className(), ['id' => 'employee_id']);
    }

    /**
     * @inheritdoc
     * @return CommerceEmployeeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CommerceEmployeeQuery(get_called_class());
    }
}
