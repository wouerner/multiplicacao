<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
            <?php include 'incluidos/css.inc.php' ; ?>
            <?php include 'incluidos/js.inc.php' ; ?>
<script>
$(document).ready(function () {
$(".btn-warning").click( function(){
                var id = this.id ;

                $( "#dialog-confirm" ).dialog({
                resizable: false,
                height:240,
                modal: true,
                buttons: {
            Cancelar: function() {
                $( this ).dialog( "close" );
            },
      Desativar: function() {
                                        $(location).attr('href', '/discipulo/discipulo/desativar/id/'+id);
       },
}

});

}

); });
</script>
    </head>

    <body>

<div id="dialog-confirm" title="deseja desativar?" style = "display:none" >
<p>
    <span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;">
    </span>Se desativar o discipulo, só terá acesso após comunicar ao seu líder.
    </p>
</div>

        <section class = "container-fluid">

        <nav>

            <?php include 'modulos/menu/visao/menu.inc.php' ; ?>
        </nav>
        <section>
            <article>

                <?php require 'modulos/Discipulo/visao/chamarDiscipulo.php' ; ?>
                <div class = "row-fluid" >
                <div class = "span12" >

                <table class = "table table-condensed well ">
                <caption><h3>Lista de Discipulos</h3></caption>
                    <thead>
                        <th>Nome</th>
                    <?php if ($acesso->hasPermission('admin_acesso') == true): ?>
                        <th>Líder</th>
                    <?php endif; ?>
                        <th>Telefone</th>
                        <th>E-mail</th>
                        <?php if ($acesso->hasPermission('admin_acesso') == true): ?>
                            <th>Ações</th>
                        <?php endif; ?>
                    </thead>

                <?php foreach ( $discipulos as $discipulo) : ?>
                <tr>
                    <td><?php echo !isset($count)  ?$count=1 : ++$count ; ?></td>
                    <td><a href="/discipulo/discipulo/detalhar/id/<?php echo $discipulo->id?>" ><strong><?php echo $discipulo->nome ; ?></strong></a></td>
                    <?php if ($acesso->hasPermission('admin_acesso') == true): ?>
                    <td><a href="/discipulo/discipulo/detalhar/id/<?php echo $discipulo->getLider()->id?>" ><?php echo $discipulo->getLider()->nome ; ?></a></td>
                    <?php endif; ?>
                <td><?php echo $discipulo->telefone ; ?></td> <td><?php echo $discipulo->email ; ?></td>
                        <?php if ($acesso->hasPermission('admin_acesso') == true): ?>
                <td><a class = "btn btn-mini" href = "/discipulo/discipulo/desarquivar/id/<?php echo $discipulo->id ; ?>"><i class = "icon-arrow-up" ></i>Desarquivar</a></td>
                        <?php endif; ?>
                </tr>


                <?php endforeach ; ?>
                </table>

                </div>
            </div>
            </article>

        </section>

        </section>
    </body>
</html>
