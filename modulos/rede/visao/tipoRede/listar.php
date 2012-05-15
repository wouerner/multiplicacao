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
						<table class = "table bordered-table">
						<caption><h3>Lista de Tipo de Rede</h3></caption>

						<?php foreach ( $redes as $rede) : ?>

						<tr><td><a href="/rede/detalharTipoRede/id/<?php echo $rede['id']?>" ><h2><?php echo $rede['nome'] ; ?> </h2></a></td>
							<?php require 'rede/visao/tipoRede/menu.inc.php' ; ?>
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

