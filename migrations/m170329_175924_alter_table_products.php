<?php

use yii\db\Migration;

class m170329_175924_alter_table_products extends Migration
{
    public function up()
    {
        $this->addColumn('product', 'image', 'string');
    }

    public function down()
    {
        $this->dropColumn('product', 'image');
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
