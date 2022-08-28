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
                    <legend>Incluir Ministerio</legend>
                    <form action = "/ministerio/novo" method = "post"  class = "form-horizontal">
                <fieldset>

                        <h2><a href = "/discipulo/detalhar/id/<?php echo $discipulo['id']?>" ><?php echo $discipulo['nome']; ?></a></strong></h2>
                        <input type = "hidden" name = "discipuloId" value ="<?php echo $discipulo['id'] ; ?>" >

                        <div class = "control-group" >
                        <label class = "control-label" >Função</label>
                        <div class = "controls" >
                            <select name = "funcaoId" >
                                <?php foreach ($funcoes as $funcao) : ?>
                                    <option value = "<?php echo $funcao ['id'] ; ?>" ><?php echo $funcao['nome'] ; ?></option>
                                <?php endforeach ; ?>
                            </select>
                        </div>
                        </div>

                        <div class = "control-group" >
                        <label class = "control-label" >Ministério</label>
                        <div class = "controls" >
                            <select name = "ministerioId" >
                                <?php foreach ($ministerios as $ministerio) : ?>
                                    <option value = "<?php echo $ministerio ['id'] ; ?>" ><?php echo $ministerio['nome'] ; ?></option>
                                <?php endforeach ; ?>
                            </select>
                        </div>
                        </div>

                        <div class = "form-actions" >
                        <button type = "submit" class = "btn btn-primary" >Atualizar</button>
                        <button type = "reset" class = "btn" >Limpar</button>
                        </div>
                        </div>
                </fieldset>
                    </form>

                        <table class = "table" >
                                <?php foreach ($ministeriosDiscipulo as $ministerio) : ?>
                                    <tr>
                                        <td>
                                    <?php echo $ministerio['ministerio'] ; ?>
                                        </td>
                                        <td>
                                    <?php echo $ministerio['funcao'] ; ?>
                                        </td>
                                        <td>
                                        <a class = "btn btn-danger" href="/ministerio/excluir/id/<?php echo $ministerio['discipuloId'] ; ?>/<?php echo $ministerio['ministerioId']?>" >Excluir</a>
                                        </td>
                                    </tr>
                                <?php endforeach ; ?>
                        </table>

            </article>

        </section>

        </section>
    </body>

</html>
