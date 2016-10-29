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
            <?php require 'modulos/Discipulo/visao/chamarDiscipulo.php' ; ?>
            <div class = "row-fluid" >
                <form class = "well form-horizontal"  method="post">
                 <input name="discipuloId" type="hidden" value="<?php echo $discipulo->id?>">
                <legend>Geração <?php echo $discipulo->nome ?></legend>
                    <div class = "control-group">
                        <div class = "controls">
                          <label class="control-label">Geração:</label>
                        <select name="tipoGeracao" >
                            <?php foreach($tipos as $t ):?>
                                <option value="<?php echo $t->id?>"><?php echo $t->nome?></option>
                            <?php endforeach; ?>
                        </select>
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
