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
                    <legend>Criar Estado Civil</legend>
                    <form action = "/discipulo/discipulo/novoEstadoCivil" method = "post"  class = "form-horizontal">
                <fieldset>
                        <div class = "control-group" >

                        <label class = "control-label" >Nome do Estado Civil:</label>
                        <div class = "controls" >
                            <input name = "nome" autofocus alt = "Nome" placeholder= "" required>
                        </div>
                        </div>

                        <div class = "form-actions" >
                        <a class = "btn" href = "/discipulo/listarEstadoCivil" ><i class = "icon-chevron-left" ></i></a>
                        <button type = "submit" class = "btn btn-success" >Criar</button>
                        <button type = "reset" class = "btn" >Limpar</button>
                        </div>
                        </div>
                </fieldset>
                    </form>

            </article>

        </section>

        </section>
    </body>

</html>
