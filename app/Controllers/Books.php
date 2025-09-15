<?php

namespace App\Controllers;

use App\Models\BookModel;
use CodeIgniter\Controller;

class Books extends BaseController
{
    protected $bookModel;

    public function __construct()
    {
        $this->bookModel = new BookModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Katalog Online - Sistem Informasi Perpustakaan',
            'books' => $this->bookModel->paginate(6),
            'pager' => $this->bookModel->pager
        ];

        return view('books/catalog', $data);
    }

    public function detail($id)
    {
        $book = $this->bookModel->find($id);
        
        if (!$book) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Buku tidak ditemukan');
        }

        // Get related books (same author or similar)
        $relatedBooks = $this->bookModel->where('author', $book['author'])
                                       ->where('id !=', $id)
                                       ->limit(3)
                                       ->findAll();

        $data = [
            'title' => 'Detail Buku - ' . $book['title'],
            'book' => $book,
            'relatedBooks' => $relatedBooks
        ];

        return view('books/detail', $data);
    }

    public function search()
    {
        $keyword = $this->request->getGet('q');
        
        if (!$keyword) {
            return redirect()->to('/books');
        }

        $books = $this->bookModel->search($keyword);

        $data = [
            'title' => 'Hasil Pencarian: ' . $keyword,
            'books' => $books,
            'keyword' => $keyword
        ];

        return view('books/search_results', $data);
    }

    public function location($bookId)
    {
        $book = $this->bookModel->find($bookId);
        
        if (!$book) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Buku tidak ditemukan']);
        }

        return $this->response->setJSON([
            'status' => 'success',
            'location' => $book['location'],
            'barcode' => $book['barcode']
        ]);
    }
}