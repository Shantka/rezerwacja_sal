<?php declare(strict_types=1);
namespace Components;

use DateTime;
use Models\Note;
use Models\Reservation;
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

    public function getRoomById(int $id): Room
    {
        $stmt = $this->pdo->prepare("SELECT * FROM sale WHERE id = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        return new Room($data);
    }

    public function addNewReservation(int $roomId, int $organizerId, string $date, string $topic, string $description): int
    {
        $stmt = $this->pdo->prepare("INSERT INTO rezerwacje(organizatorId, salaId, start, koniec, temat, opis)
                                    VALUES(:organizatorId, :salaId, :start, :koniec, :temat, :opis)");
        $stmt->bindParam(":organizatorId", $organizerId, PDO::PARAM_INT);
        $stmt->bindParam(":salaId", $roomId, PDO::PARAM_INT);
        $stmt->bindParam(":start", $date);
        $stmt->bindParam(":koniec", $date);
        $stmt->bindParam(":temat", $topic, PDO::PARAM_STR);
        $stmt->bindParam(":opis", $description, PDO::PARAM_STR);

        $stmt->execute();

        return (int)$this->pdo->lastInsertId();
    }

    public function deleteReservation(int $reservationId)
    {

    }

    public function getUserReservations(int $userId): array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM `rezerwacje` WHERE organizatorId = :organizatorId");
        $stmt->bindParam(":organizatorId", $userId, PDO::PARAM_INT);
        $stmt->execute();

        $reservations = array();
        while ($row = $stmt->fetch()) {
            array_push($reservations, new Reservation($row));
        }

        return $reservations;
    }

    public function getReservation(int $id): ?Reservation
    {
        $stmt = $this->pdo->prepare("SELECT * FROM `rezerwacje` WHERE id = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) 
        {
            return new Reservation($stmt->fetch());
        }

        return null;
    }

    public function addNewReservationNote(int $reservationId, string $note)
    {
        $stmt = $this->pdo->prepare("INSERT INTO notatki(rezerwacjaId, notatka) VALUES(:rezerwacjaId, :notatka)");
        $stmt->bindParam(":rezerwacjaId", $reservationId, PDO::PARAM_INT);
        $stmt->bindParam(":notatka", $note, PDO::PARAM_STR);
        
        $stmt->execute();
    }

    public function editReservationNote(int $noteId, string $note)
    {
        $stmt = $this->pdo->prepare("UPDATE notatki SET notatka = :notatka WHERE id = :id");
        $stmt->bindParam(":id", $noteId, PDO::PARAM_INT);
        $stmt->bindParam(":notatka", $note, PDO::PARAM_STR);

        $stmt->execute();
    }
    
    public function deleteReservationNode(int $noteId)
    {
        $stmt = $this->pdo->prepare("DELETE FROM notatki WHERE id = :id");
        $stmt->bindParam(":id", $noteId, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function getReservationNotes(int $reservationId): array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM notatki WHERE rezerwacjaId = :rezerwacjaId");
        $stmt->bindParam(":rezerwacjaId", $reservationId, PDO::PARAM_INT);
        
        $stmt->execute();
        $notes = array();

        while ($row = $stmt->fetch()) {
            array_push($notes, new Note($row));
        }

        return $notes;
    }

    public function addInvitation(int $reservationId, int $userId) 
    {
        $stmt = $this->pdo->prepare("INSERT INTO uczestnicy(uzytkownikId, rezerwacjaId) VALUES(:uzytkownikId, :rezerwacjaId)");
        $stmt->bindParam(":uzytkownikId", $userId, PDO::PARAM_INT);
        $stmt->bindParam(":rezerwacjaId", $reservationId, PDO::PARAM_INT);

        $stmt->execute();
    }

    public function deleteInvitation(int $reservationId, int $userId) 
    {
        $stmt = $this->pdo->prepare("DELETE FROM uczestnicy WHERE uzytkownikId = :uzytkownikId AND rezerwacjaId = :rezerwacjaId");
        $stmt->bindParam(":uzytkownikId", $userId, PDO::PARAM_INT);
        $stmt->bindParam(":rezerwacjaId", $reservationId, PDO::PARAM_INT);

        $stmt->execute();
    }    

    public function getInvitedUsers(int $reservationId): array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM uzytkownicy WHERE id IN (SELECT uzytkownikId from uczestnicy WHERE rezerwacjaId = :rezerwacjaId)");
        $stmt->bindParam(":rezerwacjaId", $reservationId, PDO::PARAM_INT);
        $stmt->execute();

        $reservations = array();
        while ($row = $stmt->fetch()) {
            array_push($reservations, new User($row));
        }

        return $reservations;
    }

    public function getAllNotInvitedUsers(int $reservationId): array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM uzytkownicy WHERE id NOT IN (SELECT uzytkownikId FROM uczestnicy WHERE rezerwacjaId = :rezerwacjaId) AND id NOT IN (SELECT organizatorId FROM rezerwacje WHERE id = :rezerwacjaId2)");
        $stmt->bindParam(":rezerwacjaId", $reservationId, PDO::PARAM_INT);
        $stmt->bindParam(":rezerwacjaId2", $reservationId, PDO::PARAM_INT);
        $stmt->execute();

        $users = array();
        while ($row = $stmt->fetch()) {
            array_push($users, new User($row));
        }

        return $users;
    }

    public function getInvitedUserReservations(int $userId): array 
    {
        $ids = $this->getUserReservationIds($userId);

        $reservations = array();
        foreach ($ids as $id)
        {
            array_push($reservations, $this->getReservation((int)$id));
        }

        return $reservations;
    }

    private function getUserReservationIds(int $user): array
    {
        $stmt = $this->pdo->prepare("SELECT rezerwacjaId FROM uczestnicy WHERE uzytkownikId = :uzytkownikId");
        $stmt->bindParam(":uzytkownikId", $user, PDO::PARAM_INT);
        $stmt->execute();

        $ids = array();
        
        while ($row = $stmt->fetch()) {
            array_push($ids, $row['rezerwacjaId']);
        }

        return $ids;
    }

    public function addRoom(string $name, string $description, int $personcount)
    {
        $stmt = $this->pdo->prepare("INSERT INTO sale(nazwa, opis, liczbaOsob) VALUES(:name, :description, :personcount)");
        $stmt->bindParam(":name", $name, PDO::PARAM_STR);
        $stmt->bindParam(":description", $description, PDO::PARAM_STR);
        $stmt->bindParam(":personcount", $personcount, PDO::PARAM_INT);

        $stmt->execute();
    }

    public function editRoom(int $id, string $name, string $description, int $personcount) 
    {
        $stmt = $this->pdo->prepare("UPDATE sale SET nazwa = :name, opis = :description, liczbaOsob = :personcount WHERE id = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":name", $name, PDO::PARAM_STR);
        $stmt->bindParam(":description", $description, PDO::PARAM_STR);
        $stmt->bindParam(":personcount", $personcount, PDO::PARAM_INT);

        $stmt->execute();
    }

    public function getOccupiedDatesForRoom(int $roomId, string $year, string $month): ?array
    {
        $firstDay = "$year-$month-01";
        $lastDay = "$year-$month-".date('t',strtotime($firstDay));

        $stmt = $this->pdo->prepare("SELECT id, start FROM rezerwacje WHERE salaId = :roomId and start >= :start and start <= :end");
        $stmt->bindParam(':roomId', $roomId, PDO::PARAM_INT);
        $stmt->bindParam(':start', $firstDay);
        $stmt->bindParam(':end', $lastDay);

        $stmt->execute();
        $ids = array();
        
        while ($row = $stmt->fetch()) {
            $ids[date("Y-m-d", strtotime($row['start']))] = $row['id'];    
        }

        return $ids;
    }

    public function acceptInvitation(int $reservationId, int $userId)
    {

    }

    public function rejectInvitaion(int $reservationId, int $userId)
    {

    }
}