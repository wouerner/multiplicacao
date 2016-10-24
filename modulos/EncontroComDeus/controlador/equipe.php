<?php
namespace encontroComDeus\controlador;

use \Discipulo\Modelo\Discipulo as discipulo;

class equipe
{
    public function index($url)
    {
        $encontroId = $url['4'] ;
        $encontro = new \encontroComDeus\modelo\equipe() ;
        $encontro->encontroComDeusId = $encontroId ;

        $equipes = $encontro->listarEquipeEncontro();

        //var_dump($equipes);

        require_once 'modulos/encontroComDeus/visao/equipe/listar.php';

    }

    public function listarEquipe($url)
    {
        $tipoEquipe = new \encontroComDeus\modelo\tipoEquipe() ;
        $tiposEquipe = $tipoEquipe->listarUm();
        $encontroId = $url[6] ;

        require_once 'modulos/encontroComDeus/visao/equipe/listar.php';

    }

    public function listarTodasEquipes($url)
    {
        $encontroId = $url['4'] ;
        $equipe = new \encontroComDeus\modelo\equipe() ;
        $equipe->encontroComDeusId = $encontroId ;
        $equipes = $equipe->listarTodasEquipes() ;

        foreach ($equipes as $e) {
         $eq[$e['eNome']][] = $e ;
        }

        require_once 'modulos/encontroComDeus/visao/equipe/listarTodos.php';
    }

    public function membros($url)
    {
        $equipe = new \encontroComDeus\modelo\equipe() ;
        $equipe->id = $url[4] ;
        $equip = $equipe->listarUm();

        $equipes = $equipe->listarEquipes();
        $membros = $equipe->membros();
        $total = count($membros);

        require_once 'modulos/encontroComDeus/visao/equipe/membros.php';
    }

    public function novoEquipe($url)
    {
      if ( empty ( $url['post'] ) ) {
            $encontroId = $url[4] ;

            $tipoEquipe = new \encontroComDeus\modelo\tipoEquipe();
            $tiposEquipe = $tipoEquipe->listarTodos() ;

            require_once 'modulos/encontroComDeus/visao/equipe/novo.php';
        } else {

        $post = $url['post'] ;

        $equipe = new \encontroComDeus\modelo\equipe() ;

        $equipe->tipoEquipeId = $post['tipoEquipeId'] ;
        $equipe->encontroComDeusId = $post['encontroId'] ;
        $equipe->salvar() ;

        header ('location:/encontroComDeus/equipe/index/id/'.$equipe->encontroComDeusId );
        exit();
        }

    }

    public function novoMembro($url)
    {
      if ( empty ( $url['post'] ) ) {
            $id = $url[4] ;
            $discipulo = new discipulo() ;
            $discipulo->id = $id ;
            $discipulo = $discipulo->listarUm();

            $encontro = new \encontroComDeus\modelo\encontroComDeus();
            $equipe = new \encontroComDeus\modelo\equipe();
            $equipes = $equipe->listarEquipesAtivas() ;

            //var_dump($equipes);

            require_once 'modulos/encontroComDeus/visao/equipe/novoMembro.php';
        } else {

            $post = $url['post'] ;
            $equipe = new \encontroComDeus\modelo\equipe() ;
            $equipe->id = $post['equipeId'] ;

            $equipe->equipeId = $post['equipeId'] ;
            $equipe->discipuloId = $post['discipuloId'] ;

            if (!$equipe->eMembro()){

                $equipe->salvarMembro($post['discipuloId']) ;

                $preEquipe = new \encontroComDeus\modelo\preEquipe() ;
                $preEquipe->discipuloId = $post['discipuloId'] ;
                $preEquipe->excluir() ;

                $_SESSION['mensagem'] = array('mensagem'	=> 'Cadastro Realizado com Sucesso!',
                                                                  'class' => 'alert alert-success');
            }
            else{
                $preEquipe = new \encontroComDeus\modelo\preEquipe() ;
                $preEquipe->discipuloId = $post['discipuloId'] ;
                $preEquipe->excluir() ;

                $_SESSION['mensagem'] = array('mensagem'	=> 'Já esta Cadastrado!',
                                                                  'class' => 'alert ');
            }


            $redirecionar = '/encontroComDeus/equipe/membros/id/'.$post['equipeId'];
            //$redirecionar = $_SERVER['HTTP_REFFER'];
            header ('location:'.$redirecionar );
            //header ('location:/discipulo/discipulo' );
            exit();
        }

    }

