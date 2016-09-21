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

            <form class = "well" method = "post" action = "/celula/celula/listarPorStatus">
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
    <li><a href="#sem" data-toggle="tab" >Sem</a></li>
</ul>

<div class = "tab-content" >
    <div class = "tab-pane active" id = "com"  >
            <h4>Total de Discipulos: <?php echo $totalDiscipulos?></h4>
            <?php if (isset($lider)) : ?>

                            <div class="accordion" id="accordion2">
                                <?php foreach ( $lider as $k => $v ) : ?>
                                    <div class="accordion-group">
                                        <div class="accordion-heading">
                                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#<?php echo ++$cont ; ?>">
                                        <?php echo $cont ; ?>	- <?php  echo $k ; ?>(<?php echo $v['total'] ; ?>) </a>
                                        </div>

                                        <div id="<?php echo $cont ; ?>" class="accordion-body collapse ">
                                        <div class="accordion-inner">

                                        <table class = "table" >
                                            <?php foreach ($v as $key => $value ) : ?>
                                                <tr>
                                                    <?php if ( $key != 'total') : ?>
                                                    <td><a target = "blank" href = "/discipulo/discipulo/detalhar/id/<?php echo $value[1]?>"><?php echo $key ; ?> </a></td> <td> <?php echo $value[0] ?></td>
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

            <div class = "tab-pane" id = "sem" >

            <h4>Total: <?php echo $totalDiscipulosSem?></h4>
            <?php if (isset($lider)) : ?>

                            <div class="accordion" id="accordion2">
                                <?php foreach ( $liderSem as $k => $v ) : ?>
                                    <div class="accordion-group">
                                        <div class="accordion-heading">
                                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#<?php echo ++$cont ; ?>">
                                            <?php echo !isset($c) ? $c=1 : ++$c ;  ; ?> - <?php  echo $k ; ?>(<?php echo $v['total'] ; ?>) </a>
                                        </div>

                                        <div id="<?php echo $cont ; ?>" class="accordion-body collapse ">
                                        <div class="accordion-inner">

                                        <table class = "table" >
                                            <?php foreach ($v as $key => $value ) : ?>
                                                <tr>
                                                    <?php if ( $key != 'total') : ?>
                                                    <td><?php echo $key ; ?> </td> <td> <?php echo $value ?></td>
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
            </article>

        </section>

        </section>
    </body>
</html>
