<?php
use discipulo\Modelo\Discipulo;
use discipulo\Modelo\estadoCivil;
use celula\modelo\celula;
use evento\modelo\evento;
use evento\modelo\eventoDiscipulo;
use framework\visao\visao ;
use discipulo\Modelo\foto;

namespace discipulo\controlador;

class foto
{
            const DIR_FOTO = '/../visao/foto/upload/' ;

          /* Mostra a lista de todos os discipulos cadastrados no sistema
            *
            * */

        public function index()
        {
        }

        public function novo($url)
        {
            if (!$_FILES) {

                $discipuloId = $url[4] ;
              require_once 'modulos/discipulo/visao/foto/novo.php';
            } else {

                $id = $url['post']['discipuloId'] ;

                $foto = $_FILES['arquivo'] ;
                //var_dump($foto);
                $nomeArquivo = str_replace(" ", "",microtime()).".".strtolower(end(explode(".", $foto['name'])));
                //echo $nomeArquivo;
                $dir = dirname(__FILE__).self::DIR_FOTO;
                //echo $dir;

                if (move_uploaded_file($foto['tmp_name'], $dir.$nomeArquivo)) {
                //echo "Arquivo enviado com sucesso!";

                    $foto = new \discipulo\Modelo\foto();
                    $foto->discipuloId = $id ;
                    $foto->url = '/modulos/discipulo/visao/foto/upload/'.$nomeArquivo ;

                    if ( !$foto->salvar()) {

                        $foto = $foto->listarUm();
                        //var_dump($foto);

                        $arq = $_SERVER['DOCUMENT_ROOT'].$foto->url ;
                        //var_dump($arq);
                        //var_dump($nomeArquivo) ;
                        //unlink($arq ) ;
                        $foto->url ='/modulos/discipulo/visao/foto/upload/'.$nomeArquivo ;

                        $foto->atualizar();
                    }
                    $redirecionar = '/discipulo/discipulo/perfil/id/'.$id;
                    header ('location:'.$redirecionar );
                    exit();
                }

            }
        }

        public function semLider()
        {
          $pagina = isset($_GET['pagina']) ? (int) $_GET['pagina'] : 1 ;
          $quantidadePorPagina = 12;

          $discipulos =	new \Discipulo\Modelo\Discipulo();
          $discipulos = $discipulos->semLider($quantidadePorPagina , $pagina);

          $totalDiscipulos = \Discipulo\Modelo\Discipulo::totalDiscipulosSemLider() ;
          $totalDiscipulos = (int) $totalDiscipulos['total'] ;

          require_once 'modulos/discipulo/visao/listar.php';

        }

