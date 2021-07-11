	<?php require_once 'conexion.php';!isset($_SESSION) ? session_start():'';require_once 'helpers.php';?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Blog de videojuegos</title>
	<link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
	<!--CABECERA -->
	<!-- /header -->
	<header id="cabecera" class="">

		<div id=logo>
			<a href="index.php">
				Blog de Videojuegos
			</a>
		</div>
		<!--MENU -->
		<nav id="menu">
			<ul>
				<li>
					<a href="index.php" title="">Inicio</a>
				</li>
				<?php 
					$categorias = conseguirCategorias($db);
					if(!empty($categorias)):
						while ($categoria = mysqli_fetch_assoc($categorias)):
				?>
							<li>
								<a href="categoria.php?id= <?=$categoria['id'];?> "><?=$categoria['nombre']?></a>
							</li>
				<?php 
						endwhile; 
					endif;
				?>
				<li>
					<a href="index.php" title="">Sobre mi</a>
				</li>
				<li>
					<a href="index.php" title="">Contacto</a>
				</li>
			</ul>
		</nav>
		<div class="clearfix">
			
		</div>
	</header>

	<div id="contenedor">