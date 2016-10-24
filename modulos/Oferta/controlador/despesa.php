<?php
use \Discipulo\Modelo\Discipulo ;
use \oferta\modelo\despesa;

namespace oferta\controlador;

use \oferta\modelo\oferta as Oferta;

class despesa {

    public function index() {
        $valor = \oferta\modelo\despesa::valorTotal();
        $valorOfertas = Oferta::valorTotal();
        $saldo = $valorOfertas->total - $valor->total;
        require_once  'modulos/oferta/visao/despesa/index.php';
    }

    public function all ($url) {
        $despesas = new \oferta\modelo\despesa();

        header('Content-Type: application/json');
        echo json_encode($despesas->listarTodos());
    }

    public function update ($url) {
        $despesa = new \oferta\modelo\despesa();

        $post = $url['post'];

        $despesa->id = $post['id'];
        $despesa->descricao = $post['descricao'];
        $despesa->pago = $post['pago'] == "true"? 1 : 0 ;
        $despesa->data = $post['data'];
        $despesa->contaId = $post['contaId'];
        $despesa->valor = $post['valor'];
        $despesa->atualizar();

        header('Content-Type: application/json');
        echo json_encode(true);
    }

    public function store ($url) {
        $despesa = new \oferta\modelo\despesa();

        $post = $url['post'];

        $despesa->descricao = $post['descricao'];
        $despesa->pago = $post['pago'];
        $despesa->data = $post['data'];
        $despesa->contaId = $post['contaId'];
        $despesa->valor = $post['valor'];


        $despesa->salvar();

        header('Content-Type: application/json');
        echo json_encode(['success'=>true, 'data' => '']);
    }

    public function destroy ($url) {
        $despesa = new \oferta\modelo\despesa();

        $despesa->id = $url[3];

        $despesa->excluir();

        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'data'=> '']);
    }

}
