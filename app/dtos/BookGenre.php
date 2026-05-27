<?php

namespace App\DTOS;

use App\Models\Book;

class BookGenre {
    public Book $book;
    public string $genres;

    public function __construct(Book $book, string $genres)
    {
        $this->book = $book;
        $this->genres = $genres;
    }
}