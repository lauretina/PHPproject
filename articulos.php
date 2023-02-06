<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Articulos</title>
</head>
<body>

	<?php 
		include "funciones.php";


		if(($_COOKIE["cookie"]) == "autorizado"){  
			
			echo "<h1>Lista de artículos</h1>";
			echo "<a href='index.php'>Volver</a>\n<br>" ;
			$orden="random";
			pintaProductos($orden);

			
			}else{
			echo "<h1>Lista de artículos</h1>
			     <p>No tienes permisos para estar aquí.<a href='index.php'</a></p>";
		}
		
?>
</body>

</html>
