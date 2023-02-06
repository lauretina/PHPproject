<?php

include "conexion.php";

function tipoUsuario($nombre, $correo){
	$DB = crearConexion("pac3_daw");
	$sql = "SELECT ENABLED FROM USER WHERE fullname = '" . $nombre . "' AND email = '" . $correo . "'";
	$result = mysqli_query($DB, $sql);
	if (mysqli_num_rows($result) > 0) {
		$enabled = mysqli_fetch_array($result);
		if ($enabled[0] == 1 || $enabled[0] == 0) {
			if (esSuperadmin($nombre, $correo)) {
				return "superadmin";
			}
			if ($enabled[0] == 1) {
				return "autorizado";
			} else {
				return "registrado";
			}
		}
	} else {
		return "no registrado";
	}
	cerrarConexion($DB);
}

// devuelve boolean
function esSuperadmin($nombre, $correo){
	$DB = crearConexion("pac3_daw");
	$sql = "SELECT * FROM USER AS U INNER JOIN SETUP AS S ON U.USERID = S.SUPERADMIN WHERE u.FullName='" . $nombre . "' AND u.Email='" . $correo . "'";

	//si el usuario existe en la tabla setup es superadmin
	$result = mysqli_query($DB, $sql);

	if (mysqli_num_rows($result) > 0) {
		return true;
	} else {
		return false;
	}

	cerrarConexion($DB);
}


function getPermisos(){
	$DB = crearConexion("pac3_daw");
	$sql = "SELECT AUTENTICACIÓN FROM SETUP";
	$result = mysqli_query($DB, $sql);
	return $result;

	cerrarConexion($DB);
}


function cambiarPermisos(){
	$DB = crearConexion("pac3_daw");
	$sql = "UPDATE SETUP SET Autenticación = CASE Autenticación
		WHEN '1' THEN '0' 
		WHEN '0' THEN '1'
		END ";
	$result = mysqli_query($DB, $sql);
	return $result;

	cerrarConexion($DB);
}


function getCategorias(){
	$DB = crearConexion("pac3_daw");
	$sql = "SELECT CATEGORYID,NAME FROM CATEGORY";
	$result = mysqli_query($DB, $sql);
	return $result;

	cerrarConexion($DB);
}

function getListaUsuarios(){
	$DB = crearConexion("pac3_daw");
	$sql = "SELECT FULLNAME, EMAIL, ENABLED FROM USER";
	$result = mysqli_query($DB, $sql);
	return $result;

	cerrarConexion($DB);
}

//pasas el codigo y obtienes la info
function getProducto($ID){
	$DB = crearConexion("pac3_daw");
	$sql = "SELECT P.PRODUCTID, P.NAME, P.COST, P.PRICE, C.NAME FROM PRODUCT 
	AS P INNER JOIN CATEGORY AS C ON P.CATEGORYID=C.CATEGORYID WHERE PRODUCTID='" . $ID . "'";
	$result = mysqli_query($DB, $sql);
	return $result;

	cerrarConexion($DB);
}


//SACAR LISTA PRODUCTOS EN LA CONSULTA
function getProductos($orden){
	$DB = crearConexion("pac3_daw");
	
	$sql = "SELECT P.PRODUCTID, P.NAME, P.COST, P.PRICE, C.NAME FROM PRODUCT AS P INNER JOIN CATEGORY AS C ON P.CATEGORYID=C.CATEGORYID ORDER BY '" . $orden . "'";
	$result = mysqli_query($DB, $sql);
	return $result;

	cerrarConexion($DB);
}


function anadirProducto($nombre, $coste, $precio, $categoria){
	$DB = crearConexion("pac3_daw");
	$sql = "INSERT INTO PRODUCT (NAME, COST, PRICE, CATEGORYID)
		VALUES ('$nombre','$coste','$precio','$categoria')";

	$result = mysqli_query($DB, $sql);
	return $result;

	cerrarConexion($DB);
}


function borrarProducto($id){
	$DB = crearConexion("pac3_daw");

	$sql = "DELETE FROM PRODUCT WHERE ProductID='$id'";

	$result = mysqli_query($DB, $sql);
	return $result;

	cerrarConexion($DB);
}


function editarProducto($id, $nombre, $coste, $precio, $categoria){
	$DB = crearConexion("pac3_daw");	
	
	$sql = "UPDATE PRODUCT 
			SET ProductID='$id', NAME ='$nombre', 
		    COST ='$coste', PRICE='$precio', CategoryID='$categoria' WHERE ProductID='$id'";


	$result = mysqli_query($DB, $sql);
	return $result;

	cerrarConexion($DB);


	
}
