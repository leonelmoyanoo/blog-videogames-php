<?php 

	function mostrarError($errores,$campo){
		if (isset($errores[$campo]) && !empty($campo)) {
			$alerta = "<div class ='alerta alerta-error'>".$errores[$campo]."</div>";
		}else{
			$alerta = "";
		}
	return $alerta;
	}

	function borrarErrores(){
		if (isset($_SESSION["errores"])) {
			$_SESSION["errores"] = null;
			unset($_SESSION["errores"]);
		}
		if (isset($_SESSION["completado"])) {
			$_SESSION["completado"] = null;
			unset($_SESSION["completado"]);
		}
	}

	function conseguirCategorias($db){
		$sql = "SELECT * FROM categorias ORDER BY id DESC;";
		$categorias = mysqli_query($db,$sql);
		$result = array();
		if ($categorias && mysqli_num_rows($categorias) >= 1) {
			$result = $categorias;
		}
		return $result;
	}
	function conseguirEntradas($db,$limit = null,$categoria= null,$buscar = null){
		$sql = "SELECT e.*,
				c.nombre AS 'Categoria',
				CONCAT(u.nombre,' ',u.apellidos) AS 'usuario' 
				FROM entradas e
			   	INNER JOIN categorias c ON e.categoria_id = c.id 
			   	INNER JOIN usuarios u ON e.usuario_id = u.id ";
		 if ($categoria != null) {
		 	$sql.= " WHERE e.categoria_id = $categoria ";
		 }

		 if (!empty($buscar)) {
		 	$sql .= "WHERE e.titulo LIKE '%$buscar%' ";
		 }

		 $sql.="ORDER BY e.id DESC";
		if ($limit) {
			 $sql.=" LIMIT 4;";
		}		
		$entradas = mysqli_query($db,$sql);
		$result = array();
		if ($entradas && mysqli_num_rows($entradas) >= 1) {
			$result = $entradas;
		}
		return $result;
	}
	function conseguirEntrada($db,$id){
		$sql = "SELECT e.*,
				c.nombre AS 'Categoria',
				CONCAT(u.nombre,' ',u.apellidos) AS 'usuario' 
				FROM entradas e
			   	INNER JOIN categorias c ON e.categoria_id = c.id 
			   	INNER JOIN usuarios u ON e.usuario_id = u.id 
			   WHERE e.id = $id";	
		$entrada = mysqli_query($db,$sql);
		$result = mysqli_fetch_assoc($entrada);
		return $result;
	}
	function conseguirCategoria($db,$id){
		$sql = "SELECT * FROM categorias WHERE id = $id;";
		$categorias = mysqli_query($db,$sql);
		$result = mysqli_fetch_assoc($categorias);
		return $result;
	}

	function buscarEntradas($db,$buscar){
		$sql = "SELECT e.*,
				c.nombre AS 'Categoria',
				CONCAT(u.nombre,' ',u.apellidos) AS 'usuario' 
				FROM entradas e
			   	INNER JOIN categorias c ON e.categoria_id = c.id 
			   	INNER JOIN usuarios u ON e.usuario_id = u.id ";
		 if ($categoria != null) {
		 	$sql.= " WHERE e.categoria_id = $categoria ";
		 }
		 $sql.="ORDER BY e.id DESC";
		if ($limit) {
			 $sql.=" LIMIT 4;";
		}		
		$entradas = mysqli_query($db,$sql);
		$result = array();
		if ($entradas && mysqli_num_rows($entradas) >= 1) {
			$result = $entradas;
		}
		return $result;
	}
?>