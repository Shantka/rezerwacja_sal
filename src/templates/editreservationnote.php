<?php
include '../components/Database.php';

use Components\Database;

$note = $_REQUEST["note"];
$reservationid = $_REQUEST["reservation"];

if ($reservationid > 0) {
    Database::instance()->editReservationNote($reservationid, $note);
}
