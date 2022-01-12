<?php
include_once 'config.php';

// Tabla de todos las historial para una mascota
function modeloHistorialList($id_mascota)
{
    // Genero lo datos para la vista 
    $vista = [];
    global $conexion;
    $consulta = "SELECT h.id_historial , m.nombre, h.fecha, h.descripcion, i.descripcion as intervencion, h.observaciones
                FROM historial h, mascotas m, intervenciones i 
                WHERE m.id_mascota = h.id_mascota AND h.id_intervencion = i.id_intervencion AND h.id_mascota = ?
                ORDER BY h.fecha DESC";
    $sentenca = $conexion->prepare($consulta);
    $sentenca->bindValue(1, $id_mascota);
    $sentenca->execute();
    $sentenca->setFetchMode(PDO::FETCH_ASSOC);
    while ($fila = $sentenca->fetch()) {
        $vista[] = $fila;
    }
    return $vista;
}

// Carga un historial
function modeloHistorialGet($id_historial)
{
    // Genero lo datos para la vista 
    global $conexion;
    $consulta = "SELECT h.id_historial, h.id_mascota, h.fecha, h.descripcion, h.observaciones, h.id_intervencion 
                FROM historial h WHERE h.id_historial = ?";
    $sentenca = $conexion->prepare($consulta);
    $sentenca->bindValue(1, $id_historial);
    $sentenca->execute();
    if ($sentenca->rowCount() > 0) {
        $sentenca->setFetchMode(PDO::FETCH_ASSOC);
        $historial = $sentenca->fetch();
    }
    return $historial;
}

// Añadir un nuevo historial
function modelHistorialAdd($historial)
{
    global $conexion;
    $consulta = "INSERT INTO historial (id_mascota, fecha, id_intervencion, descripcion, observaciones) 
                VALUES (?, ?, ?, ?, ?)";
    $stmt = $conexion->prepare($consulta);
    for ($x = 0; $x < count($historial); $x++) {
        $stmt->bindValue($x + 1, $historial[$x]);
    }
    $stmt->execute();
}

// Modificar historial
function modelHistorialUpdate($historial)
{
    global $conexion;
    $consulta = "UPDATE historial SET fecha = ?, id_intervencion = ?, descripcion = ?, observaciones = ?
                WHERE id_historial = ?";
    $stmt = $conexion->prepare($consulta);
    for ($x = 0; $x < count($historial); $x++) {
        $stmt->bindValue($x + 1, $historial[$x]);
    }
    $stmt->execute();
}

// Borrar historial
function modelHistorialDelete($id_historial)
{
    global $conexion;
    $consulta = "DELETE FROM historial WHERE id_historial = ?";
    $stmt = $conexion->prepare($consulta);
    $stmt->bindValue(1, $id_historial);
    $stmt->execute();
}
