<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<?php include 'incluidos/css.inc.php' ?>
		<?php include 'incluidos/js.inc.php' ?>
		<script src="../../../ext/jquery/jquery-1.7.1.min.js"></script>
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
					<div class = "well" >
						<table class = "table table-bordered">

						<caption><h3></h3></a></caption>


							<tr><td class = "span6" ><h4>Tema:<?php echo $tema->nome ; ?>  </h4></td>
							<tr><td><h5>Titulo: <?php echo $relatorio->titulo ; ?><h5></td> </tr>
							<tr>
								<td>Data:<?php echo $relatorio->dataEnvio ; ?>	</td> 
							</tr>
							<tr>
								<td>Relatório: <?php echo $relatorio->texto ; ?></td>
							</tr>
							<tr>
								<td> <strong>Participação </strong></td>
							</tr>
							<?php foreach ( $participacao as $p ) : ?>
							<tr>
								<td> <?php echo $p->nome ; ?></td>
							</tr>
							<?php endforeach ; ?>
							
							<tr>
							</table>
						</div>
				
			</article>
		
		</section>

		</section>
	</body>
</html>

