<?php

/** @var Book[] $books */
$books = $_REQUEST['books'];
?>

<?php foreach ($books as $book): ?>
    <div class="card w-25 p-2 m-4">
        <a class="card-title" href="/views/books/book.php?b=<?= $book->getSlug(); ?>">
            <?= $book->getName(); ?>
        </a>
        <ul>
            <li>Número de páginas: <?= $book->getNumberOfPages(); ?></li>
            <li>Preço: <?= $book->getFormatedPrice(); ?></li>
            <li>Ano de publicação: <?= $book->getPubYear(); ?></li>
        </ul>
    </div>
<?php endforeach ?>