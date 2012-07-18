				<form action = "/discipulo/novoCompleto" method = "post"  class = "form-inline">
					<fieldset class = "f_fieldset" >

						<fieldset>
							<legend>Dados Pessoais</legend>
							<div class = "control-group" >

							  <div class="control-group span3">
								  	<label class = "control-label" for = "nome" >Nome:</label>
									<div class = "controls" >
									<input id = "nome" class = "span3" name = "nome"  value = "<?php echo $dados['nome']?>" required autofocus>
									</div>
								</div>
									
							  <div class="control-group span1">
								  	<label class = "control-label" for = "ativo" >Ativo:</label>
									<div class = "controls" >
								  	<input id = "ativo" name = "ativo" type = "checkbox"  
										  value = ""  >
									</div>
								</div>

							  <div class="control-group span2">
								  	<label class = "control-label" for = "dataNascimento" >Data Nasc.:</label>
									<input id = "dataNascimento" class = "span2 dataNascimento" name = "dataNascimento"  value = "<?php echo $dados['dataNascimento']?>" required >
								</div>

							  <div class="control-group span1">
								  	<label class = "control-label" for = "sexo" >Sexo:</label>
									<select id = "sexo" class = "span1" name = "sexo" required >
										  	<option value = "m" >Masculino</option>
									  		<option value = "f" >Femenino</option>
									 </select>
								</div>

							  <div class="control-group span2">
								  	<label class = "control-label" for = "estadoCivilId" >Estado Civil:</label>
									<select id = "estadoCivilId" class = "span2" name = "estadoCivilId" >
												 <option value = ""></option>
									  <?php foreach($estadosCivies as $estadoCivil) : ?>
										  <option value = "<?php echo $estadoCivil['id']?>"><?php echo $estadoCivil['nome']?> </option>
									  <?php endforeach ; ?>
									</select>
							</div>

						  <div class="control-group span2">

								  <label class = "control-label" for = "telefone" >Telefone:</label>
								  <input id = "telefone" class = "span2" type="tel" value = "<?php echo $dados['telefone']?>"  maxlength="14" 
										pattern="\([0-9]{2}\) [0-9]{4}\-[0-9]{4}" placeholder="(00) 9999-9999" value="" name="telefone" id="telefone">
							</div>

					</div>

							<div class = "control-group span8" >
								  <label class = "control-label" for = "endereco" >Endereço:</label>
								  <input id = "endereco" class = "span8" name = "endereco" value = "<?php echo $dados['endereco']?>" required >
							</div>

							<div class = "control-group span3" >
								  <label class = "control-label" for = "email" >E-mail:</label>
								  <input id = "email" class = "span3" name = "email" type = "email" value = "<?php echo $dados['email']?>" required >
							</div>
							</fieldset>

							<fieldset>
									<legend>Dados Ministériais</legend>


									  <div class = "control-group span3" >
									  <div class = "ui-widget" >
								  			<label class = "control-label span1" for = "lider" >Líder</label>
									  		<select id = "combobox" class = "combobox lider " name = "lider"  >

												 <option value = "" selected> </option>
												 <?php foreach($lideres as $lider) : ?>
												 <option value = "<?php echo $lider['id']?>"><?php echo $lider['nome']?> </option>
												 <?php endforeach ; ?>

									 		</select>
									</div>	

									</div>	

									  <div class = "ui-widget-celula" >
									<div class = "control-group span3" >
								  		<label class = "control-label span2" for = "celula" >Célula que Participa:</label>
									  	<select id = "comboboxCelula" class = "comboboxCelula" name = "celula"  >
										<option value = "" ></option>
											  	<?php foreach($celulas as $celula) : ?>
												  	<option value = "<?php echo $celula['id']?>"><?php echo $celula['nome']?> </option>
											  	<?php endforeach ; ?>
								  		</select>
									</div>
									</div>

				<!-- Formulario de atualização do STATUS CELULAR -->
					<div class = "control-group span2" >
							<label class = "control-label" ></strong>Status Celular:</label>
							<div class = "controls" >
							<select class = "span2" name = "tipoStatusCelular" >
												 <option value = ""></option>
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
												 <option value = ""></option>
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
												 <option value = ""></option>
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
												 <option value = ""></option>
								<?php foreach ($tiposRedes as $tipoRede) : ?>
										<option value = "<?php echo $tipoRede['id'] ; ?>" ><?php echo $tipoRede['nome'] ; ?></option>
								<?php endforeach ; ?>
						</select>
					</div>
				</div>
			</div>
			
		</fieldset>

		<fieldset>
			<legend>Escala Exito</legend>
							  <div class="control-group">
			
						
						<?php foreach ( $eventos as $evento) : ?>

							  <div class="control-group span2">
									<label class = "checkbox"  ><?php  echo $evento['nome'] ?>:
									<input  name = "eventos[]" type = "checkbox"  
										  value = "<?php echo $evento['id'] ; ?>" <?php  echo (array_key_exists('discipuloId',$evento))? "checked" :"" ; ?> >
									</label>
								</div>

						<?php endforeach ; ?>
					</div>
		</fieldset>

				<div class = "form-actions " >
				  		<button type = "submit" class = "btn btn-primary" >Salvar</button>
				  		<a href = "/discipulo/listarAtualizar" class = "btn btn-danger" >Cancelar</a>
			  </div>
	</fieldset>
					</form>
