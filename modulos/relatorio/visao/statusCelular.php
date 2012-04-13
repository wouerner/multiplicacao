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
	
						<table class = "table">

							<caption>Relatorios de Discipulos</caption>

							<?php foreach ( $statusCelulares as $statusCelular) : ?>

							<tr>
								<td><h2><?php echo $statusCelular['discipulo'] ; ?> </h2></td>
								<td><h2><?php echo $statusCelular['status'] ; ?> </h2></td>
							</tr>
							<tr>
							</tr>
								
							
							<?php endforeach ; ?>
						</table>
				
						<?php // discipulo\Modelo\Discipulo::mostrarPaginacao( $totalDiscipulos['total'] ,3 ,$pagina ) ; ?>
			
			</article>
		
		</section>

		</section>
	</body>
</html>

