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

            <form class = "well" method = "post" action = "/celula/celula/statusPorLiderCelula">
                <fieldset>
                    <select name = "statusId" >
                        <?php foreach ( $tipoStatus as $ts ) : ?>
                            <option value = "<?php echo $ts->id ; ?>"> <?php echo $ts->nome ; ?></option>
                        <?php endforeach ; ?>
                    </select>
                    <button class = "btn" type = "submit">Gerar</button>
                </fieldset>
            </form>

<ul class="nav nav-tabs" id="myTab">
    <li class="active" ><a data-toggle="tab" href="#com">Com</a></li>
</ul>

<div class = "tab-content" >
    <div class = "tab-pane active" id = "com"  >
            <h4>Total de Discipulos: <?php //echo $totalDiscipulos?></h4>
            <?php if (isset($lider)) : ?>

                            <div class="accordion" id="accordion2">
                                <?php foreach ( $lider as $k => $v ) : ?>
                                    <div class="accordion-group">
                                        <div class="accordion-heading ">
                                            <a class="accordion-toggle <?php echo $v['total'] ? 'text-error' : '' ; ?>text-error " data-toggle="collapse" data-parent="#accordion2" href="#<?php echo ++$cont ; ?>">
                                            <?php echo $cont ; ?>	- <?php echo $k ; ?> (<?php  echo $v['total'] ; ?>)</a>
                                        </div>

                                        <div id="<?php echo $cont ; ?>" class="accordion-body collapse ">
                                        <div class="accordion-inner">

                                        <table class = "table" >
                                            <?php foreach ($v as $key => $value ) : ?>
                                                <tr>
                                                    <?php if ( $key != 'total') : ?>
                                                    <td><a target = "blank" href = "/discipulo/discipulo/detalhar/id/<?php echo $value['id']?>"><?php echo $key ; ?> </a></td>
                                                    <?php else : ?>
                                                    <?php endif ; ?>
                                                </tr>
                                            <?php endforeach ; ?>
                                        </table>
                                    </div>
                                    </div>

                                </div>
                        <?php endforeach ; ?>
                                    </div>

                    <?php endif ; ?>
            </div>

                                </div>

            </div>

            </div>
            </article>

        </section>

        </section>
    </body>
</html>
