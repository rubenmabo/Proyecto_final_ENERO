<?php
include_once 'config.php';

// Comprueba usuario y contraseña (boolean)
function modeloUserLogin($email, $password)
{
    global $conexion;
    $usuario = NULL;
    $consulta = "SELECT * FROM usuarios WHERE email ='$email' AND password =MD5(?)";
    $sentenca = $conexion->prepare($consulta);
    $sentenca->bindValue(1, $password);
    $sentenca->execute();
    if ($sentenca->rowCount() > 0) {
        $sentenca->setFetchMode(PDO::FETCH_ASSOC);
        $usuario = $sentenca->fetch();
    }
    return $usuario;
}

// Añadir un nuevo usuario
function modelUserAdd($userdat)
{
    global $conexion;
    $consulta = "INSERT INTO usuarios (email, password, dni, nombre, apellido1,
                apellido2, telefono, direccion, localidad, provincia, codigo_postal, tipo) 
                VALUES (?, MD5(?), ?, ?, ?, ?, ?, ?, ?, ?, ?, 1)";
    $stmt = $conexion->prepare($consulta);
    for ($x = 0; $x < count($userdat); $x++) {
        $stmt->bindValue($x + 1, $userdat[$x]);
    }
    $stmt->execute();
}

// Modificar un usuario
function modelUserUpdate($userdat)
{
    global $conexion;
    $consulta = "UPDATE usuarios SET dni = ?, nombre = ?, apellido1 = ?,
                    apellido2 = ?, telefono = ?, direccion = ?, localidad = ?, provincia = ?, codigo_postal = ?
                 WHERE id_usuario = ?";
    $stmt = $conexion->prepare($consulta);
    for ($x = 0; $x < count($userdat); $x++) {
        $stmt->bindValue($x + 1, $userdat[$x]);
    }
    $stmt->execute();
}
