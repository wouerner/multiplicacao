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
					<div class = "span12" >
						<table class = "table bordered-table">
						<caption><h3>Lista de Discipulos da rede <?php echo $tipoRede->nome ; ?></h3></caption>
						<tr>
							<th>Nº</th>
							<th>Nome</th>
							<th>Líder</th>
						</tr>
						<?php foreach ( $redeMembros as $discipulo) : ?>

						<tr>
							<td><?php echo  $cont++  ?></td>
							<td><a href="/discipulo/detalhar/id/<?php echo $discipulo->id ?>" ><?php echo $discipulo->nome ; ?></a></td>
							<td><a href="/discipulo/detalhar/id/<?php echo $discipulo->getLider()->id ?>" ><?php echo $discipulo->getLider()->nome ; ?></a></td>
						</tr>
							
						
						<?php endforeach ; ?>
						</table>
					<div class = "form-actions" >	
						<?php //discipulo\Modelo\Discipulo::mostrarPaginacao( $totalDiscipulos['total'] ,3 ,$pagina ) ; ?>
					</div>
			</div>
			</div>
			</article>
		
		</section>

		</section>
	</body>
</html>

