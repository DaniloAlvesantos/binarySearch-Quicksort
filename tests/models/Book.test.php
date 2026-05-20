<?php

namespace Tests\Models;

use PHPUnit\Framework\TestCase;
use App\Models\Book;

class BookTest extends TestCase { 
    public function instanceBook() {
        $book = new Book(
            "Eu, Robô",
            "",
            "eu-robo",
            320,
            80.0,
            2014
        );

        $book->setId(1);

        $this->assertNotNull($book->getId());
        $this->assertIsInt($book->getId());
        $this->assertIsString($book->getName());
        $this->assertIsString($book->getDescription());
        $this->assertIsString($book->getSlug());
        $this->assertIsInt($book->getNumberOfPages());
        $this->assertIsFloat($book->getPrice());
        $this->assertIsInt($book->getPubYear());
    }
}