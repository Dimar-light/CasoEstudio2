USE CasoEstudioMN;

DROP PROCEDURE IF EXISTS sp_ConsultarCasasDisponibles;
DROP PROCEDURE IF EXISTS sp_AlquilarCasa;

DELIMITER $$

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

DELIMITER ;