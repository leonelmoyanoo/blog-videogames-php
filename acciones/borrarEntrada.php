<?php 
require_once '../includes/conexion.php';
	session_start();
	if (isset($_SESSION['usuario']['id']) && $_GET['id']) {
		$usuario = $_SESSION['usuario']['id'];
		$entrada = $_GET['id'];

		$sql = "DELETE FROM entradas WHERE usuario_id = $usuario AND id = $entrada";
		mysqli_query($db, $sql);
	}
	header("Location: ../index.php");
?>