          /*Cria um NOVO discipulo
          * */
        public function novoCompleto($url)
        {
         if ( empty ( $url['post'] ) ) {
            $estadosCivies = new \discipulo\Modelo\estadoCivil();

                $estadosCivies = $estadosCivies->listarTodos();

                $lideres =	new \Discipulo\Modelo\Discipulo();
                $lideres =	$lideres->listarlideres();

                $celula = new \celula\modelo\celula();

                $celulas = new \celula\modelo\celula();
                $celulas = $celulas->listarTodos();

            //status celular da pessoa
             $tiposStatusCelulares =	new \statusCelular\modelo\tipoStatusCelular() ;
             $statusCelularDiscipulo =	new \statusCelular\modelo\statusCelular() ;

             $tiposStatusCelulares = $tiposStatusCelulares->listarTodos();

             //$statusCelularDiscipulo->discipuloId= $url[3];
             $statusCelularDiscipulo = $statusCelularDiscipulo->pegarStatusCelular();
            //

             //Tipos de admissão e admissão atual
             $tipoAdmissao = new \admissao\modelo\tipoAdmissao();
             $tiposAdmissoes = $tipoAdmissao->listarTodos();

             $tipoAdmissaoAtual = new \admissao\modelo\admissao();
             //$tipoAdmissaoAtual->discipuloId = $url[3] ;
             $tipoAdmissaoAtual = $tipoAdmissaoAtual->listarUm();

             //tipos de rede e rede atual da pessoa
             $rede = new \rede\modelo\rede();
             $tipoRede = new \Rede\Modelo\TipoRede();
             $funcaoRede = new \rede\modelo\funcaoRede();

             $tiposRedes = $tipoRede->listarTodos();
             $funcoesRedes = $funcaoRede->listarTodos();
             $redeAtual = $rede->listarUm();

             //escala de exito
              $eventos = new \evento\modelo\evento();

          //$eventosDiscipulos = $eventos->listarTodosDiscipulo($$id);
            $eventos = $eventos->listarTodos();

            require_once 'modulos/discipulo/visao/novoCompleto.php';
        } else {
                $discipulo =	new \Discipulo\Modelo\Discipulo();

                $post = $url['post'] ;

                $discipulo->nome = $post['nome'] ;
                $discipulo->alcunha = $post['alcunha'] ;
                $discipulo->setDataNascimento($post['dataNascimento']) ;
                $discipulo->telefone = $post['telefone'];
                $discipulo->sexo = $post['sexo'] ;
                $discipulo->estadoCivilId = $post['estadoCivilId'] ;
                $discipulo->endereco = $post['endereco'] ;
                $discipulo->email = $post['email'] ;
                $discipulo->celula = $post['celula'] ;
                $discipulo->ativo =isset( $post['ativo']) ? $post['ativo']: 0 ;
                $discipulo->lider = $post['lider'] ;

                if ( $discipulo->emailUnico() ) {

                          $discipulo->salvarCompleto() ;
                          $_SESSION['mensagem'] = array( 000 => array (
                                                                                     'mensagem'	=> 'Cadastro Realizado com Sucesso!',
                                                                                     'classe'		=> 'success'
                                                                                                          ) );
                } else {

                $_SESSION['dados']['nome'] = $post['nome'] ;
                $_SESSION['dados']['dataNascimento'] = $post['dataNascimento'] ;
                $_SESSION['dados']['telefone'] = $post['telefone'];
                $_SESSION['dados']['endereco'] = $post['endereco'] ;
                $_SESSION['dados']['email'] = $post['email'] ;

                    $_SESSION['mensagem'] ="E-mail já cadastrado" ;
                      header ('location:/discipulo/novoCompleto');
                    exit();

                }

                //status celular
                 $tipoStatusCelular =	$post['tipoStatusCelular'] ;
                 $statusCelular =	new \statusCelular\modelo\statusCelular() ;
                $statusCelular->tipoStatusCelular = $tipoStatusCelular;
                $statusCelular->discipuloId = $discipulo->id;
                if (!$statusCelular->salvar()) $statusCelular->atualizar();

                //admissão
                 $admissao = new \admissao\modelo\admissao();
                 $admissao->tipoAdmissao = $post['tipoAdmissao'] ;
                 $admissao->discipuloId = $discipulo->id ;
                 if (!$admissao->salvar()) $admissao->atualizar() ;

                //tipos de rede e rede atual da pessoa
                $rede = new \rede\modelo\rede();

                 $rede->discipuloId = $discipulo->id;
                 $rede->tipoRedeId = $post['tipoRedeId'];
                 $rede->funcaoRedeId = $post['funcaoRedeId'];
                if (!$rede->salvar()) $rede->atualizar();

                $discipuloEventos = new \evento\modelo\evento();
                  $eventos = isset($post['eventos']) ? $post['eventos'] : NULL ;
                if ($eventos) {
                          $discipuloEventos->salvarEventos($eventos,$discipulo->id);
                }

                header('location:/discipulo/listarAtualizar');
                exit();

        }

        }

