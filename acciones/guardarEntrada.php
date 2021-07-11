<?php 
if (isset($_POST)&&isset($_POST["btn"]) && $_POST["btn"]=="Guardar") {

	//Conexion a la base de datos
	require_once '../includes/conexion.php';

	if (!isset($_SESSION)) {
		session_start();
	}
	//Obteniendo los valores del formulario de registro
	$titulo = isset($_POST["titulo"]) ? trim(mysqli_real_escape_string($db,$_POST["titulo"])) : false;
	$descripcion = isset($_POST["descripcion"]) ? trim(mysqli_real_escape_string($db,$_POST["descripcion"])) : false;
	$categoria = isset($_POST["categoria"]) ? (int)$_POST["categoria"]: false;
	$usuario = $_SESSION['usuario']['id'];
	//Array de errores
	$errores = array();

	if (empty($titulo)) {
		$errores['titulo'] = 'El titulo no es valido';
	}

	if (empty($descripcion)) {
		$errores['descripcion'] = 'La descripcion no es valida';
	}

	if (empty($categoria) && !is_numeric($categoria)) {
		$errores['categoria'] = 'La categoria no es valida';
	}
		//verifico si "$errores" esta vacia
		if (count($errores) == 0) {
			$sql = "INSERT INTO entradas VALUES (NULL,$usuario,$categoria,'$titulo','$descripcion',CURDATE());";
			$guardar = mysqli_query($db, $sql);			
			header("Location:../index.php");
		}else{
			$_SESSION["errores"]= $errores;
			header("Location:../crearEntradas.php");
		}
	}
?>