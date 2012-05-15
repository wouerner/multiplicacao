<?php
use discipulo\Modelo\Discipulo;
use discipulo\Modelo\estadoCivil;
use celula\modelo\celula;
use evento\modelo\evento;
use evento\modelo\eventoDiscipulo;

namespace discipulo\controlador; 


class discipulo{

		  /* Mostra a lista de todos os discipulos cadastrados no sistema
			*
			* */
	
		public function index(){

		  $pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1 ;

		  $discipulos =	new \discipulo\Modelo\Discipulo();
		  $quantidadePorPagina = 12;

		  $discipulos = $discipulos->listarTodosPag($_SESSION['usuario_id'], $quantidadePorPagina  , $pagina);
		  
		  $totalDiscipulos = \discipulo\Modelo\Discipulo::totalDiscipulos() ;
		  $totalDiscipulos = (int)$totalDiscipulos['total'] ;

		  require_once  'modulos/discipulo/visao/listar.php';

		}

		public function semCelula(){

		  $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1 ;
		  $quantidadePorPagina = 12;

		  $discipulos =	new \discipulo\Modelo\Discipulo();
		  $discipulos = $discipulos->semCelula($quantidadePorPagina , $pagina);
		  
		  $totalDiscipulos = \discipulo\Modelo\Discipulo::totalDiscipulosSemCelula() ;
		  $totalDiscipulos = (int)$totalDiscipulos['total'] ;


		  require_once  'modulos/discipulo/visao/listar.php';

		}

		public function semLider(){

		  $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1 ;
		  $quantidadePorPagina = 12;

		  $discipulos =	new \discipulo\Modelo\Discipulo();
		  $discipulos = $discipulos->semLider($quantidadePorPagina , $pagina);
		  
		  $totalDiscipulos = \discipulo\Modelo\Discipulo::totalDiscipulosSemLider() ;
		  $totalDiscipulos = (int)$totalDiscipulos['total'] ;

		  require_once  'modulos/discipulo/visao/listar.php';

		}

		  /*Cria um NOVO discipulo
		  * */
		  public function novo($url){
					 if ( empty ( $url['post'] ) ) {
		
					 require_once  'modulos/discipulo/visao/novo.php';
			
			}else {
					 $discipulo =	new \discipulo\Modelo\Discipulo();

					 $post = $url['post'] ;

					 $discipulo->nome			= $post['nome'];
					 $discipulo->telefone	= $post['telefone'];
					 $discipulo->endereco 	= $post['endereco'];
					 $discipulo->email 		= $post['email'];
					 $discipulo->senha		= $post['senha'];

					 if ($discipulo->salvar() ) {


								header ('location:/discipulo/detalhar/id/'.$discipulo->id);
								exit();

					 
					 }else {
								$mensagem = ($discipulo->erro== '23000') ? 'E-mail já cadastrado' :  'ok' ; 
								require_once  'modulos/discipulo/visao/novo.php';
					 
					 }

			}
			

		}
		  public function novoAnonimo($url){
					 if ( empty ( $url['post'] ) ) {
		
					 require_once  'modulos/discipulo/visao/novoAnonimo.php';
			
			}else {
					 $discipulo =	new \discipulo\Modelo\Discipulo();

					 $post = $url['post'] ;

					 $discipulo->nome			= $post['nome'];
					 $discipulo->telefone	= $post['telefone'];
					 $discipulo->endereco 	= $post['endereco'];
					 $discipulo->email 		= $post['email'];
					 $discipulo->senha		= $post['senha'];

					 if ($discipulo->salvar() ) {


								header ('location:/modulos/discipulo/visao/agradecimento.php');
								exit();

					 
					 }else {
								$mensagem = ($discipulo->erro== '23000') ? 'E-mail já cadastrado' :  'ok' ; 
								require_once  'modulos/discipulo/visao/novoAnonimo.php';
					 
					 }

			}
			

		}


