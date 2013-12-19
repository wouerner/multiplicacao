<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <?php include 'incluidos/css.inc.php' ; ?>
        <?php include 'incluidos/js.inc.php' ; ?>
    </head>
    <body>
        <section class = "container-fluid">
            <nav>
                <?php include 'modulos/menu/visao/menu.inc.php' ; ?>
            </nav>
        <section>
            <article>

                <?php require 'modulos/discipulo/visao/chamarDiscipulo.php' ; ?>

                <div class = "row-fluid" >
                    <form class = "well form-horizontal" action = "" method = "post">

                        <legend><?php echo $discipulo->nome ?></legend>
                        <input name = "discipuloId" type = "hidden" value = "<?php echo $discipuloId ; ?>" >

                            <div class = "control-group">
                                 <label class = "control-label" >Discipulo já é batizado</label>
                                <div class = "controls">
                                  <label class="radio">Sim
                                 <input name ="batismo" type = "radio" value = "1" checked></label>
                                  <label class="radio">Não
                                 <input name ="batismo" type = "radio" value = "0" ></label>
                              </div>
                            </div>

                    <div class="form-actions">
                        <button class = "btn" type="submit">Salvar</button>
                    </div>
                    </form>
            </div>
            </article>

        </section>

        </section>
    </body>
</html>
