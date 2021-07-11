<?php

?>
<style>
        <?php include 'src/controls/css/rooms.css'; ?>
    </style>
<section class="my-5">
    <h3>Sale</h3>
</section>
<div class="row">
    <?php if (count($rooms)) { ?>
        <table class="table">
            <tbody>
            <?php foreach($rooms as $room) { ?>
                <tr>                    
                    <th style="width: 100px;"><?= $room->getName() ?></th>
                    <td><?= $room->getDescription() ?></td>        
                    <td>Liczba osób:<?= $room->getMaxPersonCount() ?></td>
                    <?php 
                        $image = "images/".$room->getImageUrl();
                    ?>         
                
                    <td><img src="<?= $room->getImageUrl() ?>" width="100" height="100" /></td> 
                </tr>
            <?php } ?>
            </tbody>
        </table>
    <?php } ?>
</div>

<section class="my-5">
    <h3>Użytkownicy oprócz zalogowanego</h3>
</section>
<div class="row">
    <?php if (count($users)) { ?>
        <table class="table">
            <tbody>
            <?php foreach($users as $user) { ?>
                <tr>                    
                    <th><?= $user->getUsername() ?></th>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    <?php } ?>
</div>
