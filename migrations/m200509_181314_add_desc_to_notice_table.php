<?php

use yii\db\Migration;

/**
 * Class m200509_181314_add_desc_to_notice_table
 */
class m200509_181314_add_desc_to_notice_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('notice', 'desc', $this->text());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('notice', 'desc');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200509_181314_add_desc_to_notice_table cannot be reverted.\n";

        return false;
    }
    */
}
