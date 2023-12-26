<?php

use yii\db\Migration;

/**
 * Class m190529_025127_rename_user_table
 */
class m190529_025127_rename_user_table extends Migration
{
    public function up()
    {
        $this->renameTable('{{%user}}', '{{%users}}');
    }

    public function down()
    {
        $this->renameTable('{{%users}}', '{{%user}}');
    }
}
