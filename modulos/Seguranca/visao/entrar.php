<?php
$mensagem = isset($_SESSION['mensagem']) ? $_SESSION['mensagem'] : NULL;
$erros =  isset($_SESSION['erros']) ? $_SESSION['erros'] : NULL;
unset($_SESSION['mensagem']);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Autenticação</title>
    <link href="../../../ext/twitter-bootstrap/3/dist/css/bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="../../../ext/custom/css/login.css" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
    <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
</head>
<body>
    <div id="fullscreen_bg" class="fullscreen_bg"/>
        <div class = "row" >
            <?php if ( !is_null($mensagem) ) :?>
                <div class="alert alert-warning">
                    <?php echo $mensagem ; ?>
                </div>
            <?php endif ; ?>
        </div>
        <div class="container">
            <form class="form-signin" method="post" accept-charset="utf-8" action ="/seguranca/seguranca/entrar" >
                <img src="/ext/img/logo.png" class="img-responsive">
                <h1 class="form-signin-heading text-muted">Multiplicacao.org</h1>
                <input id="email" name="email" type="text" class="form-control" placeholder="Email address" required="" autofocus="">
                <input name="senha" type="password" class="form-control" placeholder="Password" required="">
                <button class="btn btn-lg btn-primary btn-block" type="submit">
                   Entrar
                </button>
            </form>
        </div>
        <div class="container form-signin">
        </div>
    </div>
    <script>
        jQuery('#recuperarBtn').on('click', function(){
            if(jQuery('#email').val() ==''){
                 alert('Preencha o seu email!');
                jQuery('#email').focus();
            }
            jQuery.post(
                        '/seguranca/seguranca/recuperar',
                        { email: jQuery('#email').val() },
                        function() { alert('Verifique o seu e-mail!' + jQuery("#email").val()) }
                    );
        });
    </script>
</body>
</html>
