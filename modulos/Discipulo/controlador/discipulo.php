<?php
namespace discipulo\controlador;

use Discipulo\Modelo\Discipulo as DiscipuloModelo;
use discipulo\Modelo\estadoCivil;
use Celula\Modelo\Celula as CelulaModelo;
use evento\modelo\evento;
use evento\modelo\eventoDiscipulo;
use seguranca\modelo\acl;
use Oferta\modelo\oferta as OfertaModelo;
use Oferta\modelo\tipoOferta as TipoOfertaModelo;

/**
 * Discipulo
 *
 * @package Discipulo
 * @author wouerner <wouerner@gmail.com>
 */
class discipulo
{
    /* Mostra a lista de todos os discipulos cadastrados no sistema
    *
    * */
    public function index()
    {
        $acl = new \Seguranca\Modelo\Acl($_SESSION['usuario_id']);

        $pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1 ;

        $quantidadePorPagina = 50;

          //$discipulos = $discipulos->listarTodosPag($_SESSION['usuario_id'], $quantidadePorPagina  , $pagina);

        $totalDiscipulos = \Discipulo\Modelo\Discipulo::totalDiscipulos() ;
        $totalDiscipulos = (int) $totalDiscipulos['total'] ;

        $discipulos =	new \Discipulo\Modelo\Discipulo();
            if ($acl->hasPermission('admin_acesso') == true) {
              $discipulos = $discipulos->listarTodosPag($_SESSION['usuario_id'], $quantidadePorPagina  , $pagina);
            } else {
                $discipulos->id = $_SESSION['usuario_id'];
              $discipulos = $discipulos->listarDiscipulos();

            }

          require_once 'modulos/Discipulo/visao/listar.php';
    }

    public function store()
    {
        $discipulo = new \Discipulo\Modelo\Discipulo();
        $post = $url['post'];

        $discipulo->igreja = (int)$url[4];
        $discipulo->nome = $post['nome'];
        $discipulo->alcunha = $post['alcunha'] ;
        $discipulo->setDataNascimento($post['dataNascimento']) ;
        $discipulo->telefone = $post['telefone'];
        $discipulo->sexo = $post['sexo'] ;
        $discipulo->estadoCivilId = $post['estadoCivilId'] ;
        $discipulo->endereco = $post['endereco'] ;
        $discipulo->email = $post['email'] ;
        $discipulo->celula = $post['celula'] ?$post['celula'] : null ;
        $discipulo->ativo = 1 ;
        $discipulo->lider = $post['lider'] ? $post['lider'] : null;

        $discipulo::insert();

        //$_SESSION['mensagem'] = array('mensagem'=> 'Cadastro Realizado com Sucesso!',
                                                  //'class' => 'alert alert-success');

        header('Content-Type: application/json');
        echo json_encode(["success"=>$success, "total"=>$total]);
        die;
    }

    public function lista(){
          require_once 'modulos/Discipulo/visao/lista.php';
    }

    public function index2()
    {
        $acl = new \Seguranca\Modelo\Acl($_SESSION['usuario_id']);

        $pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1 ;

        $quantidadePorPagina = 50;

        $discipulos =	new \Discipulo\Modelo\Discipulo();

        $limit = array_key_exists('count', $_REQUEST) ? $_REQUEST['count']: null;
        $page = array_key_exists('page', $_REQUEST) ? $_REQUEST['page'] : null;
        $filter = array_key_exists('filter', $_REQUEST) ? $_REQUEST['filter'] : null;

        $discipulos = $discipulos->listarTodosLista($limit, $page, $filter);

        $total =  \Discipulo\Modelo\Discipulo::totalParam($filter) ;

        //var_dump($total);die;
        header('Content-Type: application/json');
        echo json_encode(["dados"=>$discipulos, "total"=>$total]);
        die;
    }

    public function listarPorLider($url)
    {
        //include 'seguranca/ACL/assets/php/database.php';
        $acl = new \Seguranca\Modelo\Acl($_SESSION['usuario_id']);
      $pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1 ;

      $quantidadePorPagina = 50;

      $totalDiscipulos = \Discipulo\Modelo\Discipulo::totalDiscipulos() ;
      $totalDiscipulos = (int) $totalDiscipulos['total'] ;

      $discipulos =	new \Discipulo\Modelo\Discipulo();
        $discipulos->id = $url[4];
         $discipulos = $discipulos->listarDiscipulos();

      require_once 'modulos/Discipulo/visao/listar.php';

    }

    public function inativos()
    {
        $acl = new \Seguranca\Modelo\Acl($_SESSION['usuario_id']);

      $pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1 ;

      $discipulos =	new \Discipulo\Modelo\Discipulo();
      $quantidadePorPagina = 12;

        if ( $acl->hasPermission('admin_acesso') == true ) {
                $discipulos = $discipulos->inativos() ;
            //	var_dump($discipulos);
        } else {
                $discipulos->lider = $_SESSION['usuario_id'];
                $discipulos = $discipulos->inativosPorLider() ;
        }

        $total = count($discipulos);

      $totalDiscipulos = \Discipulo\Modelo\Discipulo::totalDiscipulos() ;
      $totalDiscipulos = (int) $totalDiscipulos['total'] ;

      require_once 'modulos/Discipulo/visao/inativos.php';
    }

