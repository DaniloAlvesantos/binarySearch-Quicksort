<?php

use App\Models\Book;

/** @var Book $book */
    $book = $_REQUEST['book'];

    if(!isset($book)) {
        return;
    }
?>

<section class="container-fluid">
    <h2><?= $book->getName(); ?></h2>
    <p><?= $book->getDescription(); ?></p>
    <ul>
        <li>Número de páginas: <?= $book->getNumberOfPages(); ?></li>
        <li>Preço: <?= $book->getFormatedPrice(); ?></li>
        <li>Ano de publicação: <?= $book->getPubYear(); ?></li>
    </ul>
</section>