ALTER TABLE `sale`
ADD `obrazUrl` varchar(255);

UPDATE `sale` SET `obrazUrl` = 'images/room1.png' WHERE `id`=1;
UPDATE `sale` SET `obrazUrl` = 'images/room2.png' WHERE `id`=2;
UPDATE `sale` SET `obrazUrl` = 'images/room3.png' WHERE `id`=3;
UPDATE `sale` SET `obrazUrl` = 'images/room4.png' WHERE `id`=4;
UPDATE `sale` SET `obrazUrl` = 'images/room5.png' WHERE `id`=5;