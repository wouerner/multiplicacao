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

						<table class = "table">
						<caption>Lista de Discipulos</caption>
			
						<?php if (is_null($nome)) : ?>
							<p>Faça sua pesquisa!</p>
						<?php else : ?>

						<?php foreach ( $celulas as $celula) : ?>

						<tr><td colspan = "2" ><h2><?php echo $celula['nome'] ; ?> </h2></td></tr>
						<tr><td>Endereco:<?php echo $celula['endereco'] ; ?></td> <td>Horario:<?php echo $celula['horarioFuncionamento'] ; ?></td></tr>
							<?php require 'celula/visao/menuCelula.inc.php' ; ?>
						<?php endforeach ; ?>
						<?php endif ; ?>
						</table>
				
			
			</article>
		
		</section>

		</section>
	</body>
</html>

