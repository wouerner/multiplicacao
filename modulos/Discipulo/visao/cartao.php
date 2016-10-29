<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <?php //include 'incluidos/css.inc.php' ; ?>
        <?php //include 'incluidos/js.inc.php' ; ?>

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
<style>

.id {
    float:left ;
position: absolute ;
top : 10px;
left : 43px;
font-size: 24pt;
}
.nome {
    float:left ;
position: absolute ;
top : 73px;
left : 43px;
font-size: 10pt;
}
.telefone {
    float:left ;
position: absolute ;
top : 95px;
left : 43px;
}
.email {
    float:left ;
position: absolute ;
top : 120px;
left : 43px;
}
.igreja {
    float:left ;
position: absolute ;
top : 145px;
left : 43px;
}

.fundo {
background : white ;
padding : 2px ;
border-radius: 3px;
}

.cartao {
    height : 220px;
}
</style>
    </head>

    <body>
        <section class = "container-fluid">
        <nav>
        </nav>

        <header>

        </header>

        <section>
            <article>

                    <img class = "cartao" src="/modulos/Discipulo/visao/img/cartao.png" >
                    <p class = "id fundo" >Id: <?php echo $discipulo->id ; ?></p>
                    <p class = "nome fundo" ><strong>	<?php echo $discipulo->nome ; ?></strong></p>
                    <p class = "telefone fundo" ><strong><?php echo $discipulo->telefone ; ?></strong></p>
                    <p class = "email fundo" > <strong><?php echo $discipulo->email ; ?></strong></p>
                    <p class = "igreja fundo" > <strong>Ministério Geração Apostólica</strong></p>

            </article>

        </section>

        </section>
    </body>
</html>
