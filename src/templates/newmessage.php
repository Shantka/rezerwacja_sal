<div class="d-flex justify-content-center">
<section class="my-5">
    <h3>Nowa wiadomość</h3>
</section>
</div>
<div class="d-flex justify-content-center">
    <form action="/newmessage" method="POST">
        <div>
            <span>Data</span><br>
            <span><?= date_format(date_create($reservation->getStart()), "m-d-Y") ?></span>
        </div>
        <br>
        <div>
            <span>Temat</span><br>
            <span><?= $reservation->getTopic() ?></span>
        </div>
        <br>
        <div>
            <label for="message">Wiadomość</label><br>
            <textarea name="message" rows="5" cols="50" id="message"
                class="form-control <?= isset($formError['message']) ? 'is-invalid' : ''; ?>"
                ></textarea>
            <?php if (isset($formError['message'])) {
                echo sprintf('<div class="invalid-feedback">%s</div>', htmlentities($formError['message']));
            } ?>                   
        </div>
        <br>
        <br>
        <input type="hidden" id="reservationid" name="reservationid" value="<?= $reservationid ?>">
        <button class="btn btn-lg btn-primary btn-block" type="submit">Wyślij</button>        
    </form>
<div>