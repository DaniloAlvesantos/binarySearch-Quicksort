<?php

namespace App\Repositories;

use App\DTOS\AuthorBooks;
use App\Models\Author;
use App\Models\Book;
use Config\Database;
use Exception;
use PDO;
use PDOException;

class AuthorRepository
{
    private PDO $conn;

    public function __construct()
    {
        $db = Database::getInstance();
        $this->conn = $db->getConnection();
    }

    public function getAllAuthors(): array
    {
        $stmt = $this->conn->query(
            "SELECT 
                id,
                name
             FROM tb_authors"
        );

        try {
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $authors = [];

            foreach ($result as $row) {
                $author = new Author($row['name']);
                $author->setId($row['id']);

                $authors[] = $author;
            }

            return $authors;
        } catch (PDOException $e) {
            die("Error on getting authors: " . $e->getMessage());
        }
    }

    public function getAuthorById(int $id): ?Author
    {
        $stmt = $this->conn->prepare(
            "SELECT 
                id,
                name
             FROM tb_authors
             WHERE id = ?"
        );

        $stmt->execute([$id]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$result) {
            return null;
        }

        return new Author(
            $result["id"],
            $result["name"]
        );
    }

    public function createAuthor(Author $a): bool
    {
        $stmt = $this->conn->prepare(
            "INSERT INTO tb_authors (
                name
            )
            VALUES (?)"
        );

        return $stmt->execute([$a->getName()]);
    }

    public function deleteAuthor(int $id): bool
    {
        $stmt = $this->conn->prepare(
            "DELETE FROM tb_authors
             WHERE id = ?"
        );

        return $stmt->execute([$id]);
    }

    public function updateAuthor(Author $a): bool
    {
        $stmt = $this->conn->prepare(
            "UPDATE tb_authors
             SET
                name = ?
             WHERE id = ?"
        );

        return $stmt->execute([
            $a->getName(),
            $a->getId()
        ]);
    }

    public function updateBookAuthors(int $bookId, array $authors): bool
    {
        $stmt = $this->conn->prepare(
            "DELETE FROM tb_books_authors
             WHERE book_id = ?"
        );

        $stmt->execute([$bookId]);

        if (!empty($authors)) {
            $stmt = $this->conn->prepare(
                "INSERT INTO tb_books_authors (
                    book_id,
                    author_id
                )
                VALUES (?, ?)"
            );

            foreach ($authors as $authorId) {
                $stmt->execute([
                    $bookId,
                    $authorId
                ]);
            }

            return true;
        } else {
            return false;
        }
    }

    public function createAll(array $authors)
    {
        try {
            $stmt = $this->conn->prepare(
                "INSERT INTO tb_authors (
                name
            )
            VALUES (?)"
            );

            foreach ($authors as $author) {
                $stmt->execute([$author]);
            }

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $ids = [];

            foreach ($result as $row) {
                $ids[] = $row["id"];
            }

            return $ids;
        } catch (PDOException $e) {
            die("Error on creating authors: " . $e->getMessage());
        }
    }

    public function getAuthorBooks(int $id)
    {
        try {
            $stmt = $this->conn->prepare(
                "SELECT a.name, b.name as bookName, b.slug FROM tb_books_authors ba
                INNER JOIN tb_authors a
                ON a.id = ba.author_id
                INNER JOIN tb_books b
                ON b.id = ba.book_id
                WHERE a.id = ?;"
            );
            
            $stmt->execute([$id]);

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $books = [];

            foreach ($result as $authorBooks) {
                $books[] = new Book(
                    $authorBooks['bookName'],
                    "",
                    $authorBooks['slug'],
                    0,
                    0.0,
                    0
                );
            }

            return new AuthorBooks($result[0]['name'], $books);
        } catch (Exception $e) {
            die("Error on getting author's book" . $e->getMessage());
        }
    }
}
