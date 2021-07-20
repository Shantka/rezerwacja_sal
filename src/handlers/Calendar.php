<?php declare(strict_types=1);

namespace Handlers;

use Components\Auth;
use Components\Template;
use Components\Database;

class Calendar extends Handler
{
    public function handle(): string
    {
        if (!Auth::userIsAuthenticated()) {
            return (new Login)->handle();
        }

        $year = isset($_GET['year']) ? $_GET['year'] : date('Y');
        $month = isset($_GET['month']) ? $_GET['month'] : date('m');
        $roomid = isset($_GET['room']) ? (int)$_GET['room'] : 1;

        return (new Template('calendar'))->render([
            'rooms' => Database::instance()->getRooms(),
            'occupieddates' => Database::instance()->getOccupiedDatesForRoom($roomid, $year, $month),
            'roomid' => $roomid
        ]);
    }
}