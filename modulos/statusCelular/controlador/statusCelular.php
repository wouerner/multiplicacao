<?php
use \statusCelular\modelo\tipoStatusCelular ;
use \statusCelular\modelo\statusCelular ;
use \discipulo\Modelo\Discipulo ;

namespace statusCelular\controlador; 


	class statusCelular{
	
		public function index(){


//			require_once  'modulos/discipulo/visao/listar.php';

		
		}
		public function novo($url){
			if ( empty ( $url['post'] ) ) {
				$tiposStatusCelulares =	new \statusCelular\modelo\tipoStatusCelular() ; 
			 	$statusCelularDiscipulo =	new \statusCelular\modelo\statusCelular() ;

			 	$tiposStatusCelulares = $tiposStatusCelulares->listarTodos();	
			
				$statusCelularDiscipulo->discipuloId= $url[3];
				
				$historico = $statusCelularDiscipulo->listarTodosStatus();

				$statusCelularDiscipulo = $statusCelularDiscipulo->pegarStatusCelular();

				$discipulo = new \discipulo\Modelo\Discipulo() ;
				$discipulo->id = $url[3] ;
				$discipulo = $discipulo->listarUm();

				require_once  'modulos/statusCelular/visao/novo.php';
			
			}else {
				$statusCelular =	new \statusCelular\modelo\statusCelular();

				$post = $url['post'] ;
				$statusCelular->discipuloId = $post['discipuloId'];
				$statusCelular->tipoStatusCelular = $post['tipoStatusCelular'];
	

		if ($statusCelular->salvar()){

				header ('location:/statusCelular/novo/id/'.$statusCelular->discipuloId);
				exit();
		}else {
				  $statusCelular->atualizar();
				header ('location:/discipulo/detalhar/id/'.$statusCelular->discipuloId);
				exit();
		
		
		}
			}
			

		}

		public function novoTipoStatusCelular($url){
			if ( empty ( $url['post'] ) ) {
		
				require_once  'modulos/statusCelular/visao/novoTipoStatus.php' ;
			
			}else{

			$tipoStatusCelular =	new \statusCelular\modelo\tipoStatusCelular() ; 
	
			$post = $url['post'] ;
			$tipoStatusCelular->nome = $post['nome'] ;

			$tipoStatusCelular->salvar();
			header ('location:/statusCelular/listarTipoStatusCelular') ;
				exit();
			}
			

		}

		public function listarTipoStatusCelular(){

				  $tipoStatusCelulares =	new \statusCelular\modelo\tipoStatusCelular();
				  $tipoStatusCelulares = $tipoStatusCelulares->listarTodos();

				  require 'modulos/statusCelular/visao/listarTipoStatusCelular.php' ; 
		
		}

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

				header ('location:/discipulo/atualizar/id/'.$discipulo->id);
				exit();
			}
		
		}

		public function atualizarTipoStatusCelular($url){

			if ( empty ( $url['post'] ) ) {


				$tipoStatusCelular =	new \statusCelular\modelo\tipoStatusCelular();
				$tipoStatusCelular->id = $url[3] ;
				$tipoStatusCelular = $tipoStatusCelular->listarUm();

				require_once  'modulos/statusCelular/visao/atualizarTipoStatus.php';
			
			}else {
				$tipoStatusCelular =	new \statusCelular\modelo\tipoStatusCelular();

				$post = $url['post'] ;

				$tipoStatusCelular->id = $post['id'];	
				$tipoStatusCelular->nome = $post['nome'];

				$tipoStatusCelular->atualizar();

				header ('location:/statusCelular/atualizarTipoStatusCelular/id/'.$tipoStatusCelular->id);
				exit();
			}
		
		}

		public function excluirTipoStatusCelular($url){
				$tipoStatusCelular =	new \statusCelular\modelo\tipoStatusCelular();
				$tipoStatusCelular->id = $url[3]; 
				$tipoStatusCelular->excluir();

				$_SESSION['mensagem'] = !is_null($tipoStatusCelular->erro) ? $tipoStatusCelular->erro : null ;
				
				header ('location:/statusCelular/listarTipoStatusCelular');
				exit();
		}


		public function detalhar ($url) {

			$status = new \statusCelular\modelo\tipoStatusCelular() ;

			$status->id = $url[3] ; 
			$status = $status->listarUm() ;
		
			require 'statusCelular/visao/detalhar.php' ;	
		
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

					  echo "url" ;
					 var_dump($url);
					 $id = $post['discipuloId'];

					 header ('location:/discipulo/evento/id/'.$id);
					 exit();
			
				
			
			
			}
				
		
		}	

		public function excluir($url){

				
			$id = $url[3] ;
			$discipulo = $url[5] ;

			$status = new \statusCelular\modelo\statusCelular() ;
			$status->id = $id ;
			$status->excluir();
			header ('location:/statusCelular/novo/id/'.$discipulo);
			exit();
		
		
		}
	
	}	

?>
