<?php

namespace App\Repositories;

use App\Models\Genre;
use Config\Database;
use PDO;
use PDOException;

class GenreRepository
{
    private PDO $conn;

    public function __construct()
    {
        $db = Database::getInstance();
        $this->conn = $db->getConnection();
    }

    public function getAllGenres(): array
    {
        $stmt = $this->conn->query(
            "SELECT 
                id,
                name
             FROM tb_genres"
        );

        $genres = [];

        try {

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($result as $row) {
                $genres[] = new Genre(
                    $row["name"],
                    $row["parent_id"]
                );
            }
        } catch (PDOException $e) {
            die("Error on getting genres: " . $e->getMessage());
        }

        return $genres;
    }

    public function getGenreById(int $id): ?Genre
    {
        $stmt = $this->conn->prepare(
            "SELECT 
                id,
                name,
                parent_id
             FROM tb_genres
             WHERE id = ?"
        );

        try {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error on getting genre: " . $e->getMessage());
        }

        if (!$result) {
            return null;
        }

        return new Genre(
            $result["name"],
            $result["parent_id"]
        );
    }

    public function createGenre(Genre $g): bool
    {
        $stmt = $this->conn->prepare(
            "INSERT INTO tb_genres (
                name,
                parent_id
            )
            VALUES (?, ?)"
        );

        try {
            return $stmt->execute([
                $g->getName(),
                $g->getParentId()
            ]);
        } catch (PDOException $e) {
            die("Error on creating genre: " . $e->getMessage());
        }
    }

    public function deleteGenre(int $id): bool
    {
        try {
            $stmt = $this->conn->prepare(
                "DELETE FROM tb_genres
             WHERE id = ?"
            );

            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            die("Error on deleting genre: " . $e->getMessage());
        }
    }

    public function updateGenre(Genre $g): bool
    {
        $stmt = $this->conn->prepare(
            "UPDATE tb_genres
             SET
                name = ?,
                parent_id = ?
             WHERE id = ?"
        );

        return $stmt->execute([
            $g->getName(),
            $g->getParentId(),
            $g->getId()
        ]);
    }

    public function updateBookGenres(int $bookId, array $genres): bool
    {
        $stmt = $this->conn->prepare(
            "DELETE FROM tb_books_genres
             WHERE book_id = ?"
        );

        $stmt->execute([$bookId]);

        if (!empty($genres)) {
            $stmt = $this->conn->prepare(
                "INSERT INTO tb_books_genres (
                    book_id,
                    genre_id
                )
                VALUES (?, ?)"
            );

            foreach ($genres as $genreId) {
                $stmt->execute([
                    $bookId,
                    $genreId
                ]);
            }

            return true;
        } else {
            return false;
        }
    }
}
