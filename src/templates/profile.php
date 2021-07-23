<?php

use Components\Auth;

$user = Auth::getUser();
?>
<div class="d-flex justify-content-center">
<section class="my-5">
    <h3>Witaj, <?= $user->getUsername() ?>!</h3>
</section>
</div>
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
                        <th style="width: 100px;"><?= date_format(date_create($meeting->getStart()), "m-d-Y") ?></th>
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
            Spotkania na które jesteś zaproszony
            </button>
        </h2>
        </div>

        <div id="collapseTwo" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
            <div class="card-body">
            <?php if (count($invitedmeetings) === 0) { ?>
                Nie jesteś zaproszony na żadne spotkanie
                <?php } else { ?>
                    <table class="table">
                    <tbody>
                        <?php foreach($invitedmeetings as $meeting) { ?>
                        <tr>
                        <th style="width: 100px;"><?= date_format(date_create($meeting->getStart()), "m-d-Y") ?></th>
                        <td><?= $meeting->getTopic() ?></td>
                        <td><button type="button" class="btn btn-success"
                            onclick="onacceptinvitation(<?= $userid ?>, <?= $meeting->getId() ?>)"
                            id="accept_<?= $meeting->getId() ?>"
                            <?= $invitationstatuses[$meeting->getId()]->isAccepted() ? 'disabled' : '' ?>
                            >Potwierdź</button>
                        <button type="button" class="btn btn-danger"
                            onclick="onrejectinvitation(<?= $userid ?>, <?= $meeting->getId() ?>)"
                            id="reject_<?= $meeting->getId() ?>" 
                            <?= $invitationstatuses[$meeting->getId()]->isRejected() ? 'disabled' : '' ?>                       
                            >Odrzuć</button>
                        <button type="button" class="btn btn-secondary" onclick="location.href='newmessage?reservationid=<?= $meeting->getId() ?>'">Wiadomość</button>
                        <button type="button" class="btn btn-secondary" onclick="location.href='reservation?id=<?= $meeting->getId() ?>'">Szczegóły</button>
                        </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                    </table>                
                <?php } ?>

            </div>
        </div>    
    </div>    
</div>
<script>
    function onacceptinvitation(userid, reservationid) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("POST", "src/templates/acceptinvitation.php?user=" + userid + "&reservation=" + reservationid, true);
        xmlhttp.send();
        
        document.getElementById("accept_" + reservationid).disabled = true;        
        document.getElementById("reject_" + reservationid).disabled = false;
    }

    function onrejectinvitation(userid, reservationid) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("POST", "src/templates/rejectinvitation.php?user=" + userid + "&reservation=" + reservationid, true);
        xmlhttp.send();

        document.getElementById("accept_" + reservationid).disabled = false;        
        document.getElementById("reject_" + reservationid).disabled = true;
    }
</script>