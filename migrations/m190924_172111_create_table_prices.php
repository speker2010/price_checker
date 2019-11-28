<?php

use yii\db\Migration;

/**
 * Class m190924_172111_create_table_prices
 */
class m190924_172111_create_table_prices extends Migration
{
    private $table = 'prices';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->table, [
            'id' => $this->primaryKey(),
            'created_at' => $this->integer(11),
            'updated_at' => $this->integer(11),
            'price' => $this->integer(11),
            'old_price' => $this->integer(11),
            'is_sales' => $this->tinyInteger(1),
            'http_code' => $this->integer(11),
            'city' => $this->char(50),
            'store_id' => $this->integer(11),
            'product_id' => $this->integer(11)
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
        echo "m190924_172111_create_table_prices cannot be reverted.\n";

        return false;
    }
    */
}
