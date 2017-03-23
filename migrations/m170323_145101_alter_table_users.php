<?php

use yii\db\Migration;

class m170323_145101_alter_table_users extends Migration
{
    public function up()
    {
        $this->addColumn('users', 'created_at', 'int(11)');
        $this->addColumn('users', 'updated_at', 'int(11)');
    }

    public function down()
    {
        $this->dropColumn('users', 'created_at');
        $this->dropColumn('users', 'updated_at');
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
