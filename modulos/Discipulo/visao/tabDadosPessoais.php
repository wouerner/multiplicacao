<form class="form-horizontal" action="/discipulo/discipulo/atualizar" method="post"  accept-charset="UTF-8" >
    <input id="idDiscipulo" type="hidden"   value="<?php echo $discipulo->id ; ?>">
    <fieldset  class="col-sm-6">
        <legend>Dados Pessoais</legend>
        <div class="form-group ">
            <label class="control-label col-md-3" for="nome" ><i class="icon-user" ></i> Igreja:</label>
            <div class="col-md-8">
                <select name="igreja">
                    <?php foreach($igrejas as $igreja): ?>
                    <option <?php echo $discipulo->igreja == $igreja->id ? 'selected': null ?> value="<?php echo $igreja->id?>">
                        <?php echo $igreja->nome?>
                    </option>
                    <?php endforeach ?>
                </select>
                <p class="help-block">(obrigatório)</p>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3" for="nome" >Nome:</label>
            <div class="col-sm-8">
                <input id="nome" type="text" class="form-control" name="nome"  value="<?php echo $discipulo->nome ; ?>" required autofocus>
            </div>
        </div>
        <?php if ($acesso->hasPermission('admin_acesso') == true): ?>
            <div class="form-group">
                <label class="control-label col-md-3" for = "alcunha" >Alcunha:</label>
                <div class="col-sm-8">
                    <input id="nome" type="text" class="form-control form-control" name = "alcunha"  value = "<?php echo $discipulo->alcunha ; ?>">
                </div>
            </div>
        <?php endif ; ?>
        <div class="form-group">
            <label class="control-label col-sm-3" for="dataNascimento" >Data Nasc.:</label>
            <div class="col-sm-8">
                <input id="dataNascimento" type="text" class ="form-control dataNascimento" name="dataNascimento" value = "<?php echo $dataN ; ?>" required >
            </div>
        </div>
        <div class="form-group ">
            <label class="control-label col-md-3" for="sexo">Sexo:</label>
            <div class="col-sm-8">
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
        </div>
        <?php $estadoCivil = $discipulo->getEstatoCivil() ; ?>
        <div class="form-group">
            <label class="control-label col-md-3" for = "estadoCivilId" >Estado Civil:</label>
            <div class="col-sm-8">
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
    </fieldset>
    <fieldset  class="col-sm-6">
        <legend>Contato</legend>
        <div class="form-group ">
            <label class="control-label col-md-3" for = "telefone" >Telefone:</label>
            <div class="col-sm-8 ">
                <input id="telefone" class="form-control" type="tel" value="<?php echo $discipulo->telefone ; ?>"  maxlength="14"
                        pattern="\([0-9]{2}\) [0-9]{4}\-[0-9]{4}" placeholder="(00) 9999-9999" value="" name="telefone" id="telefone">
            </div>
        </div>
        <div class = "form-group" >
          <label class = "control-label col-md-3" for="endereco" >Endereço:</label>
            <div class="col-sm-8 ">
              <input id = "endereco" type = "text" class = "form-control" name = "endereco" value = "<?php echo $discipulo->endereco ; ?>" required >
            </div>
        </div>
        <div class = "form-group" >
            <label class="control-label col-md-3" for="email" >E-mail:</label>
            <div class="col-sm-8 ">
              <input id="email" class="form-control" name="email" type = "email" value = "<?php echo $discipulo->email ; ?>"  >
            </div>
        </div>
    </fieldset>
    <fieldset class="col-sm-12">
        <legend>Dados Ministériais</legend>
        <div class="form-group">
            <label class="control-label col-md-3" for="lider">Nome do Líder:</label>
            <div class="col-md-3" >
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
        <div class="form-group" >
            <label class = "control-label  col-md-3" for = "celula" >Célula que Participa:</label>
            <select id="comboboxCelula" class="comboboxCelula" name="celula">
                <?php if($celula): ?>
                    <option value = "<?php echo $celula->id ; ?>" ><?php echo $celula->nome ; ?></option>
                <?php endif; ?>
                <option>--------- </option>
                    <?php foreach($celulas as $celula) : ?>
                        <option value = "<?php echo $celula->id ; ?>"><?php echo $celula->nome ; ?> </option>
                    <?php endforeach ; ?>
            </select>
        </div>
        <div class = "form-group" >
            <label class = "control-label  col-md-3" ></strong>Atualizar Status:</label>
            <a class = "btn" href = "/statusCelular/statusCelular/novo/id/<?php  echo $discipulo->id ; ?>"  ><?php echo $status ['nome'] ; ?></a>
        </div>
        <?php $admissao = $discipulo->getAdmissao() ; ?>
        <div class="form-group ">
            <label class="control-label col-md-3" >Admissão:</label>
            <div class="col-md-8"  >
                <select class="form-control" name = "tipoAdmissao" >
                    <option value = "<?php echo $admissao['id'] ; ?>" ><?php echo $admissao['nome'] ; ?></option>
                    <option value = "" >-------------</option>
                    <?php foreach ($tiposAdmissoes as $tipoAdmissao) : ?>
                        <option value = "<?php echo $tipoAdmissao['id'] ; ?>" ><?php echo $tipoAdmissao['nome'] ; ?></option>
                    <?php endforeach ; ?>
                </select>
            </div>
        </div>
        <?php $rede = $discipulo->getRede() ; ?>
        <div class = "form-group" >
            <label class = "control-label col-md-3" ></strong>Função na Rede</label>
            <div class = "col-md-8" >
                <select class = "form-control" name = "funcaoRedeId" >
                    <option value = "<?php echo $rede[0]['funcaoId'] ; ?>" ><?php echo $rede[0]['funcaoRede']  ?></option>
                    <option value = "" >-------------</option>
                    <?php foreach ($funcaoRedes as $f) : ?>
                        <option value = "<?php echo $f['id'] ; ?>" ><?php echo $f['nome'] ; ?></option>
                    <?php endforeach ; ?>
                </select>
            </div>
        </div>
        <div class="form-group " >
            <label class="control-label col-md-3" >Rede:</label>
            <div class="col-md-8" >
                <select class="form-control" name = "tipoRedeId" >
                    <option value = "<?php echo $rede[0]['tpRedeId'] ; ?>" ><?php echo $rede[0]['tipoRede'] ; ?></option>
                    <option value = "" >-------------</option>
                    <?php foreach ($tiposRedes as $tipoRede) : ?>
                        <option value = "<?php echo $tipoRede->id ; ?>" ><?php echo $tipoRede->nome ; ?></option>
                    <?php endforeach ; ?>
                </select>
            </div>
        </div>
        <?php $mi = $discipulo->getMinisterio() ; ?>
        <div class="form-group ">
            <label class = "control-label col-md-3" >Ministério que Participa:</label>
            <div class = "col-md-8" >
                <select class = "form-control" name = "ministerio" >
                    <option value = "<?php echo !empty($mi) ? $mi[0]['ministerioId'] : null ; ?>" >
                        <?php echo !empty($mi) ? $mi[0]['ministerio']:null ; ?>
                    </option>
                    <?php foreach ($ministerio as $m) : ?>
                            <option value = "<?php echo $m['id'] ; ?>" ><?php echo $m['nome'] ; ?></option>
                    <?php endforeach ; ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class = "control-label col-md-3">Função no Ministério:</label>
            <div class="col-md-8">
                <select class = "form-control" name="fministerio" >
                    <option value = "<?php echo !empty($mi) ? $mi[0]['funcaoId']:null ; ?>" >
                        <?php echo !empty($mi) ? $mi[0]['funcao']: null ; ?>
                    </option>
                    <option value = "" >-------------</option>
                    <?php foreach ($funcaoMinisterio as $fMinisterio) : ?>
                        <option value = "<?php echo $fMinisterio['id'] ; ?>" ><?php echo $fMinisterio['nome'] ; ?></option>
                    <?php endforeach ; ?>
                </select>
            </div>
        </div>
    </fieldset>
    <fieldset class="col-md-12 " >
        <input type = "hidden" name = "discipuloId" value = "<?php echo $discipulo->id ; ?>" >
        <button type = "submit" class = "btn btn-success" ><i class = "icon-pencil icon-white" ></i> Salvar</button>
        <a class = "btn" href = "/encontroComDeus/participantesEncontro/fichaIndividual/id/<?php echo $discipulo->id ; ?>" target = "blank" >Ficha encontro</a>
        <a class = "btn" href = "/discipulo/discipulo/crachaIndividual/id/<?php echo $discipulo->id ; ?>" target = "blank" >cracha</a>
    </fieldset>
</form>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>
<script src="https://raw.githubusercontent.com/jzaefferer/jquery-validation/master/src/localization/messages_pt_BR.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.7.0/chosen.jquery.js"></script>
<style type="text/css">
    @import url("https://cdnjs.cloudflare.com/ajax/libs/chosen/1.7.0/chosen.min.css");
</style>
<script>
    /*
    * Translated default messages for the jQuery validation plugin.
    * Locale: PT_BR
    */
    jQuery.extend(jQuery.validator.messages, {
        required: "Este campo &eacute; requerido.",
        remote: "Por favor, corrija este campo.",
        email: "Por favor, forne&ccedil;a um endere&ccedil;o eletr&ocirc;nico v&aacute;lido.",
        url: "Por favor, forne&ccedil;a uma URL v&aacute;lida.",
        date: "Por favor, forne&ccedil;a uma data v&aacute;lida.",
        dateISO: "Por favor, forne&ccedil;a uma data v&aacute;lida (ISO).",
        number: "Por favor, forne&ccedil;a um n&uacute;mero v&aacute;lido.",
        digits: "Por favor, forne&ccedil;a somente d&iacute;gitos.",
        creditcard: "Por favor, forne&ccedil;a um cart&atilde;o de cr&eacute;dito v&aacute;lido.",
        equalTo: "Por favor, forne&ccedil;a o mesmo valor novamente.",
        accept: "Por favor, forne&ccedil;a um valor com uma extens&atilde;o v&aacute;lida.",
        maxlength: jQuery.validator.format("Por favor, forne&ccedil;a n&atilde;o mais que {0} caracteres."),
        minlength: jQuery.validator.format("Por favor, forne&ccedil;a ao menos {0} caracteres."),
        rangelength: jQuery.validator.format("Por favor, forne&ccedil;a um valor entre {0} e {1} caracteres de comprimento."),
        range: jQuery.validator.format("Por favor, forne&ccedil;a um valor entre {0} e {1}."),
        max: jQuery.validator.format("Por favor, forne&ccedil;a um valor menor ou igual a {0}."),
        min: jQuery.validator.format("Por favor, forne&ccedil;a um valor maior ou igual a {0}.")
    });

    jQuery.validator.setDefaults({
        highlight: function(element) {
            $(element).closest('.form-group').addClass('has-error');
        },
        unhighlight: function(element) {
            $(element).closest('.form-group').removeClass('has-error');
        },
        errorElement: 'span',
        errorClass: 'help-block',
        errorPlacement: function(error, element) {
            if(element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        },
    });

    $("select").chosen();

    jQuery("#form").validate(
    {
        rules: {
            nome: {
                required: true
            },
            dataNascimento: {
                required: true
            },
            email: {
                required: true
            },
            endereco: {
                required: true
            },
            lider: {
                required: true
            },
            celula: {
                required: true
            }
        }
    });
</script>
