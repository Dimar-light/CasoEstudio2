<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/CasoEstudio2/Controller/CasasController.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/CasoEstudio2/View/Layout.php';

$listaCasas = ObtenerCasasConsulta();

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Consulta de Casas - CasoEstudio2</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        rel="stylesheet">
</head>

<body>

    <?php
    Navbar();
    ?>

    <div class="container mt-5">

        <h2 class="mb-4">
            Consulta de Casas (Precios entre 115,000 y 180,000)
        </h2>

        <div class="table-responsive">

            <table class="table table-bordered table-striped align-middle">

                <thead class="table-dark">
                    <tr>
                        <th>Descripción</th>
                        <th>Precio Mensual</th>
                        <th>Usuario Alquiler</th>
                        <th>Estado</th>
                        <th>Fecha Alquiler</th>
                    </tr>
                </thead>

                <tbody>

                    <?php if (count($listaCasas) > 0): ?>

                        <?php foreach ($listaCasas as $casa): ?>

                            <tr>
                                <td>
                                    <?php echo htmlspecialchars($casa['DescripcionCasa']); ?>
                                </td>

                                <td>
                                    ₡<?php echo number_format($casa['PrecioCasa'], 2); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($casa['UsuarioAlquiler']); ?>
                                </td>

                                <td>
                                    <?php if ($casa['Estado'] === 'Disponible'): ?>

                                        <span class="badge bg-success">
                                            Disponible
                                        </span>

                                    <?php else: ?>

                                        <span class="badge bg-danger">
                                            Reservada
                                        </span>

                                    <?php endif; ?>
                                </td>

                                <td>
                                    <?php
                                    echo $casa['FechaFormateada']
                                        ? $casa['FechaFormateada']
                                        : 'N/A';
                                    ?>
                                </td>
                            </tr>

                        <?php endforeach; ?>

                    <?php else: ?>

                        <tr>
                            <td colspan="5" class="text-center">
                                No hay casas registradas dentro del rango solicitado.
                            </td>
                        </tr>

                    <?php endif; ?>

                </tbody>

            </table>

        </div>

    </div>

    <?php
    Footer();
    ImportJS();
    ?>

</body>

</html>