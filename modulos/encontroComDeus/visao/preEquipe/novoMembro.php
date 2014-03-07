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
                    <form class = "well form-vertical" action = "/encontroComDeus/preEquipe/novoMembro" method = "post">
                        <input name = "discipuloId" type = "hidden" value = "<?php echo $id ; ?>" >
                        <legend>Pre-Equipe de Encontreiros: <?php echo $discipulo->nome ?></legend>
                            <div class = "control-group">
                                <label class = "control-label" >Em qual encontro vai trabalhar?</label>
                                <div class = "controls">
                            <select name = "encontroId" class = "" >
                            <?php foreach ( $encontro as $t ) :?>
                            <option  value = "<?php echo $t->id ; ?>" ><?php echo $t->nome?> </option>
                            <?php endforeach ; ?>
                        </select>
                        </div>
                        </div>

                    <button class = "btn" type="submit">Salvar</button>
                    </form>
            </div>
            </article>

        </section>

        </section>
    </body>
</html>
