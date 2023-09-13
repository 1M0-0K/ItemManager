CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `admin` tinyint(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `users` ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `name` (`name`);
 
ALTER TABLE `users` MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

INSERT INTO `users` (`name`, `password`, `admin`) VALUES ('admin', '*2470C0C06DEE42FD1618BB99005ADCA2EC9D1E19', '1');
INSERT INTO `users` (`name`, `password`, `admin`) VALUES ('Dandelion', '*2470C0C06DEE42FD1618BB99005ADCA2EC9D1E19', '0');
INSERT INTO `users` (`name`, `password`, `admin`) VALUES ('Daniel', '*2470C0C06DEE42FD1618BB99005ADCA2EC9D1E19', '0');
INSERT INTO `users` (`name`, `password`, `admin`) VALUES ('Michael', '*2470C0C06DEE42FD1618BB99005ADCA2EC9D1E19', '0');
  
CREATE TABLE `item` (
  `item_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT 'Noname',
  `type` tinyint(2) NOT NULL DEFAULT '0',
  `attack` int(11) DEFAULT '0',
  `magic` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `item` ADD PRIMARY KEY (`item_id`);
 
INSERT INTO `item` (`item_id`, `name`, `type`, `attack`, `magic`) VALUES (1, 'Sword', 1, 15, 10);
INSERT INTO `item` (`item_id`, `name`, `type`, `attack`, `magic`) VALUES (2, 'Traditional helmet', 5, 15, 0);
INSERT INTO `item` (`item_id`, `name`, `type`, `attack`, `magic`) VALUES (3, 'Lion Bow', 4, 45, 0);
INSERT INTO `item` (`item_id`, `name`, `type`, `attack`, `magic`) VALUES (4, 'Spear', 3, 20, 0);
INSERT INTO `item` (`item_id`, `name`, `type`, `attack`, `magic`) VALUES (5, 'Eye of Baldur', 7, 0, 0);
INSERT INTO `item` (`item_id`, `name`, `type`, `attack`, `magic`) VALUES (6, 'Blue potion', 6, 0, 0);
INSERT INTO `item` (`item_id`, `name`, `type`, `attack`, `magic`) VALUES (7, 'Red potion', 6, 0, 0);
INSERT INTO `item` (`item_id`, `name`, `type`, `attack`, `magic`) VALUES (8, 'Bamboo sword', 1, 25, 20);
INSERT INTO `item` (`item_id`, `name`, `type`, `attack`, `magic`) VALUES (9, 'Dragon dagger', 2, 45, 0);
INSERT INTO `item` (`item_id`, `name`, `type`, `attack`, `magic`) VALUES (10, 'Shield', 5, 20, 0);
INSERT INTO `item` (`item_id`, `name`, `type`, `attack`, `magic`) VALUES (11, 'Armor', 5, 50, 0);
  
CREATE TABLE `inventory` (
  `id` int(11) unsigned NOT NULL,
  `owner_id` bigint(2) unsigned NOT NULL DEFAULT '0',
  `pos` smallint(5) unsigned NOT NULL DEFAULT '0',
  `amount` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `item_id` int(11) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `inventory` ADD PRIMARY KEY (`id`);
ALTER TABLE `inventory` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
 
INSERT INTO `inventory` (`owner_id`, `pos`, `amount`, `item_id`) VALUES (2, 2, 1, 1);
INSERT INTO `inventory` (`owner_id`, `pos`, `amount`, `item_id`) VALUES (3, 2, 1, 2);
INSERT INTO `inventory` (`owner_id`, `pos`, `amount`, `item_id`) VALUES (4, 10, 1, 3);
INSERT INTO `inventory` (`owner_id`, `pos`, `amount`, `item_id`) VALUES (2, 4, 1, 4);
INSERT INTO `inventory` (`owner_id`, `pos`, `amount`, `item_id`) VALUES (2, 6, 1, 10);
INSERT INTO `inventory` (`owner_id`, `pos`, `amount`, `item_id`) VALUES (3, 6, 1, 11);
INSERT INTO `inventory` (`owner_id`, `pos`, `amount`, `item_id`) VALUES (4, 5, 50, 7);
INSERT INTO `inventory` (`owner_id`, `pos`, `amount`, `item_id`) VALUES (4, 3, 1, 8);
INSERT INTO `inventory` (`owner_id`, `pos`, `amount`, `item_id`) VALUES (3, 8, 1, 9);
INSERT INTO `inventory` (`owner_id`, `pos`, `amount`, `item_id`) VALUES (4, 9, 1, 5);
INSERT INTO `inventory` (`owner_id`, `pos`, `amount`, `item_id`) VALUES (3, 11, 20, 6);