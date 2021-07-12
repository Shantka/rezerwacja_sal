<section class="my-5">
    <h3>Rezerwacja</h3>
</section>
<div class="row">
    <table class="table">
        <tbody>
            <tr>
                <th style="width: 150px;">Data</th>
                <td><?= $reservation->getStart() ?></td>
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
                <td><?= $reservation->getTopic() ?></td>
            </tr>
            <tr>
                <th>Opis</th>
                <td><?= $reservation->getDescription() ?></td>
            </tr>
            <tr>
                <th>Zaproszeni uczestnicy</th>
                <td></td>
            </tr>
            <tr>
                <th>Zaproś</th>
                <td></td>
            </tr>
        </tbody>
    </table>
</div>