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
			
			<?php include 'modulos/menu/visao/menu.inc.php' ; ?>	
		</nav>
		<section>		
			<article>

				<?php require 'modulos/discipulo/visao/chamarDiscipulo.php' ; ?>
				<div class = "row-fluid" >	
				<div class = "span12" >

				<table class = "table bordered-table well ">
				<caption><h3>Lista de Discipulos</h3></caption>
					<thead>
						<th>nome</th>
						<th>Telefone</th>
						<th>E-mail</th>
						<th>Ações</th>
					</thead>

				<?php foreach ( $discipulos as $discipulo) : ?>

				<tr>
					<td><a href="/discipulo/detalhar/id/<?php echo $discipulo->id?>" ><?php echo $discipulo->nome ; ?></a></td>
				<td><?php echo $discipulo->telefone ; ?></td> <td><?php echo $discipulo->email ; ?></td>
				 <?php require 'discipulo/visao/menuDiscipulo.inc.php' ; ?>
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


