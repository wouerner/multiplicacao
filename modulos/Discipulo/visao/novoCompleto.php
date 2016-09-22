<?php
$mensagem = isset($_SESSION['mensagem']) ? $_SESSION['mensagem'] : NULL;
$dados = isset($_SESSION['dados']) ? $_SESSION['dados'] : NULL;
$_SESSION['mensagem'] = isset($_SESSION['mensagem']) ? NULL : NULL;
$_SESSION['dados'] = isset($_SESSION['dados']) ? NULL : NULL;
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

        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">Novo Cadastro</h3>
          </div>
          <div class="panel-body">
                        <?php include 'Discipulo/visao/formularioNovoCompleto.inc.php' ; ?>
          </div>
        </div>
                </article>
            </section>
        </section>
    </body>
</html>
