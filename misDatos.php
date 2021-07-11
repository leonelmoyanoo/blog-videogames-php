<?php  require_once 'includes/redireccion.php';require_once'includes/header.php';?>
	<!--BARRA LATERAL -->
	<?php require_once 'includes/barra_lateral.php' ?>

	<!--CAJA PRINCIPAL -->
	<div id="principal">
		<h1>Mis datos</h1>
		
		<p>
			Tus datos personales y puedes modificarlos si así lo deseas!.
		</p>
		
		<br>
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
				<form action="acciones/ModificarDatos.php" method="POST" accept-charset="utf-8">
					<label for="Nombres"> Nombres:</label>
					<input type="text" name="Nombres" value="<?=$_SESSION['usuario']['nombre']?>" required>
					<?= isset($_SESSION["errores"]) ? MostrarError($_SESSION["errores"],"nombre") : ''; ?>

					<label for="Apellidos"> Apellidos:</label>
					<input type="text" name="Apellidos" value="<?=$_SESSION['usuario']['apellidos']?>" required>
					<?= isset($_SESSION["errores"]) ? MostrarError($_SESSION["errores"],"apellido") : ''; ?>

					<label for="Email"> Email:</label>
					<input type="text" name="email" value="<?=$_SESSION['usuario']['email']?>" required>
					<?= isset($_SESSION["errores"]) ? MostrarError($_SESSION["errores"],"email") : ''; ?>
					<input type="submit" name="btn" value="Actualizar mis datos">
				</form>
				<?php borrarErrores(); ?>
			
			</div>
	<!--PIE DE PAGINA -->
<?php require_once'includes/footer.php' ?>