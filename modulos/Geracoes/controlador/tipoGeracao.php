<?php
namespace geracoes\controlador;

use geracoes\modelo\tipoGeracao as tipoGeracaoModelo;

class tipoGeracao
{
    public function index()
    {
        $tipo =	new tipoGeracaoModelo();
        $tipos = $tipo->listarTodos();

        require_once 'modulos/geracoes/visao/tipoGeracao/listar.php';
    }

    public function novo($url)
    {
        if (empty ($url['post'])) {
            require_once 'modulos/geracoes/visao/tipoGeracao/novo.php';
        } else {
            $tipo =	new tipoGeracaoModelo();

            $post = $url['post'] ;

            $tipo->nome = $post['nome'];

            if ($tipo->salvar()) {
                header('location:/geracoes/tipoGeracao');
            }
            exit();
        }
    }

    public function atualizar($url)
    {
        if (empty($url['post'])) {
            $tipo =	new tipoGeracaoModelo();

            $tipo->id =  $url[4] ;
            $tipo = $tipo->listarUm();

            require_once 'modulos/geracoes/visao/tipoGeracao/atualizar.php';

        } else {
            $tipo =	new tipoGeracaoModelo();

            $post = $url['post'] ;

            $tipo->id = $post['id'];
            $tipo->nome = $post['nome'];

            $tipo->atualizar();

            header('location:/geracoes/tipoGeracao');
            exit();
        }
    }

        public function atualizarTipoStatusCelular($url)
        {
            if ( empty ( $url['post'] ) ) {

                $tipoStatusCelular =	new \statusCelular\modelo\tipoStatusCelular();
                $tipoStatusCelular->id = $url[4] ;
                $tipoStatusCelular = $tipoStatusCelular->listarUm();

                require_once 'modulos/statusCelular/visao/atualizarTipoStatus.php';

            } else {
                $tipoStatusCelular =	new \statusCelular\modelo\tipoStatusCelular();

                $post = $url['post'] ;

                $tipoStatusCelular->id = $post['id'];
                $tipoStatusCelular->nome = $post['nome'];
                $tipoStatusCelular->descricao = $post['descricao'];
                $tipoStatusCelular->ordem = $post['ordem'];
                $tipoStatusCelular->cor = $post['cor'];

                $tipoStatusCelular->atualizar();
                header ('location:/statusCelular/atualizarTipoStatusCelular/id/'.$tipoStatusCelular->id);
                exit();
            }

        }

        public function excluirTipoStatusCelular($url)
        {
                $tipoStatusCelular =	new \statusCelular\modelo\tipoStatusCelular();
                $tipoStatusCelular->id = $url[4];
                $tipoStatusCelular->excluir();

                $_SESSION['mensagem'] = !is_null($tipoStatusCelular->erro) ? $tipoStatusCelular->erro : null ;

                header ('location:/statusCelular/statusCelular/listarTipoStatusCelular');
                exit();
        }

        public function detalhar ($url)
        {
            $status = new \statusCelular\modelo\tipoStatusCelular() ;

            $status->id = $url[4] ;
            $status = $status->listarUm() ;

            require 'statusCelular/visao/detalhar.php';

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

        public function excluir($url)
        {
            $id = $url[4] ;
            $discipulo = $url[6] ;

            $status = new \StatusCelular\Modelo\StatusCelular() ;
            $status->id = $id ;
            $status->excluir();
            header ('location:/statusCelular/statusCelular/novo/id/'.$discipulo);
            exit();

        }

        public function listarDiscipulosPorStatus($url)
        {
            $id = $url[4] ;

            $status = new \StatusCelular\Modelo\StatusCelular() ;
            $status->tipoStatusCelular = (int) $id ;

            $discipulos = $status->listarStatusCelularPorTipo();

            $discipulosInativos = $status->discipulosInativos();
            $discipulosArquivo = $status->discipulosArquivo();

            $totalDiscipulos = count($discipulos);
            $totalArquivo = count($discipulosArquivo);
            $totalInativos = count($discipulosInativos);

            $cont = 0 ;

            $tipoStatus = new \statusCelular\modelo\tipoStatusCelular() ;
            $tipoStatus->id = (int) $id ;
            $tipoStatus = $tipoStatus->listarUm() ;

            require 'statusCelular/visao/discipuloPorStatus.php';

        }

    }
