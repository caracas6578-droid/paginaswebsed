CREATE DATABASE IF NOT EXISTS mundo_dino;

USE mundo_dino;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    correo VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    dino_favorito VARCHAR(50)
);