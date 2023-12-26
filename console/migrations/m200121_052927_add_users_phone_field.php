<?php

use yii\db\Migration;

/**
 * Class m200121_052927_add_users_phone_field
 */
class m200121_052927_add_users_phone_field extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%users}}', 'phone', $this->string()->after('username'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%users}}', 'phone');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200121_052927_add_users_phone_field cannot be reverted.\n";

        return false;
    }
    */
}
