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
						<caption><h3>Lista de Tipo de Status Celular</h3></caption>

						<?php foreach ( $tipoStatusCelulares as $tipoStatus) : ?>

						<tr><td><a href="/statusCelular/detalhar/id/<?php echo $tipoStatus['id']?>" ><h2><?php echo $tipoStatus['nome'] ; ?> </h2></a></td>
							<?php require 'statusCelular/visao/menuTipoStatusCelular.inc.php' ; ?>
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

