<section class="my-5">
    <h3>Rezerwacja</h3>
</section>
<div>
    <form action="/testreservation" method="POST">
    <div>
        <label for="date">Data</label>
        <input type="date" name="date" id="date" onchange="ondateselect(this.value)">
    </div>

    <div>
        <label for="rooms">Sale</label><br />
        <?php foreach($rooms as $room) { ?>
            <input type="radio" name="room" id=<?= $room->getId() ?> onchange="testme(this.id)"
                value=<?= $room->getId() ?>><?= $room->getName() ?><br/>
        <?php } ?>
    </div>
    
    <div>
        <label for="topic">Temat</label><br />
        <input type="text" name="topic" id="topic">
    </div>

    <div>
        <label for="Opis">Szczegóły</label><br/>
        <input type="text" name="description" id="description"><br/>
    </div>
    <br />
    <p>Suggestions: <span id="txtHint"></span></p>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Rezerwuj</button>
    </form>
</div>
<script>
function ondateselect(str) {
     document.getElementById("txtHint").innerHTML = str;
}
</script>