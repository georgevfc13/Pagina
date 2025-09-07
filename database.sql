-- Script para crear la base de datos y tablas del sistema de login y registro GDA

CREATE DATABASE IF NOT EXISTS gda CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE gda;

-- Tabla para personas naturales
CREATE TABLE IF NOT EXISTS usuarios_naturales (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    cedula VARCHAR(20) NOT NULL UNIQUE,
    fecha_nacimiento DATE NOT NULL,
    genero VARCHAR(20),
    contacto VARCHAR(100) NOT NULL,
    tipo_contacto ENUM('correo','telefono') NOT NULL,
    terminos BOOLEAN NOT NULL DEFAULT 0,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabla para personas jurídicas
CREATE TABLE IF NOT EXISTS usuarios_juridicos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    razon_social VARCHAR(100) NOT NULL,
    correo VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    terminos BOOLEAN NOT NULL DEFAULT 0,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
