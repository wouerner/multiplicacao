<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<?php include 'incluidos/css.inc.php' ; ?>
		<?php include 'incluidos/js.inc.php' ; ?>

	</head>

	<body>
		<section class = "container-fluid">
		<header>
			<nav>
			<?php include 'modulos/menu/visao/menu.inc.php' ; ?>	
			</nav>
		</header>
		<section>		
			<article>
					<legend> Atualizar Status</legend>
					<form action = "/statusCelular/statusCelular/novo" method = "post"  class = "form-inline" >
						<fieldset>
			
						<div class = "span2" >
						<a class = "btn  " href = "/discipulo/discipulo/atualizar/id/<?php echo $discipulo->id ; ?>" ><i class = "icon-chevron-left" ></i>Voltar</a>
						</div>
						<input type = "hidden" name = "discipuloId" value ="<?php echo $discipulo->id ; ?>" >	
						<label class = " span4" ><h4><?php echo $discipulo->nome; ?> :</h4></label>
							<select name = "tipoStatusCelular" >
									<option value = "<?php echo $statusCelularDiscipulo ['id'] ; ?>" ><?php echo $statusCelularDiscipulo  ['nome'] ; ?></option>
								<?php foreach ($tiposStatusCelulares as $tipoStatusCelular) : ?>
									<option value = "<?php echo $tipoStatusCelular ->id ; ?>" ><?php echo $tipoStatusCelular ->nome ; ?></option>
								<?php endforeach ; ?>
							</select>
						
						
						<button type = "submit" class = "btn btn-success" >Salvar</button>
						</div>
						</fieldset>
					</form>
		
				<div class = "well" >
					<table class = "table table-condensed table-striped" >		
					<thead>
						<caption><h4>Histórico</h4></caption>
						<tr><th>Nº</th><th>Status</th><th>Data</th><th>Ações</th>
						</tr>
					</thead>
								<?php foreach ($historico as $h) : ?>
									<tr>
									<td><?php echo isset($cont)? ++$cont : $cont=1 ?></td>
									<td><a href = "/statusCelular/detalhar/id/<?php echo $h->tipoId ; ?>" ><?php echo  $h->nome ; ?></a></td> 
									<td><?php echo  $h->getDataInicio()->format('d-m-Y') ; ?></td> 
									<td><a class = "btn btn-mini btn-danger" href="/statusCelular/statusCelular/excluir/id/<?php echo $h->statusId?>/discipulo/<?php echo $discipulo->id ;?>" ><i class="icon-remove"></i></a> </td>

									</tr>
								<?php endforeach ; ?>
					</table>
				</div>
			</article>
		
		</section>

		</section>
	</body>

</html>
