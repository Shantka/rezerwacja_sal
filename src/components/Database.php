<?php declare(strict_types=1);
namespace Components;

use DateTime;
use Models\Note;
use Models\Reservation;
use Models\User;
use Models\Room;
use Models\InvitationStatus;
use Models\Message;
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

    /**
     * Get user data by userId
     */
    public function getUserById(int $id): ?User
    {
        $stmt = $this->pdo->prepare("SELECT * FROM uzytkownicy WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        if ($stmt->execute() && ($data = $stmt->fetch(PDO::FETCH_ASSOC))) {
            return new User($data);
        }
        return null;
    }

    /**
     * Get user data by user login
     */
    public function getUserByLogin(string $formUserlogin): ?User
    {
        $stmt = $this->pdo->prepare("SELECT * FROM uzytkownicy WHERE login = :userlogin");
        if ($stmt->execute([':userlogin' => $formUserlogin]) && ($data = $stmt->fetch(PDO::FETCH_ASSOC))) {
            return new User($data);
        }
        return null;
    }

    /**
     * Get all users without one
     */
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

    /**
     * Get all rooms
     */
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

    /**
     * Get one room by id
     */
    public function getRoomById(int $id): Room
    {
        $stmt = $this->pdo->prepare("SELECT * FROM sale WHERE id = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        return new Room($data);
    }

    /**
     * Add new reservation with selected organizer, room adn date. Topic and description are optional
     */
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

    /**
     * Get all reservations starting from today
     */
    public function getAllReservations(): array
    {
        $startdate = date('Y-m-d');
        $stmt = $this->pdo->prepare("SELECT * FROM `rezerwacje` WHERE start >= :start ORDER BY start");
        $stmt->bindParam(":start", $startdate);
        $stmt->execute();

        $reservations = array();
        while ($row = $stmt->fetch()) {
            array_push($reservations, new Reservation($row));
        }

        return $reservations;        
    }

    /**
     * Get all user reservations, staring from today
     */
    public function getUserReservations(int $userId): array
    {
        $startdate = date('Y-m-d');
        $stmt = $this->pdo->prepare("SELECT * FROM `rezerwacje` WHERE organizatorId = :organizatorId AND start >= :start ORDER BY start");
        $stmt->bindParam(":organizatorId", $userId, PDO::PARAM_INT);
        $stmt->bindParam(":start", $startdate);
        $stmt->execute();

        $reservations = array();
        while ($row = $stmt->fetch()) {
            array_push($reservations, new Reservation($row));
        }

        return $reservations;
    }

    /**
     * Get one reservation by id
     */
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

    /**
     * Edit reservation topic
     */
    public function editReservationTopic(int $id, string $topic){
        $stmt = $this->pdo->prepare("UPDATE rezerwacje SET temat = :topic WHERE id = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":topic", $topic, PDO::PARAM_STR);

        $stmt->execute();
    }

    /**
     * Edit reservation description
     */
    public function editReservationDescription(int $id, string $description){
        $stmt = $this->pdo->prepare("UPDATE rezerwacje SET opis = :description WHERE id = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":description", $description, PDO::PARAM_STR);

        $stmt->execute();
    }

    /**
     * Edit reservation note
     */
    public function editReservationNote(int $id, string $note){
        $stmt = $this->pdo->prepare("UPDATE rezerwacje SET notatka = :note WHERE id = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":note", $note, PDO::PARAM_STR);

        $stmt->execute();
    }    

    /**
     * Invite user to a meeting
     */
    public function addInvitation(int $reservationId, int $userId) 
    {
        $stmt = $this->pdo->prepare("INSERT INTO uczestnicy(uzytkownikId, rezerwacjaId) VALUES(:uzytkownikId, :rezerwacjaId)");
        $stmt->bindParam(":uzytkownikId", $userId, PDO::PARAM_INT);
        $stmt->bindParam(":rezerwacjaId", $reservationId, PDO::PARAM_INT);

        $stmt->execute();
    }

    /**
     * Delete user invitation
     */
    public function deleteInvitation(int $reservationId, int $userId) 
    {
        $stmt = $this->pdo->prepare("DELETE FROM uczestnicy WHERE uzytkownikId = :uzytkownikId AND rezerwacjaId = :rezerwacjaId");
        $stmt->bindParam(":uzytkownikId", $userId, PDO::PARAM_INT);
        $stmt->bindParam(":rezerwacjaId", $reservationId, PDO::PARAM_INT);

        $stmt->execute();
    }    

    /**
     * Get all users invited to a meeting
     */
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

    /**
     * Get all users not invited to a meeting, excluding meeting organizer
     */
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

    /**
     * Get meetings to which user is invited, staring from today
     */
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
        $startdate = date('Y-m-d');
        $stmtSrt = "SELECT u.rezerwacjaId FROM uczestnicy as u ".
                    "JOIN rezerwacje as r ON u.rezerwacjaId = r.id ".
                    "WHERE u.uzytkownikId = :uzytkownikId ".
                    "AND r.start >= :start ".
                    "ORDER BY r.start";

        $stmt = $this->pdo->prepare($stmtSrt);
        $stmt->bindParam(":uzytkownikId", $user, PDO::PARAM_INT);
        $stmt->bindParam(":start", $startdate);
        $stmt->execute();

        $ids = array();
        
        while ($row = $stmt->fetch()) {
            array_push($ids, $row['rezerwacjaId']);
        }

        return $ids;
    }

    /** 
     * Add new room. Name, description and person count are required 
     */
    public function addRoom(string $name, string $description, int $personcount)
    {
        $stmt = $this->pdo->prepare("INSERT INTO sale(nazwa, opis, liczbaOsob) VALUES(:name, :description, :personcount)");
        $stmt->bindParam(":name", $name, PDO::PARAM_STR);
        $stmt->bindParam(":description", $description, PDO::PARAM_STR);
        $stmt->bindParam(":personcount", $personcount, PDO::PARAM_INT);

        $stmt->execute();
    }

    /**
     * Edit room data
     */
    public function editRoom(int $id, string $name, string $description, int $personcount) 
    {
        $stmt = $this->pdo->prepare("UPDATE sale SET nazwa = :name, opis = :description, liczbaOsob = :personcount WHERE id = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":name", $name, PDO::PARAM_STR);
        $stmt->bindParam(":description", $description, PDO::PARAM_STR);
        $stmt->bindParam(":personcount", $personcount, PDO::PARAM_INT);

        $stmt->execute();
    }

    /**
     * Get already occupied dates for selected room and selected month in year
     */
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

    /**
     * Accept invitation to a meeting
     */
    public function acceptInvitation(int $reservationId, int $userId)
    {
        $stmt = $this->pdo->prepare("UPDATE uczestnicy SET potwierdzone = true, odrzucone = false WHERE rezerwacjaId = :reservationId AND uzytkownikId = :userId");
        $stmt->bindParam(":reservationId", $reservationId, PDO::PARAM_INT);
        $stmt->bindParam(":userId", $userId, PDO::PARAM_INT);

        $stmt->execute();
    }

    /**
     * Reject invitation to a meeting
     */
    public function rejectInvitaion(int $reservationId, int $userId)
    {
        $stmt = $this->pdo->prepare("UPDATE uczestnicy SET potwierdzone = false, odrzucone = true WHERE rezerwacjaId = :reservationId AND uzytkownikId = :userId");
        $stmt->bindParam(":reservationId", $reservationId, PDO::PARAM_INT);
        $stmt->bindParam(":userId", $userId, PDO::PARAM_INT);

        $stmt->execute();
    }

    /**
     * Get statuses of invitations for user
     */
    public function getUserInvivationStatuses(int $userId): ?array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM uczestnicy WHERE uzytkownikId = :userId");
        $stmt->bindParam(":userId", $userId, PDO::PARAM_INT);

        $stmt->execute();

        $statuses = array();
        while ($row = $stmt->fetch()) {
            $statuses[$row['rezerwacjaId']] = new InvitationStatus($row);
        }

        return $statuses;
    }

    /**
     * Get invitation statuses for meeting
     */
    public function getReservationInvivationStatuses(int $reservationId): ?array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM uczestnicy WHERE rezerwacjaId = :reservationId");
        $stmt->bindParam(":reservationId", $reservationId, PDO::PARAM_INT);

        $stmt->execute();

        $statuses = array();
        while ($row = $stmt->fetch()) {
            $statuses[$row['uzytkownikId']] = new InvitationStatus($row);
        }

        return $statuses;
    }    

    /**
     * Send new meeting message
     */
    public function sendReservationMessage(int $userId, int $reservationId, string $message)
    { 
        $stmt = $this->pdo->prepare("INSERT INTO wiadomosci(uzytkownikId, rezerwacjaId, wiadomosc) VALUES(:uzytkownikId, :rezerwacjaId, :wiadomosc)");
        $stmt->bindParam(":uzytkownikId", $userId, PDO::PARAM_INT);
        $stmt->bindParam(":rezerwacjaId", $reservationId, PDO::PARAM_INT);
        $stmt->bindParam(":wiadomosc", $message, PDO::PARAM_STR);

        $stmt->execute();
    }

    /**
     * Get all meeting messages
     */
    public function getReservationMessages(int $reservationId): array
    {
        $stmtStr = "SELECT w.wiadomosc, u.imie AS uzytkownik FROM wiadomosci w ".
                    "INNER JOIN uzytkownicy u ON u.id = w.uzytkownikId ".
                    "WHERE w.rezerwacjaId = :rezerwacjaId ".
                    "ORDER BY w.id";
        $stmt = $this->pdo->prepare($stmtStr);
        $stmt->bindParam(":rezerwacjaId", $reservationId, PDO::PARAM_INT);

        $stmt->execute();

        $messages = array();
        while ($row = $stmt->fetch()) {
            array_push($messages, new Message($row));            
        }

        return $messages;
    }
}