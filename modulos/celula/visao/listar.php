<?php 
$mensagem = isset($_SESSION['mensagem']) ? $_SESSION['mensagem'] : NULL ;
unset($_SESSION['mensagem']) ;

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
			<?php include 'incluidos/css.inc.php' ?>
			<?php include 'incluidos/js.inc.php' ?>
	</head>

	<body>
		<section class = "container-fluid">

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
				<h3>Total de Células: <?php //echo $totalCelulas ; ?>		</h3>
						<table class = "table">

							<caption><h3>Lista de Células</h3></caption>

							<?php foreach ( $celulas as $celula) : ?>

							<tr><td><h2><a href ="#" ><?php echo $celula['nome'] ; ?> </a></h2></td>

								<?php require 'celula/visao/menuCelula.inc.php' ; ?>

							</tr>
							<tr>
								<td>Endereço:<?php echo $celula['endereco'] ; ?>	</td> 
								<td>Horario:<?php echo $celula['horarioFuncionamento'] ; ?></td>
							</tr>
								
							
						<?php endforeach ; ?>
						</table>
				
			</article>
		
		</section>

		</section>
	</body>
</html>

