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
				<p>Total de Células: <?php echo $totalCelulas ; ?>		</p>
						<table class = "table">

							<caption><h3>Lista de Células</h3></caption>

							<?php foreach ( $celulas as $celula) : ?>

							<tr><td><h2><a href ="/celula/detalhar/id/<?php echo $celula['id']?>" ><?php echo $celula['nome'] ; ?> </a></h2></td>

								<?php require 'celula/visao/menuCelula.inc.php' ; ?>

							</tr>
							<tr>
								<td>Endereço:<?php echo $celula['endereco'] ; ?>	</td> 
								<td>Horario:<?php echo $celula['horarioFuncionamento'] ; ?></td>
							</tr>
								
							
						<?php endforeach ; ?>
						</table>
				
						<?php // discipulo\Modelo\Discipulo::mostrarPaginacao( $totalDiscipulos['total'] ,3 ,$pagina ) ; ?>
			
			</article>
		
		</section>

		</section>
	</body>
</html>

