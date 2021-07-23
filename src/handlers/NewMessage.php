<?php

namespace Handlers;

use Components\Auth;
use Components\Template;
use Components\Database;

class NewMessage extends Handler
{
    public function handle(): string
    {
        if (!Auth::userIsAuthenticated()) {
            return (new Login)->handle();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'GET' && !isset($_GET['reservationid'])) {
            $this->requestRedirect("/profile");
        }

        $reservationId = 0;

        if (isset($_GET['reservationid'])) {
            $reservationId = (int)$_GET['reservationid'];
        }

        $formError = array();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $formError = $this->handleMessage();

            $reservationId = (int)$_POST['reservationid'];

            if (!$formError) {
                $this->requestRedirect("/profile");
            }            
        }


        $reservation = Database::instance()->getReservation($reservationId);

        return (new Template('newmessage'))->render([
            'reservation' => $reservation,
            'reservationid' => $reservationId,
            'formError' => $formError
        ]);
    }

    private function handleMessage(): ?array 
    {
        $formError = null;
        $formMessage = trim($_POST['message'] ?? '');    
        $reservationId = (int)$_POST['reservationid'];

        if (!$formMessage || strlen($formMessage) < 1) {
            $formError = ['message' => 'Wiadomość nie może być pusta'];
        } else {
            Database::instance()->sendReservationMessage(Auth::getAuthenticatedUserId(), $reservationId, $formMessage);
        }

        return $formError;        
    }
}