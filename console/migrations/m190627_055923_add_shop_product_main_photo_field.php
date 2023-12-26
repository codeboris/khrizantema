<?php

use yii\db\Migration;

/**
 * Class m190627_055923_add_shop_product_main_photo_field
 */
class m190627_055923_add_shop_product_main_photo_field extends Migration
{
    public function up()
    {
        $this->addColumn('{{%shop_products}}', 'main_photo_id', $this->integer());
        $this->createIndex('{{%idx-shop_products-main_photo_id}}', '{{%shop_products}}', 'main_photo_id');
        $this->addForeignKey('{{%fk-shop_products-main_photo_id}}', '{{%shop_products}}', 'main_photo_id', '{{%shop_photos}}', 'id', 'SET NULL', 'RESTRICT');
    }

    public function down()
    {
        $this->dropForeignKey('{{%fk-shop_products-main_photo_id}}', '{{%shop_products}}');
        $this->dropColumn('{{%shop_products}}', 'main_photo_id');
    }


}
