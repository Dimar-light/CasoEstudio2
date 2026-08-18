<?php

function ImportCSS()
{
    echo '
        <head>
            <meta charset="UTF-8">
            <title>Caso de Estudio 2</title>
            <meta name="viewport" content="width=device-width, initial-scale=1">

            <link rel="stylesheet"
                href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
        </head>
    ';
}

function Navbar()
{
    echo '
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">

                <a class="navbar-brand" href="consultarCasas.php">
                    CasoEstudio2
                </a>

                <button class="navbar-toggler" type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#menuPrincipal">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="menuPrincipal">
                    <div class="navbar-nav ms-auto">

                        <a class="nav-link" href="consultarCasas.php">
                            Consulta de casas
                        </a>

                        <a class="nav-link" href="alquilarCasa.php">
                            Alquiler de casas
                        </a>

                    </div>
                </div>

            </div>
        </nav>
    ';
}

function Footer()
{
    echo '
        <footer class="text-center text-secondary py-4 mt-5">
            <p class="mb-0">Caso de Estudio 2 - 2026</p>
        </footer>
    ';
}

function ImportJS()
{
    echo '
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.21.0/dist/jquery.validate.min.js"></script>
    ';
}

?>