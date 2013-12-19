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
			
		<header>
		
		</header>

		<section>		
			<article>
			<?php if (isset($mensagem)) : ?>
					<div class="alert <?php echo ($mensagem=='ok') ? 'alert-success' : 'alert-error' ; ?>">
				  	<h4 class="alert-heading">
						<?php echo $mensagem ?>!
					</h4>
				   </div>
				<?php endif ; ?>

						<table class = "table bordered-table">
						<caption><h3>Lista dos tipo de Escala de Êxito </h3></caption>

						<?php foreach ( $eventos as $evento) : ?>

						<tr><td><a href="/evento/detalhar/id/<?php echo $evento['id']?>" ><h2><?php echo $evento['nome'] ; ?> </h2></a></td>
						
							<?php require 'evento/visao/menuEvento.inc.php' ; ?>
						</tr>
						<?php endforeach ; ?>
						</table>
				
						<?php //discipulo\Modelo\Discipulo::mostrarPaginacao( $totalDiscipulos['total'] ,3 ,$pagina ) ; ?>
			
			</article>
		
		</section>

		</section>
	</body>
</html>

