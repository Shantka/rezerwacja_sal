<?php declare(strict_types=1);

namespace Handlers;

use Components\Template;
use Components\Database;
use Components\Auth;

class Reservation extends Handler
{
    private int $reservationId;

    public function __construct($reservtionId)
    {
        $this->reservationId = $reservtionId;
    }

    public function handle(): string
    {                
        $reservation = Database::instance()->getReservation($this->reservationId);
        $organizer = Database::instance()->getUserById($reservation->getOrganizerId());
        $room = Database::instance()->getRoomById($reservation->getRoomId());
        $canEdit = (Auth::getAuthenticatedUserId() === $reservation->getOrganizerId()) || Auth::getUser()->getIsAdmin();
        $isOwner = Auth::getAuthenticatedUserId() === $reservation->getOrganizerId();
        $invited = Database::instance()->getInvitedUsers($this->reservationId);
        $reservationStatuses = Database::instance()->getReservationInvivationStatuses($this->reservationId);
        $messages = Database::instance()->getReservationMessages($this->reservationId);

        return (new Template('reservation'))->render([
            'reservation' => $reservation,
            'organizer' => $organizer,
            'room' => $room,
            'canedit' => $canEdit,
            'isowner' => $isOwner,
            'invited' => $invited,
            'reservationstatuses' => $reservationStatuses,
            'messages' => $messages,
        ]);    
    }
}