    public function ativar($url)
    {
        $discipulo =	new \Discipulo\Modelo\Discipulo();

        $discipulo->id = $url[4] ;
        $discipulo->ativar();

        $aviso = new \Aviso\Modelo\Aviso();
        $aviso->identificacao = $discipulo->id;
        $aviso->tipoAviso = 7;
        $aviso->emissor = $_SESSION['usuario_id'];
        $aviso->salvar();

        $discipulo = $discipulo->listarUm();

        $headers = "MIME-Version: 1.1\n";
        $headers .= "Content-type: text/plain; charset=utf-8\n";
        $headers .= "From: Multiplicação12 <multiplicaca12@multiplicacao.org>"."\n"; // remetente
        $headers .= "Return-Path: Meu Nome <multiplicacao@multiplicacao.org>"."\n"; // return-path
        $envio = mail("tiaoveloso12@gmail.com,wouerner@gmail.com,".$discipulo->getLider()->email,
                        "Ativou Discipulo",
                        "Lider: ".$discipulo->getLider()->nome.", nome: ".$discipulo->nome,
                        $headers,"-r multiplicacao@multiplicacao.org");

        header ('location:/discipulo/discipulo/inativos');
        exit();
        }

        /* Desativar os discipulos
         * @author Wouerner
         * */
    public function desativar($url)
    {
        $discipulo = new \Discipulo\Modelo\Discipulo();

        $discipulo->id = $url[4];
        $discipulo->observacao = $url['post']['observacao'];

        $aviso = new \Aviso\Modelo\Aviso();
        $aviso->identificacao = $discipulo->id;
        $aviso->tipoAviso = 2 ;
        $aviso->emissor = $_SESSION['usuario_id'];
        $aviso->salvar();

        $discipulo->desativar();

        $discipulo = $discipulo->listarUm();

        $headers = "MIME-Version: 1.1\n";
        $headers .= "Content-type: text/plain; charset=utf-8\n";
        $headers .= "From: Multiplicação12 <multiplicaca12@multiplicacao.org>"."\n"; // remetente
        $headers .= "Return-Path: Meu Nome <multiplicacao@multiplicacao.org>"."\n"; // return-path
        $envio = mail("tiaoveloso12@gmail.com,wouerner@gmail.com,".$discipulo->getLider()->email,
                        "Desativação Discipulo",
                        "Lider: ".$discipulo->getLider()->nome.", nome: ".$discipulo->nome,
                        $headers,"-r multiplicacao@multiplicacao.org");

        header ('location:/discipulo/discipulo');
        exit();
        }

    public function arquivar($url)
    {
        $discipulo = new \Discipulo\Modelo\Discipulo();

        $discipulo->id = $url[4];
        $discipulo->arquivar();

        $aviso = new \Aviso\Modelo\Aviso();
        $aviso->identificacao = $discipulo->id;
        $aviso->tipoAviso = 5;
        $aviso->emissor = $_SESSION['usuario_id'];
        $aviso->salvar();

        $discipulo = $discipulo->listarUm();

        $headers = "MIME-Version: 1.1\n";
        $headers .= "Content-type: text/plain; charset=utf-8\n";
        $headers .= "From: Multiplicação12 <multiplicaca12@multiplicacao.org>"."\n"; // remetente
        $headers .= "Return-Path: Meu Nome <multiplicacao@multiplicacao.org>"."\n"; // return-path
        $envio = mail("tiaoveloso12@gmail.com,wouerner@gmail.com,".$discipulo->getLider()->email,
                        "Arquivou Discipulo",
                        "Lider: ".$discipulo->getLider()->nome.", nome: ".$discipulo->nome,
                        $headers,"-r multiplicacao@multiplicacao.org");

        header ('location:/discipulo/discipulo/inativos');
        exit();
    }

    public function desarquivar($url)
    {
        $discipulo = new \Discipulo\Modelo\Discipulo();

        $discipulo->id = $url[4] ;
        $discipulo->desarquivar() ;

        $aviso = new \Aviso\Modelo\Aviso();
        $aviso->identificacao = $discipulo->id;
        $aviso->tipoAviso = 6;
        $aviso->emissor = $_SESSION['usuario_id'];
        $aviso->salvar();

        $discipulo = $discipulo->listarUm();

        $headers = "MIME-Version: 1.1\n";
        $headers .= "Content-type: text/plain; charset=utf-8\n";
        $headers .= "From: Multiplicação12 <multiplicaca12@multiplicacao.org>"."\n"; // remetente
        $headers .= "Return-Path: Meu Nome <multiplicacao@multiplicacao.org>"."\n"; // return-path
        $envio = mail("tiaoveloso12@gmail.com,wouerner@gmail.com,".$discipulo->getLider()->email,
                        "Desarquivou Discipulo",
                        "Lider: ".$discipulo->getLider()->nome.", nome: ".$discipulo->nome,
                        $headers,"-r multiplicacao@multiplicacao.org");

        header ('location:/discipulo/discipulo/arquivo');
        exit();
    }

    public function arquivo()
    {
        $acl = new \Seguranca\Modelo\Acl($_SESSION['usuario_id']);
          $pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1 ;

          $discipulos =	new \Discipulo\Modelo\Discipulo();
          $quantidadePorPagina = 12;

        //teste
        if ($acl->hasPermission('admin_acesso') == true) {
          $discipulos = $discipulos->arquivados() ;
          $totalDiscipulos = \Discipulo\Modelo\Discipulo::totalDiscipulos() ;
          $totalDiscipulos = (int) $totalDiscipulos['total'] ;
        } else {
          $discipulos->lider = $_SESSION['usuario_id'];
          $discipulos = $discipulos->listarDiscipulosArquivo();
        }
        $total = count($discipulos);

        require_once 'modulos/Discipulo/visao/arquivo/listar.php';
    }

