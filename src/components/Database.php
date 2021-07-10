<?php declare(strict_types=1);
namespace Components;

use DateTime;
use Models\User;
use Models\Room;
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

    public function getAllUsersButOne(int $id): array 
    {
        $stmt = $this->pdo->prepare("SELECT * FROM uzytkownicy WHERE id <> :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $users = array();
        while ($row = $stmt->fetch()) {
            array_push($users, new User($row));
        }

        return $users;
    }

    public function getRooms(): array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM sale");
        $stmt->execute();

        $rooms = array();
        if ($stmt->rowCount()) {
            while ($row = $stmt->fetch()) {
                array_push($rooms, new Room($row));
            }
        }

        return $rooms;
    }

    public function addNewReservation(int $roomId, int $organizerId, array $users, DateTime $date)
    {

    }

    public function deleteReservation(int $reservationId)
    {

    }

    public function getUserReservations(int $userId): array
    {
        return array();
    }

    public function addNewReservationNote(int $reservationId, string $note)
    {

    }

    public function editReservationNote(int $noteId)
    {

    }
    
    public function deleteReservationNode(int $noteId)
    {

    }

    public function getReservationNotes(int $reservationId): array
    {
        return array();
    }

    public function acceptInvitation(int $reservationId, int $userId)
    {

    }

    public function rejectInvitaion(int $reservationId, int $userId)
    {

    }
}