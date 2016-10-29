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
			
		<header>
		
		</header>

		<section>		
			<article>

			<?php require 'modulos/Discipulo/visao/chamarDiscipulo.php' ; ?>

			<div class = "row-fluid" >
			<div class = "span12" >
			<table class = "table table-condensed well" >
				<caption><h3>Descrição do StatusCelular</h3></caption>
				<tr><th>Nome: </th><td ><?php echo $status->nome ; ?></td></tr>
				<tr><th>Descrição: </th><td ><?php echo $status->descricao ; ?> </td></tr>
				<tr><th>Ordem: </th><td ><?php echo $status->ordem ; ?> </td></tr>
				<tr><th>Cor: </th><td ><?php echo $status->cor ; ?> </td></tr>
					<a href="/statusCelular/listarTipoStatusCelular" class = "btn"><i class = "icon-chevron-left"></i></a>
					<?php require 'statusCelular/visao/menuTipoStatusCelular.inc.php' ; ?>
				</table>
			</div>
			</div>
			</article>
		</section>
		</section>
	</body>
</html>

