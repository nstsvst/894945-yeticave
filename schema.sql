DROP DATABASE IF EXISTS yeticave;
CREATE DATABASE yeticave
 DEFAULT CHARACTER SET utf8
 DEFAULT COLLATE utf8_general_ci;

 USE yeticave;

 CREATE TABLE users (
   id INT AUTO_INCREMENT PRIMARY KEY,
   registration_date datetime,
   email CHAR(255) NOT NULL UNIQUE,
   name CHAR(255) NOT NULL,
   password CHAR(255),
   avatar CHAR(128),
   contacts TEXT
 );
 CREATE TABLE lot (
   id INT AUTO_INCREMENT PRIMARY KEY,
   category_id INT NOT NULL,
   user_id_winner INT NOT NULL,
   user_id_autor INT NOT NULL,
   name CHAR(255) NOT NULL,
   creatiom_date datetime,
   end_date datetime,
   description CHAR(255),
   image CHAR(255),
   init_price INT,
   step INT
 );
 CREATE TABLE bid (
   id INT AUTO_INCREMENT PRIMARY KEY,
   lot_id INT NOT NULL,
   date datetime,
   sum_prise INT
 );
 CREATE TABLE category (
   id INT AUTO_INCREMENT PRIMARY KEY,
   categories CHAR(255) NOT NULL UNIQUE,
   alias CHAR(255)
 );
