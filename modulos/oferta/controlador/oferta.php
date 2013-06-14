<?php
use \discipulo\Modelo\Discipulo ;

namespace oferta\controlador;

    class oferta
    {
        public function index()
        {
//			require_once  'modulos/discipulo/visao/listar.php';

        }
        public function novo($url)
        {
                  if ( empty ( $url['post'] ) ) {

             $tiposOfertas =	new \oferta\modelo\tipoOferta() ;
             $ofertasDiscipulo =	new \oferta\modelo\oferta() ;

             $tiposOfertas = $tiposOfertas->listarTodos();

             $ofertasDiscipulo->discipuloId= $url[3];
             $ofertasDiscipulo= $ofertasDiscipulo->pegarOfertasDiscipulo();

            $discipulo = new \discipulo\Modelo\Discipulo() ;
            $discipulo->id = $url[3] ;
            $discipulo = $discipulo->listarUm();

            require_once 'modulos/oferta/visao/novo.php';

            } else {
                $oferta =	new \oferta\modelo\oferta();

                $post = $url['post'] ;
                $oferta->discipuloId = $post['discipuloId'];
                $oferta->tipoOfertaId = $post['tipoOfertaId'];
                $dataOferta = $post['ano'].'-'.$post['mes'].'-'.$post['dia'] ;

                $oferta->dataOferta = $dataOferta;

        if ($oferta->salvar()) {

                header ('location:/oferta/novo/id/'.$post['discipuloId']);
                exit();
        } else {
                  $oferta->atualizar();
                header ('location:/discipulo/detalhar/id/'.$oferta->discipuloId);
                exit();

        }
            }

        }

        public function novoTipoOferta($url)
        {
            if ( empty ( $url['post'] ) ) {

                require_once 'modulos/oferta/visao/novoTipoOferta.php';

            } else {

            $tipoOferta =	new \oferta\modelo\tipoOferta() ;

            $post = $url['post'] ;
            $tipoOferta->nome = $post['nome'] ;

            $tipoOferta->salvar();
            header ('location:/oferta/listarTipoOferta') ;
                exit();
            }

        }

        public function listarTipoOferta()
        {
                  $tipoOfertas =	new \oferta\modelo\tipoOferta();
                  $tipoOfertas = $tipoOfertas->listarTodos();

                  require 'modulos/oferta/visao/listarTipoOferta.php';

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

        public function atualizarTipoOferta($url)
        {
            if ( empty ( $url['post'] ) ) {

                $tipoOferta =	new \oferta\modelo\tipoOferta();
                $tipoOferta->id = $url[3] ;
                $tipoOferta = $tipoOferta->listarUm();

                require_once 'modulos/oferta/visao/atualizarTipoOferta.php';

            } else {
                $tipoOferta =	new \oferta\modelo\tipoOferta();

                $post = $url['post'] ;

                $tipoOferta->id = $post['id'];
                $tipoOferta->nome = $post['nome'];

                $tipoOferta->atualizar();

                header ('location:/oferta/atualizarTipoOferta/id/'.$tipoOferta->id);
                exit();
            }

        }

        public function excluirTipoOferta($url)
        {
                $tipoOferta =	new \oferta\modelo\tipoOferta();
                $tipoOferta->id = $url[3];
                $tipoOferta->excluir();
                $_SESSION['mensagem'] = !is_null($tipoOferta->erro) ? $tipoOferta->erro : null ;
                header ('location:/oferta/listarTipoOferta');
                exit();
        }

        public function excluir($url)
        {
                $oferta =	new \oferta\modelo\oferta();
                $oferta->id = $url[3];
                $oferta->excluir();
                header ('location:/oferta/novo/id/'.$url[4]);
                exit();
        }

        public function detalhar ($url)
        {
            $oferta = new \oferta\modelo\tipoOferta() ;

            $oferta->id = $url[3] ;
            $oferta = $oferta->listarUm() ;

            require 'oferta/visao/detalhar.php';

        }

    }
