<?php
include_once 'config.php';

// Tabla de todos las intervenciones
function modeloIntervencionesList()
{
    // Genero lo datos para la vista 
    $vista = [];
    global $conexion;
    $consulta = "SELECT i.id_intervencion, i.descripcion as intervencion
                FROM intervenciones i 
                ORDER BY id_intervencion ASC";
    $sentenca = $conexion->prepare($consulta);
    $sentenca->execute();
    $sentenca->setFetchMode(PDO::FETCH_ASSOC);
    while ($fila = $sentenca->fetch()) {
        $vista[] = $fila;
    }
    return $vista;
}
