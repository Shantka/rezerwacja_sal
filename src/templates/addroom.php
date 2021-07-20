<div class="d-flex justify-content-center">
<section class="my-5">
    <?php if (isset($id) && $id > 0) { ?>
        <h3>Edycja sali</h3>
    <?php } else { ?>
        <h3>Nowa sala</h3>
    <?php } ?>
</section>
</div>
<div class="d-flex justify-content-center">
    <form action="/room" method="POST">
        <div>
            <label for="name">Nazwa</label><br>
            <input type="text" name="name" id="name"
                class="form-control <?= isset($formError['name']) ? 'is-invalid' : ''; ?>"
                value="<?= htmlentities($formName) ?>">
            <?php if (isset($formError['name'])) {
                echo sprintf('<div class="invalid-feedback">%s</div>', htmlentities($formError['name']));
            } ?>            
        </div>
        <br>
        <div>
            <label for="description">Opis</label><br>
            <textarea name="description" rows="5" cols="50" id="description"
                class="form-control <?= isset($formError['description']) ? 'is-invalid' : ''; ?>"
                ><?= htmlentities($formDescription) ?></textarea>
            <?php if (isset($formError['description'])) {
                echo sprintf('<div class="invalid-feedback">%s</div>', htmlentities($formError['description']));
            } ?>                   
        </div>
        <br>
        <div>
            <label for="personcount">Liczba osób</label><br>
            <input type="number" name="personcount" id="personcount"
                class="form-control <?= isset($formError['personcount']) ? 'is-invalid' : ''; ?>"
                value="<?= htmlentities($formPersoncount) ?>">
            <?php if (isset($formError['personcount'])) {
                echo sprintf('<div class="invalid-feedback">%s</div>', htmlentities($formError['personcount']));
            } ?>                  
        </div>
        <br>
        <br>
        <input type="hidden" id="id" name="id" value="<?= $id ?>">
        <button class="btn btn-lg btn-primary btn-block" type="submit">Zapisz</button>
    </form>
</div>