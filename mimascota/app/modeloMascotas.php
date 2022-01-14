<?php
include_once 'config.php';

// Tabla de todos las mascotas para visualizar
function modeloMascotasListAdmin()
{
    // Genero lo datos para la vista 
    $vista = [];
    global $conexion;
    $consulta = "SELECT m.id_mascota , m.nombre, m.fecha_nacimiento, m.especie, m.raza,
                     CONCAT(u.nombre, ' ', u.apellido1, ' ', u.apellido2) as ususario
                FROM mascotas m, usuarios u 
                WHERE m.id_usuario = u.id_usuario
                ORDER BY fecha_nacimiento DESC";
    $sentenca = $conexion->query($consulta);
    $sentenca->execute();
    $sentenca->setFetchMode(PDO::FETCH_ASSOC);
    while ($fila = $sentenca->fetch()) {
        $vista[] = $fila;
    }
    return $vista;
}

// Tabla de todos las mascotas para una usuario
function modeloMascotasListUser($id_usuario)
{
    // Genero lo datos para la vista 
    $vista = [];
    global $conexion;
    $consulta = "SELECT m.id_mascota , m.nombre, m.fecha_nacimiento, m.especie, m.raza,
                    CONCAT(u.nombre, ' ', u.apellido1, ' ', u.apellido2) as ususario
                FROM mascotas m, usuarios u 
                WHERE m.id_usuario = u.id_usuario  AND m.id_usuario = ?
                ORDER BY fecha_nacimiento DESC";
    $sentenca = $conexion->prepare($consulta);
    $sentenca->bindValue(1, $id_usuario);
    $sentenca->execute();
    $sentenca->setFetchMode(PDO::FETCH_ASSOC);
    while ($fila = $sentenca->fetch()) {
        $vista[] = $fila;
    }
    return $vista;
}

// Tabla de todos las mascotas de los usuarios
function modeloMascotasUsersList()
{
    // Genero lo datos para la vista 
    $vista = [];
    global $conexion;
    $consulta = "SELECT m.id_mascota, CONCAT(u.apellido1, ' ', u.apellido2, ' ', u.nombre, ': ', m.nombre) descripcion
                FROM mascotas m, usuarios u 
                WHERE m.id_usuario = u.id_usuario
                ORDER BY descripcion DESC";
    $sentenca = $conexion->query($consulta);
    $sentenca->execute();
    $sentenca->setFetchMode(PDO::FETCH_ASSOC);
    while ($fila = $sentenca->fetch()) {
        $vista[] = $fila;
    }
    return $vista;
}

// Carga una mascota
function modeloMascotasGet($id_mascota)
{
    // Genero lo datos para la vista 
    global $conexion;
    $consulta = "SELECT m.id_mascota, m.fecha_nacimiento, m.especie, m.raza, m.nombre
                FROM mascotas m WHERE m.id_mascota = ?";
    $sentenca = $conexion->prepare($consulta);
    $sentenca->bindValue(1, $id_mascota);
    $sentenca->execute();
    if ($sentenca->rowCount() > 0) {
        $sentenca->setFetchMode(PDO::FETCH_ASSOC);
        $mascota = $sentenca->fetch();
    }
    return $mascota;
}

// Añadir una nueva mascota
function modelMascotasAdd($mascota)
{
    global $conexion;
    $consulta = "INSERT INTO mascotas (id_usuario, nombre, fecha_nacimiento, especie, raza) 
                VALUES (?, ?, ?, ?, ?)";
    $stmt = $conexion->prepare($consulta);
    for ($x = 0; $x < count($mascota); $x++) {
        $stmt->bindValue($x + 1, $mascota[$x]);
    }
    $stmt->execute();
}

// Modificar una mascota
function modelMascotasUpdate($mascota)
{
    global $conexion;
    $consulta = "UPDATE mascotas SET nombre = ?, fecha_nacimiento = ?, especie = ?, raza = ?
                WHERE id_mascota = ?";
    $stmt = $conexion->prepare($consulta);
    for ($x = 0; $x < count($mascota); $x++) {
        $stmt->bindValue($x + 1, $mascota[$x]);
    }
    $stmt->execute();
}

// Borrar una mascotas
function modelMascotasDelete($id_mascota)
{
    global $conexion;
    $consulta = "DELETE FROM mascotas WHERE id_mascota = ?";
    $stmt = $conexion->prepare($consulta);
    $stmt->bindValue(1, $id_mascota);
    $stmt->execute();
}
