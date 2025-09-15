<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Sistem Informasi Perpustakaan' ?></title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #2563eb;
            --secondary-color: #e5e7eb;
            --card-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', sans-serif;
            background-color: #f8fafc;
        }

        .navbar-brand {
            font-weight: 600;
            color: var(--primary-color) !important;
        }

        .navbar-brand i {
            background: linear-gradient(135deg, var(--primary-color), #3b82f6);
            color: white;
            padding: 8px;
            border-radius: 8px;
            margin-right: 10px;
        }

        .search-container {
            max-width: 400px;
            margin: 0 auto;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            border-radius: 8px;
        }

        .btn-primary:hover {
            background-color: #1d4ed8;
            border-color: #1d4ed8;
        }

        .card {
            border: none;
            border-radius: 12px;
            box-shadow: var(--card-shadow);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        .book-cover {
            height: 200px;
            object-fit: cover;
            border-radius: 8px 8px 0 0;
        }

        .book-title {
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 5px;
        }

        .book-author {
            color: #6b7280;
            font-size: 0.9em;
            margin-bottom: 10px;
        }

        .book-description {
            color: #6b7280;
            font-size: 0.85em;
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .location-btn {
            background-color: var(--primary-color);
            border: none;
            border-radius: 8px;
            padding: 8px 16px;
            font-size: 0.9em;
            transition: all 0.2s;
        }

        .location-btn:hover {
            background-color: #1d4ed8;
            transform: translateY(-1px);
        }

        .pagination .page-link {
            border: none;
            color: var(--primary-color);
            margin: 0 2px;
            border-radius: 8px;
        }

        .pagination .page-item.active .page-link {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .form-control {
            border-radius: 8px;
            border: 1px solid #d1d5db;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(37, 99, 235, 0.25);
        }
    </style>
</head>
<body>
    <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-4">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center" href="<?= base_url('/books') ?>">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/b/ba/City_of_Surabaya_Logo.svg"
                        alt="Logo Surabaya"
                        style="height: 50px; margin-right: 10px;">
                    Sistem Informasi Perpustakaan
                </a>
            
            <div class="search-container d-none d-md-block">
                <form action="<?= base_url('/books/search') ?>" method="GET" class="d-flex">
                    <input class="form-control me-2" type="search" name="q" placeholder="Telusuri buku..." 
                           value="<?= esc($keyword ?? '') ?>">
                    <button class="btn btn-outline-primary" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        <?= $this->renderSection('content') ?>
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JS -->
    <script>
        // Function to show book location
        async function showBookLocation(bookId) {
            try {
                const response = await fetch(`<?= base_url('/books/location/') ?>${bookId}`);
                const data = await response.json();
                
                if (data.status === 'success') {
                    alert(`Lokasi Buku:\n${data.location}\nBarcode: ${data.barcode}`);
                } else {
                    alert('Terjadi kesalahan saat mengambil lokasi buku');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat mengambil lokasi buku');
            }
        }

        // Mobile search toggle
        function toggleMobileSearch() {
            const searchContainer = document.querySelector('.search-container');
            searchContainer.classList.toggle('d-none');
        }
    </script>

    <?= $this->renderSection('scripts') ?>
</body>
</html>