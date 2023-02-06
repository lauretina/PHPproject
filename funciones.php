<?php

include "consultas.php";

// ARREGLAAAAAAAAAAAAAAAAAAAAAAR

function pintaCategorias($defecto){
	$datos =  getCategorias();
	while($categorias =  mysqli_fetch_assoc($datos)){
			 // Identifico cuál tengo que mostrar por defecto.	
			 if ($defecto == $categorias[0]) {
			  echo "<option value='$categorias[0]'>'$categorias[1]'</option>";
			 }else {
			  echo "<option value='$categorias[0]'>'$categorias[1]'</option>";
			 }	
 		}	
		 
}
	
function pintaTablaUsuarios(){
	$datos = getListaUsuarios();
	echo "<table>\n 
				<tr>\n
					<th>Nombre</th>\n
					<th>Email</th>\n
					<th>Autorizado</th>\n
					</tr>\n";

	while ($fila = mysqli_fetch_assoc($datos)) {
		echo "<tr>\n
						<td>{$fila["FULLNAME"]}</td>\n
						<td>{$fila["EMAIL"]}</td>\n";

		if ($fila["ENABLED"] == 1) {
			echo "<td class='rojo'>{$fila["ENABLED"]}</td>\n
						</tr>";
		} else {
			echo "<td>{$fila["ENABLED"]}</td>\n
						</tr>";
		}
	}
	echo "</table>";
}

//MOSTRAR LISTA DE PRODUCTOS
function pintaProductos($orden)
{
	$datos = getProductos($orden);

	$permiso = mysqli_fetch_array(getPermisos());
	
	if ($permiso[0] == '0'){
	
		echo "<table>\n 
						<tr>\n
							<th><a href=''>ID</a></th>\n
							<th><a href=''>Nombre</a></th>\n
							<th><a href=''>Coste</a></th>\n
							<th><a href=''>Precio</a></th>\n
							<th><a href=''>Categoría</a></th>\n
							<th>Acciones</th>\n
						</tr>\n";

		// Filas de la consulta de artículos 
		while ($fila = mysqli_fetch_array($datos)) {
			echo "<tr>\n 
							<td>" . $fila[0] . "</td>\n
							<td>" . $fila[1] . "</td>\n
							<td>" . $fila[2] . "</td>\n
							<td>" . $fila[3] . "</td>\n
							<td>" . $fila[4] . "</td>\n
						</tr>";
		};

		echo "</table>";
} else {
		echo "<a href='formArticulos.php'>Añadir producto</a>\n 
		<table>\n 
				<tr>\n
					<th><a href=''>ID</a></th>\n
					<th><a href=''>Nombre</a></th>\n
					<th><a href=''>Coste</a></th>\n
					<th><a href=''>Precio</a></th>\n
					<th><a href=''>Categoría</a></th>\n
					<th>Acciones</th>\n
				</tr>\n";

	// Filas de la consulta de artículos 
	while ($fila = mysqli_fetch_array($datos)) {
	echo "<tr>\n 
			<td>" . $fila[0] . "</td>\n
			<td>" . $fila[1] . "</td>\n
			<td>" . $fila[2] . "</td>\n
			<td>" . $fila[3] . "</td>\n
			<td>" . $fila[4] . "</td>\n
			<td><a href='formArticulos.php?editar=" . $fila[0] . "' >Editar</a>
			<a href='formArticulos.php?borrar=" . $fila[0] . "' >Borrar</a>
		</tr>";
	};

	echo "</table>";
	}

	};
	