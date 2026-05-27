<?php

namespace Tests\Repositories;

use App\DTOS\AuthorBooks;
use App\Models\Author;
use App\Models\Book;
use App\Repositories\AuthorRepository;
use PHPUnit\Framework\TestCase;

class AuthorTestRepository extends TestCase
{
    protected AuthorRepository $repository;

    public function testGetAllAuthors()
    {
        $authors = $this->repository->getAllAuthors();

        $this->assertIsArray($authors);
        $this->assertContainsOnlyInstancesOf(Author::class, $authors);
        $this->assertNotEmpty($authors);
    }

    public function testCreateAuthor()
    {
        $author = new Author(
            'Isaac Asimov'
        );

        $result = $this->repository->createAuthor($author);

        $this->assertIsBool($result);
        $this->assertTrue($result);
    }

    public function testGetAuthorsBooks()
    {
        $authorBooks = $this->repository->getAuthorBooks(1);
        $books = $authorBooks->authorBooks;

        $this->assertInstanceOf(AuthorBooks::class, $authorBooks);
        $this->assertNotNull($authorBooks);
        $this->assertEquals('Isaac Asimov', $authorBooks->authorName);
        $this->assertContainsOnlyInstancesOf(Book::class, $books);
        $this->assertIsArray($books);
    }
}
