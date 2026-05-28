<?php

namespace Tests\DTOS;

use App\DTOS\AuthorBooks;
use App\Models\Book;
use PHPUnit\Framework\TestCase;

class AuthorBooksTest extends TestCase 
{
    public function testInstanceAuthorBooks()
    {
        $authorBooks = new AuthorBooks('Isaac Asimov', [
            new Book('Ao Cair da noite', '', 'ao-cair-da-noite', 240, 50.5, 1975)
        ]);

        $this->assertIsArray($authorBooks->authorBooks);
        $this->assertIsString($authorBooks->authorName);
        $this->assertContainsOnlyInstancesOf(Book::class, $authorBooks->authorBooks);
    }
}