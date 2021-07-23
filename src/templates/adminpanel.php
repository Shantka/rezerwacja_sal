<div class="d-flex justify-content-center">
<section class="my-5">
    <h3>Panel administratora</h3>
</section>
</div>
<div>

    <table class="table">
    <tbody>
        <?php foreach($reservations as $meeting) { ?>
        <tr>
        <th style="width: 100px;"><?= date_format(date_create($meeting->getStart()), "m-d-Y") ?></th>
        <td><?= $meeting->getTopic() ?></td>
        <td><button type="button" class="btn btn-secondary" onclick="location.href='reservation?id=<?= $meeting->getId() ?>'">Szczegóły</button></td>
        </tr>
        <?php } ?>
    </tbody>
    </table>

</div>