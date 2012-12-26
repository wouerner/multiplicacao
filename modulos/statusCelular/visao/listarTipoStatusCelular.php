<?php 
$mensagem = isset($_SESSION['mensagem']) ? $_SESSION['mensagem'] : NULL ;
unset($_SESSION['mensagem']) ;
?>
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

			<?php if (isset($mensagem)) : ?>
					<div class="alert <?php echo ($mensagem=='ok') ? 'alert-success' : 'alert-error' ; ?>">
				  	<h4 class="alert-heading">
						<?php echo $mensagem ?>!
					</h4>
				   </div>
				<?php endif ; ?>

				<div class = "row" >	
				<div class = "span12" >	
						<table class = "table bordered-table">
						<caption><h3>Lista de Tipo de Status Celular</h3></caption>
								<tr>
								<th colspan = "3" ><a class = "btn btn-success" href="/statusCelular/novoTipoStatusCelular">Novo Status</a></th>
								</tr>
							<tr>
								<th>Tipo</th>
								<th>Ações</th>
							</tr>

						<?php foreach ( $tipoStatusCelulares as $status) : ?>
	
						<tr>
							<td><a href="/statusCelular/detalhar/id/<?php echo $status->id ?>" ><?php echo $status->nome ; ?></a></td>
							<?php require 'statusCelular/visao/menuTipoStatusCelular.inc.php' ; ?>
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

