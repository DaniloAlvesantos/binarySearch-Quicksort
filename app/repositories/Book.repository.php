<?php

namespace App\Repositories;

use App\DTOS\BookGenre;
use App\Models\Book;
use Config\Database;
use PDO;
use PDOException;

class BookRepository
{
    private PDO $conn;

    public function __construct()
    {
        $db = Database::getInstance();
        $this->conn = $db->getConnection();
    }

    public function getAllBooks(int $limit = 5): array
    {
        $stmt = $this->conn->prepare(
            "SELECT 
            id,
            name,
            slug,
            number_of_pages,
            price,
            publication_year
         FROM tb_books"
        );

        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $books = [];

        foreach ($result as $row) {
            $book = new Book(
                $row["name"],
                "",
                $row["slug"],
                $row["number_of_pages"],
                $row["price"],
                $row["publication_year"]
            );

            $book->setId($row["id"]);

            $books[] = $book;
        }

        return $books;
    }

    public function getBookBySlug(string $slug): ?BookGenre
    {
        if (empty($slug)) {
            return null;
        }

        $stmt = $this->conn->prepare(
            "WITH RECURSIVE genre_tree AS (
                -- root genres
                SELECT
                    id,
                    name,
                    parent_id,
                    name AS full_path
                FROM tb_genres
                WHERE parent_id IS NULL

                UNION ALL

                -- child genres
                SELECT
                    g.id,
                    g.name,
                    g.parent_id,
                    CONCAT(gt.full_path, ' > ', g.name) AS full_path
                FROM tb_genres g
                JOIN genre_tree gt
                    ON g.parent_id = gt.id
            )

            SELECT
                b.id,
                b.name,
                b.description,
                b.slug,
                b.number_of_pages,
                b.price,
                b.publication_year,
                GROUP_CONCAT(gt.full_path SEPARATOR ', ') AS genres
            FROM tb_books b
            JOIN tb_books_genres bg
                ON bg.book_id = b.id
            JOIN genre_tree gt
                ON gt.id = bg.genre_id
            WHERE b.slug = ?
            GROUP BY
                b.id,
                b.name,
                b.description,
                b.slug,
                b.number_of_pages,
                b.price,
                b.publication_year;"
        );

        $stmt->execute([$slug]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$result) {
            return null;
        }

        $book = new Book(
            $result["name"],
            $result["description"],
            $result["slug"],
            $result["number_of_pages"],
            $result["price"],
            $result["publication_year"]
        );

        return new BookGenre($book, $result["genres"]);
    }

    public function createBook(Book $b, array $authors, array $genres): bool
    {
        try {
            $this->conn->beginTransaction();

            // Insert book
            $stmt = $this->conn->prepare(
                "INSERT INTO tb_books (
                    name,
                    description,
                    slug,
                    number_of_pages,
                    price,
                    publication_year
                )
                VALUES (?, ?, ?, ?, ?, ?)"
            );

            $stmt->execute([
                $b->getName(),
                $b->getDescription(),
                $b->getSlug(),
                $b->getNumberOfPages(),
                $b->getPrice(),
                $b->getPubYear()
            ]);

            $bookId = (int) $this->conn->lastInsertId();

            // Insert authors
            if (!empty($authors)) {
                $stmtAuthors = $this->conn->prepare(
                    "INSERT INTO tb_books_authors (
                        book_id,
                        author_id
                    )
                    VALUES (?, ?)"
                );

                foreach ($authors as $authorId) {
                    $stmtAuthors->execute([
                        $bookId,
                        $authorId
                    ]);
                }
            }

            // Insert genres
            if (!empty($genres)) {
                $stmtGenres = $this->conn->prepare(
                    "INSERT INTO tb_books_genres (
                        book_id,
                        genre_id
                    )
                    VALUES (?, ?)"
                );

                foreach ($genres as $genreId) {
                    $stmtGenres->execute([
                        $bookId,
                        $genreId
                    ]);
                }
            }

            $this->conn->commit();

            return true;
        } catch (PDOException $e) {

            if ($this->conn->inTransaction()) {
                $this->conn->rollBack();
            }

            die(
                "Error on creating book: " . $e->getMessage()
            );
        }
    }

    public function deleteBook(int $id): bool
    {
        $stmt = $this->conn->prepare(
            "DELETE FROM tb_books
             WHERE id = ?"
        );

        return $stmt->execute([$id]);
    }

    public function updateBook(Book $b): bool
    {
        $stmt = $this->conn->prepare(
            "UPDATE tb_books
             SET
                name = ?,
                description = ?,
                slug = ?,
                number_of_pages = ?,
                price = ?,
                publication_year = ?
             WHERE id = ?"
        );

        return $stmt->execute([
            $b->getName(),
            $b->getDescription(),
            $b->getSlug(),
            $b->getNumberOfPages(),
            $b->getPrice(),
            $b->getPubYear(),
            $b->getId()
        ]);
    }
}
