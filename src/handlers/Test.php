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
        return (new Template('test'))->render([
            'rooms' => Database::instance()->getRooms(),
            'isadmin' => Auth::getUser()->getIsAdmin(),
        ]);    
    }
}