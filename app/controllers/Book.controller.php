<?php

namespace App\Controllers;

use App\Models\Book;
use App\Repositories\BookRepository;

class BookController
{
    private BookRepository $repository;

    public function __construct()
    {
        $this->repository = new BookRepository();
    }

    public function book() {
        $book = $this->repository->getBookBySlug($_GET['b']);
        
        if(!isset($book)) {
            return;
        }

        $_REQUEST['book'] = $book;

        ob_start();
        require_once __DIR__ . "/../views/books/book.php";
        $content = ob_get_clean();
        require_once __DIR__ . "/../views/layout.php";
    }

    public function cards() {
        $books = $this->repository->getAllBooks();

        $_REQUEST['books'] = $books;

        ob_start();
        require_once __DIR__ . "/../views/books/cards.php";
        $content = ob_get_clean();
        require_once __DIR__ . "/../views/layout.php";
    }

    public function getAll() {
        return $this->repository->getAllBooks();
    }

    public function getBySlug(string $slug) {
        return $this->repository->getBookBySlug($slug);
    }

    public function create(
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
    )
    {
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

    public function delete(int $id) {
        return $this->repository->deleteBook($id);
    }
}
