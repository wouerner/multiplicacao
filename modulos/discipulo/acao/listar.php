<?php
session_start();

if (!isset($_SESSION['logado'])) exit();


$pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1 ;

//importar discipulo
require '../../../config/autoload.php';

//criar o objeto ususario

//use discipulo\Modelo\Discipulo;

$discipulo = new discipulo\Modelo\Discipulo();

//lista todos os registros menos o do usuario logado no sistema.

$usuarioNome = $_SESSION['usuario_nome'];

$totalDiscipulos = discipulo\Modelo\Discipulo::totalDiscipulos();

$discipulos = $discipulo->listarTodosPag($_SESSION['usuario_id'], 3  , $pagina);
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
			<?php include '../../../incluidos/menu.inc.php' ; ?>
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
						</table>
				
						<?php discipulo\Modelo\Discipulo::mostrarPaginacao( $totalDiscipulos['total'] ,3 ,$pagina ) ; ?>
			
			</article>
		
		</section>

		</section>
	</body>
</html>

