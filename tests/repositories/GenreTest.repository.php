<?php

namespace Tests\Repositories;

use App\Models\Genre;
use App\Repositories\GenreRepository;
use PHPUnit\Framework\TestCase;

class GenreTestRepository extends TestCase
{
    protected GenreRepository $repository;

    public function testGetAllGenres()
    {
        $genres = $this->repository->getAllGenres();

        $this->assertIsArray($genres);
        $this->assertContainsOnlyInstancesOf(Genre::class, $genres);
        $this->assertNotEmpty($genres);
    }

    public function testCreateGenre()
    {
        $result = $this->repository->createGenre(new Genre('Ficção científica', null));

        $this->assertIsBool($result);
        $this->assertTrue($result);
    }
}