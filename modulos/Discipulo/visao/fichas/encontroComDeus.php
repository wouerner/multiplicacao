<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <style type="text/css">
           @import url("/ext/twitter-bootstrap/bootstrap.css");
        </style>
        <script src="../../../ext/jquery/jquery-1.7.1.min.js"></script>

        <style>
                body{

                    font-size: 14pt;

                    }

                    p{

                    font-size: 14pt;
                    line-height: 100%;

                    }
                    h1{
                        font-size:30pt;

                    }
                    h2{
                        font-size:24pt;

                    }
                    table{
                        margin-top:20px;

                    }
        </style>
    </head>

    <body>
        <section class = "container">

        <nav>
        </nav>

        <header>

        </header>

        <section>
            <article>

            <table class = " table" >
                <tr><td><img src="/modulos/Discipulo/visao/img/mga.jpg"> </img></td><td><h2>Encontro com Deus dias 15, 16 e 17/03/2013</h2></td></tr>

            <tr>

            <table class = " table table-bordered" >
                <tr >
                    <td class = "span8"> Nome: <?php echo $discipulo->nome ; ?></td>
                    <td class = "" > Data Nasc.: <?php echo $discipulo->getDataNascimento()->format('d/m/Y') ; ?></td>
                </tr>
            </table>

            </tr>

            <tr>

            <table class = "table table-bordered" >
                <tr>
                    <td colspan = "2" class = "">Endereço: <?php echo $discipulo->endereco; ?></td>
                </tr>

                <tr>
                    <td  class = "span7">Telefone: <?php echo $discipulo->telefone ; ?></td>
                    <td  class = "">Líder: <?php $d = $discipulo->getLider() ; ?> <?php echo $d->nome ; ?></td>
                </tr>
            </table>

            </tr>

            <tr><td></td></tr>

            <tr>
                <table class="table table-bordered">
                    <tr>
                    <td   >

<p><h3>Condições de Pagamento:</h3></p>
<p>a) Valor do encontro para encontrista: R$ 100,00 - à vista; R$ 120,00 - a prazo;</p>
<p>b) Valor do Encontro para crianças até 11 anos de idade: R$ 40,00 – à vista; R$ 50,00 – a prazo;</p>
<p>c) O pagamento a prazo e/ou parcelamento somente será aceito em CHEQUE OU CARTÃO.</p>
<p>OBS: Não haverá ressarcimento ou alteração dos valores acordados, bem como das formas de pagamento.</p>
<p>Estou <strong>CIENTE</strong> da minha participação no <strong>ENCONTRO COM DEUS</strong> e concordo em realizar o pagamento <br/>até o dia <strong>15/03/2013</strong>.</p>
<p>Assinatura do Encontrista:_______________________________________________________________</p>
<p>Menor de Idade (Ass. do Responsável):_____________________________________________________</p>
<p>Membro de outra Igreja (Ass. do Pastor):____________________________________________________</p>
                </td>
                </table>
                </tr>

                </table>
<table class = "table table-bordered" >
<tr>
</tr>
<table>

            </article>

        </section>

        </section>
    </body>
</html>
