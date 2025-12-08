-- Criação do banco de dados se não existir
CREATE DATABASE IF NOT EXISTS Notas CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Usar o banco de dados
USE Notas;

-- Configurações de timezone
SET GLOBAL time_zone = '+00:00';
