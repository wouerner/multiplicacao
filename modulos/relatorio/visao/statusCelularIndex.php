<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<style type="text/css">
		   @import url("../../../ext/twitter-bootstrap/bootstrap.css");
		   @import url("../../../incluidos/css/estilo.css");
		</style>
		<script src="../../../ext/jquery/jquery-1.7.1.min.js"></script>
	</head>

	<body>
		<section class = "container">

		<nav> 
			<?php include 'modulos/menu/visao/menu.inc.php' ; ?>	
		</nav>
			
		<header>
		
		</header>

		<section>		
			<article>
	

							<h3>Relatorio de Status Por Tipo</h3>

							<?php foreach ( $statusCelulares as $statusCelular) : ?>

							<a class = "btn" href="/relatorio/statusCelularPorTipo/<?php echo $statusCelular['id'] ; ?>" > <?php echo $statusCelular['nome'] ; ?></a>
							
							<?php endforeach ; ?>
				
						<?php // discipulo\Modelo\Discipulo::mostrarPaginacao( $totalDiscipulos['total'] ,3 ,$pagina ) ; ?>
			
			</article>
		
		</section>

		</section>
	</body>
</html>

