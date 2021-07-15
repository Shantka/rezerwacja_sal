<?php

use Components\Auth;

$user = Auth::getUser();
?>

<section class="my-5">
    <h3>Witaj, <?= $user->getUsername() ?>!</h3>
</section>
<div class="accordion" id="accordion">

    <div class="card">
        <div class="card-header" id="headingThree">
        <h2 class="mb-0">
            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseOne">
            Twój profil
            </button>
        </h2>
        </div>

        <div id="collapseThree" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
            <div class="card-body">
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
            </div>
        </div>    
    </div> 

    <div class="card">
        <div class="card-header" id="headingOne">
        <h2 class="mb-0">
            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            Spotkania które organizujesz
            </button>
        </h2>
        </div>

        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
            <div class="card-body">
            <?php if (count($organizedmeetings) === 0) { ?>
                Nie organizujesz żadnych spotkań
                <?php } else { ?>
                    <table class="table">
                    <tbody>
                        <?php foreach($organizedmeetings as $meeting) { ?>
                        <tr>
                        <th style="width: 100px;"><?= date_format(date_create($meeting->getStart()), "m-d-yy") ?></th>
                        <td><?= $meeting->getTopic() ?></td>
                        <td><button type="button" class="btn btn-secondary" onclick="location.href='reservation?id=<?= $meeting->getId() ?>'">Szczegóły</button></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                    </table>
                <?php } ?>

            </div>
        </div>    
    </div>

    <div class="card">
        <div class="card-header" id="headingTwo">
        <h2 class="mb-0">
            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseOne">
            Spotkania na które jestś zaproszony
            </button>
        </h2>
        </div>

        <div id="collapseTwo" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
            <div class="card-body">
            <?php if (count($invitedmeetings) === 0) { ?>
                Nie jestś zaproszony na żadne spotkanie
                <?php } else { ?>
                    <table class="table">
                    <tbody>
                        <?php foreach($invitedmeetings as $meeting) { ?>
                        <tr>
                        <th style="width: 100px;"><?= date_format(date_create($meeting->getStart()), "m-d-yy") ?></th>
                        <td><?= $meeting->getTopic() ?></td>
                        <td><button type="button" class="btn btn-success" disabled>Potwierdź</button>
                        <button type="button" class="btn btn-danger">Odrzuć</button></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                    </table>                
                <?php } ?>

            </div>
        </div>    
    </div>    
</div>