<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <?php include 'incluidos/css.inc.php' ; ?>
        <?php include 'incluidos/js.inc.php' ; ?>
    </head>

    <body>
        <section class = "container-fluid">
        <header>
            <nav>
            <?php include 'modulos/menu/visao/menu.inc.php' ; ?>
            </nav>

        </header>

        <section>
            <article>
                <div class = "well" >
                    <form action = "/rede/novaFuncaoRede" method = "post"  class = "form-horizontal">
                    <legend>Nova Função</legend>
                <fieldset>
                        <div class = "control-group" >

                        <label class = "control-label" >Nome da Função:</label>
                        <div class = "controls" >
                            <input type="text" name = "nome" autofocus alt = "Nome" placeholder= "">
                        </div>
                        </div>

                        <div class = "form-actions" >
                        <button type = "submit" class = "btn btn-success" >Criar</button>
                        <button type = "reset" class = "btn" >Limpar</button>
                        </div>
                        </div>
                </fieldset>
                    </form>
            </div>

            </article>

        </section>

        </section>
    </body>

</html>
