<?php 
				$mensagem = isset($_SESSION['mensagem']) ? $_SESSION['mensagem'] : NULL ; 
				$_SESSION['mensagem']=  isset($_SESSION['mensagem']) ? NULL : NULL;
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">

		<?php include 'incluidos/css.inc.php' ; ?>
		<?php include 'incluidos/js.inc.php' ; ?>

		<script src="../modulos/discipulo/visao/js/novo.js"></script>
		<script src = "/modulos/discipulo/visao/js/pesquisa.js" ></script>
		<script>
			$(document).ready(function() 
    		{ 
    	    $("table").tablesorter(); 
    		} 
				);		
		</script>

	</head>

	<body>
		<section class = "container-fluid">
		<nav> 
			<?php include 'modulos/menu/visao/menu.inc.php' ; ?>	
		</nav>
		<section>		
			<article>

			  <div class = "row-fluid" >
				<?php if ( $mensagem ) : ?>
					<div class = "alert alert-success span10" >	
						<strong>Mensagem:</strong> Atualizado com Sucesso 
						<a href="/discipulo/atualizar/id/<?php echo $mensagem['id']; ?>" > <?php echo $mensagem['nome'] ; ?></a>
					</div>
				<?php endif ; ?>
				</div>

				<?php require_once 'modulos/discipulo/visao/chamarDiscipulo.php' ; ?>

<div class = "row-fluid" >
<div class = "span12" >

<div class = "well" >
<div class="accordion" id="accordion1">

	<div class="accordion-group">
		<div class="accordion-heading">
			<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapseAviso">
						Ultimos Avisos <b class="caret pull-right"></b>
			</a>
		</div>

		<div id="collapseAviso" class="accordion-body collapse">
		<div class="accordion-inner">

						<table class = "table bordered-table">
						<caption><h3>Aviso</h3></caption>

						<?php foreach ( $ultimosAvisos as $a ) : ?>
						<tr>
							<td><?php echo date_format(date_create($a['dataAviso']), 'd-M-Y H:m') ; ?></td>
							<td><?php echo $a['nome'] ; ?> fez <?php echo $a['acao'] ; ?>
							<?php if ($acesso->hasPermission('admin_acesso') == true): ?>
 								<a href= "/<?php echo $a['modulo'] ; ?>/<?php echo $a['modulo'] ; ?>/detalhar/id/<?php echo $a['identificacao'] ; ?>"> 
												<?php echo $a['modulo'] ; ?> 
									</a>
							<?php  else :  ?>
												<?php echo $a['modulo'] ; ?> 
							<?php endif ; ?>
						</td>
						</tr>						
						<?php endforeach ; ?>
						</table>
		</div>
		</div>
</div>
</div>

</div>
</div>

<div class = "row-fluid" >
				<div class = "span6">
				<div class = "well">
				<strong>Discipulos: </strong>
				<?php foreach( $discipulos as $d ) : ?>
					<a class = "btn " href = "/discipulo/discipulo/detalhar/id/<?php echo $d->id ; ?>"  ><?php echo $d->getAlcunha() ; ?></a>
				<?php endforeach ; ?>

				<?php if ($acesso->hasPermission('discipulo_criar') == true): ?>
						  <a class = "btn btn-success " href = "/discipulo/discipulo/novoCompleto" >
									<i class = "icon-plus icon-white" ></i> Novo Discípulo
							</a>
					<?php endif ; ?>
				</div>
				</div>

					<div class = "span6" >	
					<div class = "well" >	
					<h4>Relatório de Célula:</h4>
				<?php foreach ( $celulas as $c ) : ?>
						<a class = "btn" href="/celula/relatorio/novo/id/<?php echo $c->id ; ?>" > <?php echo $c->nome ; ?></a>
					<?php endforeach ; ?>
				</div>
				</div>
				</div>


<div class = "row-fluid" >
<div class = "span6" >
<div class = "well" >

<div class="accordion" id="accordion2">
	<div class="accordion-group">
		<div class="accordion-heading">
			<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">Status da Igreja <b class="caret pull-right"></b></a>
		</div>
		<div id="collapseOne" class="accordion-body collapse">
		<div class="accordion-inner">
					<table id = "tabelaStatus" class = "table table-striped  tablesorter " >
					<thead>
						<tr>
							<th>Nome</th>
							<th>Quantidade</th>
							<th>%</th>
						</tr>
						</thead>
						<tbody>
						<?php foreach($status as $s) : ?>
							<tr>
								<?php if ($acesso->hasPermission('admin_acesso') == true): ?>
									<td><a href="/statusCelular/statusCelular/listarDiscipulosPorStatus/id/<?php echo $s['tipoStatusCelular'] ; ?>" ><?php echo $s['tipoNome'] ; ?></a></td>
								<?php else :?>
									<td><?php echo $s['tipoNome'] ; ?></td>
								<?php endif ; ?>	
									<td><?php echo $s['total'] ; ?></td>
									<td><?php echo round($s['porcentagem'],1).'%' ; ?></td>
							</tr>
						<?php endforeach ; ?>
							<tr  class = "info" ><td>Total</td><td colspan = "2"><?php echo $totalDiscipulos ; ?></td></tr>
						</tbody>
					</table>
		</div>
	</div>
</div>

	<div class="accordion-group">
		<div class="accordion-heading">
			<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">Discipulos por Rede<b class="caret pull-right"></b></a>
		</div>

		<div id="collapseTwo" class="accordion-body collapse">
		<div class="accordion-inner">
				<table class = "table " >
					<caption><h5>Total Redes</h5></caption>
					<thead>
						<th>Nome</th>
						<th>Quantidade</th>
					</thead>
					<tbody>
						<?php foreach( $totalRedes as $s) :?>
						<tr>
							<td>
								<a href = "/rede/rede/listarMembrosRede/id/<?php echo $s['id'] ; ?>"><?php echo $s['nome']?></a> 
							</td>
							<td>
								<a href = "/rede/rede/listarMembrosRede/id/<?php echo $s['id'] ; ?>">Discipulos -<?php echo $s['total']?></a>
							</td>
							<td>
								<a href = "/rede/rede/listarCelulas/id/<?php echo $s['id'] ; ?>">Células</a>
							</td>
							<td></td>
						</tr>
						<?php endforeach ; ?>
						<tr class = "info" ><td>Total</td><td><?php echo $somaRede ; ?></td></tr>
					</tbody>
				</table>

		</div>
		</div>
	</div>

	<div class="accordion-group">
		<div class="accordion-heading">
			<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTree">
				Discipulos Ativos/Inativos<b class="caret pull-right"></b>
			</a>
		</div>

		<div id="collapseTree" class="accordion-body collapse">
		<div class="accordion-inner">
				<table class = "table " >
					<thead>
						<th>Ativos</th>
						<th>Inativos</th>
					</thead>
					<tbody>
						<tr>
							<td><?php echo $totalAtivos['total'] ; ?></td>
							<td><?php echo $totalInativos['total'] ; ?></td>
						</tr>
					</tbody>
				</table>
		</div>
		</div>

</div>
</div>

</div>

</div>



			<div class = "span6 " >
<div class = "well" >
<div class="accordion" id="accordion3">

	<div class="accordion-group">
		<div class="accordion-heading">
			<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#collapse4">Meus Discipulos por Status<b class="caret pull-right"></b></a>
		</div>

		<div id="collapse4" class="accordion-body collapse ">
			<div class="accordion-inner">

			<table class = "table " >
				<thead>
					<th>Status</th>
					<th>Quantidade</th>
			</thead>
			<tbody>
				<?php foreach( $statusDiscipulos as $s) :?>
					<tr>
						<td><?php echo $s['tipoNome']?></td>
						<td><?php echo $s['total']?></td>
					</tr>
				<?php endforeach ; ?>
					<tr class = "info" >
								<td>Total</td>
								<td><?php echo $statusDiscipulosTotal ; ?></td>
							</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<div class="accordion-group">
		<div class="accordion-heading">
			<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#collapse5">Meus Discipulos por Rede<b class="caret pull-right"></b></a>
		</div>

		<div id="collapse5" class="accordion-body collapse">
			<div class="accordion-inner">
				<table class = "table " >
					<thead>
						<th>Status</th>
						<th>Quantidade</th>
					</thead>
					<tbody>
						<?php foreach( $totalRedesLideres as $s) :?>
						<tr>
							<td><?php echo $s['nome']?></td>
							<td><?php echo $s['total']?></td>
						</tr>
						<?php endforeach ; ?>
						<tr class = "info" >
							<td>Total</td>
							<td><?php echo $somaRedeDiscipulos ; ?></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<div class="accordion-group">
		<div class="accordion-heading">
			<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#collapse6">Meus Discipulos Ativos/Inativos<b class="caret pull-right"></b></a>
		</div>

		<div id="collapse6" class="accordion-body collapse">
			<div class="accordion-inner">
				<table class = "table " >
					<thead>
						<th>Ativos</th>
						<th>Inativos</th>
					</thead>
					<tbody>
						<tr>
							<td><?php echo $totalAtivosLider['total'] ; ?></td>
							<td><?php echo $totalInativosLider['total'] ; ?></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>

</div>
</div>


</div>
</div>
</div>

			</article>
		
		</section>

		</section>
	</body>
</html>

