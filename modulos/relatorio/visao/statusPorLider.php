<?php
$mensagem = isset($_SESSION['mensagem']) ? $_SESSION['mensagem'] : NULL ;
unset($_SESSION['mensagem']) ;

?>

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

        <header>

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
        <h4>Status Por Lider dos Discipulos</h4>
            <form class = "well" method = "post" action = "/relatorio/relatorio/statusPorLider">
                <fieldset>

                    <select name = "statusCelularId" >
                        <?php foreach ( $tiposStatus as $ts ) : ?>
                            <option value = "<?php echo $ts->id ; ?>"> <?php echo $ts->nome ; ?></option>
                        <?php endforeach ; ?>
                    </select>

                    <select name = "liderId" >
                        <?php foreach ( $lideres as $l ) : ?>
                            <option value = "<?php echo $l['id'] ; ?>"> <?php echo $l['nome'] ; ?></option>
                        <?php endforeach ; ?>
                    </select>
                    <button class = "btn" type = "submit">Gerar</button>
                </fieldset>
            </form>

            <?php if ($relatorio) : ?>
                <table class = "table" >
                <tbody>
                <?php foreach ($relatorio as $r ) : ?>
                    <tr class= " <?php  switch ($r['situacao']) { case 1 : echo 'success';break; case 2 :echo 'warning';break;  case 3 : echo 'error'; break; } ; ?>" >
                    <td> <a href="/discipulo/discipulo/detalhar/id/<?php echo $r['id']?>" ><?php echo !isset ($c)?$c=1 : ++$c  ; ?> - <?php echo $r['nome']?></td> <td><?php $total += $r['total'] ; echo $r['total'] ; ?></a></td>
                </tr>
                <?php endforeach ; ?>
                    <tr><td>total </td><td><?php echo $total ; ?></td></tr>
                </tbody>

                </table>
            <?php endif ; ?>

            </article>

        </section>

        </section>
    </body>
</html>
