<?php

use yii\db\Schema;
use yii\db\Migration;

class m151118_222237_tbl_books extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%books}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'preview' => $this->string(),
            'date' => $this->dateTime(),
            'author_id' => $this->smallInteger()->notNull(),
            'created_at' => $this->integer()->notNull()->notNull(),
            'updated_at' => $this->integer()->notNull()->notNull(),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%books}}');
    }
}
