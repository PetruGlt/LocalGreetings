CREATE TABLE `users` (
  `id` int(11) PRIMARY KEY AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
);

CREATE TABLE `sports_fields`
( `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY, `osm_id` INT NOT NULL,
`type` VARCHAR(50) NOT NULL, `lat` DECIMAL(9, 6), `lon` DECIMAL(9, 6), `name` VARCHAR(100), `sport` VARCHAR(50) );