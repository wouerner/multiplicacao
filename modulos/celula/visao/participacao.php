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
			
		<header>
		
		</header>

		<section>		
			<article>


			<?php if (isset($mensagem)) : ?>
					<div class="alert <?php echo ($mensagem=='ok') ? 'alert-success' : 'alert-error' ; ?>">
				  	<h4 class="alert-heading">
						<?php echo $mensagem ?>!
					</h4>
				   </div>
				<?php endif ; ?>
						<table class = "table well table-striped ">

							<caption><h3>Participação na Célula</h3></caption>

							<thead>
								<td>Nome</td>
								<td>total</td>
							</thead>

							<?php foreach ( $participacao as $p) : ?>

							<tr>
								<td><?php echo $p['nome'] ; ?></td>
								<td><?php echo $p['total'] ; ?>	</td> 
							</tr>
								
						<?php endforeach ; ?>
						</table>
				
			</article>
		
		</section>

		</section>
	</body>
</html>

