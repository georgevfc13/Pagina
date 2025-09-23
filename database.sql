-- Tabla para servicios
-- Esta tabla almacena los servicios ofrecidos por empresas o administradores.
-- Campos:
--   id: Identificador único del servicio
--   titulo: Título del servicio
--   descripcion: Descripción detallada
--   ubicacion: Ciudad o lugar donde se ofrece el servicio
--   tipo: Tipo de servicio (por ejemplo, consultoría, capacitación, etc.)
--   fecha_publicacion: Fecha en que se publica el servicio
--   empresa: Nombre de la empresa que ofrece el servicio
--   precio: Rango o valor del servicio (opcional)
CREATE TABLE IF NOT EXISTS servicios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(150) NOT NULL,
    descripcion TEXT NOT NULL,
    ubicacion VARCHAR(100) NOT NULL,
    tipo VARCHAR(50) NOT NULL,
    fecha_publicacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    empresa VARCHAR(100) NOT NULL,
    precio VARCHAR(50)
);
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


-- Tabla para vacantes
-- Esta tabla almacena las vacantes publicadas por empresas o administradores.
-- Campos:
--   id: Identificador único de la vacante
--   titulo: Título de la vacante
--   descripcion: Descripción detallada
--   ubicacion: Ciudad o lugar de la vacante
--   tipo: Tipo de vacante (por ejemplo, tiempo completo, medio tiempo, etc.)
--   fecha_publicacion: Fecha en que se publica la vacante
--   empresa: Nombre de la empresa que publica
--   salario: Rango o valor de salario (opcional)

CREATE TABLE IF NOT EXISTS vacantes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(150) NOT NULL,
    descripcion TEXT NOT NULL,
    ubicacion VARCHAR(100) NOT NULL,
    tipo VARCHAR(50) NOT NULL,
    fecha_publicacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    empresa VARCHAR(100) NOT NULL,
    salario VARCHAR(50),
    vacantes_disponibles INT NOT NULL DEFAULT 1
);

-- Tabla para registrar aplicaciones de usuarios a vacantes
CREATE TABLE IF NOT EXISTS aplicaciones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    vacante_id INT NOT NULL,
    usuario_id INT,
    fecha_aplicacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (vacante_id) REFERENCES vacantes(id)
    -- usuario_id puede ser NULL si no hay login, o referenciar usuarios_naturales
);