          public function novoAnonimo($url)
          {
                     if ( empty ( $url['post'] ) ) {

                     require_once 'modulos/discipulo/visao/novoAnonimo.php';

            } else {
                     $discipulo =	new \Discipulo\Modelo\Discipulo();

                     $post = $url['post'] ;

                     $discipulo->nome			= $post['nome'];
                     $discipulo->telefone	= $post['telefone'];
                     $discipulo->endereco 	= $post['endereco'];
                     $discipulo->email 		= $post['email'];
                     $discipulo->senha		= $post['senha'];

                     if ($discipulo->salvar() ) {

                                header ('location:/modulos/discipulo/visao/agradecimento.php');
                                exit();

                     } else {
                                $mensagem = ($discipulo->erro== '23000') ? 'E-mail já cadastrado' :  'ok' ;
                                require_once 'modulos/discipulo/visao/novoAnonimo.php';

                     }

            }

        }

        public function atualizar($url)
        {
            if ( empty ( $url['post'] ) ) {

                $discipulo =	new \Discipulo\Modelo\Discipulo();
                $lideres = $discipulo->listarLideres();

                $discipulo->id =  $url[3] ;
                $discipulo = $discipulo->listarUm();

                //estado civil
                $estadosCivies = new \discipulo\Modelo\estadoCivil();
                $estadosCivies->id = $discipulo->estadoCivilId ;

                $estadoCivil = $estadosCivies->listarUm();

                $estadosCivies = $estadosCivies->listarTodos();

                $lider =	new \Discipulo\Modelo\Discipulo();
                $lider->id = $discipulo->lider ;
                $lider = $lider->listarUm($discipulo->lider);

                $celula = new \celula\modelo\celula();
                $celula->id = $discipulo->celula;
                $celula = $celula->listarUm();

                $celulas = new \celula\modelo\celula();
                $celulas = $celulas->listarTodos();

            //status celular da pessoa
             $tiposStatusCelulares =	new \statusCelular\modelo\tipoStatusCelular() ;
             $statusCelularDiscipulo =	new \statusCelular\modelo\statusCelular() ;

             $tiposStatusCelulares = $tiposStatusCelulares->listarTodos();

             $statusCelularDiscipulo->discipuloId= $url[3];
             $statusCelularDiscipulo = $statusCelularDiscipulo->pegarStatusCelular();
            //

             //Tipos de admissão e admissão atual
             $tipoAdmissao = new \admissao\modelo\tipoAdmissao();
             $tiposAdmissoes = $tipoAdmissao->listarTodos();

             $tipoAdmissaoAtual = new \admissao\modelo\admissao();
             $tipoAdmissaoAtual->discipuloId = $url[3] ;
             $tipoAdmissaoAtual = $tipoAdmissaoAtual->listarUm();

             //tipos de rede e rede atual da pessoa
             $rede = new \rede\modelo\rede();
             $tipoRede = new \Rede\Modelo\TipoRede();
             $funcaoRedes = new \rede\modelo\funcaoRede();

             $tiposRedes = $tipoRede->listarTodos();
             $funcaoRedes = $funcaoRedes->listarTodos();
             $redeAtual = $rede->listarUm();

            //ministerio da pessoa.
             $ministerio = new \ministerio\modelo\ministerio() ;
             $ministerio = $ministerio->listarTodos() ;

             $funcaoMinisterio = new \ministerio\modelo\funcao() ;
             $funcaoMinisterio = $funcaoMinisterio->listarTodos() ;

             //escala de exito
              $eventos = new \evento\modelo\evento();

          $id = $url[3];
          $eventosDiscipulos = $eventos->listarTodosDiscipulo($id);
            $eventos = $eventos->listarTodos();

            $dataN = $discipulo->getDataNascimento()->format('d/m/Y');
            $status = $discipulo->getStatusCelular();
            $rede = $discipulo->getRede();

             require_once 'modulos/discipulo/visao/atualizar.php';

            } else {
                $discipulo =	new \Discipulo\Modelo\Discipulo();

                $post = $url['post'] ;

                $discipulo->id = $post['discipuloId'] ;
                $discipulo->nome = $post['nome'] ;
                $discipulo->alcunha = $post['alcunha'] ;
                $discipulo->setDataNascimento($post['dataNascimento']) ;
                $discipulo->telefone = $post['telefone'];
                $discipulo->sexo = $post['sexo'] ;
                $discipulo->estadoCivilId = $post['estadoCivilId'] ;
                $discipulo->endereco = $post['endereco'] ;
                $discipulo->email = $post['email'] ;
                $discipulo->celula = $post['celula'] ;
                $discipulo->ativo =isset( $post['ativo']) ? $post['ativo']: null ;
                $discipulo->lider = $post['lider'] ;

                //status celular
             /*	$tipoStatusCelular =	$post['tipoStatusCelular'] ;
                 $statusCelular =	new \statusCelular\modelo\statusCelular() ;
                $statusCelular->discipuloId = $post['discipuloId'];
                $statusCelular->tipoStatusCelular = $tipoStatusCelular;
                if (!$statusCelular->salvar()) $statusCelular->atualizar();*/

                //admissão
                 $admissao = new \admissao\modelo\admissao();
                 $admissao->discipuloId = $post['discipuloId'] ;
                 $admissao->tipoAdmissao = $post['tipoAdmissao'] ;
                 if (!$admissao->salvar()) $admissao->atualizar() ;

                //tipos de rede e rede atual da pessoa
                $rede = new \rede\modelo\rede();

                 $rede->discipuloId = $post['discipuloId'];
                 $rede->tipoRedeId = $post['tipoRedeId'];
                 $rede->funcaoRedeId = $post['funcaoRedeId'];
                if (!$rede->salvar()) $rede->atualizar();

                $discipuloEventos = new \evento\modelo\evento();
              $eventos = isset($post['eventos']) ? $post['eventos'] : NULL ;
                if (!is_null($eventos)) $discipuloEventos->salvarEventos($eventos,$discipulo->id);

                //ministerio

                $ministerio = new \ministerio\modelo\ministerioTemDiscipulo();
                $ministerio->discipuloId = $discipulo->id ;
                $ministerio->funcaoId = $post['fministerio'] ;
                $ministerio->ministerioId = $post['ministerio'] ;
                if (!$ministerio->salvar()) $ministerio->atualizar();

                $discipulo->atualizar() ;

                $estadosCivies = new \discipulo\Modelo\estadoCivil();
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
                    header ('location:/discipulo/atualizar/id/'.$discipulo->id) ;
                    exit();
                } else {
                    header ('location:/discipulo/listarAtualizar') ;
                    exit();

                }
            }

        }

        public function excluir($url)
        {
                $discipulo =	new \Discipulo\Modelo\Discipulo();
                $discipulo->id = $url[3];
                $discipulo->excluir();
                header ('location:/discipulo/listarAtualizar');
                exit();

        }

        public function detalhar ($url)
        {
            $discipulo = new \Discipulo\Modelo\Discipulo() ;
            $eventoDiscipulo = new \evento\modelo\eventoDiscipulo();
            $ministerios = new \ministerio\modelo\ministerioTemDiscipulo();
            $statusCelular = new \statusCelular\modelo\statusCelular();

            $discipulo->id = $url[3] ;

            $liderCelula = $discipulo->liderCelula();
            $participaCelula = $discipulo->participaCelula();
            $ministerios->discipuloId = $discipulo->id;
            $ministerios = $ministerios->pegarMinisterioDiscipulo();
            $statusCelular->discipuloId = $discipulo->id ;
            $statusCelular = $statusCelular->pegarstatuscelular() ;

            $eventoDiscipulo = $eventoDiscipulo->listarTodosDiscipulo($discipulo->id);

            $discipulo = $discipulo->listarUm() ;

            require 'discipulo/visao/detalhar.php';

        }

        public function chamar ()
        {
            $nome = (!empty($_GET['nome'])) ? $_GET['nome'] : NULL;
            $discipulo =	new \Discipulo\Modelo\Discipulo();
            $discipulo->nome = $nome;
            $discipulos = $discipulo->chamar($nome);

                $estadosCivies = new \discipulo\Modelo\estadoCivil();

                $estadosCivies = $estadosCivies->listarTodos();

                $lideres =	new \Discipulo\Modelo\Discipulo();
                $lideres =	$lideres->listarlideres();

                $celula = new \celula\modelo\celula();

                $celulas = new \celula\modelo\celula();
                $celulas = $celulas->listarTodos();

            //status celular da pessoa
             $tiposStatusCelulares =	new \statusCelular\modelo\tipoStatusCelular() ;
             $statusCelularDiscipulo =	new \statusCelular\modelo\statusCelular() ;

             $tiposStatusCelulares = $tiposStatusCelulares->listarTodos();

             //$statusCelularDiscipulo->discipuloId= $url[3];
             $statusCelularDiscipulo = $statusCelularDiscipulo->pegarStatusCelular();
            //

             //Tipos de admissão e admissão atual
             $tipoAdmissao = new \admissao\modelo\tipoAdmissao();
             $tiposAdmissoes = $tipoAdmissao->listarTodos();

             $tipoAdmissaoAtual = new \admissao\modelo\admissao();
             $tipoAdmissaoAtual = $tipoAdmissaoAtual->listarUm();

             //tipos de rede e rede atual da pessoa
             $rede = new \rede\modelo\rede();
             $tipoRede = new \Rede\Modelo\TipoRede();
             $funcaoRede = new \rede\modelo\funcaoRede();

             $tiposRedes = $tipoRede->listarTodos();
             $funcaoRedes = $funcaoRede->listarTodos();
             $redeAtual = $rede->listarUm();

            //ministerio da pessoa.
             $ministerio = new \ministerio\modelo\ministerio() ;
             $ministerio = $ministerio->listarTodos() ;

             $funcaoMinisterio = new \ministerio\modelo\funcao() ;
             $funcaoMinisterio = $funcaoMinisterio->listarTodos() ;

             //escala de exito
              $eventos = new \evento\modelo\evento();

           //$eventosDiscipulos = $eventos->listarTodosDiscipulo($$id);
             $eventos = $eventos->listarTodos();
             require_once 'discipulo/visao/chamar.php';

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

                     $id = $post['discipuloId'];

                     header ('location:/discipulo/evento/id/'.$id);
                     exit();

            }

        }

    public function novoEstadoCivil($url)
    {
          if ( empty ( $url['post'] ) ) {

                     require_once 'modulos/discipulo/visao/estadoCivil/novo.php';

            } else {
                     $estadoCivil =	new \discipulo\Modelo\estadoCivil();

                     $post = $url['post'] ;

                     $estadoCivil->nome = $post['nome'];

                      if ($estadoCivil->salvar() ) {

                         header ('location:/discipulo/listarEstadoCivil');
                         exit();

                      } else {
                         require_once 'modulos/discipulo/visao/estadoCivil/novo.php';

                      }

         }

        }

        public function listarEstadoCivil()
        {
            $estadosCivies = new \discipulo\Modelo\estadoCivil();
            $estadosCivies = $estadosCivies->listarTodos();

            require_once 'modulos/discipulo/visao/estadoCivil/listar.php';

        }

        public function atualizarEstadoCivil($url)
        {
            if ( empty ( $url['post'] ) ) {

                $estadoCivil = new \discipulo\Modelo\estadoCivil();
                $estadoCivil->id = $url[3] ;
                $estadoCivil = $estadoCivil->listarUm();

                require_once 'modulos/discipulo/visao/estadoCivil/atualizar.php';

            } else {
                $estadoCivil =	new \discipulo\Modelo\estadoCivil();

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
                $estadoCivil =	new \discipulo\Modelo\estadoCivil();
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
          $quantidadePorPagina = 12;

          $discipulos = $discipulos->listarTodosPag($_SESSION['usuario_id'], $quantidadePorPagina  , $pagina);

          $totalDiscipulos = \Discipulo\Modelo\Discipulo::totalDiscipulos() ;
          $totalDiscipulos = (int) $totalDiscipulos['total'] ;

                $estadosCivies = new \discipulo\Modelo\estadoCivil();

                $estadosCivies = $estadosCivies->listarTodos();

                $lideres =	new \Discipulo\Modelo\Discipulo();
                $lideres =	$lideres->listarlideres();

                $celula = new \celula\modelo\celula();

                $celulas = new \celula\modelo\celula();
                $celulas = $celulas->listarTodos();

            //status celular da pessoa
             $tiposStatusCelulares =	new \statusCelular\modelo\tipoStatusCelular() ;
             $statusCelularDiscipulo =	new \statusCelular\modelo\statusCelular() ;

             $tiposStatusCelulares = $tiposStatusCelulares->listarTodos();
             $cores = array('verde','amarelo','cinza','laranja','','');

             //colocando cores na tabela.

             //$statusCelularDiscipulo->discipuloId= $url[3];
             $statusCelularDiscipulo = $statusCelularDiscipulo->pegarStatusCelular();
            //

             //Tipos de admissão e admissão atual
             $tipoAdmissao = new \admissao\modelo\tipoAdmissao();
             $tiposAdmissoes = $tipoAdmissao->listarTodos();

             $tipoAdmissaoAtual = new \admissao\modelo\admissao();
             $tipoAdmissaoAtual = $tipoAdmissaoAtual->listarUm();

             //tipos de rede e rede atual da pessoa
             $rede = new \rede\modelo\rede();

             $tipoRede = new \Rede\Modelo\TipoRede();
             $funcaoRedes = new \rede\modelo\funcaoRede();

             $tiposRedes = $tipoRede->listarTodos();
             $funcaoRedes = $funcaoRedes->listarTodos();

            //ministerio da pessoa.
             $ministerio = new \ministerio\modelo\ministerio() ;
             $ministerio = $ministerio->listarTodos() ;

             $funcaoMinisterio = new \ministerio\modelo\funcao() ;
             $funcaoMinisterio = $funcaoMinisterio->listarTodos() ;

             //escala de exito
              $eventos = new \evento\modelo\evento();

          //$eventosDiscipulos = $eventos->listarTodosDiscipulo($$id);
            $eventos = $eventos->listarTodos();

            require 'discipulo/visao/listarAtualizar.php';

        }

        public function encontroComDeus($url)
        {
            $discipulo = new \Discipulo\Modelo\Discipulo() ;

            $discipulo->id = $url[3] ;
            $discipulo = $discipulo->listarum() ;

            require 'discipulo/visao/fichas/encontroComDeus.php';

        }

        public function fichaPorStatus($url)
        {
            $discipulos = new \Discipulo\Modelo\Discipulo() ;

            $discipulos = $discipulos->fichaPorStatus($url[3]) ;

            require 'discipulo/visao/fichas/fichaPorStatus.php';

        }

        public function cracha($url)
        {
            $discipulos = new \Discipulo\Modelo\Discipulo() ;

            $discipulos = $discipulos->fichaPorStatus($url[3]) ;

            require 'discipulo/visao/fichas/cracha.php';

        }

        public function crachaIndividual($url)
        {
            $discipulo = new \Discipulo\Modelo\Discipulo() ;
            $discipulo->id = ($url[3]);
            $discipulos[0] = $discipulo->listarUm($url[3]) ;

            require 'discipulo/visao/fichas/cracha.php';

        }

}