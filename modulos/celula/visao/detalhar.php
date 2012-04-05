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

						<table class = "table">

							<caption>Célula</caption>


							<tr><td colspan = "2" ><h2><?php echo $celula['nome'] ; ?> </h2></td></tr>
							<tr>
								<td>Endereço:<?php echo $celula['endereco'] ; ?>	</td> 
								<td>Horario:<?php echo $celula['horarioFuncionamento'] ; ?></td>
							</tr>
								
							
								<?php require 'celula/visao/menuCelula.inc.php' ; ?>
							<tr><td colspan = "2" ><h4>Lista de discipulos</h4></td></tr>
							<?php foreach ($discipulos as $discipulo) : ?>
								<tr> <td colspan = "2" > <a href = "/discipulo/detalhar/id/<?php echo $discipulo['id'] ?>"> <?php echo $discipulo['nome'] ;?> </a> </td></tr>
							<?php endforeach ; ?>
						</table>
				
						<?php // discipulo\Modelo\Discipulo::mostrarPaginacao( $totalDiscipulos['total'] ,3 ,$pagina ) ; ?>
			
			</article>
		
		</section>

		</section>
	</body>
</html>

