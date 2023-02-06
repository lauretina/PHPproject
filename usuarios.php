<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="estilo.css">
	<title>Usuarios</title>
</head>

<body>

	<?php
	include "funciones.php";
	?>

	<?php
	//comprobamos la entrada con la cookie creada
	if (($_COOKIE["cookie"]) == "superadmin") {
		
		$permiso = mysqli_fetch_array(getPermisos());
		echo "<p>Los permisos actuales están a " . $permiso['AUTENTICACIÓN'] . "";
		


		echo "<form method='GET' action='usuarios.php'>
			<input type='submit' name='cambiar' value='Cambiar permisos'>
			</form>";
		if (isset($_GET['cambiar'])) {
			cambiarPermisos();
		}
		echo "<a href='index.php'>Volver al inicio</a>";
		pintaTablaUsuarios();
	} else {
		echo "<h1>Panel de usuarios</h1>
			  <p>No tienes permisos para estar aquí<a href='index.php'></a></p>";
	}


	?>
</body>

</html>