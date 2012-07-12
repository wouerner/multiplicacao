<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<style type="text/css">
		   @import url("../../../ext/twitter-bootstrap/bootstrap.css");
		   @import url("../../../incluidos/css/estilo.css");
		</style>
		<script src="../../../ext/jquery/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="../../../../ext/jquery.tablesorter/jquery.tablesorter.js"></script> 

<script>
$(document).ready(function() 
    { 
        $(".table").tablesorter(); 
    } 
); </script>
	</head>

	<body>
		<section class = "container">

		<nav> 
			<?php include 'modulos/menu/visao/menu.inc.php' ; ?>	
		</nav>
			
		<header>
		
		</header>

		<section>		
			<article>

				<?php $cont = 0 ; ?>
				<?php $lidCont = 0 ; ?>

			<table class = "table table-bordered table-condensed tablesorter" >
				<thead>
				<tr>
					<th>Nome</th>
					<th>Sexo</th>
					<th>Endereço</th>
					<th>Status</th>
					<th>Telefone</th>
					<th>Data Nasc. </th>
				</tr>
				</thead>
				<tbody>
				<?php foreach($relatorio as $r ) : ?>
				<?php ++$lidCont ; ?>
					<tr>	<td colspan = "7" ><h4><?php echo $lidCont ; ?> - Líder: <?php echo $r['lider'] ; ?> </h4></td></tr>

						<?php foreach($r as  $l ) : ?>
							<tr>	
								<?php if (  is_object($l) ) : ?>
							  <?php $status =  $l->getStatusCelular() ; ?>
						  <tr>	
							  <?php ++$cont ; ?>
							  <td><?php echo  $cont ; ?></td>
							  <td><?php echo  $l->nome ; ?></td>
							  <td><?php echo  ($l->sexo == 'm')? 'Masculino' : 'Feminino' ; ?></td>
							  <td><?php echo  $l->endereco ; ?></td>
							  <td><?php echo  $status['nome'] ; ?></td>
							  <td><?php echo  $l->telefone ; ?></td>
							  <td><?php echo  $l->getDataNascimento()->format('d/m/Y') ; ?></td>
						  </tr>
						  <?php endif ; ?>
					<?php endforeach ; ?>
					<?php $cont = 0 ?>

				<?php endforeach ; ?>
				</tbody>
			</table>
	
			
			</article>
		
		</section>

		</section>
	</body>
</html>

