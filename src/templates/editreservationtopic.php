<?php
include '../components/Database.php';

use Components\Database;

$topic = $_REQUEST["topic"];
$reservationid = $_REQUEST["reservation"];

if ($reservationid > 0) {
    Database::instance()->editReservationTopic($reservationid, $topic);
}

