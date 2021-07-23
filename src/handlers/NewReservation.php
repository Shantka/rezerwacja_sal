<?php declare(strict_types=1);

namespace Handlers;

use Components\Template;
use Components\Database;
use Components\Auth;

class NewReservation extends Handler
{
    private $date;
    private $roomId;

    public function handle(): string
    {        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $sel_date = (string)$_POST['date'];
            $set_room = (int)$_POST['room'];
            $user_id = Auth::getAuthenticatedUserId();
            $topic = (string)$_POST['topic'];
            $description = (string)$_POST['description'];

            $new_reservation_id = Database::instance()->addNewReservation($set_room, $user_id, $sel_date, $topic, $description);

            $this->requestRedirect("/reservation?id=$new_reservation_id");
        }

        return (new Template('newreservation'))->render([
            'rooms' => Database::instance()->getRooms(), 
            'room' => Database::instance()->getRoomById($this->roomId),
            'date' => $this->date,
            'roomid' => $this->roomId,           
        ]);    
    }

    public function setDate(string $date)
    {
        $this->date = $date;
    }

    public function setRoomId(int $id) 
    {
        $this->roomId = $id;
    }
}