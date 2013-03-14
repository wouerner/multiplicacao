<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<?php include 'incluidos/css.inc.php' ; ?>
		<?php include 'incluidos/js.inc.php' ; ?>
	</head>

	<body>
		<section class = "container-fluid">

		<nav> 
			
			<?php include 'menu/visao/menu.inc.php' ; ?>	
		</nav>
		<section>		
			<article>

				<?php require 'modulos/discipulo/visao/chamarDiscipulo.php' ; ?>
				<div class = "row-fluid" >	

				<div class = "span12" >
				<div class = "well" >
				<table class = "table bordered-table">
				<caption><h3><?php echo $tipoStatus->nome ?>
				Total Discipulos: <strong><?php echo $totalDiscipulos ; ?></h3></caption>
				<thead>
						<th>Líder</th>
						<th>Nome</th>
				</thead>

				<?php foreach ( $discipulos as $discipulo) : ?>

				<tr>
						<td><a href="/discipulo/discipulo/detalhar/id/<?php echo $discipulo->getLider()->id ; ?>" ><?php echo $discipulo->getLider()->nome ; ?></a></td>
						<td><a href="/discipulo/discipulo/detalhar/id/<?php echo $discipulo->id ; ?>" ><?php echo $discipulo->nome ; ?></a></td>
				</tr>
				</tr>
				 
				<?php endforeach ; ?>
				</table>

				</div>
				</div>
			</div>
			</article>
		
		</section>

		</section>
	</body>
</html>

