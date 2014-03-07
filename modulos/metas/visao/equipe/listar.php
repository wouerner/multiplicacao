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
				<a class = "btn btn-success" href = "/encontroComDeus/equipe/novoEquipe/id/<?php echo $encontroId ; ?>" ><i class = "icon-plus icon-white" ></i>Nova Equipe</a>
				<div class = "row-fluid" >	
						<table class = "table bordered-table">
						<caption><h3>Encontro com Deus</h3></caption>

						<?php foreach ( $equipes as $e) : ?>
						<tr>
							<td><?php echo $e->nome ; ?></td>
							<td><a href="/encontroComDeus/equipe/membros/id/<?php echo $e->id?> ">Participantes</a></td>
							<td><a class = "btn btn-mini btn-danger" href="/encontroComDeus/equipe/excluirEquipe/id/<?php echo $e->id?>/encontroId/<?php echo $encontroId?> "><i class = "icon-remove icon-white" ></i>Excluir</a></td>
						</tr>
						
						<?php endforeach ; ?>
						</table>
			</div>
			</article>
		
		</section>

		</section>
	</body>
</html>

