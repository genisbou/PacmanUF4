<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsuarisTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'auto_increment' => true,
                'unsigned'       => true,
            ],
            'nom_usuari' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'unique'     => true,
            ],
            'password_usuari' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'mail' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'edat' => [
                'type'       => 'INT',
            ],
            'pais' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'created_at' => [
                'type'    => 'DATETIME',
                'null'     => true,
            ],
            'updated_at' => [
                'type'    => 'DATETIME',
                'null'     => true,
            ],
            'deleted_at' => [
                'type'    => 'DATETIME',
                'null'     => true,
            ]

        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('usuaris');
    }

    public function down()
    {
        $this->forge->dropTable('usuaris');
    }
}
