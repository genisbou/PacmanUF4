<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateConfigGameTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'auto_increment' => true,
                'unsigned'       => true,
            ],
            'usuari_id' => [
                'type'       => 'INT',
                'unsigned'   => true,
            ],
            'tema' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
                'default'    => 'light',
            ],
            'musica' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'       => true,
            ],
            'dificultat' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
                'default'    => 'normal',
            ],
            'created_at' => [
                'type'       => 'DATETIME',
                'null'         => true,
            ],
            'updated_at' => [
                'type'       => 'DATETIME',
                'null'         => true,
            ],
            'deleted_at' => [
                'type'       => 'DATETIME',
                'null'         => true,
            ]
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('usuari_id', 'usuaris', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('configGame');
    }

    public function down()
    {
        $this->forge->dropTable('configGame');
    }
}
