<?php

use yii\db\Migration;

/**
 * Class m190813_071011_add_user_roles
 */
class m190813_071011_add_user_roles extends Migration
{
    public function safeUp()
    {
        $this->batchInsert('{{%auth_items}}', ['type', 'name', 'description'], [
            [1, 'user', 'User'],
            [1, 'admin', 'Admin'],
            [1, 'moder', 'Moderator'],
        ]);

        $this->batchInsert('{{%auth_item_children}}', ['parent', 'child'], [
            ['admin', 'user'],
            ['admin', 'moder'],
        ]);

        $this->execute('INSERT INTO {{%auth_assignments}} (item_name, user_id) SELECT \'user\', u.id FROM {{%users}} u ORDER BY u.id');
    }

    public function down()
    {
        $this->delete('{{%auth_items}}', ['name' => ['user', 'admin', 'moder']]);
    }
}
