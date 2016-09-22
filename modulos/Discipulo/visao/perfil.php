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
    });

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
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/pt_BR/all.js#xfbml=1&appId=237693733039706";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div id="dialog-confirm" title="Deseja desativar?" style = "display:none">
    <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span>Quer realmente excluir?</p>
</div>

<div id="dialog-success" title="Deseja ativar?" style = "display:none">
    <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span>Quer realmente ativar?</p>
</div>

        <section class = "container-fluid">

        <nav>
            <?php if (isset ($_SESSION['logado']) && $_SESSION['logado']==true) : ?>
                <?php include 'modulos/menu/visao/menu.inc.php' ; ?>
            <?php endif ; ?>
        </nav>

        <header>

        </header>

        <section>
            <article>
<div class = "row-fluid" >
<div class = "span12 well" >

                <img src = "<?php $foto = $discipulo->getFoto() ; echo is_object($foto) ? $foto->url: '' ; ?>"class = "img-rounded span2" style="height: 150px;"  width = "150"  >
                <h3 class = "span10" ><?php echo $discipulo->nome ; ?></h3>

                    <p class = "span5" >Líder: <?php echo $discipulo->getLider()->nome ; ?></p>
                    <p class = "span5" >Status: <?php  echo $statusCelular['nome'] ; ?> </p>

                    <p class = "span5" >E-mail: <?php echo $discipulo->email ; ?></p>

                <p class = "span5" >Participa da Célula:
                            <?php echo $participaCelula['nomeCelula'] ; ?>
                    </p>
                <p class = "span5"  >
                    Líder da Célula:
                        <?php foreach ( $liderCelula as $celula) :?>
                            <?php echo $celula['nomeCelula'] ; ?>
                        <?php endforeach ; ?>
                </p>
        <div class = "span12">
        <?php
             $dominio= $_SERVER['HTTP_HOST'];
             $faceUrl=  "http://" . $dominio. $_SERVER['REQUEST_URI'];
        ?>
                        <div class="fb-comments" data-href="<?php echo $faceUrl?>" data-width="470" data-num-posts="10"></div>
        <div>
</div>
</div>

            </article>

        </section>

        </section>
    </body>
</html>
