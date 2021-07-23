<?php declare(strict_types=1);

namespace Handlers;

use Components\Auth;
use Components\Database;
use Components\Template;

class AdminPanel extends Handler
{
    public function handle(): string
    {
        if (!Auth::userIsAuthenticated()) {
            return (new Login)->handle();
        }

        if (!Auth::getUser()->getIsAdmin()) {
            return (new Profile)->handle();
        }

        return (new Template('adminpanel'))->render([
            'reservations' => Database::instance()->getAllReservations(),
        ]);
    }
}