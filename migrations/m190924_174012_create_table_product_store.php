<?php

use yii\db\Migration;

/**
 * Class m190924_174012_create_table_product_store
 */
class m190924_174012_create_table_product_store extends Migration
{
    private $table = 'product_store';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('product_store', [
            'store_id' => $this->integer(11),
            'product_id' => $this->integer(11),
            'product_uri' => $this->char(255),
            'active' => $this->boolean(),
            'id' => $this->primaryKey()
        ],
            'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB');
        $this->createIndex('product_id',
            $this->table,
            ['product_id', 'store_id'],
            true);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('product_store');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190924_174012_create_table_product_store cannot be reverted.\n";

        return false;
    }
    */
}
