<?php

use App\DTOS\BookGenre;

/** @var BookGenre $book */
$book = $_REQUEST['book'];

if (!isset($book)) {
    $title = "Livro não encontrado";
    $content = "<h1>O livro solicitado não foi encontrado em nosso acervo.</h1>";
    require_once __DIR__ . "/../views/layout.php";
    return;
}
?>

<section class="container-fluid">
    <h2><?= $book->book->getName(); ?></h2>

    <p><?= $book->book->getDescription(); ?></p>

    <ul>
        <li>
            Número de páginas:
            <?= $book->book->getNumberOfPages(); ?>
        </li>

        <li>
            Preço:
            <?= $book->book->getFormatedPrice(); ?>
        </li>

        <li>
            Ano de publicação:
            <?= $book->book->getPubYear(); ?>
        </li>

        <li>
            Gêneros:
            <?= $book->genres; ?>
        </li>
    </ul>
</section>