    public function semCelula()
    {
      $pagina = isset($_GET['pagina']) ? (int) $_GET['pagina'] : 1 ;
      $quantidadePorPagina = 12;

      $discipulos =	new \Discipulo\Modelo\Discipulo();
      $discipulos = $discipulos->semCelula($quantidadePorPagina , $pagina);

      $totalDiscipulos = \Discipulo\Modelo\Discipulo::totalDiscipulosSemCelula() ;
      $totalDiscipulos = (int) $totalDiscipulos['total'] ;

      require_once 'modulos/Discipulo/visao/listar.php';

    }

    public function semLider()
    {
      $pagina = isset($_GET['pagina']) ? (int) $_GET['pagina'] : 1 ;
      $quantidadePorPagina = 12;

      $discipulos =	new \Discipulo\Modelo\Discipulo();
      $discipulos = $discipulos->semLider($quantidadePorPagina , $pagina);

      $totalDiscipulos = \Discipulo\Modelo\Discipulo::totalDiscipulosSemLider() ;
      $totalDiscipulos = (int) $totalDiscipulos['total'] ;

      require_once 'modulos/Discipulo/visao/listar.php';

    }

      /*Cria um NOVO discipulo
      * */
    public function novo($url)
    {
         if ( empty ( $url['post'] ) ) {

         require_once 'modulos/Discipulo/visao/novo.php';

         } else {
             $discipulo =	new \Discipulo\Modelo\Discipulo();

             $post = $url['post'] ;

             $discipulo->nome			= $post['nome'];
             $discipulo->telefone	= $post['telefone'];
             $discipulo->endereco 	= $post['endereco'];
             $discipulo->email 		= $post['email'];
             $discipulo->senha		= $post['senha'];

             if ($discipulo->salvar() ) {
                        header ('location:/discipulo/detalhar/id/'.$discipulo->id);
                        exit();
             } else {
                $mensagem = ($discipulo->erro== '23000') ? 'E-mail já cadastrado' :  'ok' ;
                require_once 'modulos/Discipulo/visao/novo.php';
             }
        }
    }


    /**
     * novoCompleto
     *
     * @param mixed $url
     * @access public
     * @return void
     * @todo refatorar
     */
    public function novoCompleto($url)
    {
        if (empty ($url['post'])) {
            $estadosCivies = new \Discipulo\Modelo\EstadoCivil();
            $estadosCivies = $estadosCivies->listarTodos();

            $lideres = new DiscipuloModelo();
            $lideres = $lideres->listarlideres();
            $celula = new CelulaModelo();
            $celulas = new CelulaModelo();
            $celulas = $celulas->listarTodos();

            //status celular da pessoa
            $tiposStatusCelulares = new \StatusCelular\Modelo\TipoStatusCelular() ;
            $statusCelularDiscipulo = new \StatusCelular\Modelo\StatusCelular() ;

            $tiposStatusCelulares = $tiposStatusCelulares->listarTodos();

            $statusCelularDiscipulo = $statusCelularDiscipulo->pegarStatusCelular();

            //Tipos de admissão e admissão atual
            $tipoAdmissao = new \Admissao\Modelo\TipoAdmissao();
            $tiposAdmissoes = $tipoAdmissao->listarTodos();

            $tipoAdmissaoAtual = new \Admissao\Modelo\Admissao();
            $tipoAdmissaoAtual = $tipoAdmissaoAtual->listarUm();

            //tipos de rede e rede atual da pessoa
            $rede = new \Rede\Modelo\Rede();
            $tipoRede = new \Rede\Modelo\TipoRede();
            $funcaoRede = new \Rede\Modelo\FuncaoRede();

            $tiposRedes = $tipoRede->listarTodos();
            $funcoesRedes = $funcaoRede->listarTodos();
            $redeAtual = $rede->listarUm();

            //escala de exito
            $eventos = new \Evento\Modelo\Evento();

            $eventos = $eventos->listarTodos();

            require_once 'modulos/Discipulo/visao/novoCompleto.php';
        } else {
            $discipulo = new \Discipulo\Modelo\Discipulo();

            $post = $url['post'];

            $discipulo->igreja = (int)$url[4];
            $discipulo->nome = $post['nome'];
            $discipulo->alcunha = $post['alcunha'] ;
            $discipulo->setDataNascimento($post['dataNascimento']) ;
            $discipulo->telefone = $post['telefone'];
            $discipulo->sexo = $post['sexo'] ;
            $discipulo->estadoCivilId = $post['estadoCivilId'] ;
            $discipulo->endereco = $post['endereco'] ;
            $discipulo->email = $post['email'] ;

            $discipulo->celula = $post['celula'] ?$post['celula'] : null ;

            $discipulo->ativo = 1 ;

            $discipulo->lider = $post['lider'] ? $post['lider'] : null;

            if (empty($post['email']) || $discipulo->emailUnico()) {

                $discipulo->salvarCompleto();

                $aviso = new \Aviso\Modelo\Aviso();
                $aviso->identificacao = $discipulo->id ;
                $aviso->tipoAviso = 1 ;
                $aviso->emissor = $_SESSION['usuario_id'];
                $aviso->salvar();

                $_SESSION['mensagem'] = array('mensagem'=> 'Cadastro Realizado com Sucesso!',
                                                          'class' => 'alert alert-success');
                $lider =	new \Discipulo\Modelo\Discipulo();
                $lider->id = $_SESSION['usuario_id'];
                $lider = $lider->listarUm();

                $headers = "MIME-Version: 1.1\n";
                $headers .= "Content-type: text/plain; charset=utf-8\n";
                $headers .= "From: Multiplicação12 <multiplicaca12@multiplicacao.org>"."\n"; // remetente
                $headers .= "Return-Path: M12 <multiplicacao@multiplicacao.org>"."\n"; // return-path
                $envio = mail("tiaoveloso12@gmail.com,wouerner@gmail.com,".$lider->email,
                              "Novo Discipulo", "Nome: ".$discipulo->nome." Líder: ".$lider->nome,
                              $headers, "-r multiplicacao12@multiplicacao.org");
            } else {

                $_SESSION['dados']['nome'] = $post['nome'] ;
                $_SESSION['dados']['dataNascimento'] = $post['dataNascimento'] ;
                $_SESSION['dados']['telefone'] = $post['telefone'];
                $_SESSION['dados']['endereco'] = $post['endereco'] ;
                $_SESSION['dados']['email'] = $post['email'] ;

                $_SESSION['mensagem'] = array('mensagem'=> 'E-mail já cadastrado!',
                                              'class' => 'alert alert-danger');

                header ('location:/discipulo/discipulo/novoCompleto');
                exit();

            }

            if ($post['tipoStatusCelular']) {
                //status celular
                $tipoStatusCelular =	$post['tipoStatusCelular'] ;
                $statusCelular =	new \StatusCelular\Modelo\StatusCelular() ;
                $statusCelular->tipoStatusCelular = $tipoStatusCelular;
                $statusCelular->discipuloId = $discipulo->id;
                if (!$statusCelular->salvar()) $statusCelular->atualizar();
            }

            if ($post['tipoAdmissao']){
                //admissão
                $admissao = new \Admissao\Modelo\Admissao();
                $admissao->tipoAdmissao = $post['tipoAdmissao'] ;
                $admissao->discipuloId = $discipulo->id ;
                if (!$admissao->salvar()) $admissao->atualizar() ;
            }

            if (
                 $post['tipoRedeId'] &&
                 $post['funcaoRedeId']
            ){
                //tipos de rede e rede atual da pessoa
                $rede = new \Rede\Modelo\Rede();

                $rede->discipuloId = $discipulo->id;
                $rede->tipoRedeId = $post['tipoRedeId'];
                $rede->funcaoRedeId = $post['funcaoRedeId'];

                if (!$rede->salvar()) $rede->atualizar();
            }

                $discipuloEventos = new \Evento\Modelo\Evento();
                $eventos = isset($post['eventos']) ? $post['eventos'] : NULL ;
                if ($eventos) {
                    $discipuloEventos->salvarEventos($eventos,$discipulo->id);
                }

                header('location:/discipulo/discipulo/novoCompleto/igreja/' . $url[4]);
                exit();
            }
    }

