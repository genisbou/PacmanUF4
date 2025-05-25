<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePartidesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'usuari_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => false,
            ],
            'data datetime default current_timestamp',
            'guanyat' => [
                'type' => 'BOOLEAN',
                'default' => false,
            ],
            'punts' => [
                'type' => 'INT',
                'default' => 0,
            ],
            'durada' => [
                'type' => 'INT',
                'default' => 0,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('usuari_id', 'usuaris', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('partides');

    }

    public function down()
    {
        $this->forge->dropTable('partides');
    }
}
