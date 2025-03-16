CREATE DATABASE php_crud;
USE php_crud;

CREATE TABLE users (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(30),
    last_name VARCHAR(30),
    email VARCHAR(50),
    phone VARCHAR(11),
    avatar VARCHAR(255),
    gender VARCHAR(10),
    address VARCHAR(255)
);