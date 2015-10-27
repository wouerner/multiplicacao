<form action="/discipulo/discipulo/novoCompleto" method="post"  class="form-horizontal ">
    <fieldset class="col-md-6">
        <legend>Dados Pessoais</legend>
            <div class="form-group ">
                <label class="control-label col-md-3" for="nome" ><i class="icon-user" ></i> Nome:</label>
                <div class="col-md-8">
                    <input id="nome" type="text" class="form-control" maxlength="45" name="nome" placeholder="Nome Completo" value="<?php echo $dados['nome']?>" required autofocus>
                </div>
            </div>
            <?php if ($acesso->hasPermission('admin_acesso') == true): ?>
                <div class="form-group">
                    <label class="control-label col-md-3" for="nome">Alcunha:</label>
                    <div class="col-md-8" >
                        <input id="alcunha" type="text" class="form-control" name="alcunha" placeholder="Ou apelido"  value="<?php echo $dados['alcunha']?>">
                    </div>
                </div>
            <?php else: ?>
                <input id="alcunha" type="hidden" class="form-control " name="alcunha" placeholder="Ou apelido"  value="<?php echo $dados['alcunha']?>">
            <?php endif ; ?>
            <div class="form-group">
                <label class="control-label col-md-3" for="dataNascimento" >
                    <i class="icon-calendar" ></i> Nasc.:
                </label>
                <div class="col-md-3" >
                    <input id="dataNascimento" type="text" placeholder="dd/mm/aaaa" class="dataNascimento form-control" name="dataNascimento"  value="<?php echo $dados['dataNascimento']?>" required >
                </div>
            </div>
            <div class="form-group ">
                <label class="control-label col-md-3" for="sexo" >Sexo:</label>
                <div class="col-md-3" >
                    <select id="sexo" class="form-control " name="sexo" required >
                        <option value="m" >Masculino</option>
                        <option value="f" >Femenino</option>
                    </select>
                </div>
            </div>
            <div class="form-group ">
                <label class="control-label col-md-3" for="estadoCivilId" >Estado Civil:</label>
                <div class="col-md-3" >
                    <select id="estadoCivilId" class="form-control" name="estadoCivilId" required >
                        <?php foreach($estadosCivies as $estadoCivil) : ?>
                            <option value="<?php echo $estadoCivil['id']?>"><?php echo $estadoCivil['nome']?> </option>
                        <?php endforeach ; ?>
                    </select>
                </div>
            </div>
        </fieldset>
        <fieldset class="col-md-6">
            <legend>Contato</legend>
            <div class="form-group ">
                <label class="control-label col-md-4" for="telefone" >Telefone:</label>
                <div class=" col-md-4" >
                    <input id="telefone" class="form-control" type="tel" value="<?php echo $dados['telefone']?>"  maxlength="14"
                        pattern="\([0-9]{2}\) [0-9]{4}\-[0-9]{4}" placeholder="(00) 9999-9999" value="" name="telefone" id="telefone">
                </div>
            </div>
            <div class="form-group" >
                <label class="control-label col-md-4" for="endereco" >Endereço:</label>
                <div class="col-md-4" >
                  <input id="endereco" type="text" maxlength="45" class="form-control" name="endereco" value="<?php echo $dados['endereco']?>" required >
                </div>
            </div>
            <div class="control-group " >
                <label class="control-label col-md-4" for="email" >E-mail:</label>
                <div class="col-md-4" >
                    <input id="email" class="form-control" maxlength="60" name="email" type="email" placeholder="exemplo@exemplo.com"  value="<?php echo $dados['email']?>" >
                </div>
            </div>
        </fieldset>
    <fieldset class="col-md-12">
        <legend>Dados Ministériais</legend>
                <div class="control-group col-md-2" >
                    <label class="control-label " for="lider" >
                        <i class="icon-user" ></i>
                        Nome do Líder:
                    </label>
                    <select id="combobox" class="combobox lider " name="lider" required >
                        <option value="" selected> </option>
                            <?php foreach($lideres as $lider) : ?>
                                <option value="<?php echo $lider->id ; ?>"><?php echo $lider->getAlcunha(); ?> </option>
                            <?php endforeach ; ?>
                    </select>
                </div>
                <div class="control-group col-md-2" >
                    <div class="ui-widget-celula" >
                        <label class="control-label" for="celula">
                            <i class="icon-home"></i> Célula que Participa:
                        </label>
                        <select id="comboboxCelula" class="comboboxCelula" name="celula" required>
                            <option value="" ></option>
                            <?php foreach($celulas as $celula) : ?>
                                <option value="<?php echo $celula->id; ?>"><?php echo $celula->nome; ?> </option>
                            <?php endforeach ; ?>
                        </select>
                    </div>
                </div>
                <div class="control-group col-md-2" >
                    <label class="" >Status Celular:</label>
                    <select class="form-control" name="tipoStatusCelular" required >
                     <option value=""></option>
                        <?php foreach ($tiposStatusCelulares as $tipoStatusCelular) : ?>
                            <option value="<?php echo $tipoStatusCelular->id ; ?>" >
                                <?php echo $tipoStatusCelular->nome ; ?>
                            </option>
                        <?php endforeach ; ?>
                    </select>
                </div>
                <div class="form-group col-md-2" >
                    <label class="control-label" >Admissão:</label>
                    <div class="controls" >
                        <select class="form-control" name="tipoAdmissao" >
                             <option value=""></option>
                                <?php foreach ($tiposAdmissoes as $tipoAdmissao) : ?>
                                    <option value="<?php echo $tipoAdmissao['id'] ; ?>" >
                                    <?php echo $tipoAdmissao['nome'] ; ?></option>
                                <?php endforeach ; ?>
                        </select>
                    </div>
                </div>
                <div class="control-group col-md-2" >
                    <label class="control-label" >Função</label>
                    <div class="controls" >
                        <select class="form-control" name="funcaoRedeId" >
                            <option value=""></option>
                            <?php foreach ($funcoesRedes as $funcaoRede) : ?>
                                <option value="<?php echo $funcaoRede['id'] ; ?>" ><?php echo $funcaoRede['nome'] ; ?></option>
                            <?php endforeach ; ?>
                        </select>
                    </div>
                </div>
                <div class="control-group col-md-1" >
                    <label class="control-label" >Rede:</label>
                    <div class="controls" >
                        <select class="form-control" name="tipoRedeId" >
                            <option value=""></option>
                            <?php foreach ($tiposRedes as $tipoRede) : ?>
                                <option value="<?php echo $tipoRede->id ; ?>" ><?php echo $tipoRede->nome ; ?></option>
                            <?php endforeach ; ?>
                        </select>
                    </div>
                </div>
    </fieldset>
    <fieldset class="col-md-12">
        <div class="form-actions " >
            <button type="submit" class="btn btn-success" ><i class="icon-ok icon-white" ></i> Salvar</button>
            <a href="/discipulo/discipulo" class="" ><i class="icon-ban-circle" ></i>Cancelar</a>
        </div>
    </fieldset>
</form>
