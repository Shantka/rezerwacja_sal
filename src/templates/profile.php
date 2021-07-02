<?php

use Components\Auth;

$user = Auth::getUser();
?>

<section class="my-5">
    <h3>Witaj, <?= $user->getUsername() ?>!</h3>
</section>
<h4 class="mb-3">Twój profil:</h4>
<table class="table">
    <tbody>
    <tr>
        <th>Nazwa użytkownika:</th>
        <td><?= $user->getUsername() ?></td>
    </tr>    
    <tr>
        <th>Login:</th>
        <td><?= $user->getLogin() ?></td>
    </tr>
    <tr>
        <?php if ($user->getIsAdmin()) { ?>
            <th>Jesteś administratorem</th>
        <?php } else  { ?>
            <th>Nie jesteś administratorem</th>
        <?php } ?>
        <td></td>
    </tr>
    </tbody>
</table>
<hr class="my-5">