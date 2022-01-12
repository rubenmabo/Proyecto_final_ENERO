<?php
// ------------------------------------------------
// Controlador que realiza la gestión de citas
// ------------------------------------------------
include_once 'config.php';
include_once 'modeloCitas.php';
include_once 'modeloIntervenciones.php';
include_once 'modeloMascotas.php';


//Lista los registros
function ctlCitasListar()
{
    if ($_SESSION['user']['tipo'] == TIPO_ADMIN) {
        $citas = modeloCitasGetAdmin();
    } else {
        $citas = modeloCitasGetUser($_SESSION['user']['id_usuario']);
    }
    include_once 'plantilla/verCitas.php';
}

// Muestra el formulario de registro
function ctlCitasRegistro()
{
    $intervenciones = modeloIntervencionesList();
    $mascotas = modeloMascotasUsersList();
    include_once "plantilla/datosCita.php";
}

//Inserta en BBDD
function ctlCitasAlta()
{
    $data = [
        $_POST["mascota"],
        $_POST["fecha"],
        $_POST["observaciones"],
        $_POST["intervencion"],
        $_POST["estado"]
    ];
    try {
        modelCitaAdd($data);
        header("Location:index.php?orden=verCitas");
    } catch (Exception $e) {
        $msg = "Error al dar de alta la cita: " . $e->getMessage();
    }
    include_once "plantilla/datosCita.php";
}


//Muestra el formulario de modificacion
function ctlCitasCargar()
{
    $modificar = true;
    $cita = modeloCitasGet($_GET["id_cita"]);
    $intervenciones = modeloIntervencionesList();
    $mascotas = modeloMascotasUsersList();
    include_once "plantilla/datosCita.php";
}

//Modifica en BBDD
function ctlCitasModificar()
{
    $modificar = true;
    $data = [
        $_POST["mascota"],
        $_POST["fecha"],
        $_POST["observaciones"],
        $_POST["intervencion"],
        $_POST["estado"],
        $_POST["id_cita"]
    ];
    print($_POST["estado"] . "**********");
    try {
        modelCitasUpdate($data);
        header("Location:index.php?orden=verCitas");
    } catch (Exception $e) {
        $msg = "Error al modificar la cita: " . $e->getMessage();
    }
    include_once "plantilla/datosCita.php";
}

//Modifica en BBDD
function ctlCitasBorrar()
{
    try {
        modelCitasDelete($_GET["id_cita"]);
        header("Location:index.php?orden=verCitas");
    } catch (Exception $e) {
        $msg = "Error al eliminar la cita: " . $e->getMessage();
    }
    include_once "plantilla/verCitas.php";
}
