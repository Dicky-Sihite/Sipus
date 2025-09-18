<?php
/**
 * Bootstrap 5 Pagination Template for CodeIgniter 4
 * Place this file in app/Views/Pagers/bootstrap_pagination.php
 */

$pager->setSurroundCount(2);

// Ambil semua query string saat ini
$request = service('request');
$query   = $request->getGet();

/**
 * Append query params ke $uri tanpa duplikasi
 */
function append_query(string $uri, array $query): string
{
    $uriQuery = [];
    $parsedQuery = parse_url($uri, PHP_URL_QUERY);

    if ($parsedQuery) {
        parse_str($parsedQuery, $uriQuery);

        // hapus dari $query setiap kunci yang SUDAH ada di $uri
        foreach (array_keys($uriQuery) as $key) {
            if (isset($query[$key])) {
                unset($query[$key]);
            }
        }
    }

    if (empty($query)) {
        return $uri;
    }

    $delimiter = $parsedQuery ? '&' : '?';
    return $uri . $delimiter . http_build_query($query);
}
?>

<?php if (count($pager->links()) > 1) : ?>
<nav aria-label="<?= lang('Pager.pageNavigation') ?>" class="mb-3">
    <ul class="pagination justify-content-center">

        <!-- First & Previous -->
        <?php if ($pager->hasPrevious()) : ?>
            <li class="page-item">
                <a class="page-link" href="<?= append_query($pager->getFirst(), $query) ?>" aria-label="<?= lang('Pager.first') ?>">
                    ‹‹
                </a>
            </li>
            <li class="page-item">
                <a class="page-link" href="<?= append_query($pager->getPrevious(), $query) ?>" aria-label="<?= lang('Pager.previous') ?>">
                    ‹
                </a>
            </li>
        <?php else : ?>
            <li class="page-item disabled"><span class="page-link">‹‹</span></li>
            <li class="page-item disabled"><span class="page-link">‹</span></li>
        <?php endif ?>

        <!-- Numbered Links -->
        <?php foreach ($pager->links() as $link) : ?>
            <?php if ($link['active']) : ?>
                <li class="page-item active" aria-current="page">
                    <span class="page-link"><?= $link['title'] ?></span>
                </li>
            <?php else : ?>
                <li class="page-item">
                    <a class="page-link" href="<?= append_query($link['uri'], $query) ?>"><?= $link['title'] ?></a>
                </li>
            <?php endif ?>
        <?php endforeach ?>

        <!-- Next & Last -->
        <?php if ($pager->hasNext()) : ?>
            <li class="page-item">
                <a class="page-link" href="<?= append_query($pager->getNext(), $query) ?>" aria-label="<?= lang('Pager.next') ?>">
                    ›
                </a>
            </li>
            <li class="page-item">
                <a class="page-link" href="<?= append_query($pager->getLast(), $query) ?>" aria-label="<?= lang('Pager.last') ?>">
                    ››
                </a>
            </li>
        <?php else : ?>
            <li class="page-item disabled"><span class="page-link">›</span></li>
            <li class="page-item disabled"><span class="page-link">››</span></li>
        <?php endif ?>

    </ul>
</nav>
<?php endif ?>
