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
        <script>
        $(function() {

          $( ".data" ).datepicker({showWeek:true});
        });

        </script>

        <script>
        $(function() {

          $( ".tempo" ).timepicker();
        });

        </script>
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

                    <div class = "row-fluid" >
                        <div class = "well" >
                        <form method = "post" action = "/relatorio/relatorio/relatorioCelulaEnvioPorTema" class = "form-horizontal"  >

                            <legend>Relatório por Tema</legend>
                            <label>Rede: </label>
                            <select name = "tipoRedeId[]" class = "span4" multiple size = "6" >
                                <?php foreach ($tipoRede as $t ) : ?>
                                    <option value="<?php echo $t->id ; ?>" >
                                                        <?php echo $t->nome ; ?>
                                    </option>
                                <?php endforeach ; ?>
                            </select>

                            <label>Tema: </label>
                            <select name = "temaId"class = "span4"  >
                                <?php foreach ($temas as $t ) : ?>
                                    <option value="<?php echo $t->id ; ?>" >
                                                        <?php echo $t->ativo ? 'ativo' : 'inativo' ?> -
                                                        <?php echo $t->nome?> -
                                                        <?php echo date_format(date_create($t->dataInicio),'d/m/Y') ; ?> -
                                                        <?php echo date_format(date_create($t->dataFim),'d/m/Y') ; ?>
                                    </option>
                                <?php endforeach ; ?>
                            </select>

                            <button  type = "submit" class = "btn" >Gerar</button>
                            </div>
                        </form>
                    </div>

                        <?php if (isset($relatorios)) :?>
                        <div class = "well" >
                        <table class = "table table-condensed">

                        <caption>
                            <h3>Tema:  <?php echo $tema->nome ; ?> </h3>
                            <h4>Data: <?php echo date_format(date_create($tema->dataInicio),'d/m/Y  H:i:s') ; ?> -
                                                        <?php echo date_format(date_create($tema->dataFim),'d/m/Y  H:i:s') ; ?></h4></caption>
                                <thead>
                                    <th>#</th>
                                    <th>Relatorio</th>
                                    <th>Líder</th>
                                    <th>Celula</th>
                                    <th>Data Envio</th>
                                </thead>

                            <?php foreach ( $relatorios as $r ) : ?>

                            <tr class = "<?php echo $r['nomeTema']? 'success' : 'error' ?>" >
                                <td><?php echo ++$cont  ; ?></td>
                                <td><?php echo $r['nomeTema'] ? 'sim' : 'não'  ; ?></td>
                                <td><?php echo $r['lider'] ; ?></td>
                                <td>
                                    <?php if ($acesso->hasPermission('admin_acesso') == true): ?>
                                        <a href = "/celula/relatorio/index/id/<?php echo $r['celulaId']?>" ><?php echo $r['celulaNome'] ; ?></a>
                                    <?php else: ?>
                                        <?php echo $r['celulaNome'] ; ?>
                                    <?php endif ?>
                                </td>
                                <td class = "" >	<?php echo $r['dataEnvioRelatorio'] ? date_format(date_create($r['dataEnvioRelatorio']),'d/m/Y  H:i:s')  : '' ; ?></td>
                                </td>
                            </tr>
                        <?php endforeach ; ?>
                        </table>
                        </div>
                                        <?php endif ; ?>
            </article>

        </section>

        </section>
    </body>
</html>
