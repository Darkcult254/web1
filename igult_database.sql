-- Create a new database if it doesn't exist
CREATE DATABASE IF NOT EXISTS `igult_database`;

-- Use the new database
USE `igult_database`;

-- Create the categories table to store category names
CREATE TABLE IF NOT EXISTS `categories` (
  `id` INT(30) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert the specified categories into the 'categories' table
INSERT INTO `categories` (`name`) VALUES
('BLOG'),
('NEWS'),
('SPORTS'),
('TECH'),
('BUSINESS'),
('ACADEMIA'),
('CODEBIN'),
('TERMS AND CONDITIONS'),
('SUBSCRIPTION'),
('CONTACT US');

-- Create the articles table with categories (excluding special categories)
CREATE TABLE IF NOT EXISTS `articles` (
  `id` INT(30) NOT NULL AUTO_INCREMENT,
  `title` TEXT NOT NULL,
  `content` LONGTEXT NOT NULL,
  `author` VARCHAR(100) NOT NULL,
  `date_submitted` TIMESTAMP NOT NULL,
  `category_id` INT(30) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`category_id`) REFERENCES `categories`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Sample data for table `articles`
INSERT INTO `articles` (`title`, `content`, `author`, `date_submitted`, `category_id`)
VALUES
('Sample Blog Article', 'Content for Sample Blog Article', 'John Doe', NOW(), 1),  -- BLOG
('Sample News Article', 'Content for Sample News Article', 'Jane Smith', NOW(), 2),  -- NEWS
('Sample Sports Article', 'Content for Sample Sports Article', 'Mike Johnson', NOW(), 3),  -- SPORTS
('Sample Tech Article', 'Content for Sample Tech Article', 'Sarah Brown', NOW(), 4),  -- TECH
('Sample Business Article', 'Content for Sample Business Article', 'David Lee', NOW(), 5),  -- BUSINESS
('Sample Academia Article', 'Content for Sample Academia Article', 'Emily White', NOW(), 6),  -- ACADEMIA
('Sample Codebin Article', 'Content for Sample Codebin Article', 'Alex Carter', NOW(), 7);  -- CODEBIN

-- Create the multimedia_files table to store multimedia for articles (excluding special categories)
CREATE TABLE IF NOT EXISTS `multimedia_files` (
  `id` INT(30) NOT NULL AUTO_INCREMENT,
  `filename` VARCHAR(255) NOT NULL,
  `filetype` VARCHAR(50) NOT NULL,
  `filedata` LONGBLOB,
  `article_id` INT(30) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`article_id`) REFERENCES `articles`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Create the comments table
CREATE TABLE IF NOT EXISTS `comments` (
  `id` INT(30) NOT NULL AUTO_INCREMENT,
  `article_id` INT(30) NOT NULL,
  `comment` TEXT NOT NULL,
  `user` VARCHAR(100) NOT NULL,
  `date` TIMESTAMP NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`article_id`) REFERENCES `articles`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Create the contact_messages table to store contact form submissions
CREATE TABLE IF NOT EXISTS `contact_messages` (
  `id` INT(30) NOT NULL AUTO_INCREMENT,
  `first_name` VARCHAR(50) NOT NULL,
  `last_name` VARCHAR(50) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `message` TEXT NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Create the subscribers table to store subscriber data
CREATE TABLE IF NOT EXISTS `subscribers` (
  `id` INT(30) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Commit the transaction and set character sets
COMMIT;
