<?php

use yii\db\Migration;

class m170323_123830_create_table_emails extends Migration
{
    public function up()
    {
        $this->createTable('emails', [
            'id' => $this->primaryKey(),
            'email' => 'string UNIQUE',
            'username' => 'string'
        ]);
    }

    public function down()
    {
        $this->dropTable('emails');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
