<?php

namespace Tests\DTOS;

use App\DTOS\BookGenre;
use App\Models\Book;
use PHPUnit\Framework\TestCase;

class BookGenreTest extends TestCase
{
    public function testInstanceBookGenre()
    {
        $bookGenre = new BookGenre(new Book('Ao Cair da noite', '', 'ao-cair-da-noite', 240, 50.5, 1975), 'Ficção Cientifica, Suspense');

        $this->assertIsString($bookGenre->genres);
        $this->assertInstanceOf(Book::class, $bookGenre->book);
    }
}
