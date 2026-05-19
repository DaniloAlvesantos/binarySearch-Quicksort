<?php

class Book
{
    private ?int $id;
    private string $name;
    private string $description;
    private string $slug;
    private int $number_of_pages;
    private float $price;
    private int $pub_year;

    public function __construct(string $name, string $description, string $slug, int $number_of_pages, float $price, int $pub_year)
    {
        $this->setName($name);
        $this->setDescription($description);
        $this->setSlug($slug);
        $this->setNumberOfPages($number_of_pages);
        $this->setPrice($price);
        $this->setPubYear($pub_year);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function getNumberOfPages(): int
    {
        return $this->number_of_pages;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getFormatedPrice(): string {
        return number_format($this->price, 2, ',', '.');
    }

    public function getPubYear(): int
    {
        return $this->pub_year;
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

    public function setDescription(string $description): void
    {
        if (empty($description) || strlen($description) < 10) return;

        $this->description = $description;
    }

    public function setSlug(string $slug): void
    {
        if (empty($slug)) return;

        $this->slug = $slug;
    }

    public function setNumberOfPages(int $number_of_pages): void
    {
        if ($number_of_pages <= 0) return;

        $this->number_of_pages = $number_of_pages;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    public function setPubYear(int $pub_year): void
    {
        if ($pub_year <= 0) return;

        $this->pub_year = $pub_year;
    }
}
