<?php  require_once 'includes/redireccion.php';require_once'includes/header.php';?>
	<!--BARRA LATERAL -->
	<?php require_once 'includes/barra_lateral.php' ?>

	<!--CAJA PRINCIPAL -->
	<div id="principal">
		<h1>Crear categorias</h1>
		
		<p>
			Añade nuevas categorias al blog para que los usuarios puedan usaralas al cear sus entradas.
		</p>

		<br>
		<form action="acciones/guardarCategoria.php" method="POST" accept-charset="utf-8">
			<label for="Nombre">Nombre de la categoria</label>
			<input type="text" name="nombre" required>
			
			<input type="submit" name="btn" value="Guardar">
		</form>
	<!--PIE DE PAGINA -->
<?php require_once'includes/footer.php' ?>