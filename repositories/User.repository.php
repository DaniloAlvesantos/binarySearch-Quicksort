<?php

class UserRepositoy
{
    private PDO $conn;

    public function __construct()
    {
        $db = Database::getInstance();
        $this->conn = $db->getConnection();
    }

    public function getAllUsers(): array
    {
        $stmt = $this->conn->query(
            "SELECT 
                id,
                name,
                email
             FROM tb_users"
        );

        $users = [];

        try {
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($result as $row) {
                $users[] = new User(
                    $row["id"],
                    $row["name"],
                    $row["email"],
                    $row["password"]
                );
            }

            return $users;
        } catch (PDOException $e) {
            die("Error on getting users: " . $e->getMessage());
        }
    }

    public function getUserById(int $id): ?User
    {
        $stmt = $this->conn->prepare(
            "SELECT 
                id,
                name,
                email
             FROM tb_users
             WHERE id = ?"
        );

        try {
            $stmt->execute([$id]);

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$result) {
                return null;
            }

            return new User(
                $result["id"],
                $result["name"],
                $result["email"],
                $result["password"]
            );
        } catch (PDOException $e) {
            die("Error on getting user: " . $e->getMessage());
        }
    }

    public function createUser(User $u): bool
    {
        $stmt = $this->conn->prepare(
            "INSERT INTO tb_users (
                name,
                email,
                password
            )
            VALUES (?, ?, ?)"
        );

        try {
            return $stmt->execute([
                $u->getName(),
                $u->getEmail(),
                $u->getPassword()
            ]);
        } catch (PDOException $e) {
            die("Error on creating user: " . $e->getMessage());
        }
    }

    public function deleteUser(int $id): bool
    {
        $stmt = $this->conn->prepare(
            "DELETE FROM tb_users
             WHERE id = ?"
        );

        try {
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            die("Error on deleting user: " . $e->getMessage());
        }
    }
}
