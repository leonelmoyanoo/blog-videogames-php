	
		<aside id="sidebar">
			<div id="buscador" class="bloque">
				<h3>Buscar</h3>

				<?php if (isset($_SESSION['error_login'])):?>
					<div class="alerta alerta-error">
						<?=$_SESSION['error_login'];?>
					</div>
				<?php endif;?>

				<form action="buscar.php" method="POST" accept-charset="utf-8">
					<label for="buscador"> Buscador:</label>
					<input type="text" name="buscador" required>
					<?= isset($_SESSION["errores"]) ? MostrarError($_SESSION["errores"],"emailLogin") : ''; ?>
					<input type="submit" name="btn" value="Buscar">
				</form>
			</div>
			<?php if (isset($_SESSION['usuario'])){ ?>
				<div id="usuario-logeado" class="bloque">
					<h3><?='Bienvenido, '.$_SESSION['usuario']['nombre'].' '.$_SESSION['usuario']['apellidos'] ?></h3>
					<!-- BOTONES -->
					<a href="crearCategoria.php" class="boton boton-naranja">Crear categorias</a>
					<a href="crearEntradas.php" class="boton boton-verde">Crear entradas</a>
					<a href="misDatos.php" class="boton">Mis datos</a>
					<a href="acciones/cerrar.php" class="boton boton-rojo">Cerrar sesión</a>
				</div>
			<?php }else{ ?>

			<div id="login" class="bloque">

				<?php if (isset($_SESSION['error_login'])):?>
					<div class="alerta alerta-error">
						<?=$_SESSION['error_login'];?>
					</div>
				<?php endif;?>

				<h3>Identificate</h3>
				<form action="acciones/login.php" method="POST" accept-charset="utf-8">
					<label for="Email"> Email:</label>
					<input type="email" name="email" required>
					<?= isset($_SESSION["errores"]) ? MostrarError($_SESSION["errores"],"emailLogin") : ''; ?>


					<label for="Password"> Contraseña:</label>
					<input type="password" name="Password" required>
					<?= isset($_SESSION["errores"]) ? MostrarError($_SESSION["errores"],"passwordLogin") : ''; ?>


					<input type="submit" name="btn" value="Ingresar">
				</form>
			</div>
			<div id="register" class="bloque">
				<!-- Mostrar errores -->
				<?php if (isset($_SESSION["completado"])): ?>
					<div class="alerta alerta-exito">
						<?=$_SESSION["completado"];?> 
					</div>
				<?php elseif (isset($_SESSION["errores"]["general"])):?>
					<div class="alerta alerta-error">
						<?=$_SESSION["errores"]["general"];?>
					</div>
				<?php endif;?>

				<h3>Registrate</h3>
				<form action="acciones/register.php" method="POST" accept-charset="utf-8">
					<label for="Nombres"> Nombres:</label>
					<input type="text" name="Nombres" required>
					<?= isset($_SESSION["errores"]) ? MostrarError($_SESSION["errores"],"nombre") : ''; ?>

					<label for="Apellidos"> Apellidos:</label>
					<input type="text" name="Apellidos" required>
					<?= isset($_SESSION["errores"]) ? MostrarError($_SESSION["errores"],"apellido") : ''; ?>

					<label for="Email"> Email:</label>
					<input type="text" name="email" required>
					<?= isset($_SESSION["errores"]) ? MostrarError($_SESSION["errores"],"email") : ''; ?>

					<label for="Password"> Contraseña:</label>
					<input type="password" name="Password" required>
					<?= isset($_SESSION["errores"]) ? MostrarError($_SESSION["errores"],"password") : ''; ?>

					<input type="submit" name="btn" value="Registrarse">
				</form>
				<?php borrarErrores(); ?>
			
			</div>
			<?php } //endif?>
		</aside>