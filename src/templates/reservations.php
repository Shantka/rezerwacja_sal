<?php
/** @var array $formError */
/** @var string $formUsername */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../../style.css" rel="stylesheet" type="text/css">
    <title>Rezerwacje sal</title>
</head>
<body>
<div class="d-flex justify-content-center">
    <form method="post" action="/reservations" style="width: 100%; max-width: 420px;">
        <div class="text-center mb-4">
            <h1 class="h3 mb-3 mt-5 font-weight-normal">Rezerwowanie sali</h1>
        </div>

        <div class="form-label-group mb-3">
            <label for="date">Data</label>
            <input type="date" name="date" id="date">
        </div>

        <div class="form-label-group mb-3">
            <label for="text">Imię i nazwisko</label>
            <select id="name" name="name" size="5">

                    <option>Marian Kowalski</option>

            </select>
        </div>

        <div class="form-label-group mb-3">
            <label for="rooms">Sale</label>
            <input type="radio" name="rooms" id="rooms" value="Sala 1">Sala 1<br />
            <input type="radio" name="rooms" id="rooms" value="Sala 2">Sala 2<br />
            <input type="radio" name="rooms" id="rooms" value="Sala 3">Sala 3<br />
            <input type="radio" name="rooms" id="rooms" value="Sala 4">Sala 4<br />
            <input type="radio" name="rooms" id="rooms" value="Sala 5">Sala 5<br />
        </div>

        <div class="form-label-group mb-3">
            <label for="text">Imię i nazwisko</label>
            <input type="text" name="name" id="name" placeholder="Adam Nowak" required="required">
        </div>

        <button type="submit" class="btn btn-lg btn-primary btn-block">Zarezerwuj</button>
    </form>
</div>
</body>
</html>