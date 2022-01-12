<?php
// ------------------------------------------------
// Controlador que realiza la gestión de historial
// ------------------------------------------------
include_once 'config.php';
include_once 'modeloHistorial.php';
include_once 'modeloIntervenciones.php';


//Lista los registros
function ctlHistorialListar()
{
    if (isset($_GET["id_mascota"])) {
        $_SESSION["id_mascota"] = $_GET["id_mascota"];
    }
    $historial = modeloHistorialList($_SESSION["id_mascota"]);
    include_once 'plantilla/verHistorial.php';
}

// Muestra el formulario de registro
function ctlHistorialRegistro()
{
    $intervenciones = modeloIntervencionesList();
    include_once "plantilla/datosHistorial.php";
}

//Inserta en BBDD
function ctlHistorialAlta()
{
    $data = [
        $_SESSION["id_mascota"],
        $_POST["fecha"],
        $_POST["intervencion"],
        $_POST["descripcion"],
        $_POST["observaciones"]
    ];
    try {
        modelHistorialAdd($data);
        header("Location:index.php?orden=verHistorial");
    } catch (Exception $e) {
        $msg = "Error al dar de alta la historial: " . $e->getMessage();
    }
    include_once "plantilla/datosHistorial.php";
}

//Muestra el formulario de modificacion
function ctlHistorialCargar()
{
    $modificar = true;
    $intervenciones = modeloIntervencionesList();
    $historial = modeloHistorialGet($_GET["id_historial"]);
    include_once "plantilla/datosHistorial.php";
}

//Modifica en BBDD
function ctlHistorialModificar()
{
    $modificar = true;
    $data = [
        $_POST["fecha"],
        $_POST["intervencion"],
        $_POST["descripcion"],
        $_POST["observaciones"],
        $_POST["id_historial"]
    ];
    try {
        modelHistorialUpdate($data);
        header("Location:index.php?orden=verHistorial");
    } catch (Exception $e) {
        $msg = "Error al modificar la historial: " . $e->getMessage();
    }
    include_once "plantilla/datosHistorial.php";
}


//Modifica en BBDD
function ctlHistorialBorrar()
{
    try {
        modelHistorialDelete($_GET["id_historial"]);
        header("Location:index.php?orden=verHistorial");
    } catch (Exception $e) {
        $msg = "Error al eliminar la historial: " . $e->getMessage();
    }
    include_once "plantilla/verHistorial.php";
}
