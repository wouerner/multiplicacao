<?php
use \Discipulo\Modelo\Discipulo ;

namespace rede\controlador;

class rede
{
    public function index()
    {
//			require_once  'modulos/discipulo/visao/listar.php';

    }
    public function novo($url)
    {
              if ( empty ( $url['post'] ) ) {
                         $post = $url['post'] ;

         $rede =	new \rede\modelo\rede() ;
         $funcaoRede =	new \rede\modelo\funcaoRede() ;
         $tipoRede =	new \Rede\Modelo\TipoRede() ;

         $rede->discipuloId = $url[3];
         $rede->tipoRedeId = $url[3];
         $rede->funcaoRedeId = $url[3];

        $discipulo = new \Discipulo\Modelo\Discipulo() ;
        $discipulo->id = $url[3] ;
        $discipulo = $discipulo->listarUm();

        require_once 'modulos/rede/visao/novo.php';

        } else {
            $rede =	new \rede\modelo\rede();

    $post = $url['post'] ;
    $rede->discipuloId = $post['discipuloId'];
    $rede->tipoRedeId = $post['tipoRedeId'];
    $rede->funcaoRedeId = $post['funcaoRedeId'];

    if (!$rede->salvar()) {

              $rede->atualizar();

    }
        }
             header ('location:/discipulo/detalhar/id/'.$post['discipuloId']);
             exit();

    }

    public function novoTipoRede($url)
    {
        if ( empty ( $url['post'] ) ) {

            require_once 'modulos/rede/visao/tipoRede/novo.php';

        } else {

        $tipoRede =	new \Rede\Modelo\TipoRede() ;

        $post = $url['post'] ;
        $tipoRede->nome = $post['nome'] ;

        $tipoRede->salvar();
        header ('location:/rede/listarTipoRede') ;
        exit();
        }

    }

    public function novaFuncaoRede($url)
    {
        if ( empty ( $url['post'] ) ) {

            require_once 'modulos/rede/visao/funcaoRede/nova.php';

        } else {

        $funcao =	new \rede\modelo\funcaoRede() ;

        $post = $url['post'] ;
        $funcao->nome = $post['nome'] ;

        $funcao->salvar();
        header ('location:/rede/listarFuncaoRede') ;
        exit();
        }

    }

    public function listarTipoRede()
    {
              $redes =	new \Rede\Modelo\TipoRede();
              $redes = $redes->listarTodos();
                $totalMeta= 0 ;
                $totalDisc= 0 ;

              require 'modulos/rede/visao/tipoRede/listar.php';

    }

    public function listarFuncaoRede()
    {
              $funcoes =	new \rede\modelo\funcaoRede();
              $funcoes = $funcoes->listarTodos();

              require 'modulos/rede/visao/funcaoRede/listar.php';

    }

public function listarMembrosRede($url)
{
    $redeId = $url[4];

    $rede =	new \rede\modelo\rede();
    $funcao =	new \rede\modelo\funcaoRede();
    $tipoRede = new \Rede\Modelo\TipoRede();
    $tipoRede->id = $redeId;
    $lideresRede = $tipoRede->lideresRede();
    $tipoRede = $tipoRede->listarUm();
    $rede->tipoRedeId = $redeId;

    $idLideres = null;
    foreach ($lideresRede as $lider) {
        $idLideres[] = $lider['discipuloId'];
    }

    $liderRede = in_array($_SESSION['usuario_id'], $idLideres);

    $funcoes = $funcao->listarTodos();

    $redeMembros = $rede->pegarMembrosAtivos();

    $redeInativos = $rede->pegarMembrosInativos();
    $redeArquivados = $rede->pegarMembrosArquivados();
    $cont = 1 ;
    $metaTotal=0;
    $metaTotalLider=0;

    require 'modulos/rede/visao/rede/listar.php';

}

    public function listarCelulas($url)
    {
                $redeId = $url[4];

                $tipoRede = new \Rede\Modelo\TipoRede();
                $tipoRede->id = $redeId;
                $celulas = $tipoRede->listarCelulas();
                $cont = 0;

              require 'modulos/rede/visao/tipoRede/celulas.php';

    }