    public function novo($url)
    {
      if ( empty ( $url['post'] ) ) {
            $encontroId = $url[4] ;
            $discipulos = new discipulo();
            $discipulos = $discipulos->listarTodos($_SESSION['usuario_id']);

            $tipoEquipe = new \encontroComDeus\modelo\tipoEquipe();
            $tipoEquipe =$tipoEquipe->listarTodos() ;

            require_once 'modulos/encontroComDeus/visao/equipe/novo.php';
        } else {

        $post = $url['post'] ;

        $equipe = new \encontroComDeus\modelo\equipe() ;

        $discipulos= $post['equipe'] ;
        $equipe->tipoEquipeId = $post['tipoEquipeId'] ;
        $equipe->encontroComDeusId = $post['encontroId'] ;
        $equipe->salvarMuitos($discipulos) ;

        header ('location:/encontroComDeus/equipe/index/id/'.$quipe->id );
        exit();
        }

    }

        public function novoMinisterio($url)
        {
            if ( empty ( $url['post'] ) ) {

                require_once 'modulos/ministerio/visao/novoMinisterio.php';

            } else {

            $ministerio =	new \ministerio\modelo\ministerio() ;

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

            $funcao =	new \ministerio\modelo\funcao() ;

            $post = $url['post'] ;
            $funcao->nome = $post['nome'] ;

            $funcao->salvar();
            header ('location:/ministerio/listarFuncao') ;
            exit();
            }

        }

        public function listarMinisterio()
        {
                  $ministerios =	new \ministerio\modelo\ministerio();
                  $ministerios = $ministerios->listarTodos();

                  require 'modulos/ministerio/visao/listarMinisterio.php';

        }

        public function listarFuncao()
        {
                  $funcoes =	new \ministerio\modelo\funcao();
                  $funcoes = $funcoes->listarTodos();

                  require 'modulos/ministerio/visao/listarFuncao.php';

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

                $celula = new \celula\modelo\celula();
                $celula->id = $discipulo['celula'];
                $celula = $celula->listarUm();

                $celulas = new \celula\modelo\celula();
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

        public function atualizarMinisterio($url)
        {
            if ( empty ( $url['post'] ) ) {

                $ministerio =	new \ministerio\modelo\ministerio();
                $ministerio->id = $url[3] ;
                $ministerio = $ministerio->listarUm();

                require_once 'modulos/ministerio/visao/atualizarMinisterio.php';

            } else {
                $ministerio =	new \ministerio\modelo\ministerio();

                $post = $url['post'] ;

                $ministerio->id = $post['id'];
                $ministerio->nome = $post['nome'];

                $ministerio->atualizarMinisterio();

                header ('location:/ministerio/atualizarMinisterio/id/'.$ministerio->id);
                exit();
            }

        }

        public function atualizarFuncao($url)
        {
            if ( empty ( $url['post'] ) ) {

                $funcao =	new \ministerio\modelo\funcao();
                $funcao->id = $url[3] ;
                $funcao = $funcao->listarUm();

                require_once 'modulos/ministerio/visao/atualizarFuncao.php';

            } else {
                $funcao =	new \ministerio\modelo\funcao();

                $post = $url['post'] ;

                $funcao->id = $post['id'];
                $funcao->nome = $post['nome'];

                $funcao->atualizarFuncao();

                header ('location:/ministerio/atualizarFuncao/id/'.$funcao->id);
                exit();
            }

        }

        public function excluirMembro($url)
        {
                $equipe =	new \encontroComDeus\modelo\equipe();
                $equipe->equipeId = $url[4];
                $equipe->discipuloId = $url[6];
                $equipe->excluir();

                header ('location:/encontroComDeus/equipe/membros/id/'.$equipe->equipeId );
                exit();
        }

        public function excluirEquipe($url)
        {
                $encontroId = $url[6] ;
                $equipe =	new \encontroComDeus\modelo\equipe();
                $equipe->equipeId = $url[4];
                $equipe->excluirEquipe();

                header ('location:/encontroComDeus/equipe/index/id/'.$encontroId );
                exit();
        }

        public function excluirFuncao($url)
        {
                $funcao =	new \ministerio\modelo\funcao();
                $funcao->id = $url[3];
                $funcao->excluir();

                $_SESSION['mensagem'] = !is_null($funcao->erro) ? $funcao->erro : null ;
                header ('location:/ministerio/listarFuncao');
                exit();
        }

        public function excluir($url)
        {
                $ministerio =	new \ministerio\modelo\ministerioTemDiscipulo();
                $ministerio->discipuloId = $url[3];
                $ministerio->ministerioId = $url[4];
                $ministerio->excluir();
                header ('location:/ministerio/novo/id/'.$ministerio->discipuloId);
                exit();
        }

        public function detalhar ($url)
        {
            $discipulo = new \Discipulo\Modelo\Discipulo() ;

            $discipulo->id = $url[3] ;
            $discipulo = $discipulo->listarUm() ;

            require 'discipulo/visao/detalhar.php';

        }

        public function detalharFuncao ($url)
        {
            $funcao = new \ministerio\modelo\funcao() ;

            $funcao->id = $url[3] ;
            $funcao = $funcao->listarUm() ;

            require 'ministerio/visao/detalharFuncao.php';

        }

        public function detalharMinisterio ($url)
        {
            $ministerio = new \ministerio\modelo\ministerio() ;

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
