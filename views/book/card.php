<?php

/** @var Book[] $books */
$books = $_REQUEST['books'];
?>

<?php foreach ($books as $book): ?>
    <div>
        <a href="/pages/book?<?= $book->getSlug(); ?>">
            <?= $book->getName(); ?>
        </a>
        <ul>
            <li>Número de páginas: <?= $book->getNumberOfPages(); ?></li>
            <li>Preço: R$<?= $book->getFormatedPrice(); ?></li>
            <li>Ano de publicação: <?= $book->getPubYear(); ?></li>
        </ul>
    </div>
<?php endforeach ?>