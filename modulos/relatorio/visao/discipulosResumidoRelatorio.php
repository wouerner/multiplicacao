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
			<table class = "table table-bordered table-condensed" >
					<caption><h3>Relatório</h3></caption>
				<tr>
					<th>Sexo :  <?php  echo $sexo ?></th>
					<th>Estado Civil : <?php echo is_object($estadoCivil) ? $estadoCivil->nome : 'todos' ?></th>
					<th>Rede : <?php echo is_object($rede) ? $rede->nome : 'todos' ?></th>
					<th>Status :<?php echo is_object($status) ? $status->nome : 'todos' ?> </th>
					<th>célula :<?php echo is_object($celula)? $celula->nome : 'todos' ?> </th>
				</tr>
			</table>

			<table class = "table table-bordered table-condensed tablesorter" >
				<thead>

				<tr>
					<th>Nº total</th>
					<th colspan = "2" >Nome</th>
					<th>Sexo</th>
					<th>Endereço</th>
					<th>Telefone</th>
					<th>Data Nasc. </th>
					<th>Status</th>
				</tr>

				</thead>
				<tbody>
				<?php $contador = 0 ?>
				<?php foreach($relatorio as $r ) : ?>
				<?php ++$lidCont ; ?>
					<tr><td><?php  echo ++$contador  ;?></td>	<td colspan = "7" ><h4><?php echo $lidCont ; ?> - Líder: <?php echo $r['lider'] ; ?> </h4></td></tr>

						<?php foreach($r as  $l ) : ?>
							<tr>	
								<?php if (  is_object($l) ) : ?>
							  <?php $status =  $l->getStatusCelular() ; ?>
						  <tr>	
							  <?php ++$cont ; ?>
<td><?php echo ++$contador?></td>
							  <td><?php echo  $cont ; ?></td>
							  <td><a href="/discipulo/atualizar/id/<?php echo $l->id ; ?>"><?php echo  $l->nome ; ?></a></td>
							  <td><?php echo  ($l->sexo == 'm')? 'Masculino' : 'Feminino' ; ?></td>
							  <td><?php echo  $l->endereco ; ?></td>
							  <td><?php echo  $l->telefone ; ?></td>
							  <td><?php echo  $l->getDataNascimento()->format('d/m/Y') ; ?></td>
							  <td><?php echo  $status['nome'] ; ?></td>
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

