<form action = "/discipulo/discipulo/atualizar" method="post"  class="" accept-charset = "UTF-8" >
    <input id = "idDiscipulo" type = "hidden"   value = "<?php echo $discipulo->id ; ?>" >
    <fieldset  class = "">
        <legend>Dados Pessoais</legend>
        <div class="row" >
            <div class="form-group col-md-3">
                <label class="" for="nome" >Nome:</label>
                <input id="nome" type="text" class="form-control" name="nome"  value="<?php echo $discipulo->nome ; ?>" required autofocus>
            </div>
            <?php if ($acesso->hasPermission('admin_acesso') == true): ?>
                <div class="form-group col-md-3">
                    <label class = "control-label" for = "alcunha" >Alcunha:</label>
                    <input id = "nome" type = "text" class = "form-control form-control" name = "alcunha"  value = "<?php echo $discipulo->alcunha ; ?>">
                </div>
            <?php endif ; ?>
            <div class="form-group col-md-1">
                <label class="control-label" for = "dataNascimento" >Data Nasc.:</label>
                <input id="dataNascimento" type="text" class ="form-control dataNascimento" name = "dataNascimento" value = "<?php echo $dataN ; ?>" required >
            </div>
            <div class="form-group col-md-1">
                <label class="control-label" for="sexo">Sexo:</label>
                <select id="sexo" class="form-control" name="sexo" required >
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
            <div class="form-group col-md-2">
                <label class="control-label" for = "estadoCivilId" >Estado Civil:</label>
                <select id = "estadoCivilId" class = "form-control" name = "estadoCivilId" >
                    <option value="<?php echo is_object($estadoCivil)? $estadoCivil->id : '' ; ?>" >
                       <?php echo is_object($estadoCivil)? $estadoCivil->nome : '' ; ?> </option>
                    <option>---------</option>
                      <?php foreach($estadosCivies as $estadoCivil) : ?>
                          <option value = "<?php echo $estadoCivil['id']?>"><?php echo $estadoCivil['nome']?> </option>
                    <?php endforeach ; ?>
                </select>
            </div>
        </div>
            <!-- linha 2 -->
        <div class = "row" >
            <div class="form-group col-md-2">
                <label class="control-label" for = "telefone" >Telefone:</label>
                <input id="telefone" class="form-control" type="tel" value="<?php echo $discipulo->telefone ; ?>"  maxlength="14"
                        pattern="\([0-9]{2}\) [0-9]{4}\-[0-9]{4}" placeholder="(00) 9999-9999" value="" name="telefone" id="telefone">
            </div>
            <div class = "form-group col-md-3" >
                  <label class = "control-label" for = "endereco" >Endereço:</label>
                  <input id = "endereco" type = "text" class = "form-control" name = "endereco" value = "<?php echo $discipulo->endereco ; ?>" required >
            </div>
            <div class = "form-group col-md-3" >
                  <label class = "control-label" for = "email" >E-mail:</label>
                  <input id = "email" class = "form-control" name = "email" type = "email" value = "<?php echo $discipulo->email ; ?>"  >
            </div>
        </div>
    </fieldset>
    <fieldset>
        <legend>Dados Ministériais</legend>
        <div class="row" >
            <div class="form-group col-md-3" >
                <div class="ui-widget" >
                    <label class="control-label" for="lider" >Nome do Líder:</label>
                    <select id="combobox" class="form-control combobox lider " name = "lider"  >
                        <option value = "<?php echo is_object($lider) ? $lider->id  : '' ; ?>" selected><?php echo is_object($lider) ? $lider->getAlcunha() : ''; ?></option>
                        <option>--------- </option>
                        <?php foreach($lideres as $lider) : ?>
                        <option value = "<?php echo $lider->id ?>"><?php echo $lider->getAlcunha() ?> </option>
                        <?php endforeach ; ?>
                     </select>
                </div>
            </div>
            <?php $celula = $discipulo->getCelula(); ?>
            <div class = "form-group col-md-3" >
                <label class = "control-label " for = "celula" >Célula que Participa:</label>
                <select id = "comboboxCelula" class = "comboboxCelula" name = "celula"  >
                    <option value = "<?php echo $celula->id ; ?>" ><?php echo $celula->nome ; ?></option>
                    <option>--------- </option>
                        <?php foreach($celulas as $celula) : ?>
                            <option value = "<?php echo $celula->id ; ?>"><?php echo $celula->nome ; ?> </option>
                        <?php endforeach ; ?>
                </select>
            </div>
            <div class = "form-group col-md-3" >
                <label class = "control-label " ></strong>Atualizar Status:</label>
                <div class = "controls form-control" >
                    <a class = "btn" href = "/statusCelular/statusCelular/novo/id/<?php  echo $discipulo->id ; ?>"  ><?php echo $status ['nome'] ; ?></a>
                </div>
            </div>
            <?php $admissao = $discipulo->getAdmissao() ; ?>
            <div class = "form-group col-md-2 "  >
                <label class = "control-label" >Admissão:</label>
                <select class = "form-control" name = "tipoAdmissao" >
                    <option value = "<?php echo $admissao['id'] ; ?>" ><?php echo $admissao['nome'] ; ?></option>
                    <option value = "" >-------------</option>
                    <?php foreach ($tiposAdmissoes as $tipoAdmissao) : ?>
                        <option value = "<?php echo $tipoAdmissao['id'] ; ?>" ><?php echo $tipoAdmissao['nome'] ; ?></option>
                    <?php endforeach ; ?>
                </select>
            </div>
        </div>
        <div class = "row" >
            <?php $rede = $discipulo->getRede() ; ?>
            <div class = "form-group col-md-2" >
                <label class = "control-label" ></strong>Função na Rede</label>
                <div class = "controls" >
                    <select class = "form-control" name = "funcaoRedeId" >
                        <option value = "<?php echo $rede[0]['funcaoId'] ; ?>" ><?php echo $rede[0]['funcaoRede']  ?></option>
                        <option value = "" >-------------</option>
                            <?php foreach ($funcaoRedes as $f) : ?>
                                <option value = "<?php echo $f['id'] ; ?>" ><?php echo $f['nome'] ; ?></option>
                            <?php endforeach ; ?>
                    </select>
                </div>
            </div>
            <div class = "form-group col-md-2" >
                <label class = "control-label" >Rede:</label>
                <div class = "controls" >
                    <select class = "form-control" name = "tipoRedeId" >
                        <option value = "<?php echo $rede[0]['tpRedeId'] ; ?>" ><?php echo $rede[0]['tipoRede'] ; ?></option>
                        <option value = "" >-------------</option>
                            <?php foreach ($tiposRedes as $tipoRede) : ?>
                                    <option value = "<?php echo $tipoRede->id ; ?>" ><?php echo $tipoRede->nome ; ?></option>
                            <?php endforeach ; ?>
                    </select>
                </div>
            </div>
            <?php $mi = $discipulo->getMinisterio() ; ?>
            <div class = "form-group col-md-2" >
                <label class = "control-label" >Ministério que Participa:</label>
                <div class = "controls" >
                    <select class = "form-control" name = "ministerio" >
                                    <option value = "<?php echo $mi[0]['ministerioId'] ; ?>" ><?php echo $mi[0]['ministerio'] ; ?></option>
                            <?php foreach ($ministerio as $m) : ?>
                                    <option value = "<?php echo $m['id'] ; ?>" ><?php echo $m['nome'] ; ?></option>
                            <?php endforeach ; ?>
                    </select>
                </div>
            </div>
            <div class = "form-group col-md-2" >
                <label class = "control-label" >Função no Ministério:</label>
                <select class = "form-control" name = "fministerio" >
                    <option value = "<?php echo $mi[0]['funcaoId'] ; ?>" ><?php echo $mi[0]['funcao'] ; ?></option>
                    <option value = "" >-------------</option>
                    <?php foreach ($funcaoMinisterio as $fMinisterio) : ?>
                            <option value = "<?php echo $fMinisterio['id'] ; ?>" ><?php echo $fMinisterio['nome'] ; ?></option>
                    <?php endforeach ; ?>
                </select>
            </div>
        </div>
    </fieldset>

