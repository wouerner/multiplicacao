<form id="form" action="/discipulo/discipulo/novoCompleto/igreja/<?php echo !empty($url['4'])? $url['4']: ''?>" method="post"  class="form-horizontal ">
    <fieldset class="col-md-6">
        <legend>Dados Pessoais</legend>
        <div class="form-group ">
            <label class="control-label col-md-3" for="nome" ><i class="icon-user" ></i> Igreja:</label>
            <div class="col-md-8">
                <select name="igreja">
                    <?php foreach($igrejas as $igreja): ?>
                    <option value="<?php echo $igreja->id?>">
                        <?php echo $igreja->nome?>
                    </option>
                    <?php endforeach ?>
                </select>
                <p class="help-block">(obrigatório)</p>
            </div>
        </div>
        <div class="form-group ">
            <label class="control-label col-md-3" for="nome" ><i class="icon-user" ></i> Nome:</label>
            <div class="col-md-8">
                <input id="nome" type="text" class="form-control" maxlength="45" name="nome" placeholder="Nome Completo" value="<?php echo $dados['nome']?>" required autofocus>
                <p class="help-block">(obrigatório)</p>
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
                <i class="icon-calendar" ></i> Nasc*.:
            </label>
            <div class="col-md-3" >
                <input id="dataNascimento" type="text" placeholder="dd/mm/aaaa" class="dataNascimento form-control" name="dataNascimento"  value="<?php echo $dados['dataNascimento']?>" required >
                <p class="help-block">(obrigatório)</p>
            </div>
        </div>
        <div class="form-group ">
            <label class="control-label col-md-3" for="sexo" >Sexo*:</label>
            <div class="col-md-3" >
                <select id="sexo" class="form-control " name="sexo" required >
                    <option value="m" >Masculino</option>
                    <option value="f" >Feminino</option>
                </select>
              <p class="help-block">(obrigatório)</p>
            </div>
        </div>
        <div class="form-group ">
            <label class="control-label col-md-3" for="estadoCivilId" >Estado Civil*:</label>
            <div class="col-md-3" >
                <select id="estadoCivilId" class="form-control" name="estadoCivilId" required >
                    <?php foreach($estadosCivies as $estadoCivil) : ?>
                        <option value="<?php echo $estadoCivil['id']?>"><?php echo $estadoCivil['nome']?> </option>
                    <?php endforeach ; ?>
                </select>
                <p class="help-block">(obrigatório)</p>
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
            <label class="control-label col-md-4" for="endereco" >Endereço*:</label>
            <div class="col-md-4" >
              <input id="endereco" type="text" maxlength="45" class="form-control" name="endereco" value="<?php echo $dados['endereco']?>" placeholder="" required >
              <p class="help-block">(obrigatório)</p>
            </div>
        </div>
        <div class="control-group " >
            <label class="control-label col-md-4" for="email" >E-mail*:</label>
            <div class="col-md-4" >
                <input id="email" class="form-control" maxlength="60" name="email" type="email" placeholder="exemplo@exemplo.com"  value="<?php echo $dados['email']?>" required>
              <p class="help-block">(obrigatório)</p>
            </div>
        </div>
    </fieldset>
    <fieldset class="col-md-12">
        <legend>Dados Ministériais</legend>
        <div class="form-group ">
            <label class="control-label " for="lider" >
                <i class="icon-user"></i> Líder:
            </label>
            <select id="lider" name="lider" >
                <?php foreach($lideres as $lider) : ?>
                    <option value="<?php echo $lider->id; ?>"><?php echo $lider->getAlcunha(); ?> </option>
                <?php endforeach ; ?>
            </select>
        </div>
        <div class="form-group" >
            <label class="control-label" for="celula">
                <i class="icon-home"></i> Célula:
            </label>
            <select id="celula" class="celula" name="celula" >
                <option value="" ></option>
                <?php foreach($celulas as $celula) : ?>
                    <option value="<?php echo $celula->id; ?>"><?php echo $celula->nome; ?> </option>
                <?php endforeach ; ?>
            </select>
        </div>
        <div class="form-group" >
            <label class="" >Status Celular:</label>
            <select class="form-control" name="tipoStatusCelular"  >
             <option value=""></option>
                <?php foreach ($tiposStatusCelulares as $tipoStatusCelular) : ?>
                    <option value="<?php echo $tipoStatusCelular->id ; ?>" >
                        <?php echo $tipoStatusCelular->nome ; ?>
                    </option>
                <?php endforeach ; ?>
            </select>
        </div>
        <div class="form-group" >
            <label class="control-label" >Admissão:</label>
            <select class="form-control" name="tipoAdmissao" id="tipoAdmissao">
                 <option value=""></option>
                  <?php foreach ($tiposAdmissoes as $tipoAdmissao) : ?>
                        <option value="<?php echo $tipoAdmissao['id'] ; ?>" >
                        <?php echo $tipoAdmissao['nome'] ; ?></option>
                  <?php endforeach ; ?>
            </select>
        </div>
        <div class="form-group" >
            <label class="control-label" >Função</label>
            <select class="form-control" name="funcaoRedeId" >
                <option value=""></option>
                <?php foreach ($funcoesRedes as $funcaoRede) : ?>
                    <option value="<?php echo $funcaoRede['id'] ; ?>" ><?php echo $funcaoRede['nome'] ; ?></option>
                <?php endforeach ; ?>
            </select>
        </div>
        <div class="form-group " >
            <label class="control-label" >Rede:</label>
            <select class="form-control" name="tipoRedeId" >
                <option value=""></option>
                <?php foreach ($tiposRedes as $tipoRede) : ?>
                    <option value="<?php echo $tipoRede->id ; ?>" ><?php echo $tipoRede->nome ; ?></option>
                <?php endforeach ; ?>
            </select>
        </div>
    </fieldset>
    <fieldset class="col-md-12">
        <div class="form-actions " >
            <button id="salvar" type="submit" class="btn btn-success" ><i class="icon-ok icon-white" ></i> Salvar</button>
            <a href="/discipulo/discipulo" class="" ><i class="icon-ban-circle" ></i>Cancelar</a>
        </div>
    </fieldset>
</form>
<div id="dialog" title="Salvar">
    Deseja Salvar?
</div>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<link href="https://raw.1githubusercontent.com/t0m/select2-bootstrap-css/bootstrap3/select2-bootstrap.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>
<script src="https://raw.githubusercontent.com/jzaefferer/jquery-validation/master/src/localization/messages_pt_BR.js"></script>
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
    jQuery("select").select2();

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
    jQuery("#form").validate();

    //jQuery("#salvar").on('click', function(){
      //jQuery( "#dialog" ).dialog({
              //modal: true,
              //buttons: {
                //"Delete all items": function() {
                  //$( this ).dialog( "close" );
                //},
                //Cancel: function() {
                  //$( this ).dialog( "close" );
                //}
              //}
          //} );
    //});
</script>