    public function novoAnonimo($url)
    {
     if ( empty ( $url['post'] ) ) {

                     require_once 'modulos/Discipulo/visao/novoAnonimo.php';

            } else {
                     $discipulo =	new \Discipulo\Modelo\Discipulo();

                     $post = $url['post'] ;

                     $discipulo->nome			= $post['nome'];
                     $discipulo->telefone	= $post['telefone'];
                     $discipulo->endereco 	= $post['endereco'];
                     $discipulo->email 		= $post['email'];
                     $discipulo->senha		= $post['senha'];

                     if ($discipulo->salvar() ) {

                                header ('location:/modulos/Discipulo/visao/agradecimento.php');
                                exit();

                     } else {
                                $mensagem = ($discipulo->erro== '23000') ? 'E-mail já cadastrado' :  'ok' ;
                                require_once 'modulos/Discipulo/visao/novoAnonimo.php';

                     }

            }

        }

    public function atualizar($url)
    {
        $acl = new \Seguranca\Modelo\Acl($_SESSION['usuario_id']);

        if ( empty ( $url['post'] ) ) {

            $discipulo =	new \Discipulo\Modelo\Discipulo();
            $lideres = $discipulo->listarLideres();

            $discipulo->id =  $url[4] ;
            $discipulo = $discipulo->listarUm();

            //estado civil
            $estadosCivies = new \Discipulo\Modelo\EstadoCivil();
            $estadosCivies->id = $discipulo->estadoCivilId ;

            $estadoCivil = $estadosCivies->listarUm();

            $estadosCivies = $estadosCivies->listarTodos();

            $lider =	new \Discipulo\Modelo\Discipulo();
            $lider->id = $discipulo->lider ;
            $lider = $lider->listarUm($discipulo->lider);

            $celula = new \Celula\Modelo\Celula();
            $celula->id = $discipulo->celula;
            $celula = $celula->listarUm();

            $celulas = new \Celula\Modelo\Celula();
            $celulas = $celulas->listarTodos();

            //status celular da pessoa
             $tiposStatusCelulares =	new \StatusCelular\Modelo\TipoStatusCelular() ;
             $statusCelularDiscipulo =	new \StatusCelular\Modelo\StatusCelular() ;

             $tiposStatusCelulares = $tiposStatusCelulares->listarTodos();

             $statusCelularDiscipulo->discipuloId= $url[4];
             $statusCelularDiscipulo = $statusCelularDiscipulo->pegarStatusCelular();
            //

             //Tipos de admissão e admissão atual
             $tipoAdmissao = new \Admissao\Modelo\TipoAdmissao();
             $tiposAdmissoes = $tipoAdmissao->listarTodos();

             $tipoAdmissaoAtual = new \Admissao\Modelo\Admissao();
             $tipoAdmissaoAtual->discipuloId = $url[4] ;
             $tipoAdmissaoAtual = $tipoAdmissaoAtual->listarUm();

             //tipos de rede e rede atual da pessoa
             $rede = new \Rede\Modelo\Rede();
             $tipoRede = new \Rede\Modelo\TipoRede();
             $funcaoRedes = new \Rede\Modelo\FuncaoRede();

             $tiposRedes = $tipoRede->listarTodos();
             $funcaoRedes = $funcaoRedes->listarTodos();
             $redeAtual = $rede->listarUm();

            //ministerio da pessoa.
             $ministerio = new \Ministerio\Modelo\Ministerio() ;
             $ministerio = $ministerio->listarTodos() ;

             $funcaoMinisterio = new \Ministerio\Modelo\Funcao() ;
             $funcaoMinisterio = $funcaoMinisterio->listarTodos() ;

             //escala de exito
              $eventos = new \Evento\Modelo\Evento();

          $id = $url[3];
          $eventosDiscipulos = $eventos->listarTodosDiscipulo($id);
            $eventos = $eventos->listarTodos();

            $dataN = $discipulo->getDataNascimento()->format('d/m/Y');
            $status = $discipulo->getStatusCelular();
            $rede = $discipulo->getRede();

             require_once 'modulos/Discipulo/visao/atualizar.php';

            } else {
                $discipulo =	new \Discipulo\Modelo\Discipulo();

                $post = $url['post'] ;

                $discipulo->id = $post['discipuloId'] ;
                $discipulo->nome = $post['nome'];
                $discipulo->alcunha = isset($post['alcunha']) ?$post['alcunha'] : null;
                $discipulo->setDataNascimento($post['dataNascimento']) ;
                $discipulo->telefone = $post['telefone'];
                $discipulo->sexo = $post['sexo'] ;
                $discipulo->estadoCivilId = $post['estadoCivilId'] ;
                $discipulo->endereco = $post['endereco'] ;
                $discipulo->email = isset($post['email']) ? $post['email']: null ;
                $discipulo->celula = $post['celula'] ;

                //if ($acl->hasPermission('admin_acesso') == true) {
                //$discipulo->ativo =isset( $post['ativo']) && ($post['ativo'] == 1 )  ? $post['ativo']: 0 ;
                //var_dump($post['ativo']);
                //var_dump($discipulo->ativo);
                //exit();
                //}
                $discipulo->lider = $post['lider'] ;

                //var_dump($discipulo);
                //exit();

                //status celular
             /*	$tipoStatusCelular =	$post['tipoStatusCelular'] ;
                 $statusCelular =	new \StatusCelular\Modelo\StatusCelular() ;
                $statusCelular->discipuloId = $post['discipuloId'];
                $statusCelular->tipoStatusCelular = $tipoStatusCelular;
                if (!$statusCelular->salvar()) $statusCelular->atualizar();*/

                //admissão
                 $admissao = new \Admissao\Modelo\Admissao();
                 $admissao->discipuloId = $post['discipuloId'] ;
                 $admissao->tipoAdmissao = $post['tipoAdmissao'] ;
                 if (!$admissao->salvar()) $admissao->atualizar() ;

                //tipos de rede e rede atual da pessoa
                $rede = new \Rede\Modelo\Rede();

                 $rede->discipuloId = $post['discipuloId'];
                 $rede->tipoRedeId = $post['tipoRedeId'];
                 $rede->funcaoRedeId = $post['funcaoRedeId'];
                if (!$rede->salvar()) $rede->atualizar();

                $discipuloEventos = new \Evento\Modelo\Evento();
              $eventos = isset($post['eventos']) ? $post['eventos'] : NULL ;
                if (!is_null($eventos)) $discipuloEventos->salvarEventos($eventos,$discipulo->id);

                //ministerio

                $ministerio = new \Ministerio\Modelo\MinisterioTemDiscipulo();
                $ministerio->discipuloId = $discipulo->id ;
                $ministerio->funcaoId = $post['fministerio'] ;
                $ministerio->ministerioId = $post['ministerio'] ;
                if (!$ministerio->salvar()) $ministerio->atualizar();

                $discipulo->atualizar() ;

                $estadosCivies = new \Discipulo\Modelo\EstadoCivil();
                $estadosCivies->id = $discipulo->estadoCivilId ;

                $estadoCivil = $estadosCivies->listarUm();

                $estadosCivies = $estadosCivies->listarTodos();

                $_SESSION['mensagem'] = ($discipulo->erro) ? $discipulo->erro : array(
                                                                                                              000 => array(
                                                                                                                      'mensagem' => 'Atualizado com Sucesso' ,
                                                                                                                    'classe' => "success" )	,
                                                                                                            'discipulo' => array(
                                                                                                                              'id' => $discipulo->id,
                                                                                                    'nome' => $discipulo->nome )
                                                                                                             );

                $caminho = explode('/',$_SERVER['HTTP_REFERER']) ;

            // verifica de onde veio a requisição e enviar para a pagina da visão correta.
                if (!$caminho=='listarAtualizar') {
                    header ('location:/discipulo/discipulo/atualizar/id/'.$discipulo->id) ;
                    exit();
                } else {
                    header ('location:/discipulo/discipulo') ;
                    exit();

                }
            }

        }

