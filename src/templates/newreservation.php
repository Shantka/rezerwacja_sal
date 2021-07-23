<div class="d-flex justify-content-center">
<section class="my-5">
    <h3>Nowa rezerwacja</h3>
</section>
</div>
<div class="d-flex justify-content-center">
    <form action="/newreservation" method="POST">
    <div>
        Sala: <?= $room->getName() ?>
        <input type="hidden" id="room" name="room" value="<?= $room->getId() ?>">
    </div>
    <br>
    <div>
        <label for="datec">Data</label><br> 
        <input class="form-control" type="date" name="datec" value=<?= $date ?> disabled>
        <input type="hidden" id="date" name="date" value=<?= $date ?>>
    </div>
    <br>
    <div>
        <label for="topic">Temat</label><br>
        <input class="form-control" type="text" name="topic" id="topic">
    </div>
    <br>
    <div>
        <label for="Opis">Szczegóły</label><br>
        <textarea class="form-control" name="description" id="description" cols="50"></textarea><br/>
    </div>
    <br>
    <br>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Rezerwuj</button>
    </form>
</div>