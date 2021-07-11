<?php 
if (!isset($_SESSION)) {
	session_start();
}

	if (isset($_POST)&&isset($_POST["btn"]) && $_POST["btn"]=="Registrarse") {
		require_once '../includes/conexion.php';

		//Obteniendo los valores del formulario de registro
		$nombre = isset($_POST["Nombres"]) ? trim(mysqli_real_escape_string($db,$_POST["Nombres"])) : false;
		$apellidos = isset($_POST["Apellidos"]) ? mysqli_real_escape_string($db,$_POST["Apellidos"]) : false;
		$email = isset($_POST["email"]) ? trim(mysqli_real_escape_string($db,$_POST["email"])) : false;
		$password = isset($_POST["Password"]) ? mysqli_real_escape_string($db,$_POST["Password"]) : false;

		//Array de errores
		$errores = array();
		//Verificacion de datos
		// Verifico si el nombre no esta vacio y no es un número
		$nombre_validate = !empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/",$nombre);

		// Verifico si el apellido no esta vacio y no es un número
		$apellido_validate = !empty($apellidos) && !is_numeric($apellidos) && !preg_match("/[0-9]/",$apellidos);

		// Verifico si el email es un dominio valido y no esta vacia
		$email_validate = !empty($email) && filter_var($email,FILTER_VALIDATE_EMAIL);

		// Verifico si el contraseña no esta vacia
		$password_validate = !empty($password);

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

		if (!$password_validate) {
			$errores["password"] = "La contraseña esta vacia";
		}
		//por las dudas borro si hubo un error en el login
		if (isset($_SESSION['error_login'])) {
			session_unset($_SESSION['error_login']);
		}

		//verifico si "$errores" esta vacia
		if (count($errores) == 0) {
			//COMPROBAR SI EL EMAIL YA EXISTE
			$sql = "SELECT email FROM usuarios WHERE email = '$email';";
			$isset_email = mysqli_query($db,$sql);
			$isset_user = mysqli_fetch_assoc($isset_email);

			if (empty($isset_user)) {

				//CIFRAR LA CONTRASEÑA
				$password_segura = password_hash($password,PASSWORD_BCRYPT,['cost' => 4]);

				//insertar usuario
				$sql = "INSERT INTO usuarios VALUES(null,'$nombre','$apellidos','$email','$password_segura',CURDATE());";
				$guardar = mysqli_query($db, $sql);

				if ($guardar) {
					$_SESSION["completado"] = "El registro se ha completado con éxito";
				}else{
					$_SESSION["errores"]["general"] = "Fallo al registrar el usaurio";
				}
			}else{
				$_SESSION["errores"]["general"] = "Este usuario ya existe";
			}
		}else{
			$_SESSION["errores"] = $errores;
		}
	}
	header("Location:../index.php");
?>