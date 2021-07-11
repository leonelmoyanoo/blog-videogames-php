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
	$id = isset($_GET['id']):false;
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
			$sql = "UPDATE entradas set categoria_id = $categoria,titulo ='$titulo',descripcion = '$descripcion' WHERE id = $id AND usuario_id = $usuario;";
			$guardar = mysqli_query($db, $sql);			
			header("Location:../index.php");
		}else{
			$_SESSION["errores"]= $errores;
			header("Location:../editarEntrada.php");
		}
	}
?>