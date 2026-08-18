<?php

    include_once $_SERVER['DOCUMENT_ROOT'] . '/CasoEstudio2/Controller/AlquilerController.php';
    include_once $_SERVER['DOCUMENT_ROOT'] . '/CasoEstudio2/View/Layout.php';

    $datos = ConsultarCasasDisponibles();

?>

<!DOCTYPE html>
<html lang="es">

<?php
    ImportCSS();
?>

<body>

    <?php
        Navbar();
    ?>

    <main class="container py-5">

        <!-- Encabezado -->
        <div class="row mb-4">
            <div class="col-12">

                <h1 class="fs-4 mb-1 fw-semibold">
                    Alquiler de casas
                </h1>

                <p class="text-muted">
                    Complete la información para alquilar una casa disponible
                </p>

                <hr>

            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-xl-8 col-lg-8 col-md-10">

                <?php

                    if(isset($_POST["Mensaje"]))
                    {
                        echo '<div class="alert alert-danger text-center">'
                            . htmlspecialchars($_POST["Mensaje"]) .
                            '</div>';
                    }

                ?>

                <div class="card shadow-sm">

                    <div class="card-header bg-primary text-white">

                        <h5 class="mb-0">
                            Información del alquiler
                        </h5>

                    </div>

                    <div class="card-body p-4">

                        <?php if($datos != null && count($datos) > 0): ?>

                            <form id="formAlquilarCasa" action="" method="POST">

                                <!-- Dropdown de casas -->
                                <div class="mb-3">

                                    <label for="idCasa" class="form-label fw-medium">
                                        Casa disponible
                                    </label>

                                    <select class="form-select" id="idCasa" name="idCasa">

                                        <option value="">
                                            Seleccione una casa
                                        </option>

                                        <?php

                                            foreach($datos as $casa)
                                            {
                                                $seleccionada = isset($_POST["idCasa"]) &&
                                                    $_POST["idCasa"] == $casa["IdCasa"]
                                                    ? "selected"
                                                    : "";

                                                echo '<option
                                                    value="' . $casa["IdCasa"] . '"
                                                    data-precio="' . $casa["PrecioCasa"] . '"
                                                    ' . $seleccionada . '>'
                                                    . htmlspecialchars($casa["DescripcionCasa"]) .
                                                    '</option>';
                                            }

                                        ?>

                                    </select>

                                </div>

                                <!-- Precio de solo lectura -->
                                <div class="mb-3">

                                    <label for="precioCasa" class="form-label fw-medium">
                                        Precio mensual
                                    </label>

                                    <input
                                        type="text"
                                        class="form-control"
                                        id="precioCasa"
                                        name="precioCasa"
                                        value=""
                                        readonly>

                                </div>

                                <!-- Usuario -->
                                <div class="mb-3">

                                    <label for="usuarioAlquiler" class="form-label fw-medium">
                                        Usuario que alquila
                                    </label>

                                    <input
                                        type="text"
                                        class="form-control"
                                        id="usuarioAlquiler"
                                        name="usuarioAlquiler"
                                        maxlength="30"
                                        value="<?php
                                            echo isset($_POST["usuarioAlquiler"])
                                                ? htmlspecialchars($_POST["usuarioAlquiler"])
                                                : "";
                                        ?>">

                                </div>

                                <!-- Botones -->
                                <div class="d-grid gap-2">

                                    <button
                                        type="submit"
                                        id="btnAlquilar"
                                        name="btnAlquilar"
                                        class="btn btn-primary">

                                        Alquilar

                                    </button>

                                    <a href="consultarCasas.php" class="btn btn-light">
                                        Volver a la consulta
                                    </a>

                                </div>

                            </form>

                        <?php else: ?>

                            <div class="alert alert-info text-center mb-0">
                                No hay casas disponibles para alquilar
                            </div>

                            <div class="d-grid mt-3">

                                <a href="consultarCasas.php" class="btn btn-light">
                                    Volver a la consulta
                                </a>

                            </div>

                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>

        <?php
            Footer();
        ?>

    </main>

    <?php
        ImportJS();
    ?>

    <script src="js/alquilarCasa.js"></script>

</body>
</html>