<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<?php include 'incluidos/css.inc.php'?> 
		<?php include 'incluidos/js.inc.php'?> 
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

			<?php require 'modulos/discipulo/visao/chamarDiscipulo.php' ; ?>
			<table class = "table well" >
				<caption><h3>Rede</h3></caption>


				<tr><td><h2><?php echo $rede->nome ; ?> </h2></td></tr>

					<?php require 'rede/visao/tipoRede/menu.inc.php' ; ?>
				</table>
			
			</article>
		
		</section>

		</section>
	</body>
</html>

