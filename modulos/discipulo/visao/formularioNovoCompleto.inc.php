				<form action = "/discipulo/novoCompleto" method = "post"  class = "form-inline well">
					<fieldset class = "f_fieldset" >

						<fieldset>
							<legend>Dados Pessoais</legend>

							<div class = "row-fluid" >
							<div class = "span12" >

							  <div class="control-group span4">
									<i class = "icon-user" ></i>
								  	<label class = "control-label" for = "nome" >Nome:</label>
									<div class = "controls" >
									<input id = "nome" type = "text" class = "input-block-level" name = "nome"  value = "<?php echo $dados['nome']?>" required autofocus>
									</div>
								</div>

							  <div class="control-group span4">
								  	<label class = "control-label" for = "nome" >Alcunha:</label>
									<div class = "controls" >
									<input id = "alcunha" type = "text" class = "input-block-level" name = "alcunha"  value = "<?php echo $dados['alcunha']?>" >
									</div>
								</div>

							  <div class="control-group span2">
								  	<label class = "control-label" for = "ativo" >Ativo:</label>
									<div class = "controls" >
								  	<input id = "ativo" name = "ativo" type = "checkbox"  
										  value = ""  >
									</div>
								</div>
							</div>
							</div>
									
							<div class = "row-fluid" >
								<div class = "span12" >

							  <div class="control-group span4">
									<i class = "icon-calendar" ></i>
									<label class = "control-label" for = "dataNascimento" >Data Nasc.:</label>
									<div class = "controls" >
										<input id = "dataNascimento" type = "date" class = "dataNascimento" name = "dataNascimento"  value = "<?php echo $dados['dataNascimento']?>" required >
								</div>
								</div>

							  <div class="control-group span4">
								  	<label class = "control-label" for = "sexo" >Sexo:</label>
										<div class = "controls" >
										<select id = "sexo" class = "" name = "sexo" required >
										  	<option value = "m" >Masculino</option>
									  		<option value = "f" >Femenino</option>
									 </select>
								</div>
								</div>

							  <div class="control-group span4">
								  	<label class = "control-label" for = "estadoCivilId" >Estado Civil:</label>
										<div class = "controls" >
									<select id = "estadoCivilId" class = "" name = "estadoCivilId" >
												 <option value = ""></option>
									  <?php foreach($estadosCivies as $estadoCivil) : ?>
										  <option value = "<?php echo $estadoCivil['id']?>"><?php echo $estadoCivil['nome']?> </option>
									  <?php endforeach ; ?>
									</select>
							</div>
							</div>


					</div>
					</div>
				</div>
				</div>

					<div class = "row-fluid" >
					<div class = "span12" >
					  <div class="control-group span4">
						  <label class = "control-label" for = "telefone" >Telefone:</label>
							<div class = "controls" >
							  <input id = "telefone" class = "" type="tel" value = "<?php echo $dados['telefone']?>"  maxlength="14" 
										pattern="\([0-9]{2}\) [0-9]{4}\-[0-9]{4}" placeholder="(00) 9999-9999" value="" name="telefone" id="telefone">
						</div>
						</div>

					<div class = "control-group span4" >
						  <label class = "control-label" for = "endereco" >Endereço:</label>
							<div class = "controls" >
							  <input id = "endereco" type = "text" class = "input-block-level" name = "endereco" value = "<?php echo $dados['endereco']?>" required >
							</div>
							</div>

							<div class = "control-group span2" >
								<label class = "control-label" for = "email" >E-mail:</label>
								<div class = "controls" >
								  <input id = "email" class = "" name = "email" type = "email" value = "<?php echo $dados['email']?>" required >
								</div>
							</div>
						</div>
						</div>
							</fieldset>

							<fieldset>
								<legend>Dados Ministériais</legend>
									  <div class = "row " >
									  <div class = "span12 " >
									 
										 <div class = "control-group span3" >
									  			<div class = "ui-widget" >
												<i class = "icon-user" ></i>
								  				<label class = "control-label " for = "lider" >Nome do Líder:</label>
									  				<select id = "combobox" class = "combobox lider " name = "lider"  >
												 		<option value = "" selected> </option>
												 			<?php foreach($lideres as $lider) : ?>
												 				<option value = "<?php echo $lider->id ; ?>"><?php echo $lider->nome ; ?> </option>
												 			<?php endforeach ; ?>
									 				</select>
												</div>	
										</div>	

										<div class = "control-group span3" >
									  		<div class = "ui-widget-celula" >
								  				<label class = "control-label " for = "celula" >Célula que Participa:</label>
									  			<select id = "comboboxCelula" class = "comboboxCelula" name = "celula"  >
														<option value = "" ></option>
											  				<?php foreach($celulas as $celula) : ?>
												  		<option value = "<?php echo $celula['id']?>"><?php echo $celula['nome']?> </option>
												  			<?php endforeach ; ?>
								 		 		</select>
											</div>
										</div>

				<!-- Formulario de atualização do STATUS CELULAR -->
										<div class = "control-group span3" >
											<label class = "control-label" ></strong>Status Celular:</label>
											<div class = "controls" >
												<select class = "span2" name = "tipoStatusCelular" >
												 <option value = ""></option>
													<?php foreach ($tiposStatusCelulares as $tipoStatusCelular) : ?>
														<option value = "<?php echo $tipoStatusCelular->id ; ?>" >
															<?php echo $tipoStatusCelular->nome ; ?>
														</option>
													<?php endforeach ; ?>
												</select>
											</div>
										</div>
						

					<div class = "control-group " >
						<label class = "control-label" >Admissão:</label>
						<div class = "controls" >
							<select class = "span2" name = "tipoAdmissao" >
								 <option value = ""></option>
									<?php foreach ($tiposAdmissoes as $tipoAdmissao) : ?>
										<option value = "<?php echo $tipoAdmissao['id'] ; ?>" >
										<?php echo $tipoAdmissao['nome'] ; ?></option>
									<?php endforeach ; ?>
							</select>
						</div>	
					</div>	
				</div>
				</div>

				<div class = "row " >
				<div class = "span12" >
				<div class = "control-group span3" >
						<label class = "control-label" ></strong>Função</label>
						<div class = "controls" >
							<select class = "" name = "funcaoRedeId" >
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
				  		<button type = "submit" class = "btn btn-success" ><i class = "icon-ok icon-white" ></i> Salvar</button>
				  		<a href = "/discipulo/listarAtualizar" class = "" ><i class = "icon-ban-circle" ></i>Cancelar</a>
			  </div>
	</fieldset>
					</form>