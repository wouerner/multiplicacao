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

					<?php require 'modulos/celula/visao/chamarCelula.php' ; ?>

			<?php if (isset($mensagem)) : ?>
					<div class="alert <?php echo ($mensagem=='ok') ? 'alert-success' : 'alert-error' ; ?>">
				  	<h4 class="alert-heading">
						<?php echo $mensagem ?>!
					</h4>
				   </div>
				<?php endif ; ?>
						<table class = "table">

							<caption><h3>Lista de Líderes de Células</h3></caption>
							<thead>
								<th>Nome</th>
								<th>Total</th>
							</thead>

							<?php foreach ( $lideres as $lider) : ?>

							<tr>
								<td>
									<h2><a href ="/discipulo/detalhar/id/<?php echo $lider['id']?>" ><?php echo $lider['nome'] ; ?></a></h2>
								</td>
								<td>
								<?php echo $lider['totalCelulas'] ; ?>	
								</td>
							</tr>
						<?php endforeach ; ?>
						</table>
				
						<?php // discipulo\Modelo\Discipulo::mostrarPaginacao( $totalDiscipulos['total'] ,3 ,$pagina ) ; ?>
			
			</article>
		
		</section>

		</section>
	</body>
</html>

