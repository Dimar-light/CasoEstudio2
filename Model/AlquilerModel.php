<?php

    include_once $_SERVER['DOCUMENT_ROOT'] . '/CasoEstudio2/Model/UtilitarioModel.php';

    function ConsultarCasasDisponiblesModel()
    {
        try
        {
            $conn = OpenDB();

            $sql = "CALL sp_ConsultarCasasDisponibles()";
            $response = $conn -> query($sql);

            $datos = [];

            while($fila = $response -> fetch_assoc())
            {
                $datos[] = $fila;
            }

            CloseDB($conn);
            return $datos;
        }
        catch(Exception $e)
        {
            AddError($e, 'ConsultarCasasDisponiblesModel');
            return null;
        }
    }

    function AlquilarCasaModel($idCasa, $usuarioAlquiler)
    {
        try
        {
            $conn = OpenDB();

            $idCasa = (int)$idCasa;
            $usuarioAlquiler = $conn -> real_escape_string($usuarioAlquiler);

            $sql = "CALL sp_AlquilarCasa('$idCasa', '$usuarioAlquiler')";
            $response = $conn -> query($sql);

            $datos = null;

            while($fila = $response -> fetch_assoc())
            {
                $datos = $fila;
            }

            CloseDB($conn);
            return $datos;
        }
        catch(Exception $e)
        {
            AddError($e, 'AlquilarCasaModel');
            return null;
        }
    }

?>