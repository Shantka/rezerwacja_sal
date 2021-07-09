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
    <title>Sale</title>
</head>
<body>
<div class="d-flex justify-content-center">
    <form method="post" action="/reservations" style="width: 100%; max-width: 420px;">
        <div class="text-center mb-4">
            <h1 class="h3 mb-3 mt-5 font-weight-normal">Sale dostępne pod wynajem</h1>
        </div>

        <div class="form-label-group mb-3">
            <label for="rooms">Sala nr 1</label><br />
            <!-- <img src="" > -->
            <p>
                Nowoczesna klimatyzowana sala o powierzchni 50 m², doskonała na spotkania rekrutacyjne oraz biznesowe. W układzie szkolnym pomieści 30 osób, w układzie teatralnym pomieści 60 osób, w układzie kameralnym pomieści 20 osób, przy ustawieniu stołów w podkowę pomieści 16 osób. Sala wyposażona w nagłośnienie, rzutnik, dostęp do sieciowego internetu oraz do bezprzewodowego internetu wi-fi.
            </p>
        </div>

        <div class="form-label-group mb-3">
            <label for="rooms">Sala nr 2</label><br />
            <!-- <img src="" > -->
            <p>
                Przestronna aula, sala konferencyjna lub sala szkoleniowa o powierzchni 165 m² dla 170 osób z krzesłami o stałym układzie teatralnym. Aula posiada naturalne oświetlenie z możliwością zaciemnienia oraz wyposażona jest w tablicę suchościeralną, rzutnik podwieszany z ekranem, flipchart, nagłośnienie, mównicę oraz wi-fi. Klimatyzowana aula przeznaczona jest przede wszystkim do konferencji, szkoleń i wykładów.
            </p>
        </div>

        <div class="form-label-group mb-3">
            <label for="rooms">Sala nr 3</label><br />
            <!-- <img src="" > -->
            <p>
                Salka konferencyjna o powierzchni 35 m² to przeszklone pomieszczenie stanowiące idealne tło niewielkich spotkań biznesowych, rozmów kwalifikacyjnych, jak i szkoleń w małych grupach. Sala jest klimatyzowana, posiada rzutnik, flipchart oraz wi-fi. W stałym układzie kameralnym pomieści 14 osób.
            </p>
        </div>

        <div class="form-label-group mb-3">
            <label for="rooms">Sala nr 4</label><br />
            <!-- <img src="" > -->
            <p>
                Duża sala wykładowa o powierzchni 90 m² z pojedynczymi ławkami dla uczestników, standardowo wyposażona w rzutnik z ekranem, tablicę suchościeralną, flipchart, klimatyzację oraz wi-fi. Ławki i krzesła w sali łatwo jest w razie potrzeby przestawić, aby jak najlepiej dostosować salę do potrzeb szkolenia.
            </p>
        </div>

        <div class="form-label-group mb-3">
            <label for="rooms">Sala nr 5</label><br />
            <!-- <img src="" > -->
            <p>
                Jasna, przestronna sala o powierzchni 45 m², mieszcząca do 40 osób, wyposażona w rzutnik z ekranem oraz flipchart. Idealnie sprawdzi się jako sala szkoleniowa - jej układ umożliwia dowolną aranżację i ustawienie krzeseł, dzięki czemu mogą z niej korzystać zarówno mniejsze, jak i większe grupy.
            </p>
        </div>

        <button type="submit" class="btn btn-lg btn-primary btn-block">Zarezerwuj</button>
    </form>
</div>
</body>
</html>