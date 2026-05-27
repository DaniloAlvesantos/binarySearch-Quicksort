<?php

namespace App\Controllers;

use App\Repositories\AuthorRepository;

class AuthorController {
    private AuthorRepository $repository;

    public function __construct()
    {
        $this->repository = new AuthorRepository();
    }

    public function author() {
        $authorId = intval($_GET['a']);
        $authorBooks = $this->repository->getAuthorBooks($authorId);

        $_REQUEST['authorBooks'] = $authorBooks;

        ob_start();
        require_once __DIR__ . "/../views/authors/author.php";
        $content = ob_get_clean();
        require_once __DIR__ . "/../views/layout.php";
    }

    public function authors() {
        $authors = $this->repository->getAllAuthors();
        
        $_REQUEST['authors'] = $authors;

        ob_start();
        require_once __DIR__ . "/../views/authors/authors.php";
        $content = ob_get_clean();   
        require_once __DIR__ . "/../views/layout.php";   
    }
}