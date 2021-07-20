<div class="d-flex justify-content-center">
    <form action="/calendar" method="GET" name="roomform">
        <br>
        <div>
        <select class="form-control" style="font-size: 20px;" name="room" id="room" onchange="roomform.submit()">
            <?php foreach($rooms as $room) { ?>
                <option style="font-size: 20px;" value=<?= $room->getId() ?> <?= $room->getId() === $roomid ? 'selected' : '' ?>><?= $room->getName() ?> </option>
            <?php } ?>
        </select>
        </div>
    <form>
</div>

<div class="d-flex justify-content-center">
    <style>
        <?php include 'src/controls/css/calendar.css'; ?>
    </style>
    <?php 
        $calendar = new CalendarControl($occupieddates, $roomid);
        
        echo $calendar->show();
    ?>
</div>