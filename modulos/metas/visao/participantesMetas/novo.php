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
                <h1>Cadastrar meta:</h1>
                    <form class = "well form-horizontal" action = "/metas/participantesMetas/novo" method = "post">
                        <legend><?php echo $discipulo->nome ?></legend>
                        <input name = "discipuloId" type = "hidden" value = "<?php echo $discipulo->id ; ?>" >

                            <div class = "control-group">
                                <label class = "control-label" >Meta: </label>
                                <div class = "controls">
                            <select name = "metaId" >
                            <?php foreach ( $metas as $t ) :?>
                                <option  value = "<?php echo $t->id ; ?>" ><?php echo $t->nome?></option>
                            <?php endforeach ; ?>
                        </select>
                        </div>
                        </div>
                    <div class = "form-actions" >
                        <button class = "btn" type="submit">Salvar</button>
                    </div>
                    </form>
            </div>
            </article>

        </section>

        </section>
    </body>
</html>
