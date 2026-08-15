<?php

    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }

    function OpenDB()
    {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        return new mysqli("127.0.0.1:3307", "root", "", "CasoEstudioMN");
    }

    function CloseDB($conn)
    {
        $conn->close();
    }

    function AddError($error, $accion)
    {
        error_log("[$accion] " . $error->getMessage());
    }

?>