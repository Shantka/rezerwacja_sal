<?php declare(strict_types=1);

namespace Handlers;

use Components\Auth;
use Components\Template;

class AdminPanel extends Handler
{
    public function handle(): string
    {
        if (!Auth::userIsAuthenticated()) {
            return (new Login)->handle();
        }

        return (new Template('adminpanel'))->render();
    }
}