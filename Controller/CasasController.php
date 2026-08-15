<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/CasoEstudio2/Model/CasasModel.php';

function ObtenerCasasConsulta()
{
    return ConsultarCasasModel();
}
?>