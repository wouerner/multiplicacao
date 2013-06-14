<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <?php include 'incluidos/css.inc.php' ?>
        <?php include 'incluidos/js.inc.php' ?>
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

            <?php if (isset($mensagem)) : ?>
                    <div class="alert <?php echo ($mensagem=='ok') ? 'alert-success' : 'alert-error' ; ?>">
                      <h4 class="alert-heading">
                        <?php echo $mensagem ?>!
                    </h4>
                   </div>
                <?php endif ; ?>

                    <form action = "/discipulo/foto/novo" method = "post"  class = "form-horizontal" enctype="multipart/form-data" >
                        <input name = "discipuloId" type = "hidden" value = "<?php echo $discipuloId ; ?>" >
                <fieldset>
                    <legend>Foto para o perfil</legend>
                        <div class = "control-group" >
                            <label class = "control-label" >Arquivo:</label>
                            <div class = "controls" >
                            <input name = "arquivo" alt = "Nome" type = "file" required >
                            </div>
                        </div>

                        <div class = "form-actions" >
                        <button type = "submit" class = "btn btn-success" >Criar</button>
                        <button type = "reset" class = "btn" >Limpar</button>
                        </div>
                        </div>
                </fieldset>
                    </form>

            </article>

        </section>

        </section>
    </body>

</html>
