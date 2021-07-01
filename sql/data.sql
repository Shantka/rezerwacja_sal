INSERT INTO `sale`(liczbaOsob, nazwa, opis)
VALUES
    (60, 'Sala 1', 'Nowoczesna klimatyzowana sala o powierzchni 50 m2 doskonała na spotkania rekrutacyjne oraz biznesowe. W układzie szkolnym pomieści 30 osób, w układzie teatralnym pomieści 60 osób, w układzie kameralnym pomieści 20 osób, przy ustawieniu stołów w podkowę pomieści 16 osób. Sala wyposażona w nagłośnienie, rzutnik, dostęp do sieciowego internetu oraz do bezprzewodowego internetu WI-FI.'),
    (170, 'Sala 2', 'Przestronna aula, sala konferencyjna lub sala szkoleniowa o powierzchni 165 m2 dla 170 osób z krzesłami o stałym układzie teatralnym. Aula posiada naturalne oświetlenie z możliwością zaciemnienia oraz wyposażona jest w tablicę suchościeralną, rzutnik podwieszany z ekranem, flipchart, nagłośnienie oraz wi-fi. Mównica w sali pozwala na lepszy kontakt ze słuchaczami. Klimatyzowana aula przeznaczona jest przede wszystkim do konferencji, szkoleń i wykładów.'),
    (14, 'Sala 3', 'Salka konferncyjna o powierzchni 35 m2 to przeszklone pomieszczenie, stanowiące idealne tło niewielkich spotkań biznesowych, rozmów kwalifikacyjnych, jak i szkoleń w małych grupach. Sala jest klimatyzowana, posiada rzutnik, flipchart oraz wi-fi. W stałym układzie kameralnym, pomieści 14 osób.'),
    (50, 'Sala 4', 'Duża sala wykładowa o powierzchni 90m2 z pojedynczymi ławkami dla uczestników, standardowo wyposażona w rzutnik z ekranem, tablicę suchościeralną, flipchart, klimatyzację oraz wi-fi. Ławki i krzesła w sali łatwo jest w razie potrzeby przestawić, aby jak najlepiej dostosować salę do potrzeb szkolenia.'),
    (40, 'Sala 5', 'Jasna, przestronna sala o powierzchni 45m, mieszcząca do 40 osób, wyposażona w rzutnik z ekranem oraz flipchart, które ułatwią przeprowadzenie skutecznego szkolenia. Przeznaczona jest do spotkań szkoleniowych lub konferencji, oświetlona światłem naturalnym, z możliwością wybrania jednego spośród wielu ustawień, co pozwoli dostować układ krzeseł tak, by uczestnicy czerpali ze szkolenia jak najwięcej.');

INSERT INTO `uzytkownicy` (`login`, `imie`, `haslo`, `isAdmin`) 
VALUES
    ('m_kowalski@email.com', 'Marian Kowalski', '207023CCB44FEB4D7DADCA005CE29A64', 1),
    ('j_wtorek@email.com', 'Jacek Wtorek', '207023CCB44FEB4D7DADCA005CE29A64', 0),
    ('a_sroda@email.com', 'Adam Środa', '207023CCB44FEB4D7DADCA005CE29A64', 0),
    ('k_czwartek@email.com', 'Kazimierz Czwartek', '207023CCB44FEB4D7DADCA005CE29A64', 0);

INSERT INTO `wyposazenie` (`opis`, `liczba`) 
VALUES 
    ('Projektor', 15), 
    ('Tablica', 5), 
    ('Laptop', 10), 
    ('Mikrofon', 100), 
    ('Wskaźnik', 10), 
    ('Myszka', 30), 
    ('Flipchart', 10);