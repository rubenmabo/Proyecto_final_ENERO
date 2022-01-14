<?php
session_start();
include_once 'app/config.php';
include_once 'app/controlerUser.php';
include_once 'app/modeloUser.php';
include_once 'app/controlerCitas.php';
include_once 'app/modeloCitas.php';
include_once 'app/controlerMascotas.php';
include_once 'app/modeloMascotas.php';
include_once 'app/controlerHistorial.php';
include_once 'app/modeloHistorial.php';

// Relación  peticiones - función que la va a tratar
$rutasUser = [
    "Login" => "ctlUserLogin",
    "Registro" => "ctlUserRegistro",
    "AltaUsuario" => "ctlUserAlta",
    "CargaUsuario" => "ctlUserCargar",
    "ModificarUsuario" => "ctlUserModificar",
    "Cerrar" => "ctlUserCerrar",

    "verCitas" => "ctlCitasListar",
    "RegistroCita" => "ctlCitasRegistro",
    "AltaCita" => "ctlCitasAlta",
    "CargaCita" => "ctlCitasCargar",
    "ModificarCita" => "ctlCitasModificar",
    "BorrarCita" => "ctlCitasBorrar",

    "verMascotas" => "ctlMascotasListar",
    "RegistroMascota" => "ctlMascotasRegistro",
    "AltaMascota" => "ctlMascotasAlta",
    "CargaMascota" => "ctlMascotasCargar",
    "ModificarMascota" => "ctlMascotasModificar",
    "BorrarMascota" => "ctlMascotasBorrar",

    "verHistorial" => "ctlHistorialListar",
    "RegistroHistorial" => "ctlHistorialRegistro",
    "AltaHistorial" => "ctlHistorialAlta",
    "CargaHistorial" => "ctlHistorialCargar",
    "ModificarHistorial" => "ctlHistorialModificar",
    "BorrarHistorial" => "ctlHistorialBorrar"

];
// Si no hay usuario a Inicio
if (!isset($_SESSION['user'])) {
    if (isset($_GET['orden']) && ($_GET['orden'] == 'Registro' || $_GET['orden'] == 'AltaUsuario')) {
        $procRuta = $rutasUser[$_GET['orden']];
    } else {
        $procRuta = 'ctlUserLogin';
    }
} else {
    //if ( $_SESSION['modo'] == GESTIONUSUARIOS){
    if (isset($_GET['orden'])) {
        // La orden tiene una funcion asociada 
        if (isset($rutasUser[$_GET['orden']])) {
            $procRuta =  $rutasUser[$_GET['orden']];
        } else {
            // Error no existe función para la ruta
            header('Status: 404 Not Found');
            echo '<html><body><h1>Error 404: No existe la ruta <i>' .
                $_GET['orden'] .
                '</p></body></html>';
            exit;
        }
    } else {
        $procRuta = "ctlCitasListar";
    }
    //}
    // Usuario Normal PRIMERA VERSION SIN ACCIONES
    //else {
    //   $procRuta= "ctlUserLogin";    
    //}
}

// Llamo a la función seleccionada
$procRuta();
