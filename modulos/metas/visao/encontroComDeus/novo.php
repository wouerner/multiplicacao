<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <?php include 'incluidos/css.inc.php' ; ?>
        <?php include 'incluidos/js.inc.php' ; ?>
        <script>
        $(function() {

                  $( ".data" ).datepicker();
        });
        </script>
    </head>

    <body>
        <section class = "container-fluid">
        <header>
            <navo>
            <?php include 'modulos/menu/visao/menu.inc.php' ; ?>
            </nav>

        </header>

        <section>
            <article>
                <form action = "/encontroComDeus/encontroComDeus/novo" method = "post"  class = "form-horizontal">
                    <legend>Nova Equipe </legend>
                    <fieldset>

                        <div class = "control-group" >
                        <label class = "control-label" >Nome: </label>
                        <div class = "controls" >
                            <input name = "nome" type = "text" autofocus alt = "Nome" placeholder= "">
                        </div>
                        </div>

                        <div class = "control-group" >
                        <label class = "control-label" >Data: </label>
                        <div class = "controls" >
                            <input class = "data" name = "dataEncontroComDeus" type = "text" autofocus alt = "Nome" placeholder= "">
                        </div>
                        </div>

                        <label class = "control-label" >Endereço: </label>
                        <div class = "controls" >
                            <input name = "endereco" type = "text" autofocus alt = "Nome" placeholder= "">
                        </div>
                        </div>

                        <div class = "form-actions" >
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
