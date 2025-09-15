<?= $this->extend('layouts/base') ?>

<?= $this->section('content') ?>
<div class="container">
    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="mb-1">Katalog Online</h2>
            <p class="text-muted">Temukan buku yang Anda butuhkan</p>
        </div>
    </div>

    <!-- Mobile Search (visible on mobile) -->
    <div class="row mb-4 d-md-none">
        <div class="col-12">
            <form action="<?= base_url('/books/search') ?>" method="GET">
                <div class="input-group">
                    <input type="text" class="form-control" name="q" placeholder="Telusuri buku..." 
                           value="<?= esc($keyword ?? '') ?>">
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Filters -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="d-flex align-items-center">
                <label for="show-entries" class="me-2">Show</label>
                <select id="show-entries" class="form-select form-select-sm" style="width: auto;">
                    <option value="3">3</option>
                    <option value="6" selected>6</option>
                    <option value="12">12</option>
                </select>
                <span class="ms-2">entries</span>
            </div>
        </div>
    </div>

    <!-- Books Grid -->
    <div class="row" id="books-container">
        <?php if (empty($books)): ?>
            <div class="col-12">
                <div class="alert alert-info text-center">
                    <i class="fas fa-info-circle me-2"></i>
                    Tidak ada buku yang ditemukan.
                </div>
            </div>
        <?php else: ?>
            <?php foreach ($books as $index => $book): ?>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="position-relative">
                            <div class="position-absolute top-0 start-0 m-2">
                                <span class="badge bg-primary"><?= $index + 1 ?></span>
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
                            <h5 class="book-title"><?= esc($book['title']) ?></h5>
                            <p class="book-author"><?= esc($book['author']) ?></p>
                            
                            <?php if ($book['description']): ?>
                                <p class="book-description flex-grow-1">
                                    <?= esc($book['description']) ?>
                                </p>
                            <?php endif; ?>
                            
                            <div class="mt-auto">
                                <button class="btn btn-primary location-btn w-100" 
                                        onclick="showBookLocation(<?= $book['id'] ?>)">
                                    <i class="fas fa-eye me-2"></i>
                                    Lihat Lokasi Buku
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <!-- Pagination -->
    <?php if (isset($pager) && $pager->getPageCount() > 1): ?>
        <div class="row">
            <div class="col-12">
                <nav aria-label="Page navigation">
                    <div class="d-flex justify-content-center">
                        <?= $pager->links('default', 'bootstrap_pagination') ?>
                    </div>
                </nav>
            </div>
        </div>
    <?php endif; ?>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    // Handle entries per page change
    document.getElementById('show-entries').addEventListener('change', function() {
        const perPage = this.value;
        const url = new URL(window.location);
        url.searchParams.set('per_page', perPage);
        window.location.href = url.toString();
    });

    // Set current per_page value
    const urlParams = new URLSearchParams(window.location.search);
    const currentPerPage = urlParams.get('per_page');
    if (currentPerPage) {
        document.getElementById('show-entries').value = currentPerPage;
    }
</script>
<?= $this->endSection() ?>