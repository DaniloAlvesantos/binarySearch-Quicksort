<?php

use App\Models\Book;

/** @var Book $book */
$book = $_REQUEST['book'];

if (!isset($book)) {
    $title = "Livro não encontrado";
    $content = "<h1>O livro solicitado não foi encontrado em nosso acervo.</h1>";
    require_once __DIR__ . "/../views/layout.php";
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