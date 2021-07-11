<?php 
if (!isset($_SESSION)) {
	session_start();
}

	if (isset($_POST["btn"]) && $_POST["btn"]=="Ingresar") {
		require_once '../includes/conexion.php';

		//Obteniendo los valores del formulario del inicio de sesion
		$email = isset($_POST["email"]) ? trim(mysqli_real_escape_string($db,$_POST["email"])) : false;
		$password = isset($_POST["Password"]) ? mysqli_real_escape_string($db,$_POST["Password"]) : false;

		//Array de errores
		$errores = array();
		// Verifico si el email es un dominio valido y no esta vacia
		$email_validate = !empty($email) && filter_var($email,FILTER_VALIDATE_EMAIL);

		// Verifico si el contraseña no esta vacia
		$password_validate = !empty($password);

		if (!$email_validate) {
			$errores["emailLogin"] = "El email no es valido";
		}

		if (!$password_validate) {
			$errores["passwordLogin"] = "La contraseña esta vacia";
		}

		//verifico si "$errores" esta vacia
		if (count($errores) == 0) {
			//Comprobar si existe este usuario
			$sql = "SELECT * FROM usuarios WHERE email = '$email'";
			$login = mysqli_query($db,$sql);
			if ($login && mysqli_num_rows($login) == 1) {
				$usuario = mysqli_fetch_assoc($login);

				//verifico si las contraseñas son iguales
				$verify = password_verify($password, $usuario["password"]);

				if ($verify) {
					$_SESSION['usuario'] = $usuario;

					if (isset($_SESSION['error_login'])) {
						unset($_SESSION['error_login']);
					}
				}else{

					$_SESSION['error_login'] = "Login incorrecto!";
				}
			}else{
				$_SESSION['error_login'] = "Login incorrecto!";
			}
		}else{
			$_SESSION["errores"] = $errores;
			
		}
		header("Location:../index.php");
	}
?>