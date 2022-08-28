<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <?php include 'incluidos/css.inc.php' ; ?>
        <?php include 'incluidos/js.inc.php' ; ?>
    </head>

    <body>
        <section class = "container-fluid">

        <nav>
            <?php include 'modulos/menu/visao/menu.inc.php' ; ?>
        </nav>

        <header>

        </header>

        <section>
            <article>

            <?php require 'modulos/Discipulo/visao/chamarDiscipulo.php' ; ?>
            <div class = "well" >
            <table>
                <caption><h3>Detalhes do Discipulos</h3></caption>

                <tr><td colspan = "2" ><h2><?php echo $discipulo['nome'] ; ?> </h2></td></tr>
                <tr><td>Telefone:<?php echo $discipulo['telefone'] ; ?></td>
                     <td>E-mail:<?php echo $discipulo['email'] ; ?></td>
                </tr>

                <tr><td colspan = "2" >Endereço: <?php  echo $discipulo['endereco'] ; ?></td></tr>
                    <?php require 'Discipulo/visao/menuDiscipulo.inc.php' ; ?>
                </table>
            </div>

            </article>

        </section>

        </section>
    </body>
</html>
