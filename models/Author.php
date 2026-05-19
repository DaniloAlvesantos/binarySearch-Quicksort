<?php

class Author
{
    private ?int $id;
    private string $name;

    public function __construct(string $name)
    {
        $this->setName($name);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
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
}
