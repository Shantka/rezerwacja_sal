<?php declare(strict_types=1);

namespace Models;

class Room 
{
    private $id;
    private $name;
    private $description;
    private $maxPersonCount;
    private $imageUrl;

    public function __construct(array $input) 
    {
        $this->id = (int)($input['id'] ?? 0);
        $this->name = (string)($input['nazwa'] ?? '');
        $this->description = (string)($input['opis'] ?? '');
        $this->maxPersonCount = (int)($input['liczbaOsob'] ?? 0);
        $this->imageUrl = (string)($input['obrazUrl'] ?? '');
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

    public function getMaxPersonCount(): int 
    {
        return $this->maxPersonCount;
    }

    public function getImageUrl(): string
    {
        return $this->imageUrl;
    }
}