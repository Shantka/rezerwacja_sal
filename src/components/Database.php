<?php declare(strict_types=1);
namespace Components;
use Models\User;
use PDO;
use PDOStatement;

class Database 
{
    public $pdo;
    private function __construct()
    {
        $dsn = "mysql:host=localhost;port=3306;dbname=sale_rezerwacja;charset=utf8mb4";
        $options = [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];
        $this->pdo = new PDO($dsn, "root", "", $options);
    }

    public static function instance()
    {
        static $instance;
        if (is_null($instance)) {
            $instance = new static();
        }
        return $instance;
    }

    public function getUserById(int $id): ?User
    {
        $stmt = $this->pdo->prepare("SELECT * FROM uzytkownicy WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        if ($stmt->execute() && ($data = $stmt->fetch(PDO::FETCH_ASSOC))) {
            return new User($data);
        }
        return null;
    }

    public function getUserByLogin(string $formUserlogin): ?User
     {
        $stmt = $this->pdo->prepare("SELECT * FROM uzytkownicy WHERE login = :userlogin");
        if ($stmt->execute([':userlogin' => $formUserlogin]) && ($data = $stmt->fetch(PDO::FETCH_ASSOC))) {
            return new User($data);
        }
        return null;
     }

}