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

                <?php require 'modulos/discipulo/visao/chamarDiscipulo.php' ; ?>
                <div class = "row-fluid" >
                <div class = "span12" >

                <table class = "table table-condensed well ">
                <caption><h3>Lista de Discipulos</h3></caption>
                    <thead>
<?php if ($acl->hasPermission('admin_acesso') == true) :  ?>
                        <th>Líder</th>
<?php endif; ?>
                        <th>Nome</th>
                        <th>Telefone</th>
                        <th>E-mail</th>
                        <th>Ações</th>
                    </thead>

                <?php foreach ( $discipulos as $discipulo) : ?>

                <tr>

<?php if ($acl->hasPermission('admin_acesso') == true) :  ?>
                    <td><a href="/discipulo/discipulo/detalhar/id/<?php echo $discipulo->getLider()->id?>" ><?php echo $discipulo->getLider()->nome ; ?></a></td>
<?php endif; ?>

                    <td><a href="/discipulo/discipulo/detalhar/id/<?php echo $discipulo->id?>" ><strong><?php echo $discipulo->nome ; ?></strong></a></td>
                <td><?php echo $discipulo->telefone ; ?></td> <td><?php echo $discipulo->email ; ?></td>
                 <?php require 'discipulo/visao/menuDiscipulo.inc.php' ; ?>
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
