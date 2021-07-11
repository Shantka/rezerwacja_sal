<?php declare(strict_types=1);

namespace Handlers;

use Components\Template;
use Components\Database;
use Models\Room;
use Components\Auth;

class Test extends Handler
{
    public function handle(): string
    {        
        
        // Dodanie nowej rezerwacji(id sali, id organizatora, data rezerwacji, temat, opis)
        // Database::instance()->addNewReservation(1, 1, date("Y-m-d"), 'temat', 'opis');
        
        // Pobranie rezerwacji użytkownika (id użytkownika)
        // $r = Database::instance()->getUserReservations(1);
        
        // Dodanie nowej notatki do rezerwacji (id rezerwacji, treść notatki)
        // Database::instance()->addNewReservationNote(1, "Notatka 2");
        
        // Edycja notatki rezerwacji (id notatki, treść notatki)
        // Database::instance()->editReservationNote(2, "Zmieniona notatka 2");
        
        // Pobranie notatatek do rezerwacji(id rezerwacji)
        // $n = Database::instance()->getReservationNotes(1);

        // Dodanie zaproszenia (id rezerwacji, id użytkownika)
        // Database::instance()->addInvitation(1, 2);

        // Pobranie wszystkich spotkań na które jest zaproszony użytkownik (id użytkownika)
        // $invitedUserReservations = Database::instance()->getInvitedUserReservations(2);

        return (new Template('test'))->render([
            'rooms' => Database::instance()->getRooms(),
            'users' => Database::instance()->getAllUsersButOne(Auth::getAuthenticatedUserId()),
        ]);    
    }
}