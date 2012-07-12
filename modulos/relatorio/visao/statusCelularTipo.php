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
			<?php //include 'modulos/menu/visao/menu.inc.php' ; ?>	
		</nav>
			
		<header>
		
		</header>

		<section>		
			<article>
			<?php $cont = 0 ; ?>
						<table class = "table table-condensed table-bordered">

						<caption><h3>Relatorio de Status Por Tipo: <?php echo $status ; ?><h3></caption>
							<thead>
								<tr>
								<th class = "span1" >Nº</th>	<th>Nome</th>
								</tr>
							</thead>

							<?php foreach ( $statusCelulares as $statusCelular) : ?>

							<tr>
								<td><?php echo ++$cont?></td> <td><?php echo $statusCelular['discipulo'] ; ?></td>
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

