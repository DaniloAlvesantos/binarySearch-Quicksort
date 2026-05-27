<?php

namespace Tests\Models;

use App\Models\Genre;
use PHPUnit\Framework\TestCase;

class GenreTest extends TestCase {
    protected Genre $genre;

    protected function setUp(): void 
    {
        $this->genre = new Genre('Ficção Científica', null);

        $this->genre->setId(1);
    }

    public function testInstanceGenre()
    {
        $this->setUp();

        $this->assertNotNull($this->genre->getId());
        $this->assertIsInt($this->genre->getId());
        $this->assertIsString($this->genre->getName());
    }

    public function testChangeGenreName()
    {
        $newName = 'Romance';
        $this->setUp();

        $this->genre->setName($newName);
        $this->assertEquals($newName, $this->genre->getName());
        $this->assertIsString($this->genre->getName());
    }

    public function testChangeId()
    {
        $this->setUp();

        $this->genre->setId(10);
        $this->assertNotNull($this->genre->getId());
        $this->assertEquals(1, $this->genre->getId());
    }
}