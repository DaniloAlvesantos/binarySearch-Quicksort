<?php

namespace App\Repositories;

use App\Models\Author;
use Config\Database;
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
                $authors[] = new Author(
                    $row["name"]
                );
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
}
