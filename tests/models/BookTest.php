<?php

namespace Tests\Models;

use PHPUnit\Framework\TestCase;
use App\Models\Book;

class BookTest extends TestCase
{
    public Book $book;

    protected function setUp(): void
    {
        $this->book = new Book(
            "Eu, Robô",
            "Habilidades Práticas com Software e Robótica.",
            "eu-robo",
            320,
            80.0,
            2014
        );

        $this->book->setId(1);
    }

    public function testInstanceBook()
    {
        $this->setUp();

        $this->assertNotNull($this->book->getId());
        $this->assertIsInt($this->book->getId());
        $this->assertIsString($this->book->getName());
        $this->assertIsString($this->book->getDescription());
        $this->assertIsString($this->book->getSlug());
        $this->assertIsInt($this->book->getNumberOfPages());
        $this->assertIsFloat($this->book->getPrice());
        $this->assertIsInt($this->book->getPubYear());
    }

    public function testFormatedPrice()
    {
        $this->setUp();

        $this->assertIsString($this->book->getFormatedPrice());
        $this->assertEquals($this->book->getFormatedPrice(), "R$80,00");
    }
}
