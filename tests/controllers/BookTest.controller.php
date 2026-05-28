<?php

namespace Tests\Controllers;

use App\Controllers\BookController;
use PHPUnit\Framework\TestCase;

class BookTestController extends TestCase
{
    protected BookController $controller;

    protected function setUp(): void
    {
        parent::setUp();

        if (!defined('BASE_URL')) {
            define('BASE_URL', '/binarySearch-Quicksort');
        }

        $_GET = [];
        $_POST = [];
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_REQUEST = [];
    }

    public function testCardsRenderBooks()
    {
        $controller = $this->controller;

        $this->expectOutputRegex('/<html>/i');
        $this->expectOutputRegex('/<head>/i');
        $this->expectOutputRegex('/<title>/i');
        $this->expectOutputRegex('/BinaryLibrary/i');

        $controller->cards();

        $this->assertArrayHasKey('books', $_REQUEST);
        $this->assertIsArray($_REQUEST['books']);
    }

    public function testSearchWithExactSlug()
    {
        $_GET['q'] = 'eu-robo';


        $controller = $this->controller;

        $this->expectOutputRegex('/BinaryLibrary/i');
        
        $controller->search();

        $this->assertArrayHasKey('books',$_REQUEST);
        $books = $_REQUEST['books'];

        if(count($books) > 0){
            $this->assertEquals('eu-robo', $books[0]['slug']);
        }
    }

    public function testSearchWithPartialSlug()
    {
        $_GET['q'] = 'eu-';

        $controller = $this->controller;

        $this->expectOutputRegex('/BinaryLibrary/i');

        $controller->search();

        $this->assertArrayHasKey('books', $_REQUEST);
        $books = $_REQUEST['books'];

        if (count($books) > 0) {
            $this->assertEquals('eu-robo', $books[0]['slug']);
        }
    }

    public function testGetBook()
    {
        $_GET['b'] = 'eu-robo';

        $controller = $this->controller;

        $this->expectOutputRegex('/BinaryLibrary/i');

        $controller->book();

        $this->assertArrayHasKey('book', $_REQUEST);
        $book = $_REQUEST['book'];

        $this->assertEquals('eu-robo', $book['slug']);
        $this->assertEquals('Eu robo', $book['name']);
    }

    public function testCreateBook()
    {
        $_SERVER['REQUEST_METHOD'] = 'GET';

        $controller = $this->controller;

        $this->expectOutputRegex('/BinaryLibrary/i');

        $controller->create();

        $this->assertArrayHasKey('message', $_REQUEST);
        $this->assertEquals('', $_REQUEST['message']);
        $this->assertArrayHasKey('scripts', $_REQUEST);
        $this->assertIsArray($_REQUEST['scripts']);
        $this->assertEquals('createBook.js', $_REQUEST['scripts'][0]);

        $_SERVER['REQUEST_METHOD'] = 'POST';

        $name = 'Book Test';
        $description = 'Description test';
        $slug = 'book-test';
        $price = 10.00;
        $numberOfPage = 100;
        $pubYear = 2020;
        $authors = 'John Doe';
        $genres = 'test, test2';

        $_POST['name'] = $name;
        $_POST['description'] = $description;
        $_POST['slug'] = $slug;
        $_POST['price'] = $price;
        $_POST['numberOfPages'] = $numberOfPage;
        $_POST['pubYear'] = $pubYear;
        $_POST['authors'] = $authors;
        $_POST['genres'] = $genres;

        $controller->create();

        $this->assertArrayHasKey('message', $_GET);
        $this->assertEquals('Livro cadastrado com sucesso!', $_GET['message']);
    }
}
