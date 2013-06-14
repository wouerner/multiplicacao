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
                    <form action = "/statusCelular/atualizarTipoStatusCelular" method = "post"  class = "form-horizontal">

                    <div class = "row" >
                              <fieldset class = "span6" >
                                  <legend>Atualizar Tipo de Status</legend>

                              <div class="control-group ">
                                  <label class = "control-label" >Nome:</label>
                                  <div class = "controls" >
                                      <input name = "nome"  value = "<?php echo $tipoStatusCelular->nome ; ?>" required >
                                  </div>
                                  </div>

                                <div class = "control-group" >
                                    <label class = "control-label" >Descrição:</label>
                                    <div class = "controls" >
                                        <textarea name = "descricao" alt = "descricao do StatusCelular" placeholder= "Descrição do StatusCelular " required><?php echo $tipoStatusCelular->descricao?></textarea>
                                    </div>
                                </div>

                              <div class="control-group ">
                                  <label class = "control-label" >ordem:</label>
                                  <div class = "controls" >
                                      <input name = "ordem"  value = "<?php echo $tipoStatusCelular->ordem ; ?>" required >
                                  </div>
                                  </div>

                              <div class="control-group ">
                                  <label class = "control-label" >cor:</label>
                                  <div class = "controls" >
                                      <input name = "cor"  value = "<?php echo $tipoStatusCelular->cor ; ?>" required >
                                  </div>
                                  </div>
                                  <input type = "hidden" name = "id" value = "<?php echo $tipoStatusCelular->id ?>">

                              </fieldset>

                              <fieldset class = "span12" >
                                      <div class = "form-actions" >
                                        <a href="/statusCelular/listarTipoStatusCelular" class = "btn" ><i class = "icon-chevron-left" ></i></a>
                                          <button type = "submit" class = "btn btn-success" >Salvar</button>
                                  </div>
                              </fieldset>

                    </div>

                    </form>

            </article>

        </section>

        </section>
    </body>

</html>
