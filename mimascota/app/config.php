<?php

const DBSERVER = "localhost:3306";
const DBNAME = "mi_mascota";
const DBUSER = "root";
const DBPASSWORD = "";

// (0-Administrador |1-Cliente)
const TIPO_USUARIO = ['Administrador', 'Cliente'];
const ESTADO_CITA = ['Aceptada', 'Pendiente', 'Rechazada'];
const TIPO_ADMIN = 0;

// Notificar todos los errores de PHP
error_reporting(-1);
try {
	$dsn = "mysql:host=" . DBSERVER . ";dbname=" . DBNAME . ";charset=UTF8";
	$conexion = new PDO($dsn, DBUSER, DBPASSWORD);
	$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
	die("Error de conexión " . $e->getMessage());
}
