<?php

namespace App\Models;

class Genre
{
    private ?int $id;
    private string $name;
    private int $parentId;

    public function __construct(string $name, int $parentId)
    {
        $this->setName($name);
        $this->setParentId($parentId);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getParentId(): int
    {
        return $this->parentId;
    }

    public function setId(int $id): void
    {
        if($this->id === null){
            $this->id = $id;
        }
    }

    public function setName(string $name): void
    {
        if (empty($name)) return;

        $this->name = $name;
    }

    public function setParentId(int $parentId): void
    {
        if ($parentId <= 0) return;

        $this->parentId = $parentId;
    }
}
