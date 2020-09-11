<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%notice}}`.
 */
class m200429_174711_create_notice_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%notice}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'price' => $this->float(),
            'category_id' => $this->integer(),
            'city_id' => $this->integer(),
            'user_id' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'photo' => $this->string(),
            'status' => $this->boolean()->defaultValue( true )
        ]);

//        $this->createIndex(
//        'idx-notice-category_id',
//        'notice',
//        'category_id'
//        );
//
//        $this->addForeignKey(
//            'fk-notice-category_id',
//            'notice',
//            'category_id',
//            'category',
//            'id',
//            'CASCADE'
//        );
//
//        $this->createIndex(
//            'idx-notice-city_id',
//            'notice',
//            'city_id'
//        );
//
//        $this->addForeignKey(
//            'fk-notice-city_id',
//            'notice',
//            'city_id',
//            'city',
//            'id',
//            'CASCADE'
//        );
//
//        $this->createIndex(
//            'idx-notice-user_id',
//            'notice',
//            'user_id'
//        );
//
//        $this->addForeignKey(
//            'fk-notice-user_id',
//            'notice',
//            'user_id',
//            'user',
//            'id',
//            'CASCADE'
//        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

        $this->dropIndex(
            'idx-notice-category_id',
            'notice'
        );

        $this->dropForeignKey(
            'fk-notice-category_id',
            'notice'
        );

        $this->dropTable('{{%notice}}');
    }
}
