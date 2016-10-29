<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <?php include 'incluidos/css.inc.php' ?>
        <?php include 'incluidos/js.inc.php' ?>
        <script src="/modulos/Discipulo/visao/js/combobox.js"></script>
        <script src="/modulos/Discipulo/visao/js/comboboxCelula.js"></script>
    </head>
    <body>
        <section class = "container-fluid">
        <header>
            <nav>
                <?php require 'modulos/menu/visao/menu.inc.php' ; ?>
            </nav>
        </header>
        <section>
            <article>
                <div class = "well" >
                    <form action = "/celula/relatorio/atualizar" method = "post"  class = "form-horizontal">
                        <input type = "hidden" name="id"  value = "<?php echo $relatorio->id; ?>" >
                        <fieldset>
                            <legend>Atualizar Relatório</legend>
                            <div class = "control-group" >
                                <label class = "control-label" >Título:</label>
                                <div class = "controls" >
                                    <input type = "text" name="titulo"  value = "<?php echo $relatorio->titulo ; ?>" >
                                </div>
                            </div>
                            <div class = "control-group" >
                                <label class = "control-label" >Texto:</label>
                                <div class = "controls" >
                                    <textarea name="texto"><?php echo $relatorio->texto ; ?></textarea>
                                </div>
                            </div>
                            <div class = "form-actions" >
                                <button type = "submit" class = "btn btn-primary" >Salvar</button>
                                <a href = "/celula/celula"  class = "btn" >Cancelar</a>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
            </article>
        </section>
        </section>
    </body>
</html>
