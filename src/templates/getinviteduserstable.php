<?php
include '../components/Database.php';
include '../models/User.php';

use Components\Database;

$reservationid = $_REQUEST["reservation"];

if ($reservationid > 0) {
    $users = Database::instance()->getInvitedUsers($reservationid);

    echo "
    <table class=\"table\">
    <tbody>";
    foreach($users as $user) {
        echo "
        <tr>
        <th>";
        echo $user->getUsername();
        echo "
        </th>
        <td>
        <button type=\"button\" class=\"btn btn-dark btn-sm\";
        onclick=\"onremoveinvitation(";
        echo $user->getId();
        echo ",";
        echo $reservationid;
        echo ")\">Usuń</button>";
        echo " 
        </td>
        </tr>";
    }
    echo "
    </tbody>
    </table>";
}


?>