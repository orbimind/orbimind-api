CREATE DATABASE IF NOT EXISTS usof;

CREATE USER IF NOT EXISTS 'paxanddos'@'localhost' IDENTIFIED WITH mysql_native_password BY 'securepass';
GRANT ALL ON *.* TO 'paxanddos'@'localhost' WITH GRANT OPTION;

CREATE TABLE usof.users (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `username` VARCHAR(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL UNIQUE,
    `password` VARCHAR(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
    `name` VARCHAR(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
    `email` VARCHAR(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL UNIQUE,
    `picture` INT UNSIGNED NULL DEFAULT NULL , `rating` INT NULL DEFAULT '0' UNIQUE,
    `role` ENUM('user','admin') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'user'
) ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_general_ci;

CREATE TABLE usof.categories (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `title` VARCHAR(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
    `description` VARCHAR(256) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_general_ci;

CREATE TABLE usof.posts (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT UNSIGNED NOT NULL ,
    `title` VARCHAR(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
    `date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
    `status` BOOLEAN NOT NULL DEFAULT TRUE ,
    `content` VARCHAR(4096) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL ,
    `category_id` INT UNSIGNED NOT NULL,
    FOREIGN KEY (user_id) REFERENCES usof.users (id),
    FOREIGN KEY (category_id) REFERENCES usof.categories (id)
) ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_general_ci;

CREATE TABLE usof.comments (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT UNSIGNED NOT NULL ,
    `date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
    `content` VARCHAR(4096) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
    FOREIGN KEY (user_id) REFERENCES usof.users (id)
) ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_general_ci;

CREATE TABLE usof.likes (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT UNSIGNED NOT NULL ,
    `date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
    `post_id` INT UNSIGNED NOT NULL ,
    `type` ENUM('like','dislike') CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
    FOREIGN KEY (user_id) REFERENCES usof.users (id),
    FOREIGN KEY (post_id) REFERENCES usof.posts (id)
) ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_general_ci;