    public function excluir($url)
    {
        $acl = new \Seguranca\Modelo\Acl($_SESSION['usuario_id']);

        if ($acl->hasPermission('admin_acesso') == true) {

            $discipulo = new \Discipulo\Modelo\Discipulo();
            $discipulo->id = $url[4];
            var_dump($url);
            $discipulo->excluir();
        }
        header ('location:/discipulo/discipulo');
        exit();
    }

    public function detalhar ($url)
        {
            $discipulo = new \Discipulo\Modelo\Discipulo() ;
            $eventoDiscipulo = new \Evento\Modelo\EventoDiscipulo();
            $ministerios = new \Ministerio\Modelo\MinisterioTemDiscipulo();
            $statusCelular = new \StatusCelular\Modelo\StatusCelular();
            $tipoStatus= new \StatusCelular\Modelo\TipoStatusCelular();

            $statusCelulares = $tipoStatus->listarTodos() ;

            $discipulo->id = $url[4] ;

            $ofertas = new OfertaModelo();
            $ofertas = $ofertas->porDiscipulo($discipulo->id);

            $tipoOfertas = new TipoOfertaModelo();
            $tipoOfertas = $tipoOfertas->listarTodos();

            $liderCelula = $discipulo->liderCelula();
            $participaCelula = $discipulo->participaCelula();
            $ministerios->discipuloId = $discipulo->id;
            $ministerios = $ministerios->pegarMinisterioDiscipulo();
            $statusCelular->discipuloId = $discipulo->id ;
            $statusCelular = $statusCelular->pegarstatuscelular() ;

            $eventoDiscipulo = $eventoDiscipulo->listarTodosDiscipulo($discipulo->id);

            $discipulo = $discipulo->listarUm() ;

            $totalAtivosLider =  \Discipulo\Modelo\Discipulo::totalAtivosLider($url['4']) ;
            $totalInativosLider = \Discipulo\Modelo\Discipulo::totalInativosLider($url['4']) ;

            $totalRedesLideres =  \Rede\Modelo\Rede::pegarTodasRedesPorLider($url['4']);


            //meta dos discipulos:

            $meta = new \Metas\Modelo\Metas() ;
            $meta->discipuloId = $discipulo->id;
            $metas = $meta->listar() ;

            $discipulos = $discipulo->listarDiscipulos();

            require 'Discipulo/visao/detalhar.php';

        }

