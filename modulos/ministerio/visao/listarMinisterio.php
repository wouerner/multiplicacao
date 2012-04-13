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
						<table class = "table bordered-table">
						<caption><h3>Lista de Ministérios</h3></caption>

						<?php foreach ( $ministerios as $ministerio) : ?>

						<tr><td><a href="/ministerio/detalhar/id/<?php echo $ministerio['id']?>" ><h2><?php echo $ministerio['nome'] ; ?> </h2></a></td>
							<?php require 'ministerio/visao/menuMinisterio.inc.php' ; ?>
						</tr>
						
						<?php endforeach ; ?>
						</table>
					<div class = "form-actions" >	
						<?php //discipulo\Modelo\Discipulo::mostrarPaginacao( $totalDiscipulos['total'] ,3 ,$pagina ) ; ?>
					</div>
			</div>
			</article>
		
		</section>

		</section>
	</body>
</html>

