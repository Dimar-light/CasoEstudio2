<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/CasoEstudio2/Model/UtilitarioModel.php';

function ConsultarCasasModel()
{
    $casas = array();

    try {
        $conn = OpenDB();
        $query = "CALL sp_ConsultarCasas()";
        $resultado = $conn->query($query);

        if ($resultado && $resultado->num_rows > 0) {
            while ($row = $resultado->fetch_assoc()) {
                $casas[] = $row;
            }
        }

        CloseDB($conn);
    } catch (Exception $e) {
        AddError($e, "ConsultarCasasModel");
    }

    return $casas;
}
?>