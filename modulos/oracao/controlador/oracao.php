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
    }

    public function index()
    {
        $acl = new \seguranca\modelo\acl($_SESSION['usuario_id']);
        $oracao =	new \oracao\modelo\pedidoOracao();
        $oracoesPublicas =	$oracao->listar(1);
        $oracoesPrivadas =	$oracao->listar(0);
        require_once('oracao/visao/listar.php');

    }
}
