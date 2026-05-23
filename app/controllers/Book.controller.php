<?php

namespace App\Controllers;

use App\Models\Book;
use App\Repositories\BookRepository;
use App\Repositories\AuthorRepository;
use App\Repositories\GenreRepository;

class BookController
{
    private BookRepository $repository;

    public function __construct()
    {
        $this->repository = new BookRepository();
    }

    public function search()
    {
        $raw_q = isset($_GET['q']) ? trim($_GET['q']) : '';

        $q = strtolower($raw_q);

        $allBooks = $this->repository->getAllBooks();
        $searchResults = [];

        if (!empty($q) && !empty($allBooks)) {
            $searchSlug = str_replace(' ', '-', $q);

            $slugsList = [];
            foreach ($allBooks as $book) {
                $slugsList[] = $book->getSlug();
            }

            \App\Utils\Quicksort::stringSort($slugsList, 0, count($slugsList) - 1);

            $indexFound = \App\Utils\BinarySearch::byString($slugsList, $searchSlug);

            if ($indexFound !== -1) {
                $targetSlug = $slugsList[$indexFound];
                foreach ($allBooks as $book) {
                    if ($book->getSlug() === $targetSlug) {
                        $searchResults[] = $book;
                        break;
                    }
                }
            } else {
                foreach ($allBooks as $book) {
                    if (str_contains(strtolower($book->getName()), $q) || str_contains($book->getSlug(), $q)) {
                        $searchResults[] = $book;
                    }
                }
            }
        }

        $_REQUEST['books'] = $searchResults;

        ob_start();
        require_once __DIR__ . "/../views/books/cards.php";
        $content = ob_get_clean();
        require_once __DIR__ . "/../views/layout.php";
    }

    public function create()
    {
        $message = "";

        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $authorRepository = new AuthorRepository();
            $genreRepository = new GenreRepository();

            $name = $_POST["name"];
            $numberOfPage = $_POST["numberOfPages"];
            $price = $_POST["price"];
            $pubYear = $_POST["pubYear"];
            $description = $_POST["description"];
            $authors = $_POST["authors"];
            $genres = $_POST["genres"];

            $authors = explode(",", $authors);
            $genres = explode(",", $genres);

            $slug = strtolower($name);
            $slug = trim($slug);
            $slug = explode(" ", $name);
            $slug = implode("-", $slug);

            $book = new Book(
                $name,
                $description,
                $slug,
                $numberOfPage,
                $price,
                $pubYear
            );

            $authors = $authorRepository->createAll($authors);
            $genres = $genreRepository->createAll($genres);

            $stmt = $this->repository->createBook(
                $book,
                $authors,
                $genres
            );

            if ($stmt === false) {
                $message = "Erro ao cadastrar livro";
            } else {
                header("Location: " . BASE_URL . "/index.php?action=create:book&message=Livro cadastrado com sucesso!");
                exit();
            }
        }

        ob_start();
        require_once __DIR__ . "/../views/books/create.php";
        $_REQUEST['message'] = $message;
        $scripts = ['createBook.js'];
        $content = ob_get_clean();
        require_once __DIR__ . "/../views/layout.php";
    }

    public function books()
    {
        $limit = $_GET['l'] ?? 10;
        $offset = $_GET['o'] ?? 0;
        $books = $this->repository->getAllBooks($limit);

        $_REQUEST['books'] = $books;
        $_REQUEST['limit'] = $limit;
        $_REQUEST['offset'] = $offset;

        ob_start();
        require_once __DIR__ . "/../views/books/books.php";
        $content = ob_get_clean();
        require_once __DIR__ . "/../views/layout.php";
    }

    public function book()
    {
        $book = $this->repository->getBookBySlug($_GET['b']);

        if (!isset($book)) {
            return;
        }

        $_REQUEST['book'] = $book;

        ob_start();
        require_once __DIR__ . "/../views/books/book.php";
        $content = ob_get_clean();
        require_once __DIR__ . "/../views/layout.php";
    }

    public function cards()
    {
        $books = $this->repository->getAllBooks();

        $_REQUEST['books'] = $books;

        ob_start();
        require_once __DIR__ . "/../views/books/cards.php";
        $content = ob_get_clean();
        require_once __DIR__ . "/../views/layout.php";
    }

    public function getAll()
    {
        return $this->repository->getAllBooks();
    }

    public function getBySlug(string $slug)
    {
        return $this->repository->getBookBySlug($slug);
    }

    public function createBook(
        string $name,
        string $description,
        string $slug,
        int $number_of_pages,
        float $price,
        int $pub_year,
        array $authors,
        array $genres
    ) {
        $book = new Book(
            $name,
            $description,
            $slug,
            $number_of_pages,
            $price,
            $pub_year
        );

        return $this->repository->createBook($book, $authors, $genres);
    }

    public function update(
        int $id,
        string $name,
        string $description,
        string $slug,
        int $number_of_pages,
        float $price,
        int $pub_year,
    ) {
        $book = new Book(
            $name,
            $description,
            $slug,
            $number_of_pages,
            $price,
            $pub_year
        );

        $book->setId($id);

        return $this->repository->updateBook($book);
    }

    public function delete(int $id)
    {
        return $this->repository->deleteBook($id);
    }
}
