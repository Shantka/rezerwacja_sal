<?php
include '../components/Database.php';
include '../models/User.php';

use Components\Database;

$reservationid = $_REQUEST["reservation"];

if ($reservationid > 0) {
    $users = Database::instance()->getAllNotInvitedUsers($reservationid);

    if (count($users) > 0) 
    {    
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
            onclick=\"oninvite(";
            echo $user->getId();
            echo ",";
            echo $reservationid;
            echo ")\">Zaproś</button>";
            echo " 
            </td>
            </tr>";
        }
        echo "
        </tbody>
        </table>";
    }
    else 
    {
        echo "Brak użytkowników do zaproszenia";
    }
}
?>