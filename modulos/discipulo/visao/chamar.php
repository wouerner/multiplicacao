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
			<?php include 'incluidos/menu.inc.php' ; ?>
			<?php include 'discipulo/visao/menu.inc.php' ; ?>	
		</nav>
			
		<header>
		
		</header>

		<section>		
			<article>

			<fieldset> 
				<form action = "/discipulo/chamar" method = "GET" >
				<label>Chamar:</label>
				<input type = "search" name = "nome">
				<button type = "submit" class = "btn" >OK</button>
			</fieldset>

	
						<table class = "bordered-table">
						<caption>Lista de Discipulos</caption>
			
						<?php if (is_null($nome)) : ?>
							<p>Faça sua pesquisa!</p>
						<?php else : ?>

						<?php foreach ( $discipulos as $discipulo) : ?>

						<tr><td colspan = "2" ><h2><?php echo $discipulo['nome'] ; ?> </h2></td></tr>
						<tr><td>Telefone:<?php echo $discipulo['telefone'] ; ?></td> <td>E-mail:<?php echo $discipulo['email'] ; ?></td></tr>
						<tr><td colspan = "2" >Endereço: <?php  echo $discipulo['endereco'] ; ?></td></tr>
							
							<?php require 'discipulo/visao/menuDiscipulo.inc.php' ; ?>
						<?php endforeach ; ?>
						<?php endif ; ?>
						</table>
				
			
			</article>
		
		</section>

		</section>
	</body>
</html>