    public function perfil ($url)
        {
            //var_dump($_SESSION);
            $discipulo = new \Discipulo\Modelo\Discipulo() ;
            $eventoDiscipulo = new \Evento\Modelo\EventoDiscipulo();
            $ministerios = new \Ministerio\Modelo\MinisterioTemDiscipulo();
            $statusCelular = new \StatusCelular\Modelo\StatusCelular();

            $discipulo->id = $url[4] ;

            $liderCelula = $discipulo->liderCelula();
            $participaCelula = $discipulo->participaCelula();
            $ministerios->discipuloId = $discipulo->id;
            $ministerios = $ministerios->pegarMinisterioDiscipulo();
            $statusCelular->discipuloId = $discipulo->id ;
            $statusCelular = $statusCelular->pegarstatuscelular() ;

            $eventoDiscipulo = $eventoDiscipulo->listarTodosDiscipulo($discipulo->id);

            $discipulo = $discipulo->listarUm() ;

            $totalAtivosLider =  \Discipulo\Modelo\Discipulo::totalAtivosLider($url['4']) ;
            $totalInativosLider = \Discipulo\Modelo\Discipulo::totalInativosLider($url['4']) ;

            $totalRedesLideres =  \Rede\Modelo\Rede::pegarTodasRedesPorLider($url['4']);

            require 'Discipulo/visao/perfil.php';

        }

    public function chamar ()
    {
        $acl = new \Seguranca\Modelo\Acl($_SESSION['usuario_id']);

        $nome = (!empty($_GET['nome'])) ? $_GET['nome'] : NULL;
        $discipulo =	new \Discipulo\Modelo\Discipulo();
        $discipulo->nome = $nome;
        $discipulos = $discipulo->chamar($nome);

        $estadosCivies = new \Discipulo\Modelo\EstadoCivil();

        $estadosCivies = $estadosCivies->listarTodos();

        $lideres =	new \Discipulo\Modelo\Discipulo();
        $lideres =	$lideres->listarlideres();

        $celula = new \Celula\Modelo\Celula();

        $celulas = new \Celula\Modelo\Celula();
        $celulas = $celulas->listarTodos();

        //status celular da pessoa
         $tiposStatusCelulares =	new \StatusCelular\Modelo\TipoStatusCelular() ;
         $statusCelularDiscipulo =	new \StatusCelular\Modelo\StatusCelular() ;

         $tiposStatusCelulares = $tiposStatusCelulares->listarTodos();

         //$statusCelularDiscipulo->discipuloId= $url[3];
         $statusCelularDiscipulo = $statusCelularDiscipulo->pegarStatusCelular();
        //

         //Tipos de admissão e admissão atual
         $tipoAdmissao = new \Admissao\Modelo\TipoAdmissao();
         $tiposAdmissoes = $tipoAdmissao->listarTodos();

         $tipoAdmissaoAtual = new \Admissao\Modelo\Admissao();
         $tipoAdmissaoAtual = $tipoAdmissaoAtual->listarUm();

         //tipos de rede e rede atual da pessoa
         $rede = new \Rede\Modelo\Rede();
         $tipoRede = new \Rede\Modelo\TipoRede();
         $funcaoRede = new \Rede\Modelo\FuncaoRede();

         $tiposRedes = $tipoRede->listarTodos();
         $funcaoRedes = $funcaoRede->listarTodos();
         $redeAtual = $rede->listarUm();

        //ministerio da pessoa.
         $ministerio = new \Ministerio\Modelo\Ministerio() ;
         $ministerio = $ministerio->listarTodos() ;

         $funcaoMinisterio = new \Ministerio\Modelo\Funcao() ;
         $funcaoMinisterio = $funcaoMinisterio->listarTodos() ;

         //escala de exito
          $eventos = new \Evento\Modelo\Evento();

       //$eventosDiscipulos = $eventos->listarTodosDiscipulo($$id);
         $eventos = $eventos->listarTodos();
         //require_once 'Discipulo/visao/chamar.php' ;
         require_once 'Discipulo/visao/listar.php';

    }

