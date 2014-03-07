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

); 


    $(".btn-success").click( function(){
                var id = this.id ;

                $( "#dialog-success" ).dialog({
                resizable: false,
                height:240,
                modal: true,
                buttons: {
                    Cancelar: function() {
                        $( this ).dialog( "close" );
                    },
              Ativar: function() {
                        $(location).attr('href', '/discipulo/discipulo/ativar/id/'+id);
               },
                }

        });
    });
});
</script>

    </head>

    <body>

<div id="dialog-confirm" title="deseja desativar?" style = "display:none" >
<p>
    <span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;">
    </span>Se desativar o discipulo, só terá acesso após comunicar ao seu líder.
    </p>
</div>

<div id="dialog-success" title="Deseja ativar?" style = "display:none">
    <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span>Quer realmente ativar?</p>
</div>

        <section class = "container-fluid">

        <nav>

            <?php include 'modulos/menu/visao/menu.inc.php' ; ?>
        </nav>
        <section id = "discipulo" >
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
                <div class = "span12" >

                <table class = "table table-condensed well ">
                <caption><h3>Lista de Discipulos</h3></caption>
                    <thead>
<?php if ($acl->hasPermission('admin_acesso') == true) :  ?>
<?php endif; ?>
                        <th></th>
                        <th>Nome</th>
                        <th>Telefone</th>
                        <th>Lider</th>
                        <th>Ações</th>
                    </thead>

                <?php foreach ( $discipulos as $discipulo) : ?>

                <tr>

                <td>
                <a title=""
                    data-content=" <?php echo '<b>Email:</b> '.$discipulo->email.'<br><b>Endereço:</b> '.$discipulo->endereco ?>"
                    data-placement="right" data-toggle="popover" class="btn btn-mini btnPopover"
                    href="#aqui" data-original-title="<?php echo $discipulo->nome?>"><i class="icon-eye-close"></i></a>
                </td>


                    <td>
                 <?php if ( $discipulo->eLider()): ?>
                <h5>
                    <?php endif ; ?>
                  <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion_<?php echo $discipulo->id?>" href="#collapse_<?php echo $discipulo->id?>">
  <i class = "<?php echo $discipulo->eLider() ? 'icon-certificate' : '' ;  ?>"></i>
                 </a>

                        <i class = "<?php echo $discipulo->eLiderCelula() ? 'icon-home': '' ?>"></i>
             <a href="/discipulo/discipulo/detalhar/id/<?php echo $discipulo->id?>" >
                            <?php echo $discipulo->getAlcunha() ; ?>
                 <?php if ( $discipulo->eLider()): ?>
                    <?php endif ; ?>

                    <?php if ($discipulo->ativo == 1 ) : ?>
                        <span class="label label-success"><i class ="icon-arrow-up"></i> Ativo</span>
                    <?php elseif ($discipulo->arquivo == 1 ) : ?>
                        <span class="label label-inverse">Arquivo</span>
                    <?php else : ?>
                        <span class="label label-warning">Inativo</span>
                    <?php endif ; ?>
                    </a>
                </h5>
        </td>

                <td>
                    <?php echo $discipulo->telefone ; ?></td>
                    <td>
<a target="blank" href="/discipulo/discipulo/atualizar/id/<?php echo $discipulo->getLider()->id ?>"><?php echo $discipulo->getLider()->getAlcunha() ; ?></a></td>
                 <?php require 'discipulo/visao/menuDiscipulo.inc.php' ; ?>
                </tr>

                 <?php if ( $discipulo->eLider()): ?>
<tr  >
<td colspan = "5">
                 <div class="accordion" id="accordion_<?php echo $discipulo->id?>">
            <div class="accordion-group">
            <div id="collapse_<?php echo $discipulo->id?>" class="accordion-body collapse ">
            <div class="accordion-inner">
                      <?php foreach ($discipulo->listarDiscipulos()  as $discipulo) : ?>
                 <?php echo $discipulo->nome ?> |
              <?php endforeach ; ?>

           </div>
            </div>
                     </div>
</td>
</tr>
         <?php endif;?>

                <?php endforeach ; ?>
                </table>

                </div>
            </div>
            </article>

        </section>

        </section>
<script>
    $('.btnPopover').popover({ html:true});
</script>
    </body>
</html>
