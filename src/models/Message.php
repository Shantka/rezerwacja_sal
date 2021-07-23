<?php

namespace Models;

class Message 
{
    private $message;
    private $userName;

    public function __construct(array $input)
    {
        $this->message = (string)($input['wiadomosc'] ?? '');
        $this->userName = (string)($input['uzytkownik'] ?? '');
    }

    public function getMessage() 
    {
        return $this->message;
    }

    public function getUserName()
    {
        return $this->userName;
    }
}