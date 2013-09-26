<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <?php include 'incluidos/css.inc.php' ; ?>
        <?php include 'incluidos/js.inc.php' ; ?>
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
                    <form action = "/admissao/atualizarTipoAdmissao" method = "post"  class = "form-inline">
                <fieldset>
                    <legend>Atualizar Evento</legend>

                        <label>Nome:</label>
                        <input name = "nome"  value = "<?php echo $tipoAdmissao['nome'] ; ?>" >
                        <input type = "hidden" name = "id"  value = "<?php echo $tipoAdmissao['id'] ; ?>" >

                        <div class = "form-actions" >
                        <a class = "btn" href = "/admissao/listarTipoAdmissao"  ><i class = "icon-chevron-left" ></i></a>
                        <button type = "submit" class = "btn btn-primary " >Atualizar</button>
                            </div>
                        </fieldset>

                    </form>

            </article>

        </section>

        </section>
    </body>

</html>
