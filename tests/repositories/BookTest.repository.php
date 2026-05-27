<?php

namespace Tests\Repositories;

use App\DTOS\BookGenre;
use App\Models\Book;
use App\Repositories\BookRepository;
use PHPUnit\Framework\TestCase;

class BookTestRepository extends TestCase
{
    protected BookRepository $repository;

    public function testGetAllBooks()
    {
        $books = $this->repository->getAllBooks();

        $this->assertIsArray($books);
        $this->assertContainsOnlyInstancesOf(BookRepository::class, $books);
        $this->assertNotEmpty($books);
    }

    public function testCreateBook()
    {
        $book = new Book(
            'Ao cair da noite',
            'É um livro escrito por Isaac Asimov...',
            'ao-cair-da-noite',
            250,
            50.5,
            1975
        );

        $result = $this->repository->createBook($book, ['Isaac Asimov'], ['Ficção científica', 'Suspense']);

        $this->assertIsBool($result);
        $this->assertTrue($result);
    }

    public function testGetBookBySlug() 
    {
        $book = $this->repository->getBookBySlug('ao-cair-da-noite')->book;

        $this->assertInstanceOf(BookGenre::class, $book);
        $this->assertNotNull($book);
        $this->assertEquals('Ao cair da noite', $book->getName());
        $this->assertEquals('É um livro escrito por Isaac Asimov...', $book->getDescription());
        $this->assertEquals('ao-cair-da-noite', $book->getSlug());
        $this->assertEquals(250, $book->getNumberOfPages());
        $this->assertEquals(50.5, $book->getPrice());
        $this->assertEquals(1975, $book->getPubYear());
    }
}
