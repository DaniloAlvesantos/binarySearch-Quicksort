<?php

namespace App\DTOS;

use App\Models\Book;

class AuthorBooks
{
    public string $authorName;
    /** @var Book[] $authorBooks */
    public array $authorBooks;

    public function __construct(string $authorName, array $authorBooks)
    {
        $this->authorName = $authorName;
        $this->authorBooks = $authorBooks;
    }
}
