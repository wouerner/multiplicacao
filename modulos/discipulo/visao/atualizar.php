<?php 

$mensagem = isset($_SESSION['mensagem']) ? $_SESSION['mensagem'] : '';
unset($_SESSION['mensagem']) ;

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
		<style type="text/css">
		   @import url("../../../ext/twitter-bootstrap/bootstrap.css");
		   @import url("../../../incluidos/css/estilo.css");
			@import url("../../../ext/jquery-ui/css/ui-lightness/jquery-ui.css");
		</style>

		<script src= "../../../ext/jquery/jquery-1.7.1.min.js"></script>
		<script src= "../../../ext/jquery/jquery.maskedinput.js"> </script>

		<script src= "../../../ext/jquery-ui/js/jquery-ui.js"> </script>
		<script src= "../../../ext/jquery-ui/development-bundle/ui/i18n/jquery.ui.datepicker-pt-BR.js"> </script>
		<script>

		jQuery(function($){
   	$("#telefone").mask("(99) 9999-9999");
   	$("#dataNascimento").mask("99/99/9999");
		});

		$(function() {

				  $( "#dataNascimento" ).datepicker();
		});

// Status Celular dialog
		/*$(function() {
				  $( "#dialog-form" ).dialog({  autoOpen : false,
							 								height: 300,
															width: 500,
															modal: true,
				 									 });

				  $( "#statusCelular" )
							 .button()
							.click( function(){
										$("#dialog-form").dialog("open");
				  });

		});

// Admissao Dialog 
		$(function() {
				  $( "#formularioAdmissao" ).dialog({  autoOpen : false,
							 								height: 300,
															width: 500,
															modal: true,
				 									 });

				  $( "#butaoAdmissao" )
							 .button()
							.click( function(){
										$("#formularioAdmissao").dialog("open");
				  });

		});

// rede Dialog 
		$(function() {
				  $( "#formularioRede" ).dialog({  autoOpen : false,
							 								height: 300,
															width: 500,
															modal: true,
				 									 });

				  $( "#butaoRede" )
							 .button()
							.click( function(){
										$("#formularioRede").dialog("open");
				  });

		});*/
		</script>

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

				<?php if ($mensagem) : ?>
					<div class="alert <?php echo ($mensagem=='ok') ? 'alert-success' : 'alert-error' ; ?>">
				  	<h4 class="alert-heading">
						<?php echo $mensagem ?>!
					</h4>
				   </div>
				<?php endif ; ?>

				<form action = "/discipulo/atualizar" method = "post"  class = "form-inline">
						<fieldset>
							<legend>Dados Pessoais</legend>
							<div class = "control-group" >

							  <div class="control-group span3">
								  	<label class = "control-label" for = "nome" >Nome:</label>
									<div class = "controls" >
										<input id = "nome" class = "span3" name = "nome"  value = "<?php echo $discipulo->nome ; ?>" required autofocus>
									</div>
								</div>
									
							  <div class="control-group span1">
								  	<label class = "control-label" for = "ativo" >Ativo:</label>
									<div class = "controls" >
								  	<input id = "ativo" name = "ativo" type = "checkbox"  
										  value = "<?php echo ($discipulo->ativo != TRUE )? TRUE : 0 ; ?>" <?php  echo ($discipulo->ativo == TRUE )? "checked" :"" ; ?> >
									</div>
								</div>

							  <div class="control-group span2">
								  	<label class = "control-label" for = "dataNascimento" >Data Nasc.:</label>
									<input id = "dataNascimento" class = "span2" name = "dataNascimento"  value = "<?php echo $dataNascimento ; ?>" required >
								</div>

							  <div class="control-group span1">
								  	<label class = "control-label" for = "sexo" >Sexo:</label>
									<select id = "sexo" class = "span1" name = "sexo" required >
										<?php if ($discipulo->sexo == 'm' ) : ?>
										  	<option value = "m" >Masculino</option>
									  		<option value = "f" >Femenino</option>
										<?php else : ?>
									  		<option value = "f" >Femenino</option>
										  	<option value = "m" >Masculino</option>
										<?php endif ; ?>
									 </select>
								</div>

							  <div class="control-group span2">
								  	<label class = "control-label" for = "estadoCivilId" >Estado Civil:</label>
									<select id = "estadoCivilId" class = "span2" name = "estadoCivilId" >
									  <option value = "<?php echo is_object($estadoCivil) ? $estadoCivil->id : ' ' ?>" >
												<?php echo is_object($estadoCivil) ? $estadoCivil->nome : ' ' ; ?> </option>
									  <option>---------</option>

									  <?php foreach($estadosCivies as $estadoCivil) : ?>
										  <option value = "<?php echo $estadoCivil['id']?>"><?php echo $estadoCivil['nome']?> </option>
									  <?php endforeach ; ?>
									</select>
							</div>

						  <div class="control-group span2">

								  <label class = "control-label" for = "telefone" >Telefone:</label>
								  <input id = "telefone" class = "span2" type="tel" value = "<?php echo $discipulo->telefone ; ?>"  maxlength="14" 
										pattern="\([0-9]{2}\) [0-9]{4}\-[0-9]{4}" placeholder="(00) 9999-9999" value="" name="telefone" id="telefone">
								</div>
							</div>

</div>

							<div class = "control-group span8" >
								  <label class = "control-label" for = "endereco" >Endereço:</label>
								  <input id = "endereco" class = "span8" name = "endereco" value = "<?php echo $discipulo->endereco ; ?>" required >
							</div>

							<div class = "control-group span3" >
								  <label class = "control-label" for = "email" >E-mail:</label>
								  <input id = "email" class = "span3" name = "email" type = "email" value = "<?php echo $discipulo->email ; ?>" required >
							</div>
							</fieldset>

							<fieldset>
									<legend>Dados Ministériais</legend>


									  <div class = "control-group" >

									  <div class = "control-group span3" >
								  			<label class = "control-label" for = "lider" >Líder</label>
									  		<select id = "lider" class = "span3" name = "lider" required >

									  			<option value = "<?php echo $lider->id ; ?>"><?php echo $lider->nome ; ?> </option>
									  			<option>--------- </option>

												 <?php foreach($lideres as $lider) : ?>
												 <option value = "<?php echo $lider['id']?>"><?php echo $lider['nome']?> </option>
												 <?php endforeach ; ?>

									 		</select>
									</div>	

									<div class = "control-group span3" >
								  		<label class = "control-label" for = "celula" >Célula</label>
									  	<select id = "celula" class = "span3" name = "celula" required >
									  		<option value = "<?php echo $celula['id']?>"><?php echo $celula['nome']?> </option>
									  		<option>--------- </option>
											  	<?php foreach($celulas as $celula) : ?>
												  	<option value = "<?php echo $celula['id']?>"><?php echo $celula['nome']?> </option>
											  	<?php endforeach ; ?>
								  		</select>
									</div>

				<!-- Formulario de atualização do STATUS CELULAR -->
					<div class = "control-group span2" >
							<label class = "control-label" ></strong>Status Celular:</label>
							<div class = "controls" >
							<select class = "span2" name = "tipoStatusCelular" >
									<option value = "<?php echo $statusCelularDiscipulo ['id'] ; ?>" ><?php echo $statusCelularDiscipulo ['nome'] ; ?></option>
									<option value = "" >-------------</option>
								<?php foreach ($tiposStatusCelulares as $tipoStatusCelular) : ?>
									<option value = "<?php echo $tipoStatusCelular ['id'] ; ?>" ><?php echo $tipoStatusCelular ['nome'] ; ?></option>
								<?php endforeach ; ?>
							</select>
						</div>
					</div>
						

					<div class = "control-group span2" >
						<label class = "control-label" >Admissão:</label>
						<div class = "controls" >
							<select class = "span2" name = "tipoAdmissao" >
								<option value = "<?php echo $tipoAdmissaoAtual['id'] ; ?>" ><?php echo $tipoAdmissaoAtual['nome'] ; ?></option>
								<option value = "" >-------------</option>
									<?php foreach ($tiposAdmissoes as $tipoAdmissao) : ?>
										<option value = "<?php echo $tipoAdmissao['id'] ; ?>" ><?php echo $tipoAdmissao['nome'] ; ?></option>
									<?php endforeach ; ?>
							</select>
						</div>	
				</div>	
				<div class = "control-group span3" >
						<label class = "control-label" ></strong>Função</label>
						<div class = "controls" >
							<select class = "span3" name = "funcaoRedeId" >
								<option value = "<?php echo $redeAtual['funcaoId'] ; ?>" ><?php echo $redeAtual['funcaoNome'] ; ?></option>
								<option value = "" >-------------</option>
									<?php foreach ($funcoesRedes as $funcaoRede) : ?>
											<option value = "<?php echo $funcaoRede['id'] ; ?>" ><?php echo $funcaoRede['nome'] ; ?></option>
									<?php endforeach ; ?>
							</select>
						
						</div>
				</div>

				<div class = "control-group span3" >
					<label class = "control-label" >Rede:</label>
					<div class = "controls" >
						<select class = "span3" name = "tipoRedeId" >
							<option value = "<?php echo $redeAtual['tipoId'] ; ?>" ><?php echo $redeAtual['tipoNome'] ; ?></option>
							<option value = "" >-------------</option>
								<?php foreach ($tiposRedes as $tipoRede) : ?>
										<option value = "<?php echo $tipoRede['id'] ; ?>" ><?php echo $tipoRede['nome'] ; ?></option>
								<?php endforeach ; ?>
						</select>
					</div>
				</div>
			</div>
			
			<input type = "hidden" name = "discipuloId" value = "<?php echo $discipulo->id ; ?>" >
					
		</fieldset>
			<legend>Escala Exito</legend>
			<select name="eventoId">
					<?php foreach($eventos as $evento) : ?>
						<option value = "<?php echo $evento['id'] ; ?>" > <?php echo $evento['nome'] ; ?></option>
					<?php endforeach ; ?>
			</select>
			
		</fieldset>

		<table class = "table bordered-table">

						<?php foreach ( $eventosDiscipulos as $evento) : ?>

						<tr>
							<td ><a href="/evento/detalhar/id/<?php echo $evento['id']?>" ><?php echo $evento['nome'] ; ?> </a></td>	
							<td><?php require 'discipulo/visao/menuEvento.inc.php' ; ?>	</td></tr>
						<?php endforeach ; ?>
		</table>

				<div class = "form-actions " >
				  		<button type = "submit" class = "btn btn-primary" >Atualizar</button>
				  		<a href = "/discipulo" class = "btn btn-danger" >Cancelar</a>
			  </div>
					</form>

			</article>
		</section>

	</div>	
		</section>
	</body>



</html>

