# CREATE DATABASE IF NOT EXISTS `hackathon` DEFAULT CHARACTER SET utf8;

CREATE TABLE IF NOT EXISTS `feed` (
  `id`       INT UNSIGNED           NOT NULL AUTO_INCREMENT,
  `message`  TEXT                   NOT NULL,
  `picture`  TINYTEXT DEFAULT NULL,
  `type`     ENUM('system', 'user') NOT NULL,
  `location` TINYTEXT               NOT NULL,
  `score`    INT                    NOT NULL DEFAULT '0',
  `created`  TIMESTAMP              NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `token`    CHAR(32)               NOT NULL,
  PRIMARY KEY (`id`),
  KEY `score` (`score`, `created`),
  KEY `create` (`created`)
)
  ENGINE =InnoDB
  DEFAULT CHARSET =utf8;

CREATE TABLE IF NOT EXISTS `block_list` (
  `token` CHAR(32) NOT NULL,
  PRIMARY KEY (`token`)
)
  ENGINE =InnoDB
  DEFAULT CHARSET =utf8;

CREATE TABLE IF NOT EXISTS `user` (
  `email` VARCHAR(30) NOT NULL,
  PRIMARY KEY (`email`)
)
  ENGINE =InnoDB
  DEFAULT CHARSET =utf8;

CREATE TABLE IF NOT EXISTS `vote_status` (
  `feed_id` INT UNSIGNED                 NOT NULL,
  `token`   CHAR(32)                     NOT NULL,
  `type`    ENUM('positive', 'negative') NOT NULL,
  PRIMARY KEY (feed_id, token)
)
  ENGINE =InnoDB
  DEFAULT CHARSET =utf8;

CREATE TABLE IF NOT EXISTS `inquiry` (
  `id`        INT UNSIGNED NOT NULL,
  `phone`     CHAR(10),
  `email`     VARCHAR(50),
  `message`   TINYTEXT     NOT NULL,
  `is_solved` TINYINT DEFAULT '0',
  `created`   TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated`   DATETIME,
  PRIMARY KEY (id),
  KEY `created` (`created`),
  KEY `is_solved` (`is_solved`)
)
  ENGINE =InnoDB
  DEFAULT CHARSET =utf8;

