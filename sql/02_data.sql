INSERT INTO `sale`(liczbaOsob, nazwa, obrazUrl, opis)
VALUES
    (60, 'Sala 1', 'images/room1.png', 'Nowoczesna klimatyzowana sala o powierzchni 50 m², doskonała na spotkania rekrutacyjne oraz biznesowe. W układzie szkolnym pomieści 30 osób, w układzie teatralnym pomieści 60 osób, w układzie kameralnym pomieści 20 osób, przy ustawieniu stołów w podkowę pomieści 16 osób. Sala wyposażona w nagłośnienie, rzutnik, dostęp do sieciowego internetu oraz do bezprzewodowego internetu wi-fi.'),
    (170, 'Sala 2', 'images/room2.png', 'Przestronna aula, sala konferencyjna lub sala szkoleniowa o powierzchni 165 m² dla 170 osób z krzesłami o stałym układzie teatralnym. Aula posiada naturalne oświetlenie z możliwością zaciemnienia oraz wyposażona jest w tablicę suchościeralną, rzutnik podwieszany z ekranem, flipchart, nagłośnienie, mównicę oraz wi-fi. Klimatyzowana aula przeznaczona jest przede wszystkim do konferencji, szkoleń i wykładów.'),
    (14, 'Sala 3', 'images/room3.png', 'Salka konferencyjna o powierzchni 35 m² to przeszklone pomieszczenie stanowiące idealne tło niewielkich spotkań biznesowych, rozmów kwalifikacyjnych, jak i szkoleń w małych grupach. Sala jest klimatyzowana, posiada rzutnik, flipchart oraz wi-fi. W stałym układzie kameralnym pomieści 14 osób.'),
    (50, 'Sala 4', 'images/room4.png', 'Duża sala wykładowa o powierzchni 90 m² z pojedynczymi ławkami dla uczestników, standardowo wyposażona w rzutnik z ekranem, tablicę suchościeralną, flipchart, klimatyzację oraz wi-fi. Ławki i krzesła w sali łatwo jest w razie potrzeby przestawić, aby jak najlepiej dostosować salę do potrzeb szkolenia.'),
    (40, 'Sala 5', 'images/room5.png', 'Jasna, przestronna sala o powierzchni 45 m², mieszcząca do 40 osób, wyposażona w rzutnik z ekranem oraz flipchart. Idealnie sprawdzi się jako sala szkoleniowa - jej układ umożliwia dowolną aranżację i ustawienie krzeseł, dzięki czemu mogą z niej korzystać zarówno mniejsze, jak i większe grupy.');

INSERT INTO `uzytkownicy` (`login`, `imie`, `haslo`, `isAdmin`) 
VALUES
    ('m_kowalski@email.com', 'Marian Kowalski', '207023ccb44feb4d7dadca005ce29a64', 1),
    ('j_wtorek@email.com', 'Jacek Wtorek', '207023ccb44feb4d7dadca005ce29a64', 0),
    ('a_sroda@email.com', 'Adam Środa', '207023ccb44feb4d7dadca005ce29a64', 0),
    ('k_czwartek@email.com', 'Kazimierz Czwartek', '207023ccb44feb4d7dadca005ce29a64', 0);

INSERT INTO `wyposazenie` (`opis`, `liczba`) 
VALUES 
    ('Projektor', 15), 
    ('Tablica', 5), 
    ('Laptop', 10), 
    ('Mikrofon', 100), 
    ('Wskaźnik', 10), 
    ('Myszka', 30), 
    ('Flipchart', 10);