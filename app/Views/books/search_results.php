<?= $this->extend('layouts/base') ?>

<?= $this->section('content') ?>
<div class="container">
    <!-- Back Button -->
    <div class="row mb-3">
        <div class="col-12">
            <a href="<?= base_url('/books') ?>" class="btn btn-outline-primary">
                <i class="fas fa-arrow-left me-2"></i>
                Kembali Ke Katalog
            </a>
        </div>
    </div>

    <!-- Search Results Header -->
    <div class="row mb-4">
        <div class="col-12">
            <h2>Hasil Pencarian</h2>
            <p class="text-muted">
                <?php if (!empty($books)): ?>
                    Menampilkan <?= count($books) ?> hasil untuk "<?= esc($keyword) ?>"
                <?php else: ?>
                    Tidak ada hasil ditemukan untuk "<?= esc($keyword) ?>"
                <?php endif; ?>
            </p>
        </div>
    </div>

    <!-- Search Again -->
    <div class="row mb-4">
        <div class="col-md-6">
            <form action="<?= base_url('/books/search') ?>" method="GET">
                <div class="input-group">
                    <input type="text" class="form-control" name="q" placeholder="Cari lagi..." 
                           value="<?= esc($keyword) ?>">
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-search"></i> Cari
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Search Results -->
    <div class="row">
        <?php if (empty($books)): ?>
            <div class="col-12">
                <div class="card">
                    <div class="card-body text-center py-5">
                        <i class="fas fa-search fa-3x text-muted mb-3"></i>
                        <h4>Tidak Ada Hasil Ditemukan</h4>
                        <p class="text-muted mb-4">
                            Maaf, tidak ada buku yang cocok dengan pencarian "<?= esc($keyword) ?>"
                        </p>
                        <div>
                            <h6>Tips Pencarian:</h6>
                            <ul class="list-unstyled text-start" style="max-width: 400px; margin: 0 auto;">
                                <li><i class="fas fa-check-circle text-success me-2"></i>Periksa ejaan kata kunci</li>
                                <li><i class="fas fa-check-circle text-success me-2"></i>Gunakan kata kunci yang lebih umum</li>
                                <li><i class="fas fa-check-circle text-success me-2"></i>Coba cari berdasarkan nama pengarang</li>
                                <li><i class="fas fa-check-circle text-success me-2"></i>Gunakan kata kunci yang lebih pendek</li>
                            </ul>
                        </div>
                        <a href="<?= base_url('/books') ?>" class="btn btn-primary mt-3">
                            <i class="fas fa-arrow-left me-2"></i>Kembali ke Katalog
                        </a>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <?php foreach ($books as $index => $book): ?>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="position-relative">
                            <div class="position-absolute top-0 start-0 m-2">
                                <span class="badge bg-success"><?= $index + 1 ?></span>
                            </div>
                            <?php if ($book['cover_image']): ?>
                                <img src="<?= base_url('uploads/covers/' . $book['cover_image']) ?>" 
                                     class="card-img-top book-cover" alt="<?= esc($book['title']) ?>">
                            <?php else: ?>
                                <div class="book-cover bg-light d-flex align-items-center justify-content-center">
                                    <i class="fas fa-book fa-3x text-muted"></i>
                                </div>
                            <?php endif; ?>
                        </div>
                        
                        <div class="card-body d-flex flex-column">
                            <h5 class="book-title">
                                <?= highlightSearchTerm(esc($book['title']), $keyword) ?>
                            </h5>
                            <p class="book-author">
                                <?= highlightSearchTerm(esc($book['author']), $keyword) ?>
                            </p>
                            
                            <?php if ($book['description']): ?>
                                <p class="book-description flex-grow-1">
                                    <?= highlightSearchTerm(esc($book['description']), $keyword) ?>
                                </p>
                            <?php endif; ?>
                            
                            <div class="mt-auto">
                                <div class="row">
                                    <div class="col-6">
                                        <button class="btn btn-primary btn-sm w-100" 
                                                onclick="showBookLocation(<?= $book['id'] ?>)">
                                            <i class="fas fa-map-marker-alt me-1"></i>
                                            Lokasi
                                        </button>
                                    </div>
                                    <div class="col-6">
                                        <a href="<?= base_url('/books/detail/' . $book['id']) ?>" 
                                           class="btn btn-outline-primary btn-sm w-100">
                                            <i class="fas fa-info-circle me-1"></i>
                                            Detail
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <!-- Popular Searches or Suggestions -->
    <?php if (empty($books)): ?>
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Mungkin Anda Tertarik</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex flex-wrap gap-2">
                            <a href="<?= base_url('/books/search?q=gowa') ?>" class="btn btn-outline-secondary btn-sm">Gowa</a>
                            <a href="<?= base_url('/books/search?q=pangsuma') ?>" class="btn btn-outline-secondary btn-sm">Pangsuma</a>
                            <a href="<?= base_url('/books/search?q=havelaar') ?>" class="btn btn-outline-secondary btn-sm">Max Havelaar</a>
                            <a href="<?= base_url('/books/search?q=sejarah') ?>" class="btn btn-outline-secondary btn-sm">Sejarah</a>
                            <a href="<?= base_url('/books/search?q=novel') ?>" class="btn btn-outline-secondary btn-sm">Novel</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    // Highlight search terms in results
    function highlightSearchTerm(text, term) {
        if (!term) return text;
        
        const regex = new RegExp(`(${term})`, 'gi');
        return text.replace(regex, '<mark class="bg-warning">$1</mark>');
    }
</script>
<?= $this->endSection() ?>

<?php
// Helper function for highlighting search terms
function highlightSearchTerm($text, $term) {
    if (!$term) return $text;
    
    $highlighted = preg_replace('/(' . preg_quote($term, '/') . ')/i', '<mark class="bg-warning">$1</mark>', $text);
    return $highlighted;
}
?>