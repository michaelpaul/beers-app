<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Beer]].
 *
 * @see Beer
 */
class BeerQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    public function random()
    {
        return $this->orderBy('rand()')->limit(1)->one();
    }

    /**
     * {@inheritdoc}
     * @return Beer[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Beer|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
