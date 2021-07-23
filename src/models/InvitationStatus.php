<?php

namespace Models;

class InvitationStatus 
{
    private $accepted;
    private $rejected;

    public function __construct(array $input)
    {
        $this->accepted = (bool)($input['potwierdzone'] ?? false);
        $this->rejected = (bool)($input['odrzucone'] ?? false);
    }

    public function isAccepted(): bool
    {
        return $this->accepted;
    }

    public function isRejected(): bool
    {
        return $this->rejected;
    }

}