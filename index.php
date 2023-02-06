<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Index.php</title>
	<link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<body>
	
	<?php
	include "consultas.php";
	?>

	<form method="POST" action="index.php" name="registrar">
		<label>Usuario:</label>
		<input type="text" name="usuario" id="usuario" />
		</br>
		<label>Correo:</label>
		<input type="email" name="correo" id="correo" />
		</br>
		<button type="submit" name="registrar" value="registrar">Enviar</button>
	</form>
	<?php

	if (!empty($_POST['usuario']) && !empty($_POST['correo'])) {
		$usuario = $_POST['usuario'];
		$correo = $_POST['correo'];

		$tipoUsuario = tipoUsuario($usuario, $correo); //aquí devuelve string y parámetros son string tb

		setcookie("cookie", $tipoUsuario, time() + (60 * 60 * 24 * 365));  //cookie para un año

		switch ($tipoUsuario) {
			case "autorizado":
				echo "<p>Bienvenido " . $usuario . ". Pulsa <a href='articulos.php'>Aquí</a> para entrar al panel de artículos</p>";
				break;
			case "registrado":
				echo "<p>Bienvenido " . $usuario . ". No tienes permisos para acceder.</p>";
				break;
			case "superadmin":
				echo "<p>Bienvenido " . $usuario . ". Pulsa <a href='usuarios.php'>Aquí</a> para entrar al panel de usuarios</p>";
				break;
			case ("no registrado" || !$validarCorreo || !$validarNombre):
				echo "<p>El usuario no está registrado</p>";
				break;
		}
	}
	?>

</body>

</html>