<?php

use App\Models\Book;

/** @var Book[] $books */
$books = $_REQUEST['books'];
?>

<div class="row">
    <?php foreach ($books as $book): ?>
        <div class="card col-md-3 p-2 m-3">
            <div class="card-body">
                <a class="card-title h5 d-block mb-3" href="<?= BASE_URL ?>/index.php?action=book&b=<?= $book->getSlug(); ?>">
                    <?= $book->getName(); ?>
                </a>
                <ul class="list-unstyled">
                    <li><strong>Páginas:</strong> <?= $book->getNumberOfPages(); ?></li>
                    <li><strong>Preço:</strong> <?= $book->getFormatedPrice(); ?></li>
                    <li><strong>Ano:</strong> <?= $book->getPubYear(); ?></li>
                </ul>
            </div>
        </div>
    <?php endforeach ?>
</div>