<?php
use \Discipulo\Modelo\Discipulo;

namespace rede\controlador;

class funcaoRede
{
    /**
     * atualizar
     *
     * @param mixed $url
     * @access public
     * @return void
     */
    public function atualizar($url)
    {
            $funcao = new \Rede\Modelo\FuncaoRede();

            $post = $url['post'] ;

            $funcao->id = $post['id'];
            $funcao->nome = $post['nome'];

            $funcao->liderRede = !empty($post['liderNome']) ? 1 : 0;

            //var_dump($funcao);die;
            $funcao->atualizar();

            header('location:/rede/rede/atualizarFuncaoRede/id/'.$funcao->id);
            exit();
    }
}
