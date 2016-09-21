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
                <caption><h3>Orações Privadas</h3></caption>
                <?php foreach ($oracoesPrivadas as $oracao): ?>
                    <tr>
                    <td>
                        <?php echo $oracao->getDiscipulo()->nome?>
                    </td>
                        <td>
                            <?php echo $oracao->texto?>
                        </td>
                        <td>
                            <a class="btn btn-danger" href="/oracao/oracao/excluir/id/<?php echo $oracao->id?>">excluir</a>
                        </td>
                    </tr>
                <?php endforeach?>
                </table>
            <?php endif ?>

            <table class="table">
            <caption><h3>Orações Publicas</h3></caption>
            <?php foreach ($oracoesPublicas as $oracao):?>
                <tr>
                    <td>
                        <?php echo $oracao->getDiscipulo()->nome?>
                    </td>
                    <td>
                        <?php echo $oracao->texto?>
                    </td>
                <?php if ($acl->hasPermission('intercessao')==true): ?>
                        <td>
                            <a  class="btn btn-danger" href="/oracao/oracao/excluir/id/<?php echo $oracao->id?>">excluir</a>
                        </td>
                <?php endif ?>
                </tr>
            <?php endforeach?>
            </table>
        </section>
    </body>
</html>

