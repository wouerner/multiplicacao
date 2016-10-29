<?php

$mensagem = isset($_SESSION['mensagem']) ? $_SESSION['mensagem'] : '';
unset($_SESSION['mensagem']) ;

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <?php include 'incluidos/css.inc.php' ?>
        <?php include 'incluidos/js.inc.php' ?>

<link href="http://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0-rc.1/css/select2.min.css" rel="stylesheet" />
<script src="http://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0-rc.1/js/select2.min.js"></script>

        <script>

        jQuery(function($){
       $("#telefone").mask("(99) 9999-9999");
       $("#dataNascimento").mask("99/99/9999");
        });

        $(function() {

                  $( "#dataNascimento" ).datepicker();
        });

// Status Celular dialog
        /*$(function() {
                  $( "#dialog-form" ).dialog({  autoOpen : false,
                                                             height: 300,
                                                            width: 500,
                                                            modal: true,
                                                      });

                  $( "#statusCelular" )
                             .button()
                            .click( function(){
                                        $("#dialog-form").dialog("open");
                  });

        });

// Admissao Dialog
        $(function() {
                  $( "#formularioAdmissao" ).dialog({  autoOpen : false,
                                                             height: 300,
                                                            width: 500,
                                                            modal: true,
                                                      });

                  $( "#butaoAdmissao" )
                             .button()
                            .click( function(){
                                        $("#formularioAdmissao").dialog("open");
                  });

        });

// rede Dialog
        $(function() {
                  $( "#formularioRede" ).dialog({  autoOpen : false,
                                                             height: 300,
                                                            width: 500,
                                                            modal: true,
                                                      });

                  $( "#butaoRede" )
                             .button()
                            .click( function(){
                                        $("#formularioRede").dialog("open");
                  });

        });*/
        </script>
        <script src="/modulos/Discipulo/visao/js/combobox.js"></script>
        <script src="/modulos/Discipulo/visao/js/comboboxCelula.js"></script>

    </head>
    <body>
        <section class = "container-fluid">
        <header>
            <nav>
                <?php require 'modulos/menu/visao/menu.inc.php' ; ?>
            </nav>
        </header>
        <section>
            <article class="" >
                <?php if ($mensagem) : ?>
                    <div class="alert <?php echo ($mensagem=='ok') ? 'alert-success' : 'alert-error' ; ?>">
                      <h4 class="alert-heading">
                        <?php echo $mensagem ?>!
                    </h4>
                   </div>
                <?php endif ; ?>
                <?php include 'Discipulo/visao/formularioAtualizar.inc.php' ; ?>
            </article>
        </section>
        </div>
        </section>
    </body>
</html>
