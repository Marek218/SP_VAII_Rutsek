DROP TABLE IF EXISTS `games`;
CREATE TABLE `games`
(
    `id`           int(11)      NOT NULL AUTO_INCREMENT,
    `name`         varchar(100) NOT NULL,
    `release_date` int(4)       NOT NULL,
    `cover_image`  varchar(250) NOT NULL,
    `developer_id` int(11)      NOT NULL,
    `description`  varchar(100) NOT NULL,
    FOREIGN KEY (`developer_id`) REFERENCES `developers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    PRIMARY KEY (`id`)
);