<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Commerce]].
 *
 * @see Commerce
 */
class CommerceQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Commerce[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Commerce|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}