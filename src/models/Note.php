<?php declare(strict_types=1);

namespace Models;

class Note 
{
    private $id;
    private $reservationId;
    private $content;

    public function __construct(array $input)
    {
        $this->id = (int)($input['id'] ?? 0);
        $this->reservationId = (int)($input['rezerwacjaId'] ?? 0);
        $this->content = (string)($input['notatka'] ?? '');
    }

    public function getId(): int 
    {
        return $this->id;
    }

    public function getContent(): string
    {
        return $this->content;
    }
}