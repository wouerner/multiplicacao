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
                    <form class = "well form-horizontal" action = "/encontroComDeus/equipe/novoMembro" method = "post">
                        <input name = "discipuloId" type = "hidden" value = "<?php echo $id ; ?>" >
                        <legend>Equipe encontro: <?php echo $discipulo->nome ?></legend>
                            <div class = "control-group">
                                <label class = "control-label" >Equipe: </label>
                                <div class = "controls">
                            <select name = "equipeId" class = "span5" >
                            <?php foreach ( $equipes as $t ) :?>
                            <option  value = "<?php echo $t->id ; ?>" ><?php echo $t->nome?> - <?php echo $t->encontroNome ?></option>
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
