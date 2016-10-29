<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <style type="text/css">
           @import url("../../../ext/twitter-bootstrap/bootstrap.css");
           @import url("../../../incluidos/css/estilo.css");
        </style>

        <script src="../../../ext/jquery/jquery-1.7.1.min.js"></script>
        <script src="../../../ext/jquery/jquery.maskedinput.js"></script>
        <script src="../modulos/Discipulo/visao/js/novo.js"></script>
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

            <?php if (isset($mensagem)) : ?>
                    <div class="alert <?php echo ($mensagem=='ok') ? 'alert-success' : 'alert-error' ; ?>">
                      <h4 class="alert-heading">
                        <?php echo $mensagem ?>!
                    </h4>
                   </div>
                <?php endif ; ?>

                    <form action = "/discipulo/novo" method = "post"  class = "form-horizontal">
                <fieldset>
                    <legend>Criar Discipulo</legend>
                        <div class = "control-group" >
                            <label class = "control-label" >Nome:</label>
                            <div class = "controls" >
                            <input name = "nome" alt = "Nome" placeholder= "Nome completo" value = "<?php echo isset($post['nome']) ? $post['nome'] : '' ?>" autofocus required >
                                <p class="help-inline">Digite o nome completo.</p>
                            </div>
                        </div>

                        <div class = "control-group" >
                            <label class = "control-label" >Telefone:</label>
                            <div class = "controls" >
                                <input class = "span2" id = "telefone" name = "telefone" type = "tel"
                                    value = "<?php echo isset($post['telefone']) ? $post['telefone'] : '' ?>"
                                    placeholder= "(00)9999-9999" pattern="\([0-9]{2}\) [0-9]{4}\-[0-9]{4}" maxlength="14"  required >
                                <p class="help-inline">Digite o telefone com DDD</p>
                            </div>
                        </div>

                        <div class = "control-group" >
                        <label class = "control-label" >Endereço:</label>
                        <div class = "controls" >
                        <input name = "endereco"  value = "<?php echo isset($post['endereco']) ? $post['endereco'] : '' ?>" required >
                                <p class="help-inline">Digite o Endereço Completo.</p>
                        </div>
                        </div>

                        <div class = "control-group" >
                        <label class = "control-label" >E-mail:</label>
                        <div class = "controls" >
                                <input name = "email" type = "email" placeholder= "teste@teste.br" required>
                                <p class="help-inline">Digite o E-mail.</p>
                        </div>
                        </div>

                        <div class = "control-group" >
                        <label class = "control-label" >Senha:</label>
                        <div class = "controls" >
                        <input name = "senha" type = "password" required >
                                <p class="help-inline">Digite a senha para acesso ao sistema.</p>
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
