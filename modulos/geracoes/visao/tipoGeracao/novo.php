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
                <form class = "well form-horizontal"  method="post">
                    <legend>Novo Tipo de Geração</legend>
                    <div class = "control-group">
                        <div class = "controls">
                          <label class="control-label">Nome</label>
                         <input name="nome" type="text" >
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
