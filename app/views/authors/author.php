<?php

use App\DTOS\AuthorBooks;

/** @var AuthorBooks $authorBooks */
$authorBooks = $_REQUEST['authorBooks'];
$books = $authorBooks->authorBooks;
?>

<section class="container-fluid">
    <h2><?= $authorBooks->authorName; ?></h2>
    <ul>
        <?php foreach ($books as $book): ?>
            <li><a href="<?= BASE_URL ?>/index.php?action=book&b=<?= $book->getSlug(); ?>"><?= $book->getName() ?></a></li>
        <?php endforeach ?>
    </ul>
</section>