<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Formulario de artículos</title>
	<link rel="stylesheet" type="text/css" href="estilo.css">
</head>

<body>

	<?php
	include "funciones.php";

	if (($_COOKIE["cookie"]) == "autorizado") {  // permisos a 1 si y a 0 no
		if (!(isset($_GET['editar'])) && !(isset($_GET['borrar']))) {   //VENGO DE AÑADIR
		//en el select se tiene que ver PANTALON
		
		$id = "";
		$nombre = "";
		$coste = "";
		$precio = "";
		$categoria = "";
	
		$datos = mysqli_fetch_assoc(getCategorias());
		echo "<form action='formArticulos.php' method='POST'>
						<label>ID:</label>
						<input type='text' name='id' disabled value=''><br>
						<label>Nombre:</label>
						<input type='text' name='nombre' value=''><br>
						<label>Coste:</label>
						<input type='text' name='coste' value=''><br>
						<label>Precio:</label>
						<input type='text' name='precio' value=''><br>
						<label>Categoría:</label>
						<select name='categoria' id='categoria'>
						<option value='pantalon' stu>PANTALÓN</option>
						<option value='camisa'>CAMISA</option>
						<option value='jersey'>JERSEY</option>
						<option value='chaqueta'>CHAQUETA</option>
						</select><br>
						<input type='submit' name='botoanyade' value='Añadir'>
						<a href='articulos.php'>Volver</a>
						</form>";		}

		//SI VENGO DE EDITAR
		if (isset($_GET['editar'])) {
			$ID = $_GET['editar'];
			$fila = mysqli_fetch_array(getProducto($ID));
			$id = $fila[0];
			$nombre = $fila[1];
			$coste = $fila[2];
			$precio = $fila[3];
			$categoria = $fila[4];
			$defecto = $fila[0];
			$datos= $id;
			$categorias = mysqli_fetch_array(getCategorias());

			// Con el ID obtenemos de nuevo todos los datos del producto.
			$fila = mysqli_fetch_array(getProducto($ID));
			echo "<form action='formArticulos.php' method='POST'>
					<label>ID:</label>
					<input type='text' name='id' disabled value='" . $fila[0] . "'><br>
					<label>Nombre:</label>
					<input type='text' name='nombre' value='" . $fila[1] . "'><br>
					<label>Coste:</label>
					<input type='text' name='coste' value='" . $fila[2] . "'><br>
					<label>Precio:</label>
					<input type='text' name='precio' value='" . $fila[3] . "'><br>
					<label>Categoría:</label>
					<select name='categoria'>
					<?php
					function pintaCategorias($defecto){
						$datos = getCategorias();
						while ($categorias = mysqli_fetch_array(getCategorias($datos)){	
							 if ($defecto == $categorias[0]) {
							  echo <option value='" . $categorias[0] . "'>" . $categorias[1] . "</option>;
							 }else {
								 echo <option value='" . $categorias[0] . "'>" . $categorias[1] . "</option>;
							 }	
					 }				
					 ?>
					</select><br>
					<input type='hidden' name='idedita' value='" . $fila['PRODUCTID'] . "'>
					<input type='submit' name='botoedita' value='Editar'>
					<a href='articulos.php'>Volver</a>
					</form>";

		}
		//SI VENGO DE BORRAR
		if (isset($_GET['borrar'])) {
			$ID = $_GET['borrar'];
			$id = "";
			$nombre = "";
			$coste = "";
			$precio = "";
			$categoria = "";
			$defecto ="";
			$datos="";
			$categorias = mysqli_fetch_array(getCategorias());

			// Con el ID obtenemos de nuevo todos los datos del producto.
			$fila = mysqli_fetch_array(getProducto($ID));
			echo "<form action='formArticulos.php' method='POST'>
					<label>ID:</label>
					<input type='text' name='id' disabled value='" . $fila[0] . "'><br>
					<label>Nombre:</label>
					<input type='text' name='nombre' value='" . $fila[1] . "'><br>
					<label>Coste:</label>
					<input type='text' name='coste' value='" . $fila[2] . "'><br>
					<label>Precio:</label>
					<input type='text' name='precio' value='" . $fila[3] . "'><br>
					<label>Categoría:</label>
					<select name='categoria'>
					<?php
					function pintaCategorias($defecto){
						$datos = getCategorias();
						while ($categorias = mysqli_fetch_array(getCategorias($datos)){	
							 if ($defecto == $categorias[0]) {
							  echo <option value='" . $categorias[0] . "'>" . $categorias[1] . "</option>;
							 }else {
								 echo <option value='" . $categorias[0] . "'>" . $categorias[1] . "</option>;
							 }	
					 }				
					 ?>
					</select><br>
					<input type='hidden' name='idborra' value='" . $fila['PRODUCTID'] . "'>
					<input type='submit' name='botoborra' value='Borrar'>
					<a href='articulos.php'>Volver</a>
					</form>";


		}
		

	foreach ($_POST as $key => $boton) {
		switch ($key) {
			case 'botoedita':
				editarProducto($id, $nombre, $coste, $precio, $categoria);
				echo "Se ha editado el producto";
				break;
			case 'botoanyade':
				// Si vengo de añadir, guardo lo que escribo
				anadirProducto($nombre, $coste, $precio, $categoria);
				echo "Se ha añadido el producto";
				break;
			case 'botoborra':
				borrarProducto($_POST['idborra']);
				echo "Se ha borrado el producto";
				break;
		}
	}
}
	?>
	<?php
	if (($_COOKIE["cookie"]) != "autorizado") {
		echo "<p>No tienes permisos para estar aquí.</p>";
	}

	?>
	
</body>

</html>