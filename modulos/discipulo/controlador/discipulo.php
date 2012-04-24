<?php
use discipulo\Modelo\Discipulo;
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
		  $discipulos = $discipulos->listarTodosPag($_SESSION['usuario_id'], 5  , $pagina);
		  
		  $totalDiscipulos = \discipulo\Modelo\Discipulo::totalDiscipulos() ;
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

		/*
		 *
		 * 

		public function novoTipoStatusCelular($url){
			if ( empty ( $url['post'] ) ) {
		
			require_once  'modulos/statusCelular/visao/novoTipoStatus.php';
			
			}else {
				$discipulo =	new \statusCelular\modelo\tipoStatusCelular();

				$post = $url['post'] ;
				$tipoStatusCelular->nome = $post['nome'];

				$tipoStatusCelular->salvar();
				header ('location:/statusCelular');
				exit();
			}
			

		}*/

		public function atualizar($url){

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

				require_once  'modulos/discipulo/visao/atualizar.php';
			
			}else {
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

				
				$_SESSION['mensagem'] = ($discipulo->erro) ? $discipulo->erro : 'ok' ;	

				header ('location:/discipulo/atualizar/id/'.$discipulo->id);
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
	
	}	

?>
