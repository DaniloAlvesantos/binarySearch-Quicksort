<?php

namespace Tests\Models;

use PHPUnit\Framework\TestCase;
use App\Models\Author;

class AuthorTest extends TestCase
{
    protected Author $author;

    protected function setUp(): void
    {
        $author = new Author(
            'Issac Asimov'
        );

        $author->setId(1);

        $this->author = $author;
    }

    public function testInstanceAuthor()
    {
        $this->setUp();

        $this->assertNotNull($this->author->getId());
        $this->assertIsInt($this->author->getId());
        $this->assertIsString($this->author->getName());
    }

    public function testChangeAuthorName()
    {
        $newName = 'Matheus C.';
        $this->setUp();

        $this->author->setName($newName);
        $this->assertEquals($newName, $this->author->getName());
        $this->assertIsString($this->author->getName());
    }

    public function testChangeId() 
    {
        $this->setUp();

        $this->author->setId(10);
        $this->assertNotNull($this->author->getId());
        $this->assertEquals(1, $this->author->getId());
    }
}