    public function atualizar($url)
    {
        if ( empty ( $url['post'] ) ) {

            $discipulo =	new \Discipulo\Modelo\Discipulo();
            $lideres = $discipulo->listarLideres();

            $discipulo->id =  $url[3] ;
            $discipulo = $discipulo->listarUm();

            $lider =	new \Discipulo\Modelo\Discipulo();
            $lider->id = $discipulo['lider'] ;
            $lider = $lider->listarUm($discipulo['lider']);

            $celula = new \Celula\Modelo\Celula();
            $celula->id = $discipulo['celula'];
            $celula = $celula->listarUm();

            $celulas = new \Celula\Modelo\Celula();
            $celulas = $celulas->listarTodos();

            require_once 'modulos/discipulo/visao/atualizar.php';

        } else {
            $discipulo =	new \Discipulo\Modelo\Discipulo();

            $post = $url['post'] ;

            $discipulo->id = $post['id'];
            $discipulo->nome = $post['nome'];
            $discipulo->telefone = $post['telefone'];
            $discipulo->endereco = $post['endereco'];
            $discipulo->email = $post['email'];
            $discipulo->celula = $post['celula'];
            $discipulo->ativo =isset( $post['ativo']) ? $post['ativo']: null;
            $discipulo->lider = $post['lider'];

            $discipulo->atualizar();

            header ('location:/discipulo/atualizar/id/'.$discipulo->id);
            exit();
        }
    }

    public function atualizarTipoRede($url)
    {
        if ( empty ( $url['post'] ) ) {

            $rede =	new \Rede\Modelo\TipoRede();
            $rede->id = $url[4] ;
            $rede = $rede->listarUm();

            require_once 'modulos/rede/visao/tipoRede/atualizar.php';

        } else {
            $rede =	new \Rede\Modelo\TipoRede();

            $post = $url['post'] ;

            $rede->id = $post['id'];
            $rede->nome = $post['nome'];

            $rede->atualizar();

            header ('location:/rede/rede/atualizarTipoRede/id/'.$rede->id);
            exit();
        }

    }

    public function atualizarFuncaoRede($url)
    {
        $funcao = new \rede\modelo\funcaoRede();
        $funcao->id = $url[4] ;
        $funcao = $funcao->listarUm();

        require_once 'modulos/rede/visao/funcaoRede/atualizar.php';
    }

    public function excluirTipoRede($url)
    {
            $rede =	new \Rede\Modelo\TipoRede();
            $rede->id = $url[4];
            $rede->excluir();

            $_SESSION['mensagem'] = !is_null($rede->erro) ? $rede->erro : null ;
            header ('location:/rede/rede/listartipoRede');
            exit();
    }

    public function excluirFuncaoRede($url)
    {
            $funcao =	new \rede\modelo\funcaoRede();
            $funcao->id = $url[4];
            $funcao->excluir();

            $_SESSION['mensagem'] = !is_null($funcao->erro) ? $funcao->erro : null ;
            header ('location:/rede/listarFuncaoRede');
            exit();
    }

    public function excluir($url)
    {
            $rede =	new \rede\modelo\redeTemDiscipulo();
            $rede->discipuloId = $url[4];
            $rede->redeId = $url[4];
            $rede->excluir();
            header ('location:/rede/novo/id/'.$rede->discipuloId);
            exit();
    }

    public function detalhar ($url)
    {
        $discipulo = new \Discipulo\Modelo\Discipulo() ;

        $discipulo->id = $url[4] ;
        $discipulo = $discipulo->listarUm() ;

        require 'discipulo/visao/detalhar.php';

    }

    public function detalharFuncao ($url)
    {
        $funcao = new \rede\modelo\funcao() ;

        $funcao->id = $url[4] ;
        $funcao = $funcao->listarUm() ;

        require 'rede/visao/detalharFuncao.php';

    }

    public function detalharTipoRede ($url)
    {
        $rede = new \Rede\Modelo\TipoRede() ;

        $rede->id = $url[4] ;
        $rede = $rede->listarUm() ;

        require 'rede/visao/tipoRede/detalhar.php';

    }

    public function chamar ()
    {
        $nome = (!empty($_GET['nome'])) ? $_GET['nome'] : NULL;
        $discipulo =	new \Discipulo\Modelo\Discipulo();
        $discipulo->nome = $nome;
        $discipulos = $discipulo->chamar($nome);
        require_once 'discipulo/visao/chamar.php';

    }

    public function evento($url)
    {
        if ( empty ( $url['post'] ) ) {

              $eventos = new \Evento\Modelo\Evento();

              $id = $url[3];
              $eventosDiscipulos = $eventos->listarTodosDiscipulo($id);
            $eventos = $eventos->listarTodos();

        require_once 'modulos/discipulo/visao/evento.php';
        } else {
                  $post = $url['post'];
                 $discipuloEvento = new \Evento\Modelo\Evento();
                  $eventoId = $post['eventoId'];
                    $discipuloId = $post['discipuloId'];

                 $discipuloEvento->salvarDiscipuloEvento($discipuloId, $eventoId );

                  echo "url" ;
                 var_dump($url);
                 $id = $post['discipuloId'];

                 header ('location:/discipulo/evento/id/'.$id);
                 exit();

        }

    }

}
