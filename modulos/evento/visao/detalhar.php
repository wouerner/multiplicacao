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

			<table>
				<caption>Detalhes do Discipulos</caption>


				<tr>
					<td colspan = "2" ><h2><?php echo $evento['nome'] ; ?> </h2></td></tr>
				</tr>

					<?php require 'evento/visao/menuDiscipulo.inc.php' ; ?>
				</table>
				
			
			</article>
		
		</section>

		</section>
	</body>
</html>

