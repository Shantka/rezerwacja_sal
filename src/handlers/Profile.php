<?php declare(strict_types=1);

namespace Handlers;

use Components\Auth;
use Components\Template;
use Components\Database;

class Profile extends Handler
{
    public function handle(): string
    {
        if (!Auth::userIsAuthenticated()) {
            return (new Login)->handle();
        }

        return (new Template('profile'))->render([
            'organizedmeetings' => Database::instance()->getUserReservations(Auth::getAuthenticatedUserId()),
            'invitedmeetings' => Database::instance()->getInvitedUserReservations(Auth::getAuthenticatedUserId()),
        ]);
    }

    public function getTitle(): string
    {
        return 'Profile - ' . parent::getTitle();
    }
}