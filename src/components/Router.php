<?php declare(strict_types=1);

namespace Components;

use Handlers\Handler;
use Handlers\Login;
use Handlers\Logout;
use Handlers\Profile;
use Handlers\Calendar;
use Handlers\Rooms;
use Handlers\AdminPanel;
use Handlers\Reservations;
use Handlers\NewReservation;
use Handlers\Reservation;
use Handlers\AddRoom;
use Handlers\NewMessage;

class Router
{
    public function getHandler(): ?Handler
    {     
        $get_args = $_GET['args'];

        if ($get_args === 'calendar') {
            return new Calendar();
        }
        else if ($get_args === 'reservation') {
            return new Reservation((int)$_GET['id']);
        }
        else if ($get_args === 'room') {
            $addRoom = new AddRoom();
            if (isset($_GET['id'])) {
                $addRoom->setId($_GET['id']);
            }
            return $addRoom;
        }
        else if ($get_args === 'newreservation') {
            $reservation = new NewReservation();
            if (isset($_GET['date'])) {
                $reservation->setDate($_GET['date']);
            }
            if (isset($_GET['roomid'])) {
                $reservation->setRoomId((int)$_GET['roomid']);
            }
            return $reservation;
        }
        else if ($get_args === 'newmessage') {
            return new NewMessage();
        }

        switch ($_SERVER['REQUEST_URI'] ?? '/') {
            case '/rooms':
                return new Rooms();
            case '/room':
                return new AddRoom();                       
            case '/calendar':
                return new Calendar();               
            case '/profile':
                return new Profile();
            case '/login':
                return new Login();
            case '/logout':                
                return new Logout();
            case '/adminpanel':
                return new AdminPanel();
            case '/rezerwacje':
                return new Reservations();
            case '/':
                return new class extends Handler {
                    public function handle(): string
                    {
                        if (Auth::userIsAuthenticated()) {
                            $this->requestRedirect('/profile');
                        }
                        return (new Template('home'))->render();
                    }
                };
            default:
                return new class extends Handler {
                    public function handle(): string
                    {
                        $this->requestRedirect('/');
                        return '';
                    }
                };
        }
    }
}