<?php
use celula\modelo\celula;
use discipulo\Modelo\Discipulo;
namespace celula\controlador; 


class celula{

	/*Metodo padrão para o controler
	 *
	 * */	
	public function index(){

		$celulas =	new \celula\modelo\celula();

		include("seguranca/ACL/assets/php/database.php"); 
		$acl = new \seguranca\modelo\acl($_SESSION['usuario_id']);
			
		if ($acl->hasPermission('admin_acesso') == true){
			$celulas = $celulas->listarTodos();
			//$totalCelulas = \celula\modelo\celula::totalCelulas();
			$totalCelulas = count($celulas);
		}else {
			$celulas->lider = $_SESSION['usuario_id'];
			$celulas = $celulas->listarCelulasLider();
			$totalCelulas = count($celulas);
		}

		require_once  'modulos/celula/visao/listar.php';

		
	}
		public function novo($url){
			if ( empty ( $url['post'] ) ) {
				
				$lideres = new \discipulo\Modelo\Discipulo(); 
				$lideres = $lideres->listarLideres();
	
				require_once  'modulos/celula/visao/novo.php';
			
			}else {
				$celula =	new \celula\modelo\celula();

				$post = $url['post'] ;
				$celula->nome = $post['nome'];
				$celula->horarioFuncionamento = $post['horarioFuncionamento'];
				$celula->endereco = $post['endereco'];
				$celula->lider = $post['lider'];

				$celula->salvar();
				header ('location:/celula/celula');
				exit();
			}
			

		}

		public function atualizar($url){

			if ( empty ( $url['post'] ) ) {

				$celula =	new \celula\modelo\celula();
				$lideres = $celula->listarLideres();

				$celula->id =  $url[4] ;
				$celula = $celula->listarUm() ;

				$lider =	new \discipulo\Modelo\Discipulo() ;
				$lider->id = $celula->lider ;
				$lider = $lider->listarUm($celula->lider) ;

				require_once  'modulos/celula/visao/atualizar.php' ;
			
			}else {

				$celula =	new \celula\modelo\celula();

				$post = $url['post'] ;
				$celula->nome = $post['nome'];
				$celula->horarioFuncionamento = $post['horarioFuncionamento'];
				$celula->endereco = $post['endereco'];
				$celula->lider = $post['lider'];
				$celula->id = $post['id'];

				$celula->atualizar();

				header ('location:/celula/celula/atualizar/id/'.$celula->id);
				exit();
			}

		
		
		}

		public function excluir($url){
				$celula =	new \celula\modelo\celula();
				$celula->id = $url[4]; 
				$celula->excluir();

				$_SESSION['mensagem'] = !is_null($celula->erro) ? $celula->erro : NULL ;
				header ('location:/celula/celula');
				exit();
		
			
		
		
		}

		public function detalhar($url){

			$celula =	new \celula\modelo\celula() ;
			$celula->id = $url[3] ; 
			$discipulos= $celula->listarDiscipulos() ;
			$celula = $celula->listarUm() ;

				$lider =	new \discipulo\Modelo\Discipulo() ;
				$lider->id = $celula->lider ;
				$lider = $lider->listarUm($celula->lider) ;

//				var_dump($discipulos);
				
			require 'celula/visao/detalhar.php' ;
				
		
		}


		public function chamar () {

			$nome = isset($_GET['nome']) ? $_GET['nome'] : NULL ;
			$celula =	new \celula\modelo\celula();
			$celula->nome = $nome; 
			$celulas = $celula->chamar($nome);	
			require_once 'celula/visao/chamar.php' ;

		
		}

		public function lideresCelula(){
		
			$lideres = new \celula\modelo\celula();
			$lideres = $lideres->listarLideresCelula() ;

			require_once 'celula/visao/listarLideresCelula.php' ;

		
		}
	
	public function participacao($url){

		$celulas =	new \celula\modelo\celula();
		$celulas->id =	$url[4];
		$participacao =	$celulas->listarParticipacao() ;

		require_once  'modulos/celula/visao/participacao.php';
		
	}
	
	
	}	

?>
