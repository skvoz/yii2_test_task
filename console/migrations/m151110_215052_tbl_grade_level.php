<?php

use yii\db\Schema;
use yii\db\Migration;

class m151110_215052_tbl_grade_level extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('grade_level', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->unique(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->insert('grade_level', [
            'id'=>1,'name' => 'level 1',
        ]);
        $this->insert('grade_level', [
            'id'=>2,'name' => 'level 2',
        ]);
        $this->insert('grade_level', [
            'id'=> 3, 'name' => 'level 3'
        ]);
    }

    public function down()
    {
        $this->dropTable('grade_level');
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
