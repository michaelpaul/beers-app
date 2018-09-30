<?php

use yii\db\Migration;

/**
 * Handles the creation of table `beer`.
 */
class m180930_151041_create_beer_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('beer', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'description' => $this->text(),
            'abv' => $this->decimal(5, 2)->notNull(),
            'brewery_location' => $this->text(),
        ]);

        $this->batchInsert('beer', ['name', 'description', 'abv', 'brewery_location'], [
            ['Guinness', 'With deep, dark and satisfying flavors and distinctly smooth aromas, the three varieties of Guinness brews are undoubtedly among the most popular Irish beers, especially in the US.', '4.2', 'Ireland, Dublin'],
            ['Smithwick’s Irish Ale', 'Often referred to as “Smitticks”, Smithwick’s captures a unique flavour that combines its hops with sweet aromatic fruits and deep malt, coffee and roasted barley notes.', '4.5', 'Ireland, Kilkenny'],
            ['Brahma', 'Brahma is internationally recognized as an excellent beer. It is lighter than average pilsen beer, with the classic mouth feel of a lager beer, strong body flavour, neutral aroma, less accentuated bitterness level and medium alcoholic content.', '4.3', 'Brazil'],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('beer');
    }
}
