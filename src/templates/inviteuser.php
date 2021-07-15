<?php
include '../components/Database.php';

use Components\Database;

$userid = $_REQUEST["user"];
$reservationid = $_REQUEST["reservation"];

if ($userid > 0 && $reservationid > 0) {
    Database::instance()->addInvitation($reservationid, $userid);

    echo "Invited user";
}


?>