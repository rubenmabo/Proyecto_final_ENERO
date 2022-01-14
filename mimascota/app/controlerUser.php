<?php
// ------------------------------------------------
// Controlador que realiza la gestión de usuarios
// ------------------------------------------------
include_once "config.php";

// Login
function  ctlUserLogin()
{
    try {
        $msg = "";
        $email = "";
        $password = "";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["email"]) && isset($_POST["password"])) {
                $email = $_POST["email"];
                $password = $_POST["password"];
                $user = modeloUserLogin($email, $password);
                if ($user) {
                    $_SESSION["user"] = $user;
                    header("Location:index.php?orden=verCitas");
                } else {
                    $msg = "Usuario y contraseña no válidos.";
                }
            }
        }
    } catch (Exception $e) {
        $msg = "Error en login: " . $e->getMessage();
    }
    include_once "plantilla/acceso.php";
}

// Cierra la sesión
function ctlUserCerrar()
{
    session_destroy();
    header("Location:index.php");
}

// Muestra el formulario de registro
function ctlUserRegistro()
{
    include_once "plantilla/datosUsuario.php";
}

//Inserta en BBDD
function ctlUserAlta()
{
    $data = [
        $_POST["email"],
        $_POST["password"],
        $_POST["dni"],
        $_POST["nombre"],
        $_POST["apellido1"],
        $_POST["apellido2"],
        $_POST["telefono"],
        $_POST["direccion"],
        $_POST["localidad"],
        $_POST["provincia"],
        $_POST["codigo_postal"]
    ];
    try {
        modelUserAdd($data);
        header("Location:index.php?orden=verCitas");
    } catch (Exception $e) {
        $msg = "Error al dar de alta el usuario: " . $e->getMessage();
    }
    include_once "plantilla/datosUsuario.php";
}

//Muestra el formulario de modificacion
function ctlUserCargar()
{
    $modificar = true;
    include_once "plantilla/datosUsuario.php";
}

//Modifica en BBDD
function ctlUserModificar()
{
    $modificar = true;
    $data = [
        $_POST["dni"],
        $_POST["nombre"],
        $_POST["apellido1"],
        $_POST["apellido2"],
        $_POST["telefono"],
        $_POST["direccion"],
        $_POST["localidad"],
        $_POST["provincia"],
        $_POST["codigo_postal"],
        $_SESSION["user"]["id_usuario"],

    ];
    try {
        modelUserUpdate($data);
        $_SESSION["user"]["dni"] = $_POST["dni"];
        $_SESSION["user"]["nombre"] = $_POST["nombre"];
        $_SESSION["user"]["apellido1"] = $_POST["apellido1"];
        $_SESSION["user"]["apellido2"] = $_POST["apellido2"];
        $_SESSION["user"]["telefono"] = $_POST["telefono"];
        $_SESSION["user"]["direccion"] = $_POST["direccion"];
        $_SESSION["user"]["localidad"] = $_POST["localidad"];
        $_SESSION["user"]["provincia"] = $_POST["provincia"];
        $_SESSION["user"]["codigo_postal"] = $_POST["codigo_postal"];
        //header("Location:index.php?orden=verCitas");
    } catch (Exception $e) {
        $msg = "Error al modificar el usuario: " . $e->getMessage();
    }
    include_once "plantilla/datosUsuario.php";
}
