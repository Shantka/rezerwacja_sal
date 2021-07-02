<?php declare(strict_types=1);

namespace Models;

class User 
{
    private $id;
    private $username;
    private $login;
    private $password;    
    private $isAdmin;

    public function __construct(array $input)
    {
        $this->id = (int)($input['id'] ?? 0);
        $this->username = (string)($input['imie'] ?? '');
        $this->password = (string)($input['haslo'] ?? '');
        $this->login = (string)($input['login'] ?? '');
        $this->isAdmin = (bool)($input['isAdmin'] ?? false);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getLogin(): string 
    {
        return $this->login;
    }

    public function getIsAdmin(): bool 
    {
        return $this->isAdmin;
    }

    public function passwordMatches(string $formPassword): bool
    {
        $passmd5 = md5($formPassword);
        return $passmd5 === $this->password;
    }
}