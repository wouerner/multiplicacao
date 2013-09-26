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
            <?php include 'modulos/menu/visao/menu.inc.php' ; ?>
            </nav>

        </header>

        <section>
            <article>
                <fieldset>
                    <legend>Criar tipo de Admissão</legend>
                    <form action = "/admissao/admissao/novoTipoAdmissao" method = "post"  class = "form-inline">
                        <div class = "control-group" >
                                  <label>Nome:</label>
                                  <input name = "nome" autofocus alt = "Nome" placeholder= "Nome do Evento" required>
                        </div>
                        <div class ="form-actions" >
                        <button type = "submit" class = "btn btn-success" >Criar</button>
                        <a class = "btn btn-danger" href= "/admissao" >Cancelar</a>
                        </div>

                    </form>

                </fieldset>

            </article>

        </section>

        </section>
    </body>

</html>
