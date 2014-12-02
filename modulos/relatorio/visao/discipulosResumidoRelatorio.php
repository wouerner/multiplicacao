<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <?php include 'incluidos/css.inc.php'?>
        <?php include 'incluidos/js.inc.php'?>

<script>
$(document).ready(function() {
        $(".table").tablesorter();
    }
); </script>
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
            <table class = "table table-bordered table-condensed" >
                    <caption><h3>Relatório: <?php echo $total?></h3></caption>
                <tr>
                    <th>Sexo :  <?php  echo $sexo ?></th>
                    <th>Estado Civil : <?php echo is_object($estadoCivil) ? $estadoCivil->nome : 'todos' ?></th>
                    <th>Rede : <?php echo is_object($rede) ? $rede->nome : 'todos' ?></th>
                    <th>Status :<?php echo is_object($status) ? $status->nome : 'todos' ?> </th>
                    <th>célula :<?php echo is_object($celula)? $celula->nome : 'todos' ?> </th>
                </tr>
            </table>
            <table class = "table table-condensed tablesorter well" >
                <thead>
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th>Líder</th>
                    <th>Sexo</th>
                    <th>Endereço</th>
                    <th>Telefone</th>
                    <th>Data Nasc. </th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                <?php $cont=0;?>
                <?php foreach($relatorio as $r ) : ?>
                              <?php  $status =  $r->getStatusCelular() ; ?>
                              <?php  $lider =  is_object($r->getLider()) ? $r->getLider():'' ; ?>
                          <tr>
                                <td> <?php echo ++$cont ; ?></td>
                                <td>
                                <?php if ($acesso->hasPermission('admin_acesso') == true): ?>
                                    <a target = "blank" href="/discipulo/discipulo/atualizar/id/<?php echo $r->id ; ?>">
                                <?php endif; ?>
                                        <strong><?php echo  $r->nome ; ?>
                                        </strong>
                                <?php if ($acesso->hasPermission('admin_acesso') == true): ?>
                                    </a>
                                <?php endif; ?>
                                    <?php echo $r->ativo ? '-ativo':'inativo'?>
</td>
                               <td><?php echo $lider->getAlcunha()?></td>
                              <td><?php echo  ($r->sexo == 'm')? 'M' : 'F' ; ?></td>
                              <td><?php echo  $r->endereco ; ?></td>
                              <td><?php echo  $r->telefone; ?></td>
                              <td><?php echo  $r->getDataNascimento()->format('d/m/Y') ; ?></td>
                              <td><?php echo $status['nome'] ; ?></td>
                          </tr>
                    <?php endforeach ; ?>
                </tbody>
            </table>
            </article>
        </section>
        </section>
    </body>
</html>
