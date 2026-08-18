-- =========================================================
-- Caso de Estudio #2 - Ambiente Web Cliente Servidor
-- Base de datos: CasoEstudioMN
-- =========================================================

CREATE DATABASE IF NOT EXISTS CasoEstudioMN;
USE CasoEstudioMN;

-- =========================================================
-- Tabla CasasSistema
-- =========================================================
DROP TABLE IF EXISTS `casassistema`;
CREATE TABLE `casassistema` (
  `IdCasa` bigint(20) NOT NULL AUTO_INCREMENT,
  `DescripcionCasa` varchar(30) NOT NULL,
  `PrecioCasa` decimal(10,2) NOT NULL,
  `UsuarioAlquiler` varchar(30) DEFAULT NULL,
  `FechaAlquiler` datetime DEFAULT NULL,
  PRIMARY KEY (`IdCasa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- =========================================================
-- Datos iniciales (no modificar / no agregar / no eliminar)
-- =========================================================
INSERT INTO `casassistema` (DescripcionCasa, PrecioCasa, UsuarioAlquiler, FechaAlquiler) VALUES
('Casa en San José', 190000.00, NULL, NULL),
('Casa en Alajuela', 145000.00, NULL, NULL),
('Casa en Cartago', 115000.00, NULL, NULL),
('Casa en Heredia', 122000.00, NULL, NULL),
('Casa en Guanacaste', 105000.00, NULL, NULL);

-- =========================================================
-- Tabla de errores (misma convención que tb_error en RepoMN)
-- =========================================================
CREATE TABLE IF NOT EXISTS tb_error (
    Consecutivo INT(11) NOT NULL AUTO_INCREMENT,
    Mensaje VARCHAR(8000) NOT NULL,
    FechaHora DATETIME NOT NULL,
    Accion VARCHAR(100) NOT NULL,
    PRIMARY KEY (Consecutivo)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- =========================================================
-- Procedimientos almacenados
-- =========================================================
DROP PROCEDURE IF EXISTS sp_ConsultarCasas;
DROP PROCEDURE IF EXISTS sp_ConsultarCasasDisponibles;
DROP PROCEDURE IF EXISTS sp_AlquilarCasa;
DROP PROCEDURE IF EXISTS spRegistrarError;

DELIMITER $$

-- Vista Consulta de casas:
-- Solo precios entre 115.000 y 180.000
-- Disponibles (sin alquiler) primero, luego Reservadas
CREATE PROCEDURE sp_ConsultarCasas()
BEGIN
    SELECT
        IdCasa,
        DescripcionCasa,
        PrecioCasa,
        IFNULL(UsuarioAlquiler, 'N/A') AS UsuarioAlquiler,
        CASE
            WHEN UsuarioAlquiler IS NULL THEN 'Disponible'
            ELSE 'Reservada'
        END AS Estado,
        DATE_FORMAT(FechaAlquiler, '%d/%m/%Y') AS FechaFormateada
    FROM CasasSistema
    WHERE PrecioCasa BETWEEN 115000 AND 180000
    ORDER BY CASE WHEN UsuarioAlquiler IS NULL THEN 0 ELSE 1 END ASC;
END$$

-- Vista Alquiler de casas: solo casas NO alquiladas, para el DropdownList
CREATE PROCEDURE sp_ConsultarCasasDisponibles()
BEGIN
    SELECT
        IdCasa,
        DescripcionCasa,
        PrecioCasa
    FROM CasasSistema
    WHERE UsuarioAlquiler IS NULL
    ORDER BY DescripcionCasa ASC;
END$$

-- Alquilar una casa: solo actualiza si sigue disponible (evita doble alquiler)
CREATE PROCEDURE sp_AlquilarCasa(
    IN p_IdCasa BIGINT,
    IN p_UsuarioAlquiler VARCHAR(30)
)
BEGIN
    UPDATE CasasSistema
    SET UsuarioAlquiler = TRIM(p_UsuarioAlquiler),
        FechaAlquiler = NOW()
    WHERE IdCasa = p_IdCasa
      AND UsuarioAlquiler IS NULL;

    SELECT ROW_COUNT() AS Resultado;
END$$

-- Registrar errores del sistema
CREATE PROCEDURE spRegistrarError(
    IN pMensaje VARCHAR(8000),
    IN pAccion VARCHAR(100)
)
BEGIN
    INSERT INTO tb_error (Mensaje, FechaHora, Accion)
    VALUES (pMensaje, NOW(), pAccion);
END$$

DELIMITER ;
