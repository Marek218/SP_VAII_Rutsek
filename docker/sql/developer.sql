DROP TABLE IF EXISTS `developers`;
CREATE TABLE `developers`
(
    `id`      int(11)      NOT NULL AUTO_INCREMENT,
    `name`    varchar(100) NOT NULL,
    `country` varchar(100) NOT NULL,
    `website` varchar(100) NOT NULL,
    PRIMARY KEY (`id`)
);
ALTER TABLE `developers`
MODIFY `website` varchar(250) NOT NULL;