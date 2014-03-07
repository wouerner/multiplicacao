<?php
$mensagem = isset($_SESSION['mensagem']) ? $_SESSION['mensagem'] : NULL;
$_SESSION['mensagem'] = isset($_SESSION['mensagem']) ? NULL : NULL;
?>
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

        <section>
            <article>

                <?php require 'modulos/discipulo/visao/chamarDiscipulo.php' ; ?>

      <div class = "row-fluid" >
            <?php if ($mensagem) : ?>
            <div class = "<?php echo $mensagem['class']?>" >
                        <?php echo $mensagem['mensagem'] ; ?>
                </div>
            <?php endif ; ?>
     </div>

                <div class = "row-fluid" >
                        <table class = "table bordered-table">
                        <caption>
                        <h3>Equipe: <?php echo $equip->nome?> (<?php echo $total?>)</h3>
<h4><?php echo $equip->nomeEncontro ?></h4>
</caption>
<a class="btn" href="/encontroComDeus/preEquipe/index/id/<?php echo $equip->encontroId ?>" >Lista Pre Equipe</a>

<a class="btn btn-primary" href="/encontroComDeus/equipe/index/id/<?php echo $equip->encontroId ?>" >Listar Equipe</a>
                        <?php foreach ( $membros as $e) : ?>
                        <tr>
                            <td><?php echo  !isset($c) ? $c=1 : ++$c ; ?></td>
                            <td><a href="/discipulo/discipulo/detalhar/id/<?php echo $e->id ; ?>"><?php echo  $e->nome ?></a></td>
                            <td>

                <form method="post" action="/encontroComDeus/equipe/novoMembro" class="form-inline span5">
                    <input type="hidden" value="<?php echo $e->id?>" name="discipuloId">
                    <div class="control-group">
                        <div class="controls">
                        <select class="" name="equipeId">
                            <?php foreach($equipes as $eq ):?>
                                <option value="<?php echo $eq->id?>"><?php echo $eq->nome ?></option>
                            <?php endforeach; ?>
                        </select>
                        <button type="submit" class="btn">Salvar</button>
                        </div>
                    </div>
                </form>
                                <a class = "btn  btn-danger"  href="/encontroComDeus/equipe/excluirMembro/equipeId/<?php echo $equipe->id?>/discipuloId/<?php echo $e->id?>">
                                        <i class = "icon-remove - icon-white" ></i>Excluir</a>
                    </td>
                        </tr>

                        <?php endforeach ; ?>
                        </table>
            </div>
            </article>

        </section>

        </section>
    </body>
</html>
