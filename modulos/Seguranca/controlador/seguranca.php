<?php
namespace seguranca\controlador ;
use Discipulo\Modelo\Discipulo;
use Discipulo\modelo\role;

	class seguranca{

		public function index(){


			require 'modulos/Seguranca/visao/entrar.php' ;
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
        $discipulo = new \Discipulo\Modelo\Discipulo() ;

        if (empty($url['post'])){
            $discipulo->id = $url[4] ;
            $discipulo = $discipulo->listarUm() ;
            require 'modulos/Seguranca/visao/trocarSenha.php' ;
            exit();
        }

        $discipulo->senha = $url['post']['senha'];
        $discipulo->email = $url['post']['email'];
        $discipulo->trocarSenha();
        $mens = "Senha trocada." ;
        require 'modulos/Seguranca/visao/trocarSenha.php' ;
        exit();
    }

    public function recuperar($url){
        $discipulo = new \Discipulo\Modelo\Discipulo() ;

        if ($url['post']){
            $discipulo->senha = $this->random_password();
            $discipulo->email = $url['post']['email'];
            $discipulo->trocarSenha();

            $headers = "MIME-Version: 1.1\n";
            $headers .= "Content-type: text/plain; charset=utf-8\n";
            $headers .= "From: Multiplicação12 <multiplicaca12@multiplicacao.org>"."\n"; // remetente
            $headers .= "Return-Path: Meu Nome <multiplicacao@multiplicacao.org>"."\n"; // return-path
            $envio = mail($discipulo->email,
                        "Recuperar Senha SIM12",
                        "senha: $discipulo->senha",
                        $headers,"-r multiplicacao@multiplicacao.org");

            echo json_encode(['success' => true]);
        }
    }

    private function random_password( $length = 8 ) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
        $password = substr( str_shuffle( $chars ), 0, $length );
        return $password;
    }
}
