CREATE TABLE `uzytkownicy` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `login` varchar(255),
  `haslo` varchar(255),
  `imie` varchar(255),
  `isAdmin` boolean
);

CREATE TABLE `sale` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `nazwa` varchar(255),
  `liczbaOsob` int,
  `opis` varchar(255)
);

CREATE TABLE `rezerwacje` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `organizatorId` int,
  `salaId` int,
  `start` datetime,
  `koniec` datetime,
  `temat` varchar(255),
  `opis` varchar(255)
);

CREATE TABLE `uczestnicy` (
  `uzytkownikId` int,
  `rezerwacjaId` int,
  `potwierdzone` boolean,
  `odrzucone` boolean
);

CREATE TABLE `wyposazenieRezerwacji` (
  `wyposazenieId` int,
  `rezerwacjaId` int
);

CREATE TABLE `wyposazenie` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `opis` varchar(255),
  `liczba` int
);

CREATE TABLE `notatki` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `notatka` varchar(255),
  `rezerwacjaId` varchar(255)
);

ALTER TABLE `rezerwacje` ADD FOREIGN KEY (`organizatorId`) REFERENCES `uzytkownicy` (`id`);

ALTER TABLE `rezerwacje` ADD FOREIGN KEY (`salaId`) REFERENCES `sale` (`id`);

ALTER TABLE `uczestnicy` ADD FOREIGN KEY (`uzytkownikId`) REFERENCES `uzytkownicy` (`id`);

ALTER TABLE `uczestnicy` ADD FOREIGN KEY (`rezerwacjaId`) REFERENCES `rezerwacje` (`id`);

ALTER TABLE `wyposazenieRezerwacji` ADD FOREIGN KEY (`rezerwacjaId`) REFERENCES `rezerwacje` (`id`);

ALTER TABLE `notatki` ADD FOREIGN KEY (`rezerwacjaId`) REFERENCES `rezerwacje` (`id`);

ALTER TABLE `wyposazenieRezerwacji` ADD FOREIGN KEY (`wyposazenieId`) REFERENCES `wyposazenie` (`id`);
