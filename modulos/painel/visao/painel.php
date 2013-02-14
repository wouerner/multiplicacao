<?php 
				$mensagem = isset($_SESSION['mensagem']) ? $_SESSION['mensagem'] : NULL ; 
				$_SESSION['mensagem']=  isset($_SESSION['mensagem']) ? NULL : NULL;
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">

		<?php include 'modulos/../incluidos/css.inc.php' ; ?>
		<?php include 'modulos/../incluidos/js.inc.php' ; ?>

		<script src="../modulos/discipulo/visao/js/novo.js"></script>
		<script src = "modulos/discipulo/visao/js/pesquisa.js" ></script>

	</head>

	<body>
		<section class = "container-fluid">
		<nav> 
			<?php include 'modulos/menu/visao/menu.inc.php' ; ?>	
		</nav>
		<section>		
			<article>

			  <div class = "row" >
				<?php if ( $mensagem ) : ?>
					<div class = "alert alert-success span10" >	
						<strong>Mensagem:</strong> Atualizado com Sucesso 
						<a href="/discipulo/atualizar/id/<?php echo $mensagem['id']; ?>" > <?php echo $mensagem['nome'] ; ?></a>
					</div>
				<?php endif ; ?>
				</div>

				<?php require_once 'modulos/discipulo/visao/chamarDiscipulo.php' ; ?>

				<?php if ($acesso->hasPermission('admin_acesso') == true): ?>
				<div class = "well">
						  <a class = "btn btn-success " href = "/discipulo/discipulo/novoCompleto" >
									<i class = "icon-plus icon-white" ></i> Novo Discípulo
							</a>
						  <a class = "btn btn-warning " href = "/celula/celula/novo" >
									<i class = "icon-plus icon-white" ></i> Nova Célula
							</a>
				</div>
					<?php endif ; ?>
				<table class = "table table-striped table-hover well" >
				<?php foreach($status as $s) : ?>
						<tr>
						<?php if ($acesso->hasPermission('admin_acesso') == true): ?>
						<td><a href="/statusCelular/statusCelular/listarDiscipulosPorStatus/id/<?php echo $s['tipoStatusCelular'] ; ?>" ><?php echo $s['tipoNome'] ; ?></a></td>
						<?php else :?>
						<td><?php echo $s['tipoNome'] ; ?></td>
						<?php endif ; ?>	
						<td><?php echo $s['total'] ; ?></td>
						</tr>
				<?php endforeach ; ?>
						<tr><td>Total</td><td><?php echo $totalDiscipulos ; ?></td></tr>
				</table>
			</article>
		
		</section>

		</section>
	</body>
</html>

