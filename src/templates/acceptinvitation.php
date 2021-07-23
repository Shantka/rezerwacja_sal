<?php
include '../components/Database.php';

use Components\Database;

$userid = $_REQUEST["user"];
$reservationid = $_REQUEST["reservation"];

if ($reservationid > 0) {
    Database::instance()->acceptInvitation($reservationid, $userid);
}