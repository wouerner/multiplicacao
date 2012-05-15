<?php

//inicia a sessão
session_start();

$sessao = isset ($_SESSION) ? $_SESSION : NULL ; 


$_GET['url'] = array_key_exists('url',$_GET) ? $_GET['url'] : NULL;


//se estiver a sessão tiver indice 'logado' e o indice logado for igual a TRUE
if (array_key_exists('logado', $sessao) && $sessao['logado']==TRUE){

	$url = $_GET['url'];
	
	//se for uma tentativa de login deixar prosseguir com a url
}else if($_GET['url']=='seguranca/entrar'){
	$url = $_GET['url'];

//caso não seja nenhuma das duas opções acima redireciona para a pagina de segurança para logar no sistema.	
}else{

	$url = 'seguranca' ;
}

//acesso anonimo ao cadastro
if( $_GET['url'] == 'discipulo/novoAnonimo' ){

	$url = $_GET['url'];

}

$url = explode('/' ,$url) ;


$controlador = $url[0] ;
$acao = ( array_key_exists(1, $url) ) ? $url[1] : 'index' ;

$url['post'] = isset($_POST) ? $_POST : NULL;

require_once 'config/autoload.php' ;


require_once 'modulos/'.$controlador.'/controlador/'.$controlador.'.php' ;


$controlador = $controlador.'\controlador\\'.$controlador ;

$app = new $controlador();

$app->$acao($url);

//var_dump($url);
?>