		public function atualizar($url){

			if ( empty ( $url['post'] ) ) {
				
				

				$discipulo =	new \discipulo\Modelo\Discipulo();
				$lideres = $discipulo->listarLideres();

				$discipulo->id =  $url[3] ;
				$discipulo = $discipulo->listarUm();
				
				//estado civil
				$estadosCivies = new \discipulo\Modelo\estadoCivil();
				$estadosCivies->id = $discipulo->estadoCivilId ;

				$estadoCivil = $estadosCivies->listarUm();

				$estadosCivies = $estadosCivies->listarTodos();


				$lider =	new \discipulo\Modelo\Discipulo();
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
			 $tipoRede = new \rede\modelo\tipoRede();
			 $funcaoRede = new \rede\modelo\funcaoRede();

			 $tiposRedes = $tipoRede->listarTodos();
			 $funcoesRedes = $funcaoRede->listarTodos();
			 $rede->discipuloId = $url[3];
			 $redeAtual = $rede->listarUm();

			 $dataNascimento= $discipulo->getDataNascimento();


			 //escala de exito
		  	$eventos = new \evento\modelo\evento();
		
		  $id = $url[3];
		  $eventosDiscipulos = $eventos->listarTodosDiscipulo($id);
			$eventos = $eventos->listarTodos();


			 require_once  'modulos/discipulo/visao/atualizar.php';
			
			}else {
				$discipulo =	new \discipulo\Modelo\Discipulo();

				$post = $url['post'] ;

				$discipulo->id = $post['discipuloId'] ;	
				$discipulo->nome = $post['nome'] ;
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
			 	$tipoStatusCelular =	$post['tipoStatusCelular'] ; 
			 	$statusCelular =	new \statusCelular\modelo\statusCelular() ;
				$statusCelular->discipuloId = $post['discipuloId'];
				$statusCelular->tipoStatusCelular = $tipoStatusCelular;
				if (!$statusCelular->salvar()) $statusCelular->atualizar();

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

				//evento = escala de exito
				$discipuloEvento = new \evento\modelo\evento();
			  	$eventoId = $post['eventoId'];
				$discipuloId = $post['discipuloId'];
				$discipuloEvento->salvarDiscipuloEvento($discipuloId, $eventoId );	



				$discipulo->atualizar() ;

				$estadosCivies = new \discipulo\Modelo\estadoCivil();
				$estadosCivies->id = $discipulo->estadoCivilId ;

				$estadoCivil = $estadosCivies->listarUm();

				$estadosCivies = $estadosCivies->listarTodos();
				
				$_SESSION['mensagem'] = ($discipulo->erro) ? $discipulo->erro : 'ok' ;	

				header ('location:/discipulo/atualizar/id/'.$discipulo->id) ;
				exit();
			}
		
		}

		public function excluir($url){
				$discipulo =	new \discipulo\Modelo\Discipulo();
				$discipulo->id = $url[3]; 
				$discipulo->excluir();
				header ('location:/discipulo');
				exit();
		
		}


		public function detalhar ($url) {

			$discipulo = new \discipulo\Modelo\Discipulo() ;
			$eventosDiscipulo = new \evento\modelo\eventoDiscipulo();
			$ministerios = new \ministerio\modelo\ministerioTemDiscipulo();
			$statusCelular = new \statusCelular\modelo\statusCelular();

			$discipulo->id = $url[3] ; 

			$liderCelula = $discipulo->liderCelula();
			$participaCelula = $discipulo->participaCelula();
			$ministerios->discipuloId = $discipulo->id;
			$ministerios = $ministerios->pegarMinisteriodiscipulo();
			$statusCelular->discipuloId = $discipulo->id ;
			$statusCelular = $statusCelular->pegarStatusCelular() ;


			$eventosDiscipulo = $eventosDiscipulo->listarTodosDiscipulo($discipulo->id);

			$discipulo = $discipulo->listarUm() ;

			require 'discipulo/visao/detalhar.php' ;	
		
		}


		public function chamar () {

			$nome = (!empty($_GET['nome'])) ? $_GET['nome'] : NULL;
			$discipulo =	new \discipulo\Modelo\Discipulo();
			$discipulo->nome = $nome; 
			$discipulos = $discipulo->chamar($nome);	
			require_once 'discipulo/visao/chamar.php' ;

		
		}
	
		public function evento($url){
			

			if ( empty ( $url['post'] ) ) {

			$discipulo = new \discipulo\Modelo\Discipulo() ;

			$discipulo->id = $url[3] ; 
			$discipulo = $discipulo->listarUm() ;


				  $eventos = new \evento\modelo\evento();
				
				  $id = $url[3];
				  $eventosDiscipulos = $eventos->listarTodosDiscipulo($id);
				$eventos = $eventos->listarTodos();


				require_once 'modulos/discipulo/visao/evento.php' ;
			}else {
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
	
	public function novoEstadoCivil($url){
	
		  if ( empty ( $url['post'] ) ) {

					 require_once  'modulos/discipulo/visao/estadoCivil/novo.php';
 
			}else {
					 $estadoCivil =	new \discipulo\Modelo\estadoCivil();

					 $post = $url['post'] ;

					 $estadoCivil->nome = $post['nome'];
			

		 			 if ($estadoCivil->salvar() ) {


					 	header ('location:/discipulo/listarEstadoCivil');
					 	exit();

		  
		  			}else {
						 require_once  'modulos/discipulo/visao/estadoCivil/novo.php';
		  
		  			}

 		}
 

		}


		public function listarEstadoCivil(){
		
			$estadosCivies = new \discipulo\Modelo\estadoCivil();	
			$estadosCivies = $estadosCivies->listarTodos();

			require_once  'modulos/discipulo/visao/estadoCivil/listar.php';
		
		}

		public function atualizarEstadoCivil($url){

			if ( empty ( $url['post'] ) ) {

				$estadoCivil = new \discipulo\Modelo\estadoCivil();
				$estadoCivil->id = $url[3] ;
				$estadoCivil = $estadoCivil->listarUm();


				require_once  'modulos/discipulo/visao/estadoCivil/atualizar.php';
			
			}else {
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

		public function excluirEstadoCivil($url){
				$estadoCivil =	new \discipulo\Modelo\estadoCivil();
				$estadoCivil->id = $url[3]; 
				$estadoCivil->excluir();
				header ('location:/discipulo/listarEstadoCivil');
				exit();
		
		}
			
	
	
}