        public function chamarPorId ()
        {
        $acl = new \Seguranca\Modelo\Acl($_SESSION['usuario_id']);
            $discipulo =	new \Discipulo\Modelo\Discipulo();
            $discipulo->id = isset( $_GET['id'] )? $_GET['id']: '' ;
            $discipulos = $discipulo->listarUm() ;
            $nome = is_object($discipulos) ? $discipulos : NULL ;
            $discipulos = array($discipulo->listarUm()) ;
            //var_dump($discipulos);
                $estadosCivies = new \Discipulo\Modelo\EstadoCivil();

                $estadosCivies = $estadosCivies->listarTodos();

                $lideres =	new \Discipulo\Modelo\Discipulo();
                $lideres =	$lideres->listarlideres();

                $celula = new \Celula\Modelo\Celula();

                $celulas = new \Celula\Modelo\Celula();
                $celulas = $celulas->listarTodos();

            //status celular da pessoa
             $tiposStatusCelulares =	new \StatusCelular\Modelo\TipoStatusCelular() ;
             $statusCelularDiscipulo =	new \StatusCelular\Modelo\StatusCelular() ;

             $tiposStatusCelulares = $tiposStatusCelulares->listarTodos();

             //$statusCelularDiscipulo->discipuloId= $url[3];
             $statusCelularDiscipulo = $statusCelularDiscipulo->pegarStatusCelular();
            //

             //Tipos de admissão e admissão atual
             $tipoAdmissao = new \Admissao\Modelo\TipoAdmissao();
             $tiposAdmissoes = $tipoAdmissao->listarTodos();

             $tipoAdmissaoAtual = new \Admissao\Modelo\Admissao();
             $tipoAdmissaoAtual = $tipoAdmissaoAtual->listarUm();

             //tipos de rede e rede atual da pessoa
             $rede = new \Rede\Modelo\Rede();
             $tipoRede = new \Rede\Modelo\TipoRede();
             $funcaoRede = new \Rede\Modelo\FuncaoRede();

             $tiposRedes = $tipoRede->listarTodos();
             $funcaoRedes = $funcaoRede->listarTodos();
             $redeAtual = $rede->listarUm();

            //ministerio da pessoa.
             $ministerio = new \Ministerio\Modelo\Ministerio() ;
             $ministerio = $ministerio->listarTodos() ;

             $funcaoMinisterio = new \Ministerio\Modelo\Funcao() ;
             $funcaoMinisterio = $funcaoMinisterio->listarTodos() ;

             //escala de exito
              $eventos = new \Evento\Modelo\Evento();

           //$eventosDiscipulos = $eventos->listarTodosDiscipulo($$id);
             $eventos = $eventos->listarTodos();
             //require_once 'Discipulo/visao/chamar.php' ;
             require_once 'Discipulo/visao/listar.php';

        }

        public function cartao ($url)
        {
            $discipulo =	new \Discipulo\Modelo\Discipulo();
            $discipulo->id = $url[4] ;
            $discipulo = $discipulo->listarUm() ;
             require_once 'Discipulo/visao/cartao.php';

        }

        public function pesquisaJson($url)
        {
            $termo = $_GET['term'];
            $pesquisa = new \Discipulo\Modelo\Discipulo() ;
            $pesquisa = $pesquisa->pesquisaJson($termo);
            echo json_encode($pesquisa) ;

        }

        public function evento($url)
        {
            if ( empty ( $url['post'] ) ) {

            $discipulo = new \Discipulo\Modelo\Discipulo() ;

            $discipulo->id = $url[3] ;
            $discipulo = $discipulo->listarUm() ;

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

                     $id = $post['discipuloId'];

                     header ('location:/discipulo/evento/id/'.$id);
                     exit();

            }

        }

    public function novoEstadoCivil($url)
    {
          if ( empty ( $url['post'] ) ) {

                     require_once 'modulos/Discipulo/visao/estadoCivil/novo.php';

            } else {
                     $estadoCivil =	new \Discipulo\Modelo\EstadoCivil();

                     $post = $url['post'] ;

                     $estadoCivil->nome = $post['nome'];

                      if ($estadoCivil->salvar() ) {

                         header ('location:/discipulo/discipulo/listarEstadoCivil');
                         exit();

                      } else {
                         require_once 'modulos/Discipulo/visao/estadoCivil/novo.php';

                      }

         }

        }

        public function listarEstadoCivil()
        {
            $estadosCivies = new \Discipulo\Modelo\EstadoCivil();
            $estadosCivies = $estadosCivies->listarTodos();

            require_once 'modulos/Discipulo/visao/estadoCivil/listar.php';

        }

        public function atualizarEstadoCivil($url)
        {
            if ( empty ( $url['post'] ) ) {

                $estadoCivil = new \Discipulo\Modelo\EstadoCivil();
                $estadoCivil->id = $url[3] ;
                $estadoCivil = $estadoCivil->listarUm();

                require_once 'modulos/Discipulo/visao/estadoCivil/atualizar.php';

            } else {
                $estadoCivil =	new \Discipulo\Modelo\EstadoCivil();

                $post = $url['post'] ;

                $estadoCivil->id = $post['id'] ;
                $estadoCivil->nome = $post['nome'] ;

                $estadoCivil->atualizar() ;

                $_SESSION['mensagem'] = ($estadoCivil->erro) ? $estadoCivil->erro : 'ok' ;

                header ('location:/discipulo/listarEstadoCivil') ;
                exit();
            }

        }

        public function excluirEstadoCivil($url)
        {
                $estadoCivil =	new \Discipulo\Modelo\EstadoCivil();
                $estadoCivil->id = $url[3];
                $estadoCivil->excluir();
                header ('location:/discipulo/listarEstadoCivil');
                exit();

        }

        public function discipulosPorLider()
        {
                $discipulo = new \Discipulo\Modelo\Discipulo();

                $discipulo = $discipulo->discipulosPorLider();

                //xdebug_var_dump($discipulo);

        }

    public function listarAtualizar()
    {
      $pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1 ;

      $discipulos =	new \Discipulo\Modelo\Discipulo();
      $quantidadePorPagina = 30;

        //include("seguranca/ACL/assets/php/database.php");
        $acl = new \Seguranca\Modelo\Acl($_SESSION['usuario_id']);

        if ($acl->hasPermission('admin_acesso') == true) {
          $discipulos = $discipulos->listarTodosPag($_SESSION['usuario_id'], $quantidadePorPagina  , $pagina);
        } else {
            $discipulos->id = $_SESSION['usuario_id'];
          $discipulos = $discipulos->listarDiscipulos();

        }

      $totalDiscipulos = count($discipulos) ;

        $estadosCivies = new \Discipulo\Modelo\EstadoCivil();

        $estadosCivies = $estadosCivies->listarTodos();

            $lideres =	new \Discipulo\Modelo\Discipulo();
            $lideres =	$lideres->listarlideres();

            $celula = new \Celula\Modelo\Celula();

            $celulas = new \Celula\Modelo\Celula();
            $celulas = $celulas->listarTodos();

        //status celular da pessoa
         $tiposStatusCelulares =	new \StatusCelular\Modelo\TipoStatusCelular() ;
         $statusCelularDiscipulo =	new \StatusCelular\Modelo\StatusCelular() ;

         $tiposStatusCelulares = $tiposStatusCelulares->listarTodos();
         $cores = array('verde','amarelo','cinza','laranja','','');

         //colocando cores na tabela.

         //$statusCelularDiscipulo->discipuloId= $url[3];
         $statusCelularDiscipulo = $statusCelularDiscipulo->pegarStatusCelular();
        //

         //Tipos de admissão e admissão atual
         $tipoAdmissao = new \Admissao\Modelo\TipoAdmissao();
         $tiposAdmissoes = $tipoAdmissao->listarTodos();

         $tipoAdmissaoAtual = new \Admissao\Modelo\Admissao();
         $tipoAdmissaoAtual = $tipoAdmissaoAtual->listarUm();

         //tipos de rede e rede atual da pessoa
         $rede = new \Rede\Modelo\Rede();

         $tipoRede = new \Rede\Modelo\TipoRede();
         $funcaoRedes = new \Rede\Modelo\FuncaoRede();

         $tiposRedes = $tipoRede->listarTodos();
         $funcaoRedes = $funcaoRedes->listarTodos();

        //ministerio da pessoa.
         $ministerio = new \Ministerio\Modelo\Ministerio() ;
         $ministerio = $ministerio->listarTodos() ;

         $funcaoMinisterio = new \Ministerio\Modelo\Funcao() ;
         $funcaoMinisterio = $funcaoMinisterio->listarTodos() ;

         //escala de exito
          $eventos = new \Evento\Modelo\Evento();

      //$eventosDiscipulos = $eventos->listarTodosDiscipulo($$id);
        $eventos = $eventos->listarTodos();

        require 'Discipulo/visao/listarAtualizar.php';
    }

    public function encontroComDeus($url)
    {
        $discipulo = new \Discipulo\Modelo\Discipulo() ;

        $discipulo->id = $url[4] ;
        $discipulo = $discipulo->listarum() ;

        require 'Discipulo/visao/fichas/encontroComDeus.php';
    }

    public function fichaPorStatus($url)
    {
        $discipulos = new \Discipulo\Modelo\Discipulo() ;

        $discipulos = $discipulos->fichaPorStatus($url[4]) ;

        require 'Discipulo/visao/fichas/fichaPorStatus.php';
    }

    public function cracha($url)
    {
        $discipulos = new \Discipulo\Modelo\Discipulo() ;

        $discipulos = $discipulos->fichaPorStatus($url[4]) ;

        require 'Discipulo/visao/fichas/cracha.php';
    }

    public function crachaIndividual($url)
    {
        $discipulo = new \Discipulo\Modelo\Discipulo() ;
        $discipulo->id = ($url[4]);
        $discipulos[0] = $discipulo->listarUm($url[4]) ;

        require 'Discipulo/visao/fichas/cracha.php';
    }

    public function rank()
    {
        $rank = \Discipulo\Modelo\Discipulo::rank() ;
        $nomeRank = 'Ativos' ;
        require 'Discipulo/visao/rank.php';
    }

    public function rankInativos()
    {
        $rank = \Discipulo\Modelo\Discipulo::rankInativos() ;
        $nomeRank = 'Inativos' ;
        require 'Discipulo/visao/rank.php';
    }

    /**
     * lideres
     *
     * @access public
     * @return void
     */
    public function lideres()
    {
        $lideres = new DiscipuloModelo();
        $lideres = $lideres->lideres() ;

        require_once 'Celula/visao/listarLideresCelula.php';
    }

    public function emailUnico($url)
    {

        $discipulo = new DiscipuloModelo();

        $post = $url['post'];

        $discipulo->email = $post['email'] ;

        echo json_encode(['success' => $discipulo->emailUnico()]) ;
    }
}
