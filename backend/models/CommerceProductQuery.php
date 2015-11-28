<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[CommerceProduct]].
 *
 * @see CommerceProduct
 */
class CommerceProductQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return CommerceProduct[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return CommerceProduct|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}