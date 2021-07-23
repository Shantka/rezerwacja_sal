ALTER TABLE `sale`
ADD `obrazUrl` varchar(255);

UPDATE `sale` SET `obrazUrl` = 'images/room12.jpg' WHERE `id`=1;
UPDATE `sale` SET `obrazUrl` = 'images/room165.jpg' WHERE `id`=2;
UPDATE `sale` SET `obrazUrl` = 'images/room35.jpg' WHERE `id`=3;
UPDATE `sale` SET `obrazUrl` = 'images/room90.jpg' WHERE `id`=4;
UPDATE `sale` SET `obrazUrl` = 'images/room45.jpg' WHERE `id`=5;
