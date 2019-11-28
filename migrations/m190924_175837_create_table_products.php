<?php

use yii\db\Migration;

/**
 * Class m190924_175837_create_table_products
 */
class m190924_175837_create_table_products extends Migration
{
    private $table = 'products';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->table, [
            'id' => $this->primaryKey(),
            'name' => $this->char(255),
            'active' => $this->boolean()
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
        echo "m190924_175837_create_table_products cannot be reverted.\n";

        return false;
    }
    */
}
