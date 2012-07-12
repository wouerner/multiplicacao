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

							<caption><h2>Relatorios de Discipulos por Status</h2></caption>
							<thead>
								<th>Nome</th>
								<th>Status</th>
							</thead>
							<?php foreach ( $statusCelulares as $statusCelular) : ?>

							<tr>
								<td><h4><?php echo $statusCelular['discipulo'] ; ?></h4></td>
								<td><?php echo $statusCelular['status'] ; ?></td>
							</tr>
								
							
							<?php endforeach ; ?>
						</table>
				
						<?php // discipulo\Modelo\Discipulo::mostrarPaginacao( $totalDiscipulos['total'] ,3 ,$pagina ) ; ?>
			
			</article>
		
		</section>

		</section>
	</body>
</html>

