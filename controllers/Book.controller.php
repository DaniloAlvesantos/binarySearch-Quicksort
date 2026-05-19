<?php

require_once __DIR__ . "/../models/Book.php";
require_once __DIR__ . "/../repositories/Book.repository.php";

class BookController
{
    private BookRepository $repository;

    public function __construct()
    {
        $this->repository = new BookRepository();
    }

    public function cards() {
        $books = $this->repository->getAllBooks();

        $_REQUEST['books'] = $books;

        require_once __DIR__ . "/../views/book/card.php";
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
