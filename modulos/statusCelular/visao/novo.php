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
		<header>
			<nav>
			<?php include 'modulos/menu/visao/menu.inc.php' ; ?>	
			</nav>
		</header>
		<section>		
			<article>
					<legend>Atualizar Status Celular: <?php echo $discipulo->nome; ?> </legend>
					<form action = "/statusCelular/novo" method = "post"  class = "form-horizontal">
						<fieldset>
						<div class = "control-group" >

						<input type = "hidden" name = "discipuloId" value ="<?php echo $discipulo->id ; ?>" >	
						<label class = " span2" > Tipo do Status:</label>
							<select name = "tipoStatusCelular" >
									<option value = "<?php echo $statusCelularDiscipulo ['id'] ; ?>" ><?php echo $statusCelularDiscipulo  ['nome'] ; ?></option>
								<?php foreach ($tiposStatusCelulares as $tipoStatusCelular) : ?>
									<option value = "<?php echo $tipoStatusCelular ->id ; ?>" ><?php echo $tipoStatusCelular ->nome ; ?></option>
								<?php endforeach ; ?>
							</select>
						
						</div>
						
						<div class = "form-actions" >
						<a class = "btn  " href = "/discipulo/atualizar/id/<?php echo $discipulo->id ; ?>" ><i class = "icon-chevron-left" ></i></a>
						<button type = "submit" class = "btn btn-success" >Salvar</button>
						</div>
						</div>
						</fieldset>
					</form>
					<table class = "table table-condensed" >		
					<thead>
						<tr><th>Nº</th><th>Status</th><th>Data</th><th>Ações</th>
						</tr>
					</thead>
								<?php foreach ($historico as $h) : ?>
									<tr>
									<td><?php echo isset($cont)? ++$cont : $cont=1 ?></td>
									<td><a href = "/statusCelular/detalhar/id/<?php echo $h->tipoId ; ?>" ><?php echo  $h->nome ; ?></a></td> 
									<td><?php echo  $h->getDataInicio()->format('d-m-Y') ; ?></td> 
									<td><a class = "btn btn-danger" href="/statusCelular/excluir/id/<?php echo $h->statusId?>/discipulo/<?php echo $discipulo->id ;?>" ><i class="icon-remove"></i></a> </td>

									</tr>
								<?php endforeach ; ?>
					</table>
			</article>
		
		</section>

		</section>
	</body>

</html>
