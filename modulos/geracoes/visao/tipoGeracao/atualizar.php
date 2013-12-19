<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <?php include 'incluidos/css.inc.php' ?>
        <?php include 'incluidos/js.inc.php' ?>
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
                    <form method = "post"  class = "form-horizontal">
                      <input name="id"  type="hidden" value="<?php echo $tipo->id; ?>" >

                    <div class = "row" >
                      <fieldset class = "span6" >
                          <legend>Geração</legend>

                          <div class="control-group ">
                              <label class = "control-label" >Nome:</label>
                              <div class = "controls" >
                                  <input name = "nome"  value = "<?php echo $tipo->nome; ?>" >
                              </div>
                          </div>
                      </fieldset>

                      <fieldset class = "span12" >
                          <div class = "form-actions" >
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
