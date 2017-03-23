<?php

use yii\db\Migration;

class m170323_155807_alter_tables_products_customers extends Migration
{
    public function up()
    {
        $this->addColumn('product', 'created_at', 'int(11)');
        $this->addColumn('product', 'updated_at', 'int(11)');
        $this->addColumn('customers', 'created_at', 'int(11)');
        $this->addColumn('customers', 'updated_at', 'int(11)');
    }

    public function down()
    {
        $this->dropColumn('product', 'created_at');
        $this->dropColumn('product', 'updated_at');
        $this->dropColumn('customers', 'created_at');
        $this->dropColumn('customers', 'updated_at');
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
