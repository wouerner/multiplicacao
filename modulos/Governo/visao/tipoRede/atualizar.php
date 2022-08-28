<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <?php include 'incluidos/css.inc.php' ; ?>
        <?php include 'incluidos/js.inc.php' ; ?>
    </head>
    <body>
        <section class="container-fluid">
        <header>
            <nav>
                <?php require 'modulos/menu/visao/menu.inc.php' ; ?>
            </nav>
        </header>
        <section>
            <article>
                <form action="/governo/governo/atualizar" method="post"  class="form-horizontal">
                    <div class="row" >
                        <fieldset class="span6" >
                            <legend>Atualizar Governo</legend>
                            <div class="control-group">
                                <label class="control-label">Nome:</label>
                                <div class="controls" >
                                    <input name="nome" value="<?php echo $governo->nome; ?>" required >
                                </div>
                            </div>
                            <input type="hidden" name="id" value="<?php echo $governo->id;?>">
                        </fieldset>
                        <fieldset class="span12" >
                            <div class="form-actions" >
                                <a class="btn" href="/rede/rede/listarTipoRede" ><i class=" icon-chevron-left" ></i></a>
                                <button type="submit" class="btn btn-primary" >Atualizar</button>
                            </div>
                        </fieldset>
                    </div>
                </form>
            </article>
        </section>
        </section>
    </body>
</html>
