<?php declare(strict_types=1);

namespace Models;

class Reservation 
{
    private $id;
    private $organizerId;
    private $roomId;
    private $start;
    private $end;
    private $topic;
    private $description;

    public function __construct(array $input)
    {
        $this->id = (int)($input['id'] ?? 0);
        $this->organizerId = (int)($input['organizatorId'] ?? 0);
        $this->roomId = (int)($input['salaId'] ?? 0);
        $this->start = (string)($input['start'] ?? '');
        $this->end = (string)($input['koniec'] ?? '');
        $this->topic = (string)($input['temat'] ?? '');     
        $this->description = (string)($input['opis'] ?? '');   
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getOrganizerId(): int 
    {
        return $this->organizerId;
    }
    
    public function getRoomId(): int
    {
        return $this->roomId;
    }

    public function getStart(): string
    {
        return $this->start;
    }

    public function getTopic(): string 
    {
        return $this->topic;
    }

    public function getDescription(): string
    {
        return $this->description;
    }
}