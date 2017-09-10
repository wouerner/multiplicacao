<form id="form" action="/discipulo/discipulo/novoCompleto/igreja/<?php echo !empty($url['4'])? $url['4']: ''?>" method="post"  class="form-horizontal ">
    <fieldset class="col-md-6">
        <legend>Dados Pessoais</legend>
        <div class="form-group ">
            <label class="control-label col-md-3" for="nome" ><i class="icon-user" ></i> Igreja:</label>
            <div class="col-md-8">
                <select class="form-control" name="igreja">
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
                <input id="nome" type="text" class="form-control" maxlength="45" name="nome" placeholder="Nome Completo" value="<?php echo $dados['nome']?>"  autofocus>
                <p class="help-block">(obrigatório)</p>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3" for="dataNascimento" >
                <i class="icon-calendar" ></i> Nasc*.:
            </label>
            <div class="col-md-3" >
                <input id="dataNascimento" type="text" placeholder="dd/mm/aaaa" class="dataNascimento form-control" name="dataNascimento"  value="<?php echo $dados['dataNascimento']?>"  >
                <p class="help-block">(obrigatório)</p>
            </div>
        </div>
        <div class="form-group ">
            <label class="control-label col-md-3" for="sexo" >Sexo*:</label>
            <div class="col-md-3" >
                <select id="sexo" class="form-control " name="sexo"  >
                    <option value="m" >Masculino</option>
                    <option value="f" >Feminino</option>
                </select>
              <p class="help-block">(obrigatório)</p>
            </div>
        </div>
        <div class="form-group ">
            <label class="control-label col-md-3" for="estadoCivilId" >Estado Civil*:</label>
            <div class="col-md-3" >
                <select id="estadoCivilId" class="form-control" name="estadoCivilId"  >
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
                <input id="telefone" class="form-control" type="tel" value="<?php echo $dados['telefone']?>"  maxlength="15"
                    pattern="\([0-9]{2}\) [0-9]{5}\-[0-9]{4}" placeholder="(00) 9999-9999" value="" name="telefone" id="telefone">
            </div>
        </div>
        <div class="form-group" >
            <label class="control-label col-md-4" for="endereco" >Endereço*:</label>
            <div class="col-md-4" >
              <input id="endereco" type="text" maxlength="45" class="form-control" name="endereco" value="<?php echo $dados['endereco']?>" placeholder=""  >
              <p class="help-block">(obrigatório)</p>
            </div>
        </div>
    </fieldset>
    <fieldset class="col-md-12">
        <legend>Dados Ministériais</legend>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label col-md-3" for="lider" >
                        <i class="icon-user"></i> Líder:
                    </label>
                    <div class="col-md-9">
                        <select data-placeholder="Lider" class="form-control" id="lider" name="lider" >
                            <?php foreach($lideres as $lider) : ?>
                                <option value="<?php echo $lider->id; ?>">
                                    <?php echo $lider->getAlcunha(); ?>
                                </option>
                            <?php endforeach ; ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group " >
                    <label class="col-md-3 control-label" for="celula">
                        <i class="icon-home"></i> Célula:
                    </label>
                    <div class="col-md-9">
                        <select  data-placeholder="Selecione" id="celula" class="form-control" name="celula" >
                            <option value="" ></option>
                            <?php foreach($celulas as $celula) : ?>
                                <option value="<?php echo $celula->id; ?>"><?php echo $celula->nome; ?> </option>
                            <?php endforeach ; ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group" >
                    <label class="col-md-3 control-label">Status Celular:</label>
                    <div class="col-md-9">
                        <select  data-placeholder="Selecione" class="form-control" name="tipoStatusCelular"  >
                             <option value=""></option>
                            <?php foreach ($tiposStatusCelulares as $tipoStatusCelular) : ?>
                                <option value="<?php echo $tipoStatusCelular->id ; ?>" >
                                    <?php echo $tipoStatusCelular->nome ; ?>
                                </option>
                            <?php endforeach ; ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group" >
                    <label class="col-md-3 control-label" >Admissão:</label>
                    <div class="col-md-9" >
                        <select data-placeholder="Selecione" class="form-control" name="tipoAdmissao" id="tipoAdmissao">
                             <option value=""></option>
                              <?php foreach ($tiposAdmissoes as $tipoAdmissao) : ?>
                                    <option value="<?php echo $tipoAdmissao['id'] ; ?>" >
                                    <?php echo $tipoAdmissao['nome'] ; ?></option>
                              <?php endforeach ; ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
        </div>
    </fieldset>
    <fieldset class="col-md-12">
        <div class="form-actions text-center" >
            <button id="salvar" type="submit" class="btn btn-success" ><i class="icon-ok icon-white" ></i> Salvar</button>
            <a href="/discipulo/discipulo" class="" ><i class="icon-ban-circle" ></i>Cancelar</a>
        </div>
    </fieldset>
</form>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>
<!--script src="https://raw.githubusercontent.com/jzaefferer/jquery-validation/master/src/localization/messages_pt_BR.js"></script-->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.js"></script>

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

   jQuery("#dataNascimento").mask("99/99/9999");
   jQuery("#telefone").mask("(99) 99999-9999");

</script>
