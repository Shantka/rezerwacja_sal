<div class="d-flex justify-content-center">
<section class="my-5">
    <h3>Rezerwacja</h3>
</section>
</div>
<div class="row">
    <table class="table">
        <tbody>
            <tr>
                <th style="width: 150px;">Data</th>
                <td><?= date_format(date_create($reservation->getStart()), 'd-m-Y') ?></td>
            </tr>
            <tr>
                <th>Sala</th>
                <td><?= $room->getName() ?></td>
            </tr>
            <tr>
                <th>Organizator</th>
                <td><?= $organizer->getUsername() ?></td>
            </tr>
            <tr>
                <th>Temat</th>
                <td> 
                    <?php if ($canedit) { ?>
                    <button class="btn btn-dark btn-sm" data-toggle="modal" data-target="#editTopicButton" 
                        >Edytuj</button>
                    <br>
                    <?php } ?>
                    <span id="topic">
                        <?= $reservation->getTopic() ?>
                    </span>
                </td>
            </tr>
            <tr>
                <th>Opis</th>
                <td>
                    <?php if ($canedit) { ?>
                    <button class="btn btn-dark btn-sm" data-toggle="modal" data-target="#editDescriptionButton"
                        >Edytuj</button>
                    <br>
                    <?php } ?>  
                    <span id="description">
                        <?= $reservation->getDescription() ?>
                    </span>  
                </td>
            </tr>
            <tr>
                <th>Uczestnicy</th>
                <td>
                <div id="inviteduserstable">
                <table class="table">
                    <tbody>
                    <?php foreach($invited as $user) { ?>
                        <tr>
                            <th><?= $user->getUsername() ?></th>
                            <?php if ($canedit) { ?>
                            <td><button type="button" class="btn btn-dark btn-sm" 
                            onclick="onremoveinvitation(<?= $user->getId() ?>, <?= $reservation->getId() ?>)">Usuń</button></td>
                            <?php } ?>
                        <tr>
                    <?php } ?>                            
                    </tbody>
                </table>
                </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<div class="modal fade" id="exampleModalButton" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Zaproś uczestników spotkania</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="false">×</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="availableuserstable">

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
      </div>
    </div>
  </div>
</div>

<?php if ($canedit) { ?>
<button type="button" class="btn btn-dark" data-toggle="modal" data-target="#exampleModalButton" 
onclick="refreshavailableusers(<?= $reservation->getId() ?>)">
  Zaproś uczestników
</button>
<?php } ?>

<div class="modal fade" id="editTopicButton" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Edytuj temat</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="false">×</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="editedtopic">
            <input type="text" class="form-control" value="<?= $reservation->getTopic() ?>" id="newtopic">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal" 
        onclick="onedittopic(newtopic.value, <?= $reservation->getId() ?>)">Zapisz</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="editDescriptionButton" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Edytuj opis</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="false">×</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="editedtopic">
            <textarea class="form-control" id="newdescription"><?= $reservation->getDescription() ?></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal" 
        onclick="oneditdescriptionc(newdescription.value, <?= $reservation->getId() ?>)">Zapisz</button>
      </div>
    </div>
  </div>
</div>

<script>
function onedittopic(topic, reservationid) {    
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("POST", "src/templates/editreservationtopic.php?topic=" + topic + "&reservation=" + reservationid, true);
    xmlhttp.send();
    document.getElementById("topic").innerHTML = topic;
}

function oneditdescriptionc(description, reservationid) {    
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("POST", "src/templates/editreservationdescription.php?description=" + description + "&reservation=" + reservationid, true);
    xmlhttp.send();
    document.getElementById("description").innerHTML = description;
}

function onremoveinvitation(userid, reservationid) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            refreshinvitedusers(reservationid);
        }
    };
    xmlhttp.open("GET", "src/templates/deleteuserinvitation.php?user=" + userid + "&reservation=" + reservationid, true);
    xmlhttp.send();        
}

function refreshinvitedusers(reservationid) {
    var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("inviteduserstable").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "src/templates/getinviteduserstable.php?reservation=" + reservationid, true);
        xmlhttp.send();  
}

function refreshavailableusers(reservationid) {
    var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("availableuserstable").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "src/templates/getavailableuserstable.php?reservation=" + reservationid, true);
        xmlhttp.send();  
}

function oninvite(str, reservationid) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {            
            refreshinvitedusers(reservationid);
            refreshavailableusers(reservationid);
        }
    };
    xmlhttp.open("GET", "src/templates/inviteuser.php?user=" + str + "&reservation=" + reservationid, true);
    xmlhttp.send();        
}

</script>