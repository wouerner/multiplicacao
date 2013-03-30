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
						<table class = "table bordered-table">
						<caption><h3>Encontro com Deus</h3></caption>

						<?php foreach ( $encontros as $e) : ?>
						<tr>
							<td><?php echo $e->nome ; ?></td>
							<td>
								<a class = "btn btn-mini" href="/encontroComDeus/participantesEncontro/index/id/<?php echo $e->id?>">
									<i class = "icon-user "></i>Participantes
								</a>
							<a class = "btn btn-mini"  href="/encontroComDeus/equipe/index/id/<?php echo $e->id?>"><i class = "" ></i>Equipes</a>
								<a class = "btn btn-mini btn-danger" href="/encontroComDeus/encontroComDeus/excluir/id/<?php echo $e->id?>">
									<i class = "icon-remove icon-white" ></i> Excluir
								</a>
							</td>
						</tr>
						
						<?php endforeach ; ?>
						</table>
			</div>
			</article>
		
		</section>

		</section>
	</body>
</html>

