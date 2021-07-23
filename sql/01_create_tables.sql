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
  `opis` varchar(4500),
  `obrazUrl` varchar(255)
);

CREATE TABLE `rezerwacje` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `organizatorId` int,
  `salaId` int,
  `start` datetime,
  `koniec` datetime,
  `temat` varchar(255),
  `opis` varchar(4500),
  `notatka` varchar(4500)
);

CREATE TABLE `uczestnicy` (
  `uzytkownikId` int,
  `rezerwacjaId` int,
  `potwierdzone` boolean,
  `odrzucone` boolean
);

CREATE TABLE `wiadomosci` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `uzytkownikId` int,
  `rezerwacjaId` int,
  `wiadomosc` varchar(4500)
);

ALTER TABLE `rezerwacje` ADD FOREIGN KEY (`organizatorId`) REFERENCES `uzytkownicy` (`id`);

ALTER TABLE `rezerwacje` ADD FOREIGN KEY (`salaId`) REFERENCES `sale` (`id`);

ALTER TABLE `uczestnicy` ADD FOREIGN KEY (`uzytkownikId`) REFERENCES `uzytkownicy` (`id`);

ALTER TABLE `uczestnicy` ADD FOREIGN KEY (`rezerwacjaId`) REFERENCES `rezerwacje` (`id`) ON DELETE CASCADE;

ALTER TABLE `wiadomosci` ADD FOREIGN KEY (`uzytkownikId`) REFERENCES `uzytkownicy` (`id`);

ALTER TABLE `wiadomosci` ADD FOREIGN KEY (`rezerwacjaId`) REFERENCES `rezerwacje` (`id`) ON DELETE CASCADE;
