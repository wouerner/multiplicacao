<?php

namespace oracao\controlador;

class oracao
{
    public function pedido()
    {
        $oracao =	new \oracao\modelo\pedidoOracao();
        $oracao->discipuloId = isset($_POST['discipuloId']) ? $_POST['discipuloId'] : 0 ;
        $oracao->texto = isset($_POST['texto']) ? $_POST['texto'] : '' ;
        $oracao->publico = isset($_POST['publico']) ? 1 : 0 ;
        $oracao->salvar();

        $headers = "MIME-Version: 1.1\n";
        $headers .= "Content-type: text/plain; charset=utf-8\n";
        $headers .= "From: Multiplicação12 <multiplicaca12@multiplicacao.org>"."\n"; // remetente
        $headers .= "Return-Path: M12 <multiplicacao@multiplicacao.org>"."\n"; // return-path
        $envio = mail("aninhamga12@gmail.com,marcello12mga@gmail.com",
                      "Pedido de Oração", "Novo pedido de oração adicionado!",
                      $headers, "-r multiplicacao12@multiplicacao.org");
    }

    public function index()
    {
        $acl = new \Seguranca\Modelo\Acl($_SESSION['usuario_id']);
        $oracao =	new \oracao\modelo\pedidoOracao();
        $oracoesPublicas =	$oracao->listar(1);
        $oracoesPrivadas =	$oracao->listar(0);
        require_once('oracao/visao/listar.php');

    }
    public function excluir($url)
    {
        include 'seguranca/ACL/assets/php/database.php';
        $acl = new \Seguranca\Modelo\Acl($_SESSION['usuario_id']);

        if ($acl->hasPermission('intercessao') == true) {

            $oracao =	new \oracao\modelo\pedidoOracao();
            $oracao->id = $url[4];
            $oracao->excluir();
        }

        header ('location:/oracao/oracao');
        exit();
    }
}
