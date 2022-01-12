<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Mi mascota</title>
    <link href="web/css/default.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="web/js/funciones.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="web/css/default.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body class="bg-secondary">
    <header class="nav justify-content-between bg-dark px-5 ">
        <nav class="navbar navbar-expand-sm navbar-dark w-100">
            <a class="navbar-brand">
                <img class="logo" src="web/img/logo.jpg" height="60" alt="logo"><span class="px-3">Mi Mascota</span>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse w-100" id="navbarSupportedContent">
                <ul class="nav w-100">
                    <?php if (isset($_SESSION['user'])) { ?>
                        <li class="nav-item ">
                            <a class="nav-link text-light d-flex align-items-center" href="index.php?orden=verMascotas" title="Listado de Mascotas">
                                <span class="material-icons mx-2">pets</span>Mascotas</a>
                        </li>
                        <li class="nav-item" style="margin-right: auto;">
                            <a class="nav-link text-light d-flex align-items-center" href="index.php?orden=verCitas" title="Listado de Citas">
                                <span class="material-icons mx-2">event</span>Citas</a>
                        </li>
                        <?php
                        if ($_SESSION['user']['tipo'] != TIPO_ADMIN) { ?>
                            <li class="nav-item ">
                                <a class="nav-link text-secondary d-flex align-items-center " href="index.php?orden=CargaUsuario" title="Modificar usuario">
                                    <span class="material-icons mx-2">account_circle</span>Cuenta</a>
                            </li>

                        <?php } else { ?>
                            <li class="nav-item text-secondary d-flex align-items-center"><span class="material-icons mx-2">account_circle</span>Administrador
                            </li>
                        <?php } ?>
                        <li class="nav-item">
                            <a class="nav-link text-secondary d-flex align-items-center" href="index.php?orden=Cerrar" title="Cerrar Sesión">
                                <span class="material-icons mx-2">logout</span>Logout</a>
                        </li>
                    <?php } ?>
                </ul>
            </div>

        </nav>
    </header>
    <div class="container bg-light p-4">
        <?= $contenido ?>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>