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
                    <form class = "well form-horizontal" action = "/encontroComDeus/participantesEncontro/novoParticipante" method = "post">
                        <legend><?php echo $discipulo->nome ; ?></legend>
                        <input type = "hidden" name = "id" value = "<?php echo $discipulo->id ; ?>" >
                        <label>Encontro com Deus: </label>
                        <select name = "encontroId" >
                        <?php foreach ( $encontro as $e) : ?>

                        <option value = "<?php echo $e->id?>" ><?php echo $e->nome ; ?>	</option>
                        <?php endforeach ; ?>
                        </select>
                    <button class = "btn" type="submit"><i class = "icon-plus" ></i> Cadastrar</button>

                    </form>
            </div>
            </article>

        </section>

        </section>
    </body>
</html>
