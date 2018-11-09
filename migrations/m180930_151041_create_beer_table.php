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
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('beer');
    }
}
