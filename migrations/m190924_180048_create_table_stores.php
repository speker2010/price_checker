<?php

use yii\db\Migration;

/**
 * Class m190924_180048_create_table_stores
 */
class m190924_180048_create_table_stores extends Migration
{
    private $table = 'stores';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->table, [
            'id' => $this->primaryKey(),
            'name' => $this->char(255),
            'protocol' => $this->integer(11),
            'host' => $this->char(50),
            'price_selector' => $this->char(255),
            'price_old_selector' => $this->char(255),
            'sale_selector' => $this->char(255),
            'active' => $this->boolean(),
            'city_selector' => $this->char(255),
            'cookies' => $this->char(255)
        ],
        'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable($this->table);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190924_180048_create_table_stores cannot be reverted.\n";

        return false;
    }
    */
}
