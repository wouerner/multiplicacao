<?php

session_start();

require '../../../config/autoload.php';

$nome = (isset($_GET['nome'])) ? $_GET['nome'] : NULL;
use discipulo\Modelo\Discipulo;

$discipulos = new Discipulo();

$discipulos = $discipulos->chamar($nome);

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
		Olá <a href="#"><?php echo $_SESSION['usuario_nome'] ; ?></a> |
			<a href="#">Sair</a>
			<?php include '../visao/menu.inc.php' ; ?>	
		</nav>
			
		<header>
		
		</header>

		<section>		
			<article>

			<fieldset> 
				<form action = "../acao/chamar.php" method = "GET" >
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
						<tr>
							<td colspan = "2" >
							<a href="../formularios/atualizar.php?id=<?php echo $discipulo['id']?>" class = "btn" >Atualizar</a>
								<a href="excluir.php?id=<?php echo $discipulo['id']?>" class = "btn danger" >Excluir</a>
							</td>
						</tr>
						<?php endforeach ; ?>
						<?php endif ; ?>
						</table>
				
			
			</article>
		
		</section>

		</section>
	</body>
</html>

