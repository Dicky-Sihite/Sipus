<?= $this->extend('layouts/base') ?>

<?= $this->section('content') ?>
<div class="container">
    <!-- Page Header -->
    <div class="row mb-4 align-items-center">
        <div class="col-md-6">
            <h2 class="mb-1">Katalog Online</h2>
        </div>
        <div class="col-md-6">
            <div class="search-container d-none d-md-block">
                <form action="<?= base_url('/books/search') ?>" method="GET" class="d-flex">
                    <input class="form-control me-2" type="search" name="q" placeholder="Telusuri buku..."
                           value="<?= esc($keyword ?? '') ?>">
                    <input type="hidden" name="per_page" value="<?= esc($perPage) ?>">
                    <button class="btn btn-outline-primary" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Mobile Search -->
    <div class="row mb-4 d-md-none">
        <div class="col-12">
            <form action="<?= base_url('/books/search') ?>" method="GET">
                <div class="input-group">
                    <input type="text" class="form-control" name="q" placeholder="Telusuri buku..."
                           value="<?= esc($keyword ?? '') ?>">
                    <input type="hidden" name="per_page" value="<?= esc($perPage) ?>">
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
            <form id="per-page-form" method="get" action="<?= current_url() ?>" class="d-flex align-items-center">
                <?php if (!empty($keyword)): ?>
                    <input type="hidden" name="q" value="<?= esc($keyword) ?>">
                <?php endif; ?>
                <label for="show-entries" class="me-2">Show</label>
                <select id="show-entries" name="per_page" class="form-select form-select-sm" style="width: auto;">
                    <option value="3" <?= ($perPage == 3) ? 'selected' : '' ?>>3</option>
                    <option value="6" <?= ($perPage == 6) ? 'selected' : '' ?>>6</option>
                    <option value="12" <?= ($perPage == 12) ? 'selected' : '' ?>>12</option>
                </select>
                <span class="ms-2">entries</span>
            </form>
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
                                     class="book-cover" alt="<?= esc($book['title']) ?>">
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

                            <div class="row">
                                <div class="col-6 offset-3">
                                    <a href="<?= base_url('/books/detail/' . $book['id']) ?>"
                                       class="btn btn-outline-primary btn-sm w-100">
                                        <i class="fas fa-folder-open"></i>
                                        Detail
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <!-- Pagination -->
    <?php if (isset($pager) && $pager->getPageCount() > 1): ?>
        <div class="d-flex justify-content-center">
            <?= $pager->links('default', 'bootstrap_pagination') ?>
        </div>
    <?php endif; ?>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    document.getElementById('show-entries').addEventListener('change', function () {
        document.getElementById('per-page-form').submit();
    });
</script>
<?= $this->endSection() ?>
