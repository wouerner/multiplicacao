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

			<?php require 'modulos/Discipulo/visao/chamarDiscipulo.php' ; ?>

			<table>
				<caption><h3>Oferta</h3></caption>


				<tr><td colspan = "2" ><h2><?php echo $oferta['nome'] ; ?> </h2></td></tr>
				</tr>
					<?php require 'oferta/visao/menuTipoOferta.inc.php' ; ?>

				</table>
				
			
			</article>
		
		</section>

		</section>
	</body>
</html>

