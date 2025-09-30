-- Si tienes servicios antiguos publicados por empresas y el campo usuario_tipo está vacío o incorrecto,
-- ejecuta este UPDATE para corregirlos:
-- UPDATE servicios SET usuario_tipo = 'juridico' WHERE usuario_id IN (SELECT id FROM usuarios_juridicos);
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
-- Tabla para servicios
-- usuario_id: ID del usuario que publica el servicio (puede ser natural o jurídico)
-- usuario_tipo: 'natural' si es persona natural, 'juridico' si es empresa
CREATE TABLE IF NOT EXISTS servicios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(150) NOT NULL,
    descripcion TEXT NOT NULL,
    ubicacion VARCHAR(100) NOT NULL,
    tipo VARCHAR(50) NOT NULL,
    fecha_publicacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    empresa VARCHAR(100) NOT NULL,
    precio VARCHAR(50),
    usuario_id INT NOT NULL,
    icono VARCHAR(100) NULL;

    usuario_tipo ENUM('natural', 'juridico') NOT NULL
    -- No se define una foreign key directa, ya que puede ser de dos tablas distintas
    -- Si migras desde una versión anterior, elimina la foreign key con:
    -- ALTER TABLE servicios DROP FOREIGN KEY servicios_ibfk_1;
);
-- Script para crear la base de datos y tablas del sistema de login y registro GDA

CREATE DATABASE IF NOT EXISTS gda CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE gda;

-- Tabla para personas naturales
CREATE TABLE IF NOT EXISTS usuarios_naturales (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    identificacion VARCHAR(20) NOT NULL UNIQUE,
    fecha_nacimiento DATE NOT NULL,
    genero VARCHAR(20),
    contacto VARCHAR(100) NOT NULL,
    tipo_contacto ENUM('correo','telefono') NOT NULL,
    password VARCHAR(255) NOT NULL,
    terminos TINYINT(1) NOT NULL DEFAULT 0,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    foto_perfil VARCHAR(255) DEFAULT NULL
);

-- Tabla para personas jurídicas
CREATE TABLE empresa_rut (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nit VARCHAR(15) NOT NULL UNIQUE,         -- Ej: 900123456-7
    razon_social VARCHAR(150) NOT NULL,      -- Nombre de la empresa
    direccion VARCHAR(200) NOT NULL,         -- Dirección principal
    contacto VARCHAR(100) NOT NULL,          -- Correo electrónico o número de celular
    tipo_contacto ENUM('correo','celular') NOT NULL  -- Indica qué tipo de dato es
    password VARCHAR(255) NOT NULL,
    terminos TINYINT(1) NOT NULL DEFAULT 0,
      foto_perfil VARCHAR(255) DEFAULT NULL,
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



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


-- Tabla para vacantes
-- Esta tabla almacena las vacantes publicadas por personas naturales o jurídicas.
-- usuario_id: ID del usuario que publica la vacante (puede ser natural o jurídico)
-- usuario_tipo: 'natural' si es persona natural, 'juridico' si es empresa
CREATE TABLE IF NOT EXISTS vacantes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(150) NOT NULL,
    descripcion TEXT NOT NULL,
    ubicacion VARCHAR(100) NOT NULL,
    tipo VARCHAR(50) NOT NULL,
    fecha_publicacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    empresa VARCHAR(100) NOT NULL,
    salario VARCHAR(50),
    vacantes_disponibles INT NOT NULL DEFAULT 1,
    aplicados INT NOT NULL DEFAULT 0,
    usuario_id INT NOT NULL,
    usuario_tipo ENUM('natural', 'juridico') NOT NULL
    -- No se define una foreign key directa, ya que puede ser de dos tablas distintas
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
