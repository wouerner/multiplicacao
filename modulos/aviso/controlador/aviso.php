<?php 

namespace aviso\controlador; 

class aviso{
	
	public function index(){

		$avisos =	new \aviso\modelo\aviso();
		$avisos = $avisos->listarTodos();

		require_once  'modulos/aviso/visao/listar.php';
	
	}


	
		public function excluir($url){
				$aviso =	new \aviso\modelo\aviso();
				$aviso->id = $url[4]; 
				$aviso->excluir();

				header ('location:/aviso/aviso');
				exit();
		}

	public function email($url){
// O remetente deve ser um e-mail do seu domínio conforme determina a RFC 822.
// O return-path deve ser ser o mesmo e-mail do remetente.
$headers = "MIME-Version: 1.1\n";
$headers .= "Content-type: text/plain; charset=utf-8\n";
$headers .= "From: Multiplicação12 <multiplicaca12@mga12.org>"."\n"; // remetente
$headers .= "Return-Path: Meu Nome <multiplicacao@mga12.org>"."\n"; // return-path
$envio = mail("wouerner@gmail.com", "Aviso", "Texto", $headers,"-r multiplicacao12@mga12.org");
 
if($envio)
 echo "Mensagem enviada com sucesso";
else
 echo "A mensagem não pode ser enviada";

	}

}
