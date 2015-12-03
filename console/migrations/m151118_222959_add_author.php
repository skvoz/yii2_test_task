<?php

use yii\db\Schema;
use yii\db\Migration;

class m151118_222959_add_author extends Migration
{
    public function up()
    {
        $this->insert('author', [
            'firstname' => 'Vasiliy',
            'lastname' => 'Federov'
        ]);

        $this->insert('author', [
            'firstname' => 'Fedor',
            'lastname' => 'Vasilev'
        ]);

        $this->insert('author', [
            'firstname' => 'Petr',
            'lastname' => 'Nikolaev'
        ]);
    }

    public function down()
    {
        $this->delete('author');
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
