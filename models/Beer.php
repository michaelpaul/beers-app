<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "beer".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $abv
 * @property string $brewery_location
 */
class Beer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'beer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'abv'], 'required'],
            [['description', 'brewery_location'], 'string'],
            [['abv'], 'string'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'abv' => 'Abv',
            'brewery_location' => 'Brewery Location',
        ];
    }

    /**
     * {@inheritdoc}
     * @return BeerQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BeerQuery(get_called_class());
    }

    public function getAbvText()
    {
        return $this->abv . '%';
    }

    public function getBreweryLocationText()
    {
        return $this->brewery_location ? $this->brewery_location : 'Unknown';
    }

    public function fields()
    {
        return [
            'id',
            'name',
            'description',
            'abv' => 'abvText',
            'brewery_location'
        ];
    }
}
