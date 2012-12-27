<form action = "/discipulo/atualizar" method = "post"  class = "form-inline">
											<input id = "idDiscipulo" type = "hidden"   value = "<?php echo $discipulo->id ; ?>" >
		<fieldset class = "f_fieldset" >
			<legend>Dados Pessoais</legend>

							<!-- linha 1-->
							<div class = "row" > 
								<div class = "span12" >

							  <div class="control-group span4">
								  	<label class = "control-label" for = "nome" >Nome:</label>
										<div class = "controls" >
											<input id = "nome" class = "span4" name = "nome"  value = "<?php echo $discipulo->nome ; ?>" required autofocus>
									</div>
								</div>

							  <div class="control-group span4">
								  	<label class = "control-label" for = "alcunha" >Alcunha:</label>
										<div class = "controls" >
											<input id = "nome" class = "span4" name = "alcunha"  value = "<?php echo $discipulo->alcunha ; ?>" required autofocus>
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
										<input id = "dataNascimento" class = "span2 dataNascimento" name = "dataNascimento" value = "<?php echo $dataN ; ?>" required >
								</div>

							  <div class="control-group span2">
								  	<label class = "control-label" for = "sexo" >Sexo:</label>
										<select id = "sexo" class = "span2" name = "sexo" required >
										<?php if ($discipulo->sexo == 'm' ) : ?>
										  	<option value = "m" >Masculino</option>
									  		<option value = "f" >Feminino</option>
										<?php else : ?>
									  		<option value = "f" >Feminino</option>
										  	<option value = "m" >Masculino</option>
										<?php endif ; ?>
									 </select>
								</div>

								<?php $estadoCivil = $discipulo->getEstatoCivil() ; ?> 
							  <div class="control-group span2">
								  	<label class = "control-label" for = "estadoCivilId" >Estado Civil:</label>
										<select id = "estadoCivilId" class = "span2" name = "estadoCivilId" >

									  <option value = "<?php echo is_object($estadoCivil)? $estadoCivil->id : '' ; ?>" >
												<?php echo is_object($estadoCivil)? $estadoCivil->nome : '' ; ?> </option>
									  <option>---------</option>

									  <?php foreach($estadosCivies as $estadoCivil) : ?>
										  <option value = "<?php echo $estadoCivil['id']?>"><?php echo $estadoCivil['nome']?> </option>
									  <?php endforeach ; ?>
									</select>
							</div>

					</div>
				</div>

				<!-- linha 2 -->
				<div class = "row" >
					<div class = "span12" >

						  <div class="control-group span2">
								  <label class = "control-label" for = "telefone" >Telefone:</label>
								  <input id = "telefone" class = "span2" type="tel" value = "<?php echo $discipulo->telefone ; ?>"  maxlength="14" 
										pattern="\([0-9]{2}\) [0-9]{4}\-[0-9]{4}" placeholder="(00) 9999-9999" value="" name="telefone" id="telefone">
							</div>

							<div class = "control-group span6" >
								  <label class = "control-label" for = "endereco" >Endereço:</label>
								  <input id = "endereco" class = "span6" name = "endereco" value = "<?php echo $discipulo->endereco ; ?>" required >
							</div>

							<div class = "control-group span3" >
								  <label class = "control-label" for = "email" >E-mail:</label>
								  <input id = "email" class = "span3" name = "email" type = "email" value = "<?php echo $discipulo->email ; ?>" required >
							</div>

					</div>
			</div>

	</fieldset>

	<fieldset>
		<legend>Dados Ministériais</legend>
		
		<!-- Linha 3-->
		<div class = "row" >
			<div class = "span12" >

					<div class = "control-group span3" >
						  <div class = "ui-widget" >
								  			<label class = "control-label" for = "lider" >Nome do Líder:</label>
									  		<select id = "combobox" class = "combobox lider " name = "lider"  >

												<option value = "<?php echo is_object($lider) ? $lider->id  : '' ; ?>" selected><?php echo is_object($lider) ? $lider->getNomeAbreviado() : ''; ?></option>
									  			<option>--------- </option>

												 <?php foreach($lideres as $lider) : ?>
												 <option value = "<?php echo $lider->id ?>"><?php echo $lider->getNomeAbreviado() ?> </option>
												 <?php endforeach ; ?>

									 		</select>
							</div>	
				</div>	

				<?php $celula = $discipulo->getCelula(); ?>

			  <div class = "ui-widget-celula" >
						<div class = "control-group span3" >
								  		<label class = "control-label " for = "celula" >Célula que Participa:</label>
									  	<select id = "comboboxCelula" class = "comboboxCelula" name = "celula"  >
												<option value = "<?php echo $celula->id ; ?>" ><?php echo $celula->nome ; ?></option>
									  		<option>--------- </option>
											  	<?php foreach($celulas as $celula) : ?>
												  	<option value = "<?php echo $celula['id']?>"><?php echo $celula['nome']?> </option>
											  	<?php endforeach ; ?>
							  		</select>
						</div>
			</div>

			<div class = "control-group span3" >
				<label class = "control-label span2" ></strong>Atualizar Status:</label>
				<div class = "controls " >
							<span class ="span3" >
								<a class = "btn" href = "/statusCelular/novo/id/<?php  echo $discipulo->id ; ?>"  ><?php echo $status ['nome'] ; ?></a>
							</span>
				</div>
			</div> 

									<?php $admissao = $discipulo->getAdmissao() ; ?>
					<div class = "control-group span2" >
						<label class = "control-label" >Admissão:</label>
						<div class = "controls" >
							<select class = "span2" name = "tipoAdmissao" >
								<option value = "<?php echo $admissao['id'] ; ?>" ><?php echo $admissao['nome'] ; ?></option>
								<option value = "" >-------------</option>
								<?php foreach ($tiposAdmissoes as $tipoAdmissao) : ?>
									<option value = "<?php echo $tipoAdmissao['id'] ; ?>" ><?php echo $tipoAdmissao['nome'] ; ?></option>
								<?php endforeach ; ?>
							</select>
						</div>	
					</div>	
				</div>

		</div>

				<!-- Linha 4-->			
				<!-- Formulario de atualização do STATUS CELULAR -->
	 <div class = "row" >
		<div class = "span12" >

			<?php $rede = $discipulo->getRede() ; ?>
				<div class = "control-group span2" >
						<label class = "control-label" ></strong>Função na Rede</label>
						<div class = "controls" >
							<select class = "span2" name = "funcaoRedeId" >
								<option value = "<?php echo $rede[0]['funcaoId'] ; ?>" ><?php echo $rede[0]['funcaoRede']  ?></option>
								<option value = "" >-------------</option>
									<?php foreach ($funcaoRedes as $f) : ?>
											<option value = "<?php echo $f['id'] ; ?>" ><?php echo $f['nome'] ; ?></option>
									<?php endforeach ; ?>
							</select>
						</div>
				</div>

				<div class = "control-group span3" >
					<label class = "control-label" >Rede:</label>
					<div class = "controls" >
						<select class = "span3" name = "tipoRedeId" >
							<option value = "<?php echo $rede[0]['tpRedeId'] ; ?>" ><?php echo $rede[0]['tipoRede'] ; ?></option>
							<option value = "" >-------------</option>
								<?php foreach ($tiposRedes as $tipoRede) : ?>
										<option value = "<?php echo $tipoRede['id'] ; ?>" ><?php echo $tipoRede['nome'] ; ?></option>
								<?php endforeach ; ?>
						</select>
					</div>
				</div>

				<?php $mi = $discipulo->getMinisterio() ; ?>
				<div class = "control-group span3" >
					<label class = "control-label" >Ministério que Participa:</label>
					<div class = "controls" >
						<select class = "span3" name = "ministerio" >
										<option value = "<?php echo $mi[0]['ministerioId'] ; ?>" ><?php echo $mi[0]['ministerio'] ; ?></option>
								<?php foreach ($ministerio as $m) : ?>
										<option value = "<?php echo $m['id'] ; ?>" ><?php echo $m['nome'] ; ?></option>
								<?php endforeach ; ?>
						</select>
					</div>
				</div>

				<div class = "control-group span3" >
					<label class = "control-label" >Função no Ministério:</label>
					<div class = "controls" >
						<select class = "span3" name = "fministerio" >
										<option value = "<?php echo $mi[0]['funcaoId'] ; ?>" ><?php echo $mi[0]['funcao'] ; ?></option>
								<option value = "" >-------------</option>
								<?php foreach ($funcaoMinisterio as $fMinisterio) : ?>
										<option value = "<?php echo $fMinisterio['id'] ; ?>" ><?php echo $fMinisterio['nome'] ; ?></option>
								<?php endforeach ; ?>
						</select>
					</div>
				</div>
				
			</div>
		</div>
	</fieldset>

	<fieldset>
			<legend>Escala Exito</legend>
				 <div class="control-group">
			
						<?php $eventosDiscipulos = $discipulo->getEventos() ?>
						<?php $eventosLista = array_replace($eventos,$eventosDiscipulos) ?>

						<?php foreach ( $eventosLista as $evento) : ?>

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
							<input type = "hidden" name = "discipuloId" value = "<?php echo $discipulo->id ; ?>" >
				  		<button type = "submit" class = "btn btn-success" ><i class = "icon-pencil icon-white" ></i> Salvar</button>
							<a class = "btn" href = "/discipulo/encontroComDeus/id/<?php echo $discipulo->id ; ?>" target = "blank" >Ficha encontro</a>
							<a class = "btn" href = "/discipulo/crachaIndividual/id/<?php echo $discipulo->id ; ?>" target = "blank" >cracha</a>
			  </div>
</form>
