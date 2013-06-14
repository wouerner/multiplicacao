<?php
$mensagem = isset($_SESSION['mensagem']) ? $_SESSION['mensagem'] : NULL;
$dados = isset($_SESSION['dados']) ? $_SESSION['dados'] : NULL;
$_SESSION['mensagem'] = isset($_SESSION['mensagem']) ? NULL : NULL;
$_SESSION['dados'] = isset($_SESSION['dados']) ? NULL : NULL;

//var_dump($mensagem);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <?php include 'incluidos/css.inc.php'?>
        <?php include 'incluidos/js.inc.php'?>

        <script src="/modulos/discipulo/visao/js/combobox.js"></script>
        <script src="/modulos/discipulo/visao/js/comboboxCelula.js"></script>

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

    </head>

    <body>
        <section class = "container-fluid">
        <header>
            <nav>
                <?php require 'modulos/menu/visao/menu.inc.php' ; ?>
            </nav>
        </header>

        <section>

            <article>

            <?php if ($mensagem) : ?>
            <div class = "<?php echo $mensagem['class']?>" >
                        <?php echo $mensagem['mensagem'] ; ?>
                </div>
            <?php endif ; ?>

                <?php include 'discipulo/visao/formularioNovoCompleto.inc.php' ; ?>
            </article>
        </section>

    </div>
        </section>
    </body>

</html>
