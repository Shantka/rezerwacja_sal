<?php declare(strict_types=1);

const WWW_PATH = __DIR__;

require_once __DIR__ . '/src/components/Auth.php';
require_once __DIR__ . '/src/components/Database.php';
require_once __DIR__ . '/src/components/Template.php';
require_once __DIR__ . '/src/components/Router.php';
require_once __DIR__ . '/src/handlers/Handler.php';
require_once __DIR__ . '/src/handlers/Login.php';
require_once __DIR__ . '/src/handlers/Logout.php';
require_once __DIR__ . '/src/handlers/Profile.php';
require_once __DIR__ . '/src/handlers/Calendar.php';
require_once __DIR__ . '/src/handlers/Rooms.php';
require_once __DIR__ . '/src/handlers/AdminPanel.php';
require_once __DIR__ . '/src/handlers/Reservations.php';
require_once __DIR__ . '/src/handlers/NewReservation.php';
require_once __DIR__ . '/src/handlers/Reservation.php';
require_once __DIR__ . '/src/handlers/AddRoom.php';
require_once __DIR__ . '/src/handlers/NewMessage.php';
require_once __DIR__ . '/src/models/User.php';
require_once __DIR__ . '/src/models/Room.php';
require_once __DIR__ . '/src/models/Note.php';
require_once __DIR__ . '/src/models/Reservation.php';
require_once __DIR__ . '/src/models/InvitationStatus.php';
require_once __DIR__ . '/src/models/Message.php';
require_once __DIR__ . '/src/controls/CalendarControl.php';

use Components\Router;
use Components\Template;

session_start();

$mainTemplate = new Template('main');
$templateData = [
    'title' => 'My main template',
];

$router = new Router();
if ($handler = $router->getHandler()) {
    $content = $handler->handle();
    if ($handler->willRedirect()) {
        return;
    }
    $templateData['content'] = $content;
    $templateData['title'] = $handler->getTitle();
}

echo $mainTemplate->render($templateData);