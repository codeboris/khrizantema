<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%shop_orders}}`.
 */
class m190801_023348_create_shop_orders_table extends Migration
{
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable('{{%shop_orders}}', [
            'id' => $this->primaryKey(),
            'created_at' => $this->integer()->notNull(),
            'user_id' => $this->integer(),
            //'delivery_method_id' => $this->integer(),
            //'delivery_method_name' => $this->string()->notNull(),
            //'delivery_cost' => $this->integer()->notNull(),
            'payment_method' => $this->string(),
            'cost' => $this->integer()->notNull(),
            'note' => $this->text(),
            'current_status' => $this->integer()->notNull(),
            'cancel_reason' => $this->text(),
            'statuses_json' => 'JSON NOT NULL',
            'customer_phone' => $this->string(),
            'customer_name' => $this->string(),
            'recipient_phone' => $this->string(),
            'recipient_name' => $this->string(),
            'recipient_address' => $this->text(),
            'delivery_datetime' => $this->integer(),
            'updated_at' => $this->integer(),
            //'delivery_index' => $this->string(),
            //'delivery_address' => $this->text(),
        ], $tableOptions);

        $this->createIndex('{{%idx-shop_orders-user_id}}', '{{%shop_orders}}', 'user_id');
        //$this->createIndex('{{%idx-shop_orders-delivery_method_id}}', '{{%shop_orders}}', 'delivery_method_id');
        $this->addForeignKey('{{%fk-shop_orders-user_id}}', '{{%shop_orders}}', 'user_id', '{{%users}}', 'id', 'CASCADE');
        //$this->addForeignKey('{{%fk-shop_orders-delivery_method_id}}', '{{%shop_orders}}', 'delivery_method_id', '{{%shop_delivery_methods}}', 'id', 'SET NULL');
    }

    public function down()
    {
        $this->dropTable('{{%shop_orders}}');
    }
}