<?php
include_once 'config.php';

// Tabla de todos las citas para visualizar
function modeloCitasGetAdmin()
{
    // Genero lo datos para la vista 
    $vista = [];
    global $conexion;
    $consulta = "SELECT c.id_cita, c.estado, c.fecha, m.nombre as mascota, CONCAT(
                     u.apellido1, u.apellido2, u.nombre) as cliente, u.telefono, i.descripcion as intervencion, c.observaciones
                FROM citas c, mascotas m, usuarios u, intervenciones i 
                WHERE c.id_mascota = m.id_mascota AND m.id_usuario = u.id_usuario AND
                    c.id_intervencion = i.id_intervencion AND fecha >= curdate()
                ORDER BY fecha ASC";
    $sentenca = $conexion->query($consulta);
    $sentenca->execute();
    $sentenca->setFetchMode(PDO::FETCH_ASSOC);
    while ($fila = $sentenca->fetch()) {
        $vista[] = $fila;
    }
    return $vista;
}

// Tabla de todos las citas para un usuario
function modeloCitasGetUser($id_usuario)
{
    // Genero lo datos para la vista 
    $vista = [];
    global $conexion;
    $consulta = "SELECT c.id_cita, c.estado, c.fecha, m.nombre as mascota, CONCAT(
                u.apellido1, u.apellido2, u.nombre) as cliente, u.telefono, i.descripcion as intervencion, c.observaciones
                FROM citas c, mascotas m, usuarios u, intervenciones i 
                WHERE c.id_mascota = m.id_mascota AND m.id_usuario = u.id_usuario AND
                c.id_intervencion = i.id_intervencion AND fecha >= curdate() AND m.id_usuario = ?
                ORDER BY fecha ASC";
    $sentenca = $conexion->prepare($consulta);
    $sentenca->bindValue(1, $id_usuario);
    $sentenca->execute();
    $sentenca->setFetchMode(PDO::FETCH_ASSOC);
    while ($fila = $sentenca->fetch()) {
        $vista[] = $fila;
    }
    return $vista;
}

// Carga una cita
function modeloCitasGet($id_cita)
{
    // Genero lo datos para la vista 
    global $conexion;
    $consulta = "SELECT id_cita, id_mascota, fecha, observaciones, id_intervencion, estado
                FROM citas WHERE id_cita = ?";
    $sentenca = $conexion->prepare($consulta);
    $sentenca->bindValue(1, $id_cita);
    $sentenca->execute();
    if ($sentenca->rowCount() > 0) {
        $sentenca->setFetchMode(PDO::FETCH_ASSOC);
        $cita = $sentenca->fetch();
    }
    return $cita;
}

// Añadir una nueva cita
function modelCitaAdd($cita)
{
    global $conexion;
    $consulta = "INSERT INTO citas (id_mascota, fecha, observaciones, id_intervencion, estado) 
                VALUES (?, ?, ?, ?, ?)";
    $stmt = $conexion->prepare($consulta);
    for ($x = 0; $x < count($cita); $x++) {
        $stmt->bindValue($x + 1, $cita[$x]);
    }
    $stmt->execute();
}


// Modificar una cita
function modelCitasUpdate($cita)
{
    global $conexion;
    $consulta = "UPDATE citas SET id_mascota = ?, fecha = ?, observaciones = ?, id_intervencion = ?, estado = ?
                WHERE id_cita = ?";
    $stmt = $conexion->prepare($consulta);
    for ($x = 0; $x < count($cita); $x++) {
        $stmt->bindValue($x + 1, $cita[$x]);
    }
    $stmt->execute();
}

// Borrar una citas
function modelCitasDelete($id_cita)
{
    global $conexion;
    $consulta = "DELETE FROM citas WHERE id_cita = ?";
    $stmt = $conexion->prepare($consulta);
    $stmt->bindValue(1, $id_cita);
    $stmt->execute();
}
