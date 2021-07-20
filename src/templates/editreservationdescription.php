<?php
include '../components/Database.php';

use Components\Database;

$description = $_REQUEST["description"];
$reservationid = $_REQUEST["reservation"];

if ($reservationid > 0) {
    Database::instance()->editReservationDescription($reservationid, $description);
}

