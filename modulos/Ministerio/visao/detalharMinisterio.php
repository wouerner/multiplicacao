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
				<caption><h3>Ministério</h3></caption>


				<tr><td colspan = "2" ><h2><?php echo $ministerio['nome'] ; ?> </h2></td></tr>

					<?php require 'ministerio/visao/menuMinisterio.inc.php' ; ?>
				</table>
				
			
			</article>
		
		</section>

		</section>
	</body>
</html>

