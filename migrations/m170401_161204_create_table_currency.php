<?php

use yii\db\Migration;

class m170401_161204_create_table_currency extends Migration
{
    public function up()
    {
        $this->createTable('currency', [
            'id' => $this->primaryKey(),
            'code' => $this->string(),
            'value' => $this->string(),
            'date' => $this->integer(11),
        ]);
    }

    public function down()
    {
        $this->dropTable('currency');
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
