<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<style type="text/css">
		   @import url("../../../ext/twitter-bootstrap/bootstrap.css");
		   @import url("../../../incluidos/css/estilo.css");
		</style>
		<script src="../../../ext/jquery/jquery-1.7.1.min.js"></script>
	</head>

	<body>
		<section class = "container">

		<nav> 
			
			<?php include 'modulos/menu/visao/menu.inc.php' ; ?>	
		</nav>
		<section>		
			<article>

				<?php require 'modulos/discipulo/visao/chamarDiscipulo.php' ; ?>
				<div class = "row" >	

				<div class = "span12" >
				<table class = "table bordered-table">
				<caption><h3>Aniversariantes do mês </h3></caption>
				<thead>	
					<tr>
					<th>Data</th><th>Nome</th><th>Lider</th> <th>Status</th>
					</tr>
				</thead>

				<?php foreach ( $relatorios as $r) : ?>

				<tr>	
					<td><?php echo $r->dataNascimento->format('d-m-Y') ; ?></td>
					<td><a href= "/discipulo/atualizar/id/<?php echo $r->id ?>" ><?php echo $r->nome ; ?></a></td>
					<td><?php echo $r->getLider()->nome ?></td>
					<td><?php $l = $r->getStatusCelular() ; echo $l['nome'] ?></td>
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
