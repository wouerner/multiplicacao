<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <?php include 'incluidos/css.inc.php' ; ?>
        <?php include 'incluidos/js.inc.php' ; ?>
    </head>

    <body>
        <section class = "container">
        <header>
            <nav>
                <?php require 'modulos/menu/visao/menu.inc.php' ; ?>
            </nav>
        </header>

        <section>
            <article>
                    <form action = "/discipulo/atualizarEstadoCivil" method = "post"  class = "form-horizontal">

                    <div class = "row" >
                              <fieldset class = "span6" >
                                  <legend>Atualizar Estado Civil</legend>

                              <div class="control-group ">
                                  <label class = "control-label" >Nome:</label>
                                  <div class = "controls" >
                                      <input name = "nome"  value = "<?php echo $estadoCivil->nome ; ?>" required >
                                  </div>
                                  </div>

                                  <input type = "hidden" name = "id" value = "<?php echo $estadoCivil->id ?>">

                              </fieldset>

                              <fieldset class = "span12" >
                                      <div class = "form-actions" >
                                            <a class = "btn" href = "/discipulo/listarEstadoCivil" ><i class = "icon-chevron-left" ></i></a>
                                          <button type = "submit" class = "btn btn-primary" >Atualizar</button>
                                          <button type = "reset" class = "btn" >Cancelar</button>
                                  </div>
                              </fieldset>

                    </div>

                    </form>

            </article>

        </section>

        </section>
    </body>

</html>
