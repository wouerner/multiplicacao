<?php
use \Discipulo\Modelo\Discipulo ;

namespace encontroComDeus\controlador;

class encontroComDeus
{
    public function index()
    {
        $encontro = new \EncontroComDeus\Modelo\EncontroComDeus() ;
        $encontros = $encontro->listarTodos();

        require_once 'modulos/EncontroComDeus/visao/encontroComDeus/listar.php';

    }
    public function novo($url)
    {
      if ( empty ( $url['post'] ) ) {

            require_once 'modulos/EncontroComDeus/visao/encontroComDeus/novo.php';

        } else {

        $post = $url['post'] ;

        $encontro = new \EncontroComDeus\Modelo\EncontroComDeus() ;
        $encontro->nome = $post['nome'];
        $encontro->dataEncontroComDeus = implode ('-',array_reverse(explode('/',$post['dataEncontroComDeus'])));
        $encontro->endereco = $post['endereco'];

        $encontro->salvar() ;

        header ('location:/encontroComDeus/encontroComDeus' );
        exit();
        }

        }

    public function ativar($url)
    {
        if (isset($url['post'])) {
            $encontro = new \EncontroComDeus\Modelo\EncontroComDeus() ;
            $encontro->id = $url[4];
            $encontro->ativar() ;
            header ('location:/encontroComDeus/encontroComDeus' );
            exit();
        }

    }

    public function grafico($url)
    {
        $encontro = new \EncontroComDeus\Modelo\EncontroComDeus() ;
        $encontro->id = $url[4];
        $encontro = $encontro->listarUm();

        require_once 'modulos/EncontroComDeus/visao/encontroComDeus/grafico.php';
    }


    public function desativar($url)
    {
        if ( isset ( $url['post'] ) ) {
            $encontro = new \EncontroComDeus\Modelo\EncontroComDeus();
            $encontro->id = $url[4];
            $encontro->desativar() ;
            header ('location:/encontroComDeus/encontroComDeus' );
            exit();
        }
    }

        public function novoMinisterio($url)
        {
            if ( empty ( $url['post'] ) ) {

                require_once 'modulos/ministerio/visao/novoMinisterio.php';

            } else {

            $ministerio =	new \Ministerio\Modelo\Ministerio() ;

            $post = $url['post'] ;
            $ministerio->nome = $post['nome'] ;

            $ministerio->salvar();
            header ('location:/ministerio/listarMinisterio') ;
            exit();
            }

        }

        public function novaFuncao($url)
        {
            if ( empty ( $url['post'] ) ) {

                require_once 'modulos/ministerio/visao/novaFuncao.php';

            } else {

            $funcao =	new \Ministerio\Modelo\Funcao() ;

            $post = $url['post'] ;
            $funcao->nome = $post['nome'] ;

            $funcao->salvar();
            header ('location:/ministerio/listarFuncao') ;
            exit();
            }

        }

        public function listarMinisterio()
        {
                  $ministerios =	new \Ministerio\Modelo\Ministerio();
                  $ministerios = $ministerios->listarTodos();

                  require 'modulos/ministerio/visao/listarMinisterio.php';

        }

        public function listarFuncao()
        {
                  $funcoes =	new \Ministerio\Modelo\Funcao();
                  $funcoes = $funcoes->listarTodos();

                  require 'modulos/ministerio/visao/listarFuncao.php';

        }


        public function atualizarFuncao($url)
        {
            if ( empty ( $url['post'] ) ) {

                $funcao =	new \Ministerio\Modelo\Funcao();
                $funcao->id = $url[3] ;
                $funcao = $funcao->listarUm();

                require_once 'modulos/ministerio/visao/atualizarFuncao.php';

            } else {
                $funcao =	new \Ministerio\Modelo\Funcao();

                $post = $url['post'] ;

                $funcao->id = $post['id'];
                $funcao->nome = $post['nome'];

                $funcao->atualizarFuncao();

                header ('location:/ministerio/atualizarFuncao/id/'.$funcao->id);
                exit();
            }

        }

    public function excluir($url)
    {
        $encontro = new \EncontroComDeus\Modelo\EncontroComDeus();
        $encontro->id = $url[4];
        $encontro->excluir();
        header ('location:/encontroComDeus/encontroComDeus');
        exit();
    }

        public function detalhar ($url)
        {
            $discipulo = new \Discipulo\Modelo\Discipulo() ;

            $discipulo->id = $url[3] ;
            $discipulo = $discipulo->listarUm() ;

            require 'Discipulo/visao/detalhar.php';

        }

        public function detalharFuncao ($url)
        {
            $funcao = new \Ministerio\Modelo\Funcao() ;

            $funcao->id = $url[3] ;
            $funcao = $funcao->listarUm() ;

            require 'ministerio/visao/detalharFuncao.php';

        }

        public function detalharMinisterio ($url)
        {
            $ministerio = new \Ministerio\Modelo\Ministerio() ;

            $ministerio->id = $url[3] ;
            $ministerio = $ministerio->listarUm() ;

            require 'ministerio/visao/detalharMinisterio.php';

        }

        public function chamar ()
        {
            $nome = (!empty($_GET['nome'])) ? $_GET['nome'] : NULL;
            $discipulo =	new \Discipulo\Modelo\Discipulo();
            $discipulo->nome = $nome;
            $discipulos = $discipulo->chamar($nome);
            require_once 'Discipulo/visao/chamar.php';

        }

        public function evento($url)
        {
            if ( empty ( $url['post'] ) ) {

                  $eventos = new \Evento\Modelo\Evento();

                  $id = $url[3];
                  $eventosDiscipulos = $eventos->listarTodosDiscipulo($id);
                $eventos = $eventos->listarTodos();

            require_once 'modulos/Discipulo/visao/evento.php';
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
