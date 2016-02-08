<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <?php include 'incluidos/css.inc.php' ?>
        <?php include 'incluidos/js.inc.php' ?>
        <script src="/modulos/discipulo/visao/js/combobox.js"></script>
        <script src="/modulos/discipulo/visao/js/comboboxCelula.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.full.min.js"></script>
        <link href='https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.css' rel='stylesheet' type='text/css'>


    </head>
    <body>
        <section class = "container-fluid">
        <header>
            <nav>
                <?php require 'modulos/menu/visao/menu.inc.php' ; ?>
            </nav>
        </header>
        <section>
            <article>
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h3 class="panel-title">Atualizar Célula</h3>
                  </div>
                  <div class="panel-body">
                    <form action="/celula/celula/atualizar" method="post"  class="form-horizontal">
                        <input type = "hidden" value="<?php echo $celula->id ; ?>" name = "id" >
                        <fieldset>
                            <div class="form-group" >
                                <div class="col-sm-offset-2 col-sm-10">
                                    <label class="" >
                                        <input type="checkbox" name = "ativa" value = "1" autofocus alt = "" placeholder= "" <?php echo $celula->ativa == 1 ? 'checked' : '' ; ?>> Ativa
                                    </label>
                                </div>
                            </div>
                            <div class="form-group" >
                                <div class="col-sm-offset-2 col-sm-10">
                                    <label class="">
                                        <input class="" type="checkbox" name="multiplicao" value="1" autofocus alt="" <?php echo $celula->multiplicacao == 1 ? 'checked' : '' ; ?>>Multipiplição:
                                    </label>
                                </div>
                            </div>

                        <div class = "form-group" >
                            <label class = "col-sm-2 control-label" >Nome:</label>
                                <div class="col-md-8">
                                    <input class="form-control" type="text" name="nome"  value="<?php echo $celula->nome; ?>">
                                </div>
                        </div>

                        <div class = "form-group" >
                            <label class = "control-label col-md-2" >Horario:</label>
                            <div class="col-md-4" >
                                <input type="text" class="form-control" name="horarioFuncionamento" value="<?php echo $celula->horarioFuncionamento ; ?>">
                            </div>
                        </div>
                        <div class = "form-group" >
                            <label class = "control-label col-md-2" >Endereço:</label>
                            <div class = "col-md-2" >
                                <input class="form-control" type="text" name="endereco" value="<?php echo $celula->endereco ; ?>">
                            </div>
                        </div>
                        <div class="form-group " >
                            <label class="control-label col-md-2" for="" >Tipo de Rede:</label>
                            <div class="col-md-6" >
                                <select class = "form-control" name="tipoRedeId"  >
                                    <option value="<?php echo $tipoRede->id; ?>"><?php echo $tipoRede->nome ; ?></option>
                                    <?php foreach($tiposRedes as $r) : ?>
                                        <option value="<?php echo $r->id; ?>"><?php echo $r->nome; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <?php if ($acesso->hasPermission('admin_acesso') == true): ?>
                            <div class="form-group " >
                                <div class="ui-widget">
                                    <label class = "control-label col-md-2" for = "lider" >Líder</label>
                                    <div class="col-md-10" >
                                        <select id = "combobox" class = "combobox lider form-control" name = "lider"  >
                                           <option value = "<?php echo $lider->id?>"><?php echo $lider->nome ?></option>
                                         <?php foreach($lideres as $lider) : ?>
                                           <option value = "<?php echo $lider['id']?>"><?php echo $lider['nome']?></option>
                                         <?php endforeach ; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        <?php else: ?>
                            <input name="lider" type="hidden" value = "<?php echo $lider->id?>">
                        <?php endif; ?>
                        <?php if ($acesso->hasPermission('admin_acesso') == true): ?>
                            <div class = "form-group " >
                                <div class="ui-widget" >
                                    <label class="control-label col-md-2" for="lider">Co-líder</label>
                                    <div class="col-md-4" >
                                         <select  class="colider form-control" name = "colider"  >
                                            <option value = "<?php echo $colider->id?>">
                                                <?php echo $colider->nome ?>
                                            </option>
                                            <?php foreach($lideres as $lider) : ?>
                                                <option value = "<?php echo $lider['id']?>">
                                                    <?php echo $lider['nome']?>
                                                </option>
                                            <?php endforeach ; ?>
                                         </select>
                                    </div>
                                </div>
                            </div>
                            <script>
                                jQuery(".colider").select2();
                            </script>
                        <?php else: ?>
                            <input name="lider" type="hidden" value = "<?php echo $lider->id?>">
                        <?php endif; ?>
                        <fieldset>
                        <button type = "submit" class = "btn btn-primary" >Salvar</button>
                        <a href = "/celula/celula"  class = "btn" >Cancelar</a>
                    </form>
                    </div>
                </div>
            </div>
            </article>
        </section>
        </section>
    </body>
</html>
