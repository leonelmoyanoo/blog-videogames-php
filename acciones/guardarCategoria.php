<?php 
if (isset($_POST)&&isset($_POST["btn"]) && $_POST["btn"]=="Guardar") {

	//Conexion a la base de datos
	require_once '../includes/conexion.php';

	//Obteniendo los valores del formulario de registro
	$nombre = isset($_POST["nombre"]) ? trim(mysqli_real_escape_string($db,$_POST["nombre"])) : false;
	//Array de errores
	$errores = array();

	if (empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/",$nombre)) {
		$errores['nombre'] = 'El nombre no es valido';
	}

		//verifico si "$errores" esta vacia
		if (count($errores) == 0) {
			$sql = "INSERT INTO categorias VALUES (NULL,'$nombre');";

			$guardar = mysqli_query($db, $sql);
			echo $guardar;
			header("Location:../index.php");
		}else{
			$_SESSION["errores"]= $errores;
			header("Location:../crearCategoria.php");
		}
	}
?>