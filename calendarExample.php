<?php
include 'Calendar.php';
$calendar = new Calendar('2021-02-02');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Event Calendar</title>
    <link href="style.css" rel="stylesheet" type="text/css">
    <link href="calendar.css" rel="stylesheet" type="text/css">
</head>
<body>
<nav class="navtop">
    <div>
        <h1>Event Calendar</h1>
    </div>
</nav>
<div class="content home">
    <?=$calendar?>
</div>
</body>
</html>