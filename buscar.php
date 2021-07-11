<?php if (!isset($_POST['buscador'])): ?>
	<?php header("Location: index.php"); ?>
<?php endif ?>
<?php require_once'includes/header.php' ?>
	<!--BARRA LATERAL -->
	<?php require_once 'includes/barra_lateral.php' ?>
	<!--CAJA PRINCIPAL -->
	<div id="principal">
		<h1>Busqueda de: '<?=$_POST['buscador']?>' </h1>
		<?php 
					$entradas = conseguirEntradas($db,null,null,$_POST['buscador']);
					if(!empty($entradas)):
						while ($entrada = mysqli_fetch_assoc($entradas)):
				?>
							<article class="entrada">
								<a href="entrada.php?id= <?=$entrada['id'];?>">
									<h2><?=$entrada['titulo']?></h2>
									<span class="fecha"><?=$entrada['Categoria'].' | '.$entrada["fecha"].' | '.$entrada['usuario']?></span>
									<p>
										<?=substr($entrada['descripcion'],0,180)."..."?>
									</p>
								</a>
							</article>
				<?php 
						endwhile; 
					endif;
				?>
	</div>
	<!--PIE DE PAGINA -->
<?php require_once'includes/footer.php' ?>