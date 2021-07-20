<?php declare(strict_types=1);

namespace Handlers;

use Components\Template;
use Components\Database;
use Models\Room;
use Components\Auth;

class AddRoom extends Handler
{
    private $id;

    public function handle(): string
    {        
        if (!Auth::getUser()->getIsAdmin()) {
            $this->requestRedirect("/rooms");
        }

        $formError = [];
        $formName = '';
        $formDescription = '';
        $formPersoncount = 0;
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['id'])) {
                $this->setId($_POST['id']);
            }
            $formError = $this->handleRoom($this->id);

            $formName = $_POST['name'] ?? '';
            $formDescription = $_POST['description'] ?? '';
            $formPersoncount = $_POST['personcount'] ?? 0;

            if (!$formError) {
                $this->requestRedirect("/rooms");
            }
        }

        if ($this->id > 0 && $_SERVER['REQUEST_METHOD'] != 'POST') {
            $room = Database::instance()->getRoomById($this->id);

            $formName = $room->getName();
            $formDescription = $room->getDescription();
            $formPersoncount = $room->getMaxPersonCount();
        }

        return (new Template('addroom'))->render([
            'formError' => $formError,
            'formName' => $formName,
            'formDescription' => $formDescription,
            'formPersoncount' => $formPersoncount,
            'id' => $this->id,
        ]);    
    }

    public function setId(?string $id) {
        if (isset($id)) {
            $this->id = (int)$id;
        } else {
            $this->id = 0;
        }
    }

    private function handleRoom(?int $id): ?array
    {
        $formError = null;
        $formName = trim($_POST['name'] ?? '');
        $formDescription = trim($_POST['description'] ?? '');
        $formPersoncount = (int)trim($_POST['personcount'] ?? 0);

        if (!$formName || strlen($formName) < 1) {
            $formError = ['name' => 'Nazwa sali nie może być pusta.'];
        } elseif (!$formDescription || strlen($formDescription) < 1) {
            $formError = ['description' => 'Opis sali nie może być pusty'];
        } elseif ($formPersoncount < 2) {
            $formError = ['personcount' => 'Liczba osób musi być większa od 1.'];
        } else {
            if (isset($id) && $id > 0) {
                Database::instance()->editRoom($id, $formName, $formDescription, $formPersoncount);
            } else {
                Database::instance()->addRoom($formName, $formDescription, $formPersoncount);
            }
        }

        return $formError;
    }
}