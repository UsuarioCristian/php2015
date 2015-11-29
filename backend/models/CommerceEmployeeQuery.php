<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[CommerceEmployee]].
 *
 * @see CommerceEmployee
 */
class CommerceEmployeeQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return CommerceEmployee[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return CommerceEmployee|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}