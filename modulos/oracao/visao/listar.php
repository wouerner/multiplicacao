<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <?php include 'incluidos/css.inc.php' ?>
        <?php include 'incluidos/js.inc.php' ?>
    </head>
    <body>
        <section class = "container-fluid">
            <nav>
                <?php include 'modulos/menu/visao/menu.inc.php' ; ?>
            </nav>
            <?php if ($acl->hasPermission('intercessao')==true): ?>
                <table class="table">
                <caption>Orações Privadas</caption>
                <?php foreach ($oracoesPrivadas as $oracao): ?>
                    <tr>
                        <td>
                            <?php echo $oracao->texto?>
                        </td>
                    </tr>
                <?php endforeach?>
                </table>
            <?php endif ?>

            <table class="table">
            <caption>Orações Publicas</caption>
            <?php foreach ($oracoesPublicas as $oracao):?>
                <tr>
                    <td>
                        <?php echo $oracao->texto?>
                    </td>
                </tr>
            <?php endforeach?>
            </table>
        </section>
    </body>
</html>

