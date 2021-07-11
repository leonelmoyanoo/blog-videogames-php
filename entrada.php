<?php require_once'includes/header.php' ?>
	<!--BARRA LATERAL -->
	<?php require_once 'includes/barra_lateral.php' ?>
	<?php $entrada = conseguirEntrada($db,$_GET['id']);

		if (!isset($entrada['id']))
			header("Location: index.php");
	?>
	<!--CAJA PRINCIPAL -->
	<div id="principal">
		
		<h1>Titulo <?=$entrada['titulo']?></h1>
		<a href="categoria.php?<?=$entrada['categoria_id']?>" title="">
			<h2>Categoria <?=$entrada['Categoria']?></h2>
		</a>
			<h4><?=$entrada['fecha']?>|<?=$entrada['usuario']?></h4>
		<p>
			Descripcion: <?=$entrada['descripcion']?>
		</p>
		<br>
		<?php if (isset($_SESSION) && $_SESSION['usuario']['id'] == $entrada['usuario_id']) :?>
			<a href="editarEntrada.php?id=<?=$entrada['id']?>" class="boton boton-naranja">Editar entrada</a>
			<a href="acciones/borrarEntrada.php?id=<?=$entrada['id']?>" class="boton boton-verde">Borrar entrada</a>
		<?php endif;?>
	</div>
	<!--PIE DE PAGINA -->
<?php require_once'includes/footer.php' ?>