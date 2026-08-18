<?php

    include_once $_SERVER['DOCUMENT_ROOT'] . '/CasoEstudio2/Model/AlquilerModel.php';

    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }

    function ConsultarCasasDisponibles()
    {
        $datos = ConsultarCasasDisponiblesModel();
        return $datos;
    }

    if(isset($_POST["btnAlquilar"]))
    {
        $idCasa = isset($_POST["idCasa"]) ? $_POST["idCasa"] : "";
        $usuarioAlquiler = isset($_POST["usuarioAlquiler"])
            ? trim($_POST["usuarioAlquiler"])
            : "";

        if($idCasa == "" || $usuarioAlquiler == "")
        {
            $_POST["Mensaje"] = "Debe completar la información solicitada";
        }
        else if(strlen($usuarioAlquiler) > 30)
        {
            $_POST["Mensaje"] = "El usuario no puede superar los 30 caracteres";
        }
        else
        {
            $resultado = AlquilarCasaModel($idCasa, $usuarioAlquiler);

            if($resultado && $resultado["Resultado"] == 1)
            {
                $_SESSION["MensajeAlquiler"] = "La casa se alquiló correctamente";

                header("Location: consultarCasas.php");
                exit();
            }

            $_POST["Mensaje"] = "No se ha podido alquilar la casa seleccionada";
        }
    }

?>