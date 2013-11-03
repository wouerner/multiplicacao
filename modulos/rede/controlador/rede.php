<?php
use \discipulo\Modelo\Discipulo ;

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
             $tipoRede =	new \rede\modelo\tipoRede() ;

             $rede->discipuloId = $url[3];
             $rede->tipoRedeId = $url[3];
             $rede->funcaoRedeId = $url[3];

            $discipulo = new \discipulo\Modelo\Discipulo() ;
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

            $tipoRede =	new \rede\modelo\tipoRede() ;

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
                  $redes =	new \rede\modelo\tipoRede();
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
                    $tipoRede = new \rede\modelo\tipoRede();
                    $tipoRede->id = $redeId;
                    $tipoRede = $tipoRede->listarUm();
                    $rede->tipoRedeId = $redeId;

                  $redeMembros = $rede->pegarMembrosAtivos();
                    $cont = 1 ;
                    $metaTotal=0;
                    $metaTotalLider=0;

                  require 'modulos/rede/visao/rede/listar.php';

        }

        public function listarCelulas($url)
        {
                    $redeId = $url[4];

                    $tipoRede = new \rede\modelo\tipoRede();
                    $tipoRede->id = $redeId;
                    $celulas = $tipoRede->listarCelulas();
                    $cont = 0 ;

                  require 'modulos/rede/visao/tipoRede/celulas.php';

        }

        public function atualizar($url)
        {
            if ( empty ( $url['post'] ) ) {

                $discipulo =	new \discipulo\Modelo\Discipulo();
                $lideres = $discipulo->listarLideres();

                $discipulo->id =  $url[3] ;
                $discipulo = $discipulo->listarUm();

                $lider =	new \discipulo\Modelo\Discipulo();
                $lider->id = $discipulo['lider'] ;
                $lider = $lider->listarUm($discipulo['lider']);

                $celula = new \celula\modelo\celula();
                $celula->id = $discipulo['celula'];
                $celula = $celula->listarUm();

                $celulas = new \celula\modelo\celula();
                $celulas = $celulas->listarTodos();

                require_once 'modulos/discipulo/visao/atualizar.php';

            } else {
                $discipulo =	new \discipulo\Modelo\Discipulo();

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

                $rede =	new \rede\modelo\tipoRede();
                $rede->id = $url[4] ;
                $rede = $rede->listarUm();

                require_once 'modulos/rede/visao/tipoRede/atualizar.php';

            } else {
                $rede =	new \rede\modelo\tipoRede();

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
            if ( empty ( $url['post'] ) ) {

                $funcao =	new \rede\modelo\funcaoRede();
                $funcao->id = $url[3] ;
                $funcao = $funcao->listarUm();

                require_once 'modulos/rede/visao/funcaoRede/atualizar.php';

            } else {
                $funcao =	new \rede\modelo\funcaoRede();

                $post = $url['post'] ;

                $funcao->id = $post['id'];
                $funcao->nome = $post['nome'];

                $funcao->atualizar();

                header ('location:/rede/atualizarFuncaoRede/id/'.$funcao->id);
                exit();
            }

        }

        public function excluirTipoRede($url)
        {
                $rede =	new \rede\modelo\tipoRede();
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
            $discipulo = new \discipulo\Modelo\Discipulo() ;

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
            $rede = new \rede\modelo\tipoRede() ;

            $rede->id = $url[4] ;
            $rede = $rede->listarUm() ;

            require 'rede/visao/tipoRede/detalhar.php';

        }

        public function chamar ()
        {
            $nome = (!empty($_GET['nome'])) ? $_GET['nome'] : NULL;
            $discipulo =	new \discipulo\Modelo\Discipulo();
            $discipulo->nome = $nome;
            $discipulos = $discipulo->chamar($nome);
            require_once 'discipulo/visao/chamar.php';

        }

        public function evento($url)
        {
            if ( empty ( $url['post'] ) ) {

                  $eventos = new \evento\modelo\evento();

                  $id = $url[3];
                  $eventosDiscipulos = $eventos->listarTodosDiscipulo($id);
                $eventos = $eventos->listarTodos();

            require_once 'modulos/discipulo/visao/evento.php';
            } else {
                      $post = $url['post'];
                     $discipuloEvento = new \evento\modelo\evento();
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
