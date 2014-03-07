<?php 
namespace seguranca\controlador ; 
use discipulo\Modelo\Discipulo;
use discipulo\modelo\role;

	class seguranca{
	
		public function index(){
			

			require 'modulos/seguranca/visao/entrar.php' ;
		}

		public function entrar(){
		$discipulo = new Discipulo();

		//recuperar dados do post e atribuir ao objeto

		$discipulo->email = $_POST['email'];
		$discipulo->senha = $_POST['senha'];

		$discipuloLogado = $discipulo->entrar();


		if($discipuloLogado){
			$_SESSION['usuario_nome'] = $discipuloLogado['nome'];
			$_SESSION['usuario_id'] = $discipuloLogado['id'];
			$_SESSION['logado'] = TRUE;

			header('Location:/painel/painel');
			exit();

		}else{

			$_SESSION['mensagem'] = 'E-mail/senha incorretos!';
			header('Location:/seguranca/seguranca');
			exit();

			
			}
	
		}	
		
		public function novoPapel($url){

			if ( empty ( $url['post'] ) ) {
		
				require_once  'seguranca/visao/novoPapel.php' ;
			
			}else{

			$role =	new \seguranca\modelo\role() ; 

			$post = $url['post'] ;

			$role->roleName = $post['roleName'] ;

			$role->salvar();
			header ('location:/seguranca/novoPapel') ;
			exit();
			}
		
		
		}



		public function sair(){
		
			session_destroy();
			header('location:/seguranca');
			exit();
		
		
		}

		public function trocarSenha($url){
			$discipulo = new \discipulo\Modelo\Discipulo() ;

			if (empty($url['post'])){
				$discipulo->id = $url[4] ;
				$discipulo = $discipulo->listarUm() ;
				require 'modulos/seguranca/visao/trocarSenha.php' ;
				exit();
			}
			
		$discipulo->senha = $url['post']['senha'];	
		$discipulo->email = $url['post']['email'];	
		$discipulo->trocarSenha();	
		$mens = "Senha trocada." ;
		require 'modulos/seguranca/visao/trocarSenha.php' ;
			exit();
		
		
		}
}
