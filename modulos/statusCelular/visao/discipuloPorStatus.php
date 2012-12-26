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
		<section>		
			<article>

				<?php require 'modulos/discipulo/visao/chamarDiscipulo.php' ; ?>
				<div class = "row" >	
				<span class = "span3"><p>Total Discipulos: <strong><?php echo $totalDiscipulos ; ?></strong></p></span>

				<div class = "span12" >
				<table class = "table bordered-table">
				<caption><h3><?php echo $tipoStatus->nome?></h3></caption>

				<?php foreach ( $discipulos as $discipulo) : ?>

				<tr>
						<td><a href="/discipulo/detalhar/id/<?php echo $discipulo->id?>" ><?php echo $discipulo->nome ; ?></a></td>
				</tr>
				</tr>
				 
				<?php endforeach ; ?>
				</table>

						<?php //discipulo\Modelo\Discipulo::mostrarPaginacao( $totalDiscipulos ,$quantidadePorPagina ,$pagina ) ; ?>
				</div>
			</div>
			</article>
		
		</section>

		</section>
	</body>
</html>

