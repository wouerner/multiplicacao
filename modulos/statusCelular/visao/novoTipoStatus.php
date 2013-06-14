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
            <?php include 'modulos/menu/visao/menu.inc.php' ; ?>
            </nav>

        </header>

        <section>
            <article>
                    <legend>Criar Tipo de Status Celular</legend>
                    <form action = "/statusCelular/novoTipoStatusCelular" method = "post"  class = "form-horizontal">
                <fieldset>
                        <div class = "control-group" >
                        <label class = "control-label" >Nome do Status:</label>
                        <div class = "controls" >
                            <input name = "nome" autofocus alt = "Nome" placeholder= "" required>
                        </div>
                        </div>

                        <div class = "control-group" >
                        <label class = "control-label" >Descrição:</label>
                        <div class = "controls" >
                            <textarea name = "descricao" alt = "descricao do StatusCelular" placeholder= "Descrição do StatusCelular " required></textarea>
                        </div>
                        </div>

                        <div class = "control-group" >
                        <label class = "control-label" >Ordem:</label>
                        <div class = "controls" >
                            <input name = "ordem" autofocus alt = "ordem do StatusCelular" placeholder= "" required>
                        </div>
                        </div>

                        <div class = "control-group" >
                        <label class = "control-label" >Cor:</label>
                        <div class = "controls" >
                            <input name = "cor" autofocus alt = "Cor do StatusCelular" placeholder= "" required>
                        </div>
                        </div>

                        <div class = "form-actions" >
                        <a class = "btn" href="/statusCelular/listarTipoStatusCelular"><i class = "icon-chevron-left" ></i></a>
                        <button type = "submit" class = "btn btn-success" >Salvar</button>
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
