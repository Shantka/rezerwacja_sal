<?php declare(strict_types=1);

namespace Components;

use Handlers\Contacts;
use Handlers\Handler;
use Handlers\Login;
use Handlers\Logout;
use Handlers\Profile;
use Handlers\Calendar;
use Handlers\Rooms;
use Handlers\AdminPanel;
use Handlers\Reservations;
use Handlers\Test;

class Router
{
    public function getHandler(): ?Handler
    {     
        $get_args = $_GET['args'];

        if ($get_args === 'calendar') {
            return new Calendar();
        }

        switch ($_SERVER['REQUEST_URI'] ?? '/') {
            case '/test':
                return new Test();
            case '/calendar':
                return new Calendar();               
            case '/profile':
                return new Profile();
            case '/login':
                return new Login();
            case '/logout':                
                return new Logout();
            case '/rooms':
                return new Rooms();
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