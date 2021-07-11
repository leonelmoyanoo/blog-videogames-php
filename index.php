<?php require_once'includes/header.php' ?>
	<!--BARRA LATERAL -->
	<?php require_once 'includes/barra_lateral.php' ?>
	<!--CAJA PRINCIPAL -->
	<div id="principal">
		<h1>Ultimas entradas</h1>
		<?php 
					$entradas = conseguirEntradas($db,true);
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

	<div id="ver-todas">
		<a href="entradas.php">Ver todas las entradas</a>
	</div>
	<!--PIE DE PAGINA -->
<?php require_once'includes/footer.php' ?>