<?php
// ------------------------------------------------
// Controlador que realiza la gestión de mascotas
// ------------------------------------------------
include_once 'config.php';
include_once 'modeloMascotas.php';


//Lista los registros
function ctlMascotasListar()
{
    if ($_SESSION['user']['tipo'] == TIPO_ADMIN) {
        $mascotas = modeloMascotasListAdmin();
    } else {
        $mascotas = modeloMascotasListUser($_SESSION['user']['id_usuario']);
    }
    include_once 'plantilla/verMascotas.php';
}

// Muestra el formulario de registro
function ctlMascotasRegistro()
{
    include_once "plantilla/datosMascota.php";
}

//Inserta en BBDD
function ctlMascotasAlta()
{
    $data = [
        $_SESSION["user"]["id_usuario"],
        $_POST["nombre"],
        $_POST["nacimiento"],
        $_POST["especie"],
        $_POST["raza"]
    ];
    try {
        modelMascotasAdd($data);
        header("Location:index.php?orden=verMascotas");
    } catch (Exception $e) {
        $msg = "Error al dar de alta la mascota: " . $e->getMessage();
    }
    include_once "plantilla/datosMascota.php";
}

//Muestra el formulario de modificacion
function ctlMascotasCargar()
{
    $modificar = true;
    $mascota = modeloMascotasGet($_GET["id_mascota"]);
    include_once "plantilla/datosMascota.php";
}

//Modifica en BBDD
function ctlMascotasModificar()
{
    $modificar = true;
    $data = [
        $_POST["nombre"],
        $_POST["nacimiento"],
        $_POST["especie"],
        $_POST["raza"],
        $_POST["id_mascota"]
    ];
    try {
        modelMascotasUpdate($data);
        header("Location:index.php?orden=verMascotas");
    } catch (Exception $e) {
        $msg = "Error al modificar la mascota: " . $e->getMessage();
    }
    include_once "plantilla/datosMascota.php";
}


//Modifica en BBDD
function ctlMascotasBorrar()
{
    try {
        modelMascotasDelete($_GET["id_mascota"]);
        header("Location:index.php?orden=verMascotas");
    } catch (Exception $e) {
        $msg = "Error al eliminar la mascota: " . $e->getMessage();
    }
    include_once "plantilla/verMascotas.php";
}
