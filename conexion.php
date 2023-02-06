<?php

function crearConexion()
{

	// Variables para la conexión
	$host = "localhost";
	$user = "root";
	$pass = "";
	$baseDatos = "pac3_daw";

	// Conectamos con la base de datos
	$conexion = mysqli_connect($host, $user, $pass, $baseDatos);

	// if (!$conexion) {
	// 	die("<br>Error de conexión con la base de datos: " . mysqli_connect_error());
	// }
	
	// else {
	// 	echo "<br>Conexión correcta a la base de datos: " . $baseDatos;
	// }

	return $conexion;
}

function cerrarConexion($conexion)
{
	mysqli_close($conexion);
}
