<?php

namespace Tests\Controllers;

use App\Controllers\UserController;
use PHPUnit\Framework\TestCase;

class UserTestController extends TestCase
{
    protected UserController $controller;
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

    public function testLogin()
    {
        $_SERVER['REQUEST_METHOD'] = 'GET';
        
        $controller = $this->controller;
        $this->expectOutputRegex('/BinaryLibrary/i');

        $this->expectOutputRegex('/<html>/i');
        $this->expectOutputRegex('/<head>/i');
        $this->expectOutputRegex('/<title>/i');
        $this->expectOutputRegex('/BinaryLibrary/i');

        $controller->login();

        $this->expectOutputRegex('/<form>/i');
        $this->expectOutputRegex('/<input type="email">/i');
        $this->expectOutputRegex('/<input type="password">/i');

        $_SERVER['REQUEST_METHOD'] = 'POST';

        $_POST['email'] = 'johndoe@gmail.com';
        $_POST['pass'] = '123456';

        $controller->login();

        $this->assertArrayHasKey('user', $_SESSION);
        $this->assertEquals('johndoe@gmail.com', $_SESSION['user']['email']);
    }
}