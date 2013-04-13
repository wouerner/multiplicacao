<?php 
$mensagem = isset($_SESSION['mensagem']) ? $_SESSION['mensagem'] : NULL ;
unset($_SESSION['mensagem']) ;

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<?php include 'incluidos/css.inc.php' ?>
		<?php include 'incluidos/js.inc.php' ?>
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
						<div class = "well" >	
						<table class = "table table-condensed">
						<caption>
							<h3>Lista de Células</h3>
						</caption>
						<thead>
						<tr>
							<th>#</th>
							<th>Nome</th>
							<th>Endereço</th>
							<th>Horário</th>
						</tr>
						</thead>
						<tbody>
						<?php foreach ( $celulas as $c ) : ?>

						<tr>
							<td><?php echo ++$cont ; ?></td>
								<?php if ($acesso->hasPermission('admin_acesso') == true): ?>
								<td><a href="/celula/celula/detalhar/id/<?php echo $c->id?>" ><?php echo $c->nome ; ?> </a></td>
								<td><?php echo $c->endereco ; ?></td>
								<td><?php echo $c->horarioFuncionamento ; ?></td>
								<?php else : ?>
								<td><?php echo $c->nome ; ?></td>
								<td><?php echo $c->endereco ; ?></td>
								<td><?php echo $c->horarioFuncionamento ; ?></td>
								<?php endif ; ?>
						</tr>
						
						<?php endforeach ; ?>
						</tbody>
						</table>
					</div>
			</div>
			</div>
			</div>
			</article>
		
		</section>

		</section>
	</body>
</html>

