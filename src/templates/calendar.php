<div>
    <style>
        <?php include 'src/controls/css/calendar.css'; ?>
    </style>
    <?php 
        $calendar = new CalendarControl();
        
        echo $calendar->show();
    ?>
</div>