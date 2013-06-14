<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <style type="text/css">
           @import url("../../../ext/twitter-bootstrap/bootstrap.css");
           @import url("../../../incluidos/css/estilo.css");
        </style>
        <script src="../../../ext/jquery/jquery-1.7.1.min.js"></script>
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
                    <form action = "/evento/atualizar" method = "post"  class = "form-inline">
                <fieldset>
                    <legend>Atualizar Escala de Êxito</legend>

                        <label>Nome:</label>
                        <input name = "nome"  value = "<?php echo $evento['nome'] ; ?>" >
                        <input type = "hidden" name = "id"  value = "<?php echo $evento['id'] ; ?>" >

                        <div class = "form-actions" >
                        <button type = "submit" class = "btn btn-primary " >Atualizar</button>
                        <a class = "btn btn-danger" href = "/evento"  >Cancelar</a>
                            </div>
                        </fieldset>

                    </form>

            </article>

        </section>

        </section>
    </body>

</html>
