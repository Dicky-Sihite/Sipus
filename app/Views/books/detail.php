<?= $this->extend('layouts/base') ?>

<?= $this->section('content') ?>
<div class="container">
    <!-- Back Button -->
    <div class="row mb-3">
        <div class="col-12">
            <a href="<?= base_url('/books') ?>" class="btn btn-primary">
                <i class="fas fa-arrow-left me-2"></i>
                Kembali Ke Katalog
            </a>
        </div>
    </div>

    <!-- Book Detail Header -->
    <div class="row mb-4">
        <div class="col-12">
            <h2>Detail Buku</h2>
        </div>
    </div>

    <!-- Book Detail Content -->
    <div class="row">
        <div class="col-lg-4 mb-4">
            <!-- Book Cover -->
            <div class="card">
                <div class="card-body text-center">
                    <?php if ($book['cover_image']): ?>
                        <img src="<?= base_url('uploads/covers/' . $book['cover_image']) ?>" 
                             class="img-fluid rounded" style="max-height: 400px;" 
                             alt="<?= esc($book['title']) ?>">
                    <?php else: ?>
                        <div class="bg-light d-flex align-items-center justify-content-center rounded" 
                             style="height: 300px;">
                            <i class="fas fa-book fa-4x text-muted"></i>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Available Copies -->
            <div class="card mt-3">
                <div class="card-body text-center">
                    <h6 class="card-title">Jumlah Eksemplar: <?= $book['total_copies'] ?> Buku</h6>
                    <button class="btn btn-primary w-100 mt-2" 
                            onclick="showBookLocation(<?= $book['id'] ?>)">
                        <i class="fas fa-eye me-2"></i>
                        Lihat Lokasi Buku
                    </button>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <!-- Book Information -->
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0"><?= esc($book['title']) ?></h3>
                    <p class="text-muted mb-0"><?= esc($book['author']) ?></p>
                </div>
                <div class="card-body">
                    <h5>Detail</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Pernyataan Judul</strong></td>
                                    <td>: <?= esc($book['title']) ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Nama Pengarang</strong></td>
                                    <td>: <?= esc($book['author']) ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Penerbit (Impresum)</strong></td>
                                    <td>: <?= esc($book['publisher']) ?>, <?= $book['publish_year'] ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Pernyataan Cetakan</strong></td>
                                    <td>: cet.1</td>
                                </tr>
                                <tr>
                                    <td><strong>Nomor Panggil</strong></td>
                                    <td>: <?= $book['pages'] ? $book['pages'] . ' hlm; ' : '' ?><?= $book['dewey_number'] ?? 'N/A' ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Nomor Klasifikasi Desimal Dewey (DDC)</strong></td>
                                    <td>: <?= $book['dewey_number'] ?? 'N/A' ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Deskripsi Fisik</strong></td>
                                    <td>: <?= $book['pages'] ? $book['pages'] . ' hlm' : 'N/A' ?></td>
                                </tr>
                                <tr>
                                    <td><strong>ISBN</strong></td>
                                    <td>: <?= $book['isbn'] ?? 'N/A' ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Deskripsi</strong></td>
                                    <td>: <?= $book['description'] ? esc($book['description']) : 'Tidak ada deskripsi' ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Barcode / Location Table -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Barcode / Lokasi Buku</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>No Barcode</th>
                                    <th>Data Bibliografis</th>
                                    <th>Lokasi Buku</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php for ($i = 0; $i < $book['total_copies']; $i++): ?>
                                    <tr>
                                        <td><?= $i + 1 ?></td>
                                        <td><?= $book['barcode'] ?>-<?= str_pad($i + 1, 4, '0', STR_PAD_LEFT) ?></td>
                                        <td>
                                            <strong><?= esc($book['title']) ?>/<?= esc($book['author']) ?></strong><br>
                                            <small class="text-muted">
                                                cet.1<br>
                                                <?= esc($book['publisher']) ?> : <?= esc($book['publisher']) ?><br>
                                                BADAN PENGEMBANGAN DAN PEMBINAAN BAHASA, Tahun Terbit: <?= $book['publish_year'] ?><br>
                                                <?= $book['pages'] ? $book['pages'] . ' hlm' : '' ?><br>
                                                BUKU<br>
                                                Kondisi Buku: Bagus
                                            </small>
                                        </td>
                                        <td>
                                            <strong><?= esc($book['location']) ?></strong><br>
                                            <small>Rak : -</small>
                                        </td>
                                        <td>
                                            <span class="badge <?= $book['status'] === 'Tersedia' ? 'bg-success' : ($book['status'] === 'Tidak Tersedia' ? 'bg-danger' : 'bg-warning') ?>">
                                                <?= $book['status'] ?>
                                            </span>
                                        </td>
                                    </tr>
                                <?php endfor; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination for large collections -->
                    <nav aria-label="Barcode pagination" class="mt-3">
                        <ul class="pagination justify-content-center">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" aria-label="Previous">
                                    <span aria-hidden="true">‹‹</span>
                                </a>
                            </li>
                            <li class="page-item disabled">
                                <a class="page-link" href="#" aria-label="Previous">
                                    <span aria-hidden="true">‹</span>
                                </a>
                            </li>
                            <li class="page-item active">
                                <a class="page-link" href="#">1</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">2</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">3</a>
                            </li>
                            <li class="page-item">
                                <span class="page-link">...</span>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#"><?= ceil($book['total_copies'] / 10) ?></a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Next">
                                    <span aria-hidden="true">›</span>
                                </a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Next">
                                    <span aria-hidden="true">››</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Books Section -->
    <?php if (!empty($relatedBooks)): ?>
        <div class="row mt-4">
            <div class="col-12">
                <h4>Buku Terkait</h4>
                <div class="row">
                    <?php foreach ($relatedBooks as $relatedBook): ?>
                        <div class="col-md-4 mb-3">
                            <div class="card">
                                <?php if ($relatedBook['cover_image']): ?>
                                    <img src="<?= base_url('uploads/covers/' . $relatedBook['cover_image']) ?>" 
                                         class="card-img-top book-cover" style="height: 150px;" 
                                         alt="<?= esc($relatedBook['title']) ?>">
                                <?php else: ?>
                                    <div class="bg-light d-flex align-items-center justify-content-center" 
                                         style="height: 150px;">
                                        <i class="fas fa-book fa-2x text-muted"></i>
                                    </div>
                                <?php endif; ?>
                                <div class="card-body">
                                    <h6 class="card-title"><?= esc($relatedBook['title']) ?></h6>
                                    <p class="card-text text-muted"><?= esc($relatedBook['author']) ?></p>
                                    <a href="<?= base_url('/books/detail/' . $relatedBook['id']) ?>" 
                                       class="btn btn-sm btn-outline-primary">Lihat Detail</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>
<?= $this->endSection() ?>