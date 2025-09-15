<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBooksTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'barcode' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'unique'     => true, // sudah cukup, tidak perlu addKey lagi
            ],
            'title' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'author' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'publisher' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'publish_year' => [
                'type'       => 'INT',
                'constraint' => 4,
            ],
            'pages' => [
                'type'       => 'INT',
                'constraint' => 5,
            ],
            'isbn' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'dewey_number' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'cover_image' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
            'total_copies' => [
                'type'       => 'INT',
                'constraint' => 3,
                'default'    => 1,
            ],
            'available_copies' => [
                'type'       => 'INT',
                'constraint' => 3,
                'default'    => 1,
            ],
            'location' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['Tersedia', 'Tidak Tersedia', 'Rusak'],
                'default'    => 'Tersedia',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        
        $this->forge->addKey('id', true);
        $this->forge->createTable('books');
    }

    public function down()
    {
        $this->forge->dropTable('books');
    }
}