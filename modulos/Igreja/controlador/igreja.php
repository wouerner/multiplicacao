<?php
namespace igreja\controlador;

use \igreja\modelo\igreja as IgrejaModelo;

/**
 * Igreja
 *
 * @author wouerner <wouerner@gmail.com>
 */
class igreja {

    public function index() {
        require_once  'modulos/igreja/visao/igreja/index.php';
    }

    public function all ($url) {
        $igreja = new IgrejaModelo();

        header('Content-Type: application/json');
        echo json_encode($igreja->listarTodos());
    }

    public function update ($url) {
        $igreja = new IgrejaModelo();

        $post = $url['post'];

        $igreja->id = $post['id'];
        $igreja->nome = $post['nome'];

        $igreja->atualizar();

        header('Content-Type: application/json');
        echo json_encode(true);
    }

    public function store ($url) {
        $igreja = new IgrejaModelo();

        $post = $url['post'];

        $igreja->nome = $post['nome'];

        $igreja->salvar();

        header('Content-Type: application/json');
        echo json_encode(true);
    }

    public function destroy ($url) {
        $igreja = new IgrejaModelo();


        $igreja->id = $url[3];

        $igreja->excluir();

        header('Content-Type: application/json');
        echo json_encode(true);
    }

}
