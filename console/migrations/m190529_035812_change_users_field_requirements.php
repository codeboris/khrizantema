<?php

use yii\db\Migration;

/**
 * Class m190529_035812_change_users_field_requirements
 */
class m190529_035812_change_users_field_requirements extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function Up()
    {
        $this->alterColumn('{{%users}}', 'username', $this->string()->unique());
        $this->alterColumn('{{%users}}', 'password_hash', $this->string());
        $this->alterColumn('{{%users}}', 'email', $this->string()->unique());

    }

    public function Down()
    {
        $this->alterColumn('{{%users}}', 'username', $this->string()->notNull()->unique());
        $this->alterColumn('{{%users}}', 'password_hash', $this->string()->notNull());
        $this->alterColumn('{{%users}}', 'email', $this->string()->notNull()->unique());
    }

}