<!--    <fieldset>
            <legend>Escala Exito</legend>
                 <div class="form-control">

                        <?php $eventosDiscipulos = $discipulo->getEventos() ?>
                        <?php $eventosLista = array_replace($eventos,$eventosDiscipulos) ?>

                        <?php foreach ( $eventosLista as $evento) : ?>

                              <div class="form-control col-md-2">
                                    <label class = "checkbox"  ><?php  echo $evento['nome'] ?>:
                                    <input  name = "eventos[]" type = "checkbox"
                                          value = "<?php echo $evento['id'] ; ?>" <?php  echo (array_key_exists('discipuloId',$evento))? "checked" :"" ; ?> >
                                    </label>
                                </div>
                        <?php endforeach ; ?>
                </div>
        </fieldset>
-->

    <div class = "form-actions " >
        <input type = "hidden" name = "discipuloId" value = "<?php echo $discipulo->id ; ?>" >
        <button type = "submit" class = "btn btn-success" ><i class = "icon-pencil icon-white" ></i> Salvar</button>
        <a class = "btn" href = "/encontroComDeus/participantesEncontro/fichaIndividual/id/<?php echo $discipulo->id ; ?>" target = "blank" >Ficha encontro</a>
        <a class = "btn" href = "/discipulo/discipulo/crachaIndividual/id/<?php echo $discipulo->id ; ?>" target = "blank" >cracha</a>
    </div>
</form>
