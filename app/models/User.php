<?php

namespace App\Models;

class User
{
    private ?int $id = null;
    private string $name;
    private string $email;
    private string $password;

    public function __construct(string $name, string $email, string $password)
    {
        $this->setName($name);
        $this->setEmail($email);
        $this->setPassword($password);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setId(int $id): void
    {
        if ($this->id === null) {
            $this->id = $id;
        }
    }

    public function setName(string $name): void
    {
        if (empty($name)) return;

        $this->name = $name;
    }

    public function setEmail(string $email): void
    {
        if (empty($email)) return;

        $this->email = $email;
    }

    public function setPassword(string $password): void
    {
        if (empty($password)) return;

        $this->password = $password;
    }
}
