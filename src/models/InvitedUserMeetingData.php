<?php

namespace Models;

use Models\Reservation;

class InvitedUserMeetingData 
{
    private $accepted;
    private $rejected;
    private $resevation;

    public function __construct($array)
    {
        $this->resevation = new Reservation($array);
    }


    public function isAccepted(): bool
    {
        return $this->accepted;
    }

    public function isRejected(): bool
    {
        return $this->rejected;
    }
}

?>