<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m200429_183124_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'nm' => $this->string(),
            'email' => $this->string()->unique(),
            'pass' => $this->string(),
            'photo' => $this->string()->defaultValue(null),
            'created_at' => $this->integer(),
            'city_id' => $this->integer(),
            'phone' => $this->string(),
            'about' => $this->text(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }
}
