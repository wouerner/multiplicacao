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
				<div class = "row" >	
				<span class = "span4" ><a href = "/discipulo/novo" class = "btn btn-success" >Novo Discipulo</a></span>
				<span class = "span3"><p>Total Discipulos: <strong><?php echo $totalDiscipulos ; ?></strong></p></span>

				<div class = "span12" >
				<table class = "table bordered-table">
				<caption><h3>Lista de Discipulos</h3></caption>

				<?php foreach ( $discipulos as $discipulo) : ?>

				<tr><td><a href="/discipulo/detalhar/id/<?php echo $discipulo->id?>" ><h2><?php echo $discipulo->nome ; ?> </h2></a></td>
				 <?php require 'discipulo/visao/menuDiscipulo.inc.php' ; ?>
				</tr>
				<tr><td>Telefone:<?php echo $discipulo->telefone ; ?></td> <td>E-mail:<?php echo $discipulo->email ; ?></td></tr>
				<tr><td colspan = "2" >Endereço: <?php  echo $discipulo->endereco ; ?></td></tr>
				 
				
				<?php endforeach ; ?>
				</table>

						<?php discipulo\Modelo\Discipulo::mostrarPaginacao( $totalDiscipulos ,$quantidadePorPagina ,$pagina ) ; ?>
				</div>
			</div>
			</article>
		
		</section>

		</section>
	</body>
</html>

