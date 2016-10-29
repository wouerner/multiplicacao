<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <?php include 'incluidos/css.inc.php'?>
        <?php include 'incluidos/js.inc.php'?>
        <script src="/modulos/Discipulo/visao/js/combobox.js"></script>
    </head>

    <body>
        <section class = "container-fluid">
        <header>
            <nav>
            <?php include 'modulos/menu/visao/menu.inc.php' ; ?>
            </nav>

        </header>

        <section>
            <article>
            <div class = "well" >
                    <form action = "/celula/celula/novo" method = "post"  class = "form-horizontal">
                <fieldset>
                    <legend>Criar Célula</legend>

                    <div class = "control-group" >
                        <label class = "control-label" >Ativa:</label>
                        <div class = "controls" >
                        <input type = "checkbox" name = "ativa" autofocus alt = "" placeholder= "" required>
                        </div>
                    </div>

                    <div class = "control-group" >
                        <label class = "control-label" >Nome:</label>
                        <div class = "controls" >
                        <input type = "text" name = "nome" autofocus alt = "Nome" placeholder= "Nome da Célula" required>
                        </div>
                    </div>

                    <div class = "control-group" >
                        <label class = "control-label" >Horario:</label>
                        <div class = "controls" >
                        <input  type = "text" name = "horarioFuncionamento" >
                        </div>
                    </div>

                    <div class = "control-group" >
                        <label class = "control-label" >Endereço:</label>
                        <div class = "controls" >
                        <input  type = "text" name = "endereco" >
                        </div>
                    </div>

                         <div class = "control-group " >
                                 <label class = "control-label" for = "" >Tipo de Rede:</label>
                                <div class = "controls" >
                                 <select id = "" class = "span3" name = "tipoRedeId"  >
                                      <option value = ""></option>
                                        <?php foreach($tiposRedes as $r) : ?>
                                                <option value = "<?php echo $r->id ; ?>"><?php echo $r->nome ; ?></option>
                                      <?php endforeach ; ?>
                                 </select>
                            </div>
                         </div>

                         <div class = "control-group " >
                            <div class = "ui-widget" >
                                <label class = "control-label" for = "lider" >Líder</label>
                                <div class = "controls" >
                                 <select id = "combobox" class = "combobox lider span3" name = "lider"  >
                                      <option value = ""></option>
                                      <?php foreach($lideres as $lider) : ?><option value = "<?php echo $lider->id ; ?>"><?php echo $lider->nome ; ?></option>
                                      <?php endforeach ; ?>
                                 </select>
                            </div>
                         </div>
                         </div>

                        </div>
                    </div>

                        <div class = "form-actions" >
                        <button type = "submit" class = "btn btn-success" >Salvar</button>
                        <button type = "reset" class = "btn" >Cancelar</button>
                        </div>
                </div>
                </fieldset>
                    </form>

        </div>
            </article>

        </section>

        </section>
    </body>

</html>
