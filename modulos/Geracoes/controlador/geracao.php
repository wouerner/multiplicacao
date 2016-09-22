<?php
namespace geracoes\controlador;

use discipulo\Modelo\Discipulo as DiscipuloModelo;
use geracoes\modelo\tipoGeracao as tipoGeracaoModelo;
use geracoes\modelo\geracoes as geracoesModelo;

class geracao
{
    public function index()
    {
        //require_once  'modulos/discipulo/visao/listar.php';
    }

    public function novo($url)
    {
        if (empty($url['post'])) {
            $discipulo = new DiscipuloModelo();
            $discipulo->id = $url[4];
            $discipulo = $discipulo->listarUm();

            $tipo = new tipoGeracaoModelo();
            $tipos = $tipo->listarTodos();

            require_once 'modulos/geracoes/visao/geracao/novo.php';
        } else {

            $geracao = new geracoesModelo();

            $post = $url['post'];

            $geracao->discipuloId = $post['discipuloId'];
            $geracao->tipoGeracaoId = $post['tipoGeracao'];

            if ($geracao->salvar()) {
                header ('location:/discipulo/discipulo/detalhar/id/'.$geracao->discipuloId);
                exit();
            }
        }

    }

        public function novoTipoStatusCelular($url)
        {
            if ( empty ( $url['post'] ) ) {

                require_once 'modulos/statusCelular/visao/novoTipoStatus.php';

            } else {

            $tipoStatusCelular =	new \statusCelular\modelo\tipoStatusCelular() ;

            $post = $url['post'] ;
            $tipoStatusCelular->nome = $post['nome'] ;
            $tipoStatusCelular->descricao = $post['descricao'] ;
            $tipoStatusCelular->ordem = $post['ordem'] ;
            $tipoStatusCelular->cor = $post['cor'] ;

            $tipoStatusCelular->salvar();
                header ('location:/statusCelular/listarTipoStatusCelular') ;
                exit();
            }

        }

        public function listarTipoStatusCelular()
        {
                  $tipoStatusCelulares =	new \statusCelular\modelo\tipoStatusCelular();
                  $tipoStatusCelulares = $tipoStatusCelulares->listarTodos();

                  require 'modulos/statusCelular/visao/listarTipoStatusCelular.php';

        }

        public function atualizar($url)
        {
            if ( empty ( $url['post'] ) ) {

                $discipulo =	new \discipulo\Modelo\Discipulo();
                $lideres = $discipulo->listarLideres();

                $discipulo->id =  $url[4] ;
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

        public function excluir($url)
        {
            $id = $url[4] ;
            $discipulo = $url[6] ;

            $status = new \statusCelular\modelo\statusCelular() ;
            $status->id = $id ;
            $status->excluir();
            header ('location:/statusCelular/statusCelular/novo/id/'.$discipulo);
            exit();

        }

        public function listarDiscipulosPorStatus($url)
        {
            $id = $url[4] ;

            $status = new \statusCelular\modelo\statusCelular() ;
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
