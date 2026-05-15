CREATE DATABASE IF NOT EXISTS aluraplay;

USE aluraplay;

CREATE TABLE videos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    url VARCHAR(255) NOT NULL,
    titulo VARCHAR(255) NOT NULL
);

CREATE TABLE users (
    id INTEGER PRIMARY KEY,
    email TEXT,
    password TEXT
);
