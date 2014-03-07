<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <?php include 'incluidos/css.inc.php' ?>
        <?php include 'incluidos/js.inc.php' ?>
        <script src="/modulos/discipulo/visao/js/combobox.js"></script>
        <script src="/modulos/discipulo/visao/js/comboboxCelula.js"></script>
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

                <div class = "well" >
                <fieldset>
                    <legend>Atualizar Célula</legend>
                    <form action = "/celula/celula/atualizar" method = "post"  class = "form-horizontal">

                    <div class = "control-group" >
                        <label class = "control-label" >Ativa:</label>
                        <div class = "controls" >
                        <input type = "checkbox" name = "ativa" value = "1" autofocus alt = "" placeholder= "" <?php echo $celula->ativa == 1 ? 'checked' : '' ; ?>>
                        </div>
                    </div>

                        <div class = "control-group" >
                        <label class = "control-label" >Nome:</label>
                        <div class = "controls" >
                        <input type = "text" name = "nome"  value = "<?php echo $celula->nome ; ?>" >
                        </div>
                        </div>

                        <div class = "control-group" >
                        <label class = "control-label" >Horario:</label>
                        <div class = "controls" >
                        <input type = "text" name = "horarioFuncionamento" value = "<?php echo $celula->horarioFuncionamento ; ?>">
                        </div>
                        </div>

                        <div class = "control-group" >
                        <label class = "control-label" >Endereço:</label>
                        <div class = "controls" >
                        <input type = "text" name = "endereco" value = "<?php echo $celula->endereco ; ?>">
                        </div>
                        </div>

                         <div class = "control-group " >
                                 <label class = "control-label" for = "" >Tipo de Rede:</label>
                                <div class = "controls" >
                                 <select id = "" class = "span3" name = "tipoRedeId"  >
                                 <option value = "<?php echo $tipoRede->id ; ?>"><?php echo $tipoRede->nome ; ?></option>
                                        <?php foreach($tiposRedes as $r) : ?>
                                                <option value = "<?php echo $r->id ; ?>"><?php echo $r->nome ; ?></option>
                                      <?php endforeach ; ?>
                                 </select>
                            </div>
                         </div>

                        <?php if ($acesso->hasPermission('admin_acesso') == true): ?>
                             <div class = "control-group " >
                                <div class = "ui-widget" >
                                     <label class = "control-label" for = "lider" >Líder</label>
                                     <div class = "controls" >
                                         <select id = "combobox" class = "combobox lider span3" name = "lider"  >
                                        <option value = "<?php echo $lider->id?>"><?php echo $lider->nome ?></option>
                                      <?php foreach($lideres as $lider) : ?><option value = "<?php echo $lider['id']?>"><?php echo $lider['nome']?></option>
                                      <?php endforeach ; ?>

                                 </select>
                            </div>
                         </div>
                         </div>
                        <?php else: ?>
                            <input name="lider" type="hidden" value = "<?php echo $lider->id?>">
                        <?php endif; ?>

                        </select>
                        </div>
                        </div>

                            <input type = "hidden" value="<?php echo $celula->id ; ?>" name = "id" >

                        <div class = "form-actions" >
                        <button type = "submit" class = "btn btn-primary" >Salvar</button>
                        <a href = "/celula/celula"  class = "btn" >Cancelar</a>
                        </div>

                    </form>

                </fieldset>
            </div>
            </article>

        </section>

        </section>
    </body>

</html>
