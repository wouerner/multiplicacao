<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<?php include 'incluidos/css.inc.php' ; ?>
		<?php include 'incluidos/js.inc.php' ; ?>
	</head>

	<body>
		<section class = "container">

		<nav> 
			
			<?php include 'menu/visao/menu.inc.php' ; ?>	
		</nav>
		<section>		
			<article>

				<?php require 'modulos/discipulo/visao/chamarDiscipulo.php' ; ?>
				<div class = "row" >	
				<span class = "span3"><p>Total Discipulos: <strong><?php echo $totalDiscipulos ; ?></strong></p></span>

				<div class = "span12" >
				<table class = "table bordered-table">
				<caption><h3><?php echo $tipoStatus->nome ?></h3></caption>

				<?php foreach ( $discipulos as $discipulo) : ?>

				<tr>
						<td><a href="/discipulo/discipulo/detalhar/id/<?php echo $discipulo->id ; ?>" ><?php echo $discipulo->nome ; ?></a></td>
				</tr>
				</tr>
				 
				<?php endforeach ; ?>
				</table>

				</div>
			</div>
			</article>
		
		</section>

		</section>
	</body>
</html>

