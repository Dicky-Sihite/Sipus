<?php

namespace App\Controllers;

use App\Models\BookModel;

class Books extends BaseController
{
    protected $bookModel;

    public function __construct()
    {
        $this->bookModel = new BookModel();
    }

    // --- Halaman Katalog ---
    public function index()
    {
        $perPage = $this->request->getGet('per_page') ?? 6;

        $books = $this->bookModel->paginate($perPage, 'default');
        $pager = $this->bookModel->pager;

        $data = [
            'title'   => 'Katalog Online - Sistem Informasi Perpustakaan',
            'books'   => $books,
            'pager'   => $pager,
            'perPage' => $perPage,
            'keyword' => null
        ];

        return view('books/catalog', $data);
    }

    // --- Detail Buku ---
    public function detail($id)
    {
        $book = $this->bookModel->find($id);

        if (!$book) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Buku tidak ditemukan');
        }

        $relatedBooks = $this->bookModel
            ->where('author', $book['author'])
            ->where('id !=', $id)
            ->limit(3)
            ->findAll();

        $data = [
            'title'        => 'Detail Buku - ' . $book['title'],
            'book'         => $book,
            'relatedBooks' => $relatedBooks
        ];

        return view('books/detail', $data);
    }

    // --- Pencarian dengan Pagination ---
    public function search()
    {
        $perPage = $this->request->getGet('per_page') ?? 6;
        $keyword = $this->request->getGet('q');

        $query = $this->bookModel;

        if ($keyword) {
            $query = $query->like('title', $keyword)
                           ->orLike('author', $keyword)
                           ->orLike('description', $keyword);
        }

        $books = $query->paginate($perPage, 'default');
        $pager = $query->pager;

        $data = [
            'title'   => $keyword ? 'Hasil Pencarian: ' . $keyword : 'Katalog Online',
            'books'   => $books,
            'pager'   => $pager,
            'perPage' => $perPage,
            'keyword' => $keyword
        ];

        return view('books/catalog', $data);
    }
}
