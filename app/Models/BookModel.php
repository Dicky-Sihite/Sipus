<?php

namespace App\Models;

use CodeIgniter\Model;

class BookModel extends Model
{
    protected $table            = 'books';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'barcode',
        'title',
        'author',
        'publisher',
        'publish_year',
        'pages',
        'isbn',
        'dewey_number',
        'description',
        'cover_image',
        'total_copies',
        'available_copies',
        'location',
        'status'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation
    protected $validationRules      = [
        'barcode' => 'required|is_unique[books.barcode]',
        'title'   => 'required|max_length[255]',
        'author'  => 'required|max_length[255]',
    ];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function search($keyword)
    {
        return $this->like('title', $keyword)
                    ->orLike('author', $keyword)
                    ->orLike('barcode', $keyword)
                    ->orLike('description', $keyword)
                    ->findAll();
    }

    public function getAvailableBooks()
    {
        return $this->where('status', 'Tersedia')->findAll();
    }

    public function getBooksByLocation($location)
    {
        return $this->where('location', $location)->findAll();
    }
}