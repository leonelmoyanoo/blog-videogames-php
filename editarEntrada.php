<?php  require_once 'includes/redireccion.php';require_once'includes/header.php';?>
	<!--BARRA LATERAL -->
	<?php require_once 'includes/barra_lateral.php' ?>
	<?php if (!isset($_GET['id'])): ?>
		<?php header("Location:index.php"); ?>
	<?php else: ?>
		<?php $entrada = conseguirEntrada($db,$_GET['id']); ?>
	<?php endif ?>
	<!--CAJA PRINCIPAL -->
	<div id="principal">
		<h1>Editar entrada</h1>
		
		<p>
			Actualizá tu entrada
		</p>

		<br>
		<form action="acciones/actualizarEntrada.php?id=<?=$entrada['id']?>" method="POST" accept-charset="utf-8">
			<label for="Titulo">Titulo de entrada: </label>
			<input type="text" name="titulo" value="<?=$entrada['titulo']?>" required>
			<?= isset($_SESSION["errores"]) ? MostrarError($_SESSION["errores"],"nombre") : ''; ?>

			<label for="Descripcion">Descripcion: </label>
			<textarea name="descripcion"><?=$entrada['descripcion']?></textarea>
			<?= isset($_SESSION["errores"]) ? MostrarError($_SESSION["errores"],"nombre") : ''; ?>

			<label for="Categorias">Categorias: </label>
			<select name="categoria">
				<?php 
					$categorias = conseguirCategorias($db);
					if(!empty($categorias)):
						while ($categoria = mysqli_fetch_assoc($categorias)):
				?>
							<option value="<?=$categoria['id'];?>"
							<?=($categoria['id'] == $entrada['categoria_id'])? "selected = 'selected'": '' ?>>
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
	</div>
	<!--PIE DE PAGINA -->
<?php require_once'includes/footer.php' ?>