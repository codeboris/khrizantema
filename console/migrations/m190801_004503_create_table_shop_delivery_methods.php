<?php

use yii\db\Migration;

/**
 * Class m190801_004503_create_table_shop_delivery_methods
 */
class m190801_004503_create_table_shop_delivery_methods extends Migration
{
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable('{{%shop_delivery_methods}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'cost' => $this->integer()->notNull(),
            'min_weight' => $this->integer(),
            'max_weight' => $this->integer(),
            'sort' => $this->integer()->notNull(),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%shop_delivery_methods}}');
    }
}
