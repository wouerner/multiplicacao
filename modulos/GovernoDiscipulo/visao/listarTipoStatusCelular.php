<?php 
$mensagem = isset($_SESSION['mensagem']) ? $_SESSION['mensagem'] : NULL ;
unset($_SESSION['mensagem']) ;
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<?php include  'incluidos/css.inc.php' ?>
		<?php include  'incluidos/js.inc.php' ?>
	</head>

	<body>
		<section class = "container-fluid">

		<nav> 
			
			<?php include 'modulos/menu/visao/menu.inc.php' ; ?>	
		</nav>
			
		<section>		
			<article>

				<?php require 'modulos/Discipulo/visao/chamarDiscipulo.php' ; ?>

			<?php if (isset($mensagem)) : ?>
					<div class="alert <?php echo ($mensagem=='ok') ? 'alert-success' : 'alert-error' ; ?>">
				  	<h4 class="alert-heading">
						<?php echo $mensagem ?>!
					</h4>
				   </div>
				<?php endif ; ?>

				<div class = "row-fluid" >	
				<div class = "span12" >	
						<table class = " well table bordered-table table-condensed">
						<caption><h3>Lista de Tipo de Status Celular</h3></caption>
							<thead>
								<th>#</th>
								<th>Tipo</th>
								<th>Ações</th>
							</thead>
							<tbody>

						<?php foreach ( $tipoStatusCelulares as $status) : ?>
	
						<tr>
							<td><?php echo !isset($c)? $c=1 : ++$c ; ?></td>
							<td><a href="/statusCelular/statusCelular/detalhar/id/<?php echo $status->id ?>" ><?php echo $status->nome ; ?></a></td>
							<?php require 'statusCelular/visao/menuTipoStatusCelular.inc.php' ; ?>
						</tr>
						
						<?php endforeach ; ?>
							</tbody>
						</table>
					</div>
			</div>
			</div>
			</article>
		
		</section>

		</section>
	</body>
</html>

