<?php 
if (!isset($_SESSION)) {
	session_start();
}

	if (isset($_POST)&&isset($_POST["btn"]) && $_POST["btn"]=="Actualizar mis datos") {
		require_once '../includes/conexion.php';

		//Obteniendo los valores del formulario de registro
		$nombre = isset($_POST["Nombres"]) ? trim(mysqli_real_escape_string($db,$_POST["Nombres"])) : false;
		$apellidos = isset($_POST["Apellidos"]) ? mysqli_real_escape_string($db,$_POST["Apellidos"]) : false;
		$email = isset($_POST["email"]) ? trim(mysqli_real_escape_string($db,$_POST["email"])) : false;

		//Array de errores
		$errores = array();
		//Verificacion de datos
		// Verifico si el nombre no esta vacio y no es un número
		$nombre_validate = !empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/",$nombre);

		// Verifico si el apellido no esta vacio y no es un número
		$apellido_validate = !empty($apellidos) && !is_numeric($apellidos) && !preg_match("/[0-9]/",$apellidos);

		// Verifico si el email es un dominio valido y no esta vacia
		$email_validate = !empty($email) && filter_var($email,FILTER_VALIDATE_EMAIL);

		//Veo cuales datos fueron erroneos y los informo
		if (!$nombre_validate) {
			$errores["nombre"] = "El nombre no es valido";
		}

		if (!$apellido_validate) {
			$errores["apellido"] = "El apellido no es valido";
		}

		if (!$email_validate) {
			$errores["email"] = "El email no es valido";
		}
		//por las dudas borro si hubo un error en el login
		if (isset($_SESSION['error_login'])) {
			session_unset($_SESSION['error_login']);
		}

		//verifico si "$errores" esta vacia
		if (count($errores) == 0) {
			$usuario = $_SESSION['usuario']['id'];

			//COMPROBAR SI EL EMAIL YA EXISTE
			$sql = "SELECT email FROM usuarios WHERE email = '$email';";
			$isset_email = mysqli_query($db,$sql);
			$isset_user = mysqli_fetch_assoc($isset_email);

			if (empty($isset_user) || $usuario == $isset_user['id']) {
				//actualizar usuario
				$sql = "UPDATE usuarios SET 
						nombre = '$nombre',
						apellidos = '$apellidos',
						email = '$email' 
						WHERE  id = $usuario;";
				$guardar = mysqli_query($db, $sql);
				if ($guardar) {
					//actualizo la sesion
					$_SESSION['usuario']['nombre'] = $nombre;
					$_SESSION['usuario']['apellidos'] = $apellidos;
					$_SESSION['usuario']['email'] = $email;

					$_SESSION["completado"] = "Se actualizaron mis datos";
				}else{
					$_SESSION["errores"]["general"] = "No se actualizó correctamente";
				}
			}else{
				$_SESSION["errores"]["general"] = "Este usuario ya existe";
			}
			
		}else{
			$_SESSION["errores"] = $errores;
		}
	}
	header("Location:../misDatos.php");
?>