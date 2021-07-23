<?php declare(strict_types=1);

namespace Handlers;

use Components\Template;
use Components\Database;
use Components\Auth;

class Rooms extends Handler
{
    public function handle(): string
    {        
        return (new Template('rooms'))->render([
            'rooms' => Database::instance()->getRooms(),
            'isadmin' => Auth::getUser()->getIsAdmin(),
        ]);    
    }
}