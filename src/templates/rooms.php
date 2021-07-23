<style>
    <?php include 'src/controls/css/rooms.css'; ?>
</style>
<div class="d-flex justify-content-center">
<section class="my-5">
    <h3>Sale</h3>
</section>
</div>
<?php if ($isadmin) { ?>
    <button type="button" class="btn btn-secondary" onclick="location.href='room'">Dodaj salę</button>
    <br><br>   
<?php } ?>
<div class="row">
    <?php if (count($rooms)) { ?>
        <table class="table">
            <tbody>
            <?php foreach($rooms as $room) { ?>
                <tr>                    
                    <th style="width: 100px;"><?= $room->getName() ?></th>
                    <td><?= $room->getDescription() ?></td>        
                    <td>Liczba osób:<?= $room->getMaxPersonCount() ?></td>
                    <td>
                        <img src="<?= $room->getImageUrl() ?>" width="100" height="100"  alt="Brak obrazka"/>
                    </td> 
                    <?php if ($isadmin) { ?>
                        <td><button type="button" class="btn btn-secondary" onclick="location.href='room?id=<?= $room->getId() ?>'">Edytuj</button></td>
                    <?php } ?>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    <?php } ?>
</div>
