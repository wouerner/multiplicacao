<?php 
namespace seguranca\controlador ; 
use discipulo\Modelo\Discipulo;

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

			header('Location:../discipulo');
			exit();

		}else{

			$_SESSION['mensagem'] = 'Discipulo não encontrado';
			header('Location:/seguranca');
			exit();

			
			}
	
	
	
		}	

		public function sair(){
		
			session_destroy();
			header('location:/seguranca');
			exit();
		
		
		}
}