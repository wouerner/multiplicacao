<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<style type="text/css">
		   @import url("../../../ext/twitter-bootstrap/bootstrap.css");
		   @import url("../../../incluidos/css/estilo.css");
			@import url("../../../ext/jquery-ui/css/ui-lightness/jquery-ui.css");
		</style>
		<script src="../../../ext/jquery/jquery-1.7.1.min.js"></script>
		<script src="../../../ext/jquery-ui/js/jquery-ui.js"></script>
		<script src="/modulos/discipulo/visao/js/combobox.js"></script>
		<script src="/modulos/discipulo/visao/js/comboboxCelula.js"></script>

	</head>

	<body>
		<section class = "container">
		<header>
			<nav>
				<?php require 'modulos/menu/visao/menu.inc.php' ; ?>
			</nav>
		</header>

		<section>		
			<article>
				<fieldset>
					<legend>Atualizar Célula</legend>
					<form action = "/celula/atualizar" method = "post"  class = "form-horizontal">
						
						<div class = "control-group" >
						<label class = "control-label" >Nome:</label>
						<div class = "controls" >
						<input name = "nome"  value = "<?php echo $celula->nome ; ?>" >
						</div>
						</div>

						<div class = "control-group" >
						<label class = "control-label" >Horario:</label>
						<div class = "controls" >
						<input name = "horarioFuncionamento" value = "<?php echo $celula->horarioFuncionamento ; ?>">
						</div>
						</div>

						<div class = "control-group" >
						<label class = "control-label" >Endereço:</label>
						<div class = "controls" >
						<input name = "endereco" value = "<?php echo $celula->endereco ; ?>">
						</div>
						</div>

						 <div class = "control-group " >
							<div class = "ui-widget" >
								 <label class = "control-label" for = "lider" >Líder</label>
						<div class = "controls" >
								 <select id = "combobox" class = "combobox lider span3" name = "lider"  >
										<option value = "<?php echo $lider->id?>"><?php echo $lider->nome ?></option>
									  <?php foreach($lideres as $lider) : ?><option value = "<?php echo $lider['id']?>"><?php echo $lider['nome']?></option>
									  <?php endforeach ; ?>

								 </select>
							</div>
						 </div>	
						 </div>	



						</select>
						</div>
						</div>

							<input type = "hidden" value="<?php echo $celula->id ; ?>" name = "id" >

						
						<div class = "form-actions" >
						<button type = "submit" class = "btn btn-primary" >Salvar</button>
						<button type = "reset" class = "btn" >Cancelar</button>
						</div>
						

					</form>
				
				</fieldset>
			
			</article>
		
		</section>

		</section>
	</body>



</html>

