<?php  require_once 'includes/redireccion.php';require_once'includes/header.php';?>
	<!--BARRA LATERAL -->
	<?php require_once 'includes/barra_lateral.php' ?>

	<!--CAJA PRINCIPAL -->
	<div id="principal">
		<h1>Crear Entradas</h1>
		
		<p>
			Añade nuevas entradas al blog para que los usuarios puedan leerlas y disfrutar de nuestro contenido.
		</p>

		<br>
		<form action="acciones/guardarEntrada.php" method="POST" accept-charset="utf-8">
			<label for="Titulo">Titulo de entrada: </label>
			<input type="text" name="titulo" required>
			<?= isset($_SESSION["errores"]) ? MostrarError($_SESSION["errores"],"nombre") : ''; ?>

			<label for="Descripcion">Descripcion: </label>
			<textarea name="descripcion"></textarea>
			<?= isset($_SESSION["errores"]) ? MostrarError($_SESSION["errores"],"nombre") : ''; ?>

			<label for="Categorias">Categorias: </label>
			<select name="categoria">
				<?php 
					$categorias = conseguirCategorias($db);
					if(!empty($categorias)):
						while ($categoria = mysqli_fetch_assoc($categorias)):
				?>
							<option value="<?=$categoria['id'];?>">
								<?=$categoria['nombre'] ?>
							</option>
				<?php 
						endwhile; 
					endif;
				?>
			</select>
			<?= isset($_SESSION["errores"]) ? MostrarError($_SESSION["errores"],"nombre") : ''; ?>

			<input type="submit" name="btn" value="Guardar">
		</form>
		<?php borrarErrores(); ?>
	<!--PIE DE PAGINA -->
<?php require_once'includes/footer.php' ?>