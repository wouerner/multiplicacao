<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <?php include 'incluidos/css.inc.php' ; ?>
        <?php include 'incluidos/js.inc.php' ; ?>
        <script>
            $(function() {
        $( ".data" ).datepicker({showWeek:true});
      });
    </script>
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
                    <form action = "/metas/intervaloMetas/novo" method = "post"  class = "form-horizontal">
                    <legend> Novo Intervalo de  Meta</legend>
                <fieldset>
                        <div class = "control-group" >
                        <label class = "control-label" >Nome da Meta:</label>
                        <div class = "controls" >
                            <input name = "nome" type = "text" autofocus alt = "Nome" placeholder= "">
                        </div>
                        </div>

                        <div class = "control-group" >
                        <label class = "control-label" >Inicio da meta:</label>
                        <div class = "controls" >
                            <input class = "data" name = "dataInicio" type = "text" autofocus alt = "Nome" placeholder= "">
                        </div>
                        </div>

                        <div class = "control-group" >
                        <label class = "control-label" >Fim da meta:</label>
                        <div class = "controls" >
                            <input class = "data" name = "dataFim" type = "text" autofocus alt = "Nome" placeholder= "">
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
