<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BookSeeder extends Seeder
{
    public function run()
    {
        // Sample book data based on the images you provided
        $books = [
            [
                'barcode' => '254850-5-2025',
                'title' => 'KISAH KERAJAAN GOWA',
                'author' => 'FEBYASTI DAVELA RAMADINI',
                'publisher' => 'KOTA JAKARTA TIMUR: KEMENTERIAN PENDIDIKAN DASAR DAN MENENGAH BADAN PENGEMBANGAN DAN PEMBINAAN BAHASA',
                'publish_year' => 2025,
                'pages' => 30,
                'isbn' => '978-623-307-859-7',
                'dewey_number' => '741.559 8',
                'description' => 'kerajaan gowa adalah salah satu kerajaan maritim terbesar di nusantara',
                'cover_image' => 'kisah_gowa.png',
                'total_copies' => 25,
                'available_copies' => 23,
                'location' => 'RUSUN DUKUH MENANGGAL',
                'status' => 'Tersedia'
            ],
            [
                'barcode' => '254850-3-2025',
                'title' => 'KISAH KERAJAAN GOWA',
                'author' => 'FEBYASTI DAVELA RAMADINI',
                'publisher' => 'KOTA JAKARTA TIMUR: KEMENTERIAN PENDIDIKAN DASAR DAN MENENGAH BADAN PENGEMBANGAN DAN PEMBINAAN BAHASA',
                'publish_year' => 2025,
                'pages' => 30,
                'isbn' => '978-623-307-859-7',
                'dewey_number' => '741.559 8',
                'description' => 'kerajaan gowa adalah salah satu kerajaan maritim terbesar di nusantara',
                'cover_image' => 'dummy.png',
                'total_copies' => 15,
                'available_copies' => 12,
                'location' => 'TBM RW 8 PUTAT JAYA',
                'status' => 'Tersedia'
            ],
            [
                'barcode' => '254850-2-2025',
                'title' => 'KISAH KERAJAAN GOWA',
                'author' => 'FEBYASTI DAVELA RAMADINI',
                'publisher' => 'KOTA JAKARTA TIMUR: KEMENTERIAN PENDIDIKAN DASAR DAN MENENGAH BADAN PENGEMBANGAN DAN PEMBINAAN BAHASA',
                'publish_year' => 2025,
                'pages' => 30,
                'isbn' => '978-623-307-859-7',
                'dewey_number' => '741.559 8',
                'description' => 'kerajaan gowa adalah salah satu kerajaan maritim terbesar di nusantara',
                'cover_image' => 'dummy1.png',
                'total_copies' => 10,
                'available_copies' => 8,
                'location' => 'TBM RW 9 PAKIS',
                'status' => 'Tidak Tersedia'
            ],
            [
                'barcode' => '300450-1-2025',
                'title' => 'PANGSUMA',
                'author' => 'YENI YULIANTI',
                'publisher' => 'JAKARTA: BALAI PUSTAKA',
                'publish_year' => 2024,
                'pages' => 150,
                'isbn' => '978-623-001-234-5',
                'dewey_number' => '899.221 3',
                'description' => 'banyak pahlawan yang tak pernah disebut dalam perjuangan-perjuangan walau di daerah asalnya ia sangat dihormati hingga dijadikan nama tempat yang penting di ibukota provinsi',
                'cover_image' => 'dummy.png',
                'total_copies' => 20,
                'available_copies' => 18,
                'location' => 'PERPUSTAKAAN UMUM SURABAYA',
                'status' => 'Tersedia'
            ],
            [
                'barcode' => '300450-2-2025',
                'title' => 'PANGSUMA',
                'author' => 'YENI YULIANTI',
                'publisher' => 'JAKARTA: BALAI PUSTAKA',
                'publish_year' => 2024,
                'pages' => 150,
                'isbn' => '978-623-001-234-5',
                'dewey_number' => '899.221 3',
                'description' => 'banyak pahlawan yang tak pernah disebut dalam perjuangan-perjuangan walau di daerah asalnya ia sangat dihormati hingga dijadikan nama tempat yang penting di ibukota provinsi',
                'cover_image' => 'dummy3.png',
                'total_copies' => 12,
                'available_copies' => 10,
                'location' => 'PERPUSTAKAAN DAERAH JAWA TIMUR',
                'status' => 'Tersedia'
            ],
            [
                'barcode' => '400750-1-2025',
                'title' => 'MAX HAVELAAR JILID 2',
                'author' => 'DEWI NASTITI',
                'publisher' => 'JAKARTA: GRAMEDIA PUSTAKA UTAMA',
                'publish_year' => 2023,
                'pages' => 280,
                'isbn' => '978-602-03-9876-1',
                'dewey_number' => '899.221 5',
                'description' => 'sebelum havelaar ditugaskan di lebak, ada asisten residen sebelumnya. slotering yang juga bertugas mengawal jalannya pemerintahan yang dikehendaki oleh seorang bupati',
                'cover_image' => 'dummy4.png',
                'total_copies' => 8,
                'available_copies' => 6,
                'location' => 'PERPUSTAKAAN KOTA SURABAYA',
                'status' => 'Tersedia'
            ],
            [
                'barcode' => '400750-2-2025',
                'title' => 'MAX HAVELAAR JILID 2',
                'author' => 'DEWI NASTITI',
                'publisher' => 'JAKARTA: GRAMEDIA PUSTAKA UTAMA',
                'publish_year' => 2023,
                'pages' => 280,
                'isbn' => '978-602-03-9876-1',
                'dewey_number' => '899.221 5',
                'description' => 'sebelum havelaar ditugaskan di lebak, ada asisten residen sebelumnya. slotering yang juga bertugas mengawal jalannya pemerintahan yang dikehendaki oleh seorang bupati',
                'cover_image' => null,
                'total_copies' => 5,
                'available_copies' => 3,
                'location' => 'TBM KELURAHAN GUBENG',
                'status' => 'Tersedia'
            ],
            [
                'barcode' => '500850-1-2025',
                'title' => 'SEJARAH NUSANTARA',
                'author' => 'AHMAD WIJAYA',
                'publisher' => 'BANDUNG: MIZAN PUSTAKA',
                'publish_year' => 2024,
                'pages' => 320,
                'isbn' => '978-623-456-789-0',
                'dewey_number' => '959.8 W',
                'description' => 'Perjalanan panjang sejarah kepulauan nusantara dari masa kerajaan hingga kemerdekaan Indonesia',
                'cover_image' => null,
                'total_copies' => 15,
                'available_copies' => 12,
                'location' => 'PERPUSTAKAAN UNIVERSITAS AIRLANGGA',
                'status' => 'Tersedia'
            ],
            [
                'barcode' => '600750-1-2025',
                'title' => 'BUDAYA JAWA TIMUR',
                'author' => 'SITI NURHALIZA',
                'publisher' => 'SURABAYA: PENERBIT JAWA TIMUR',
                'publish_year' => 2024,
                'pages' => 200,
                'isbn' => '978-623-789-012-3',
                'dewey_number' => '394.09598 N',
                'description' => 'Eksplorasi mendalam tentang kekayaan budaya Jawa Timur dari tradisi hingga modernitas',
                'cover_image' => null,
                'total_copies' => 18,
                'available_copies' => 15,
                'location' => 'PERPUSTAKAAN DAERAH JAWA TIMUR',
                'status' => 'Tersedia'
            ]
        ];

        // Insert data into books table
        $this->db->table('books')->insertBatch($books);
    }
}