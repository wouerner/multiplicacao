<?php
//inicia a sessão
session_start();


$sessao = isset ($_SESSION) ? $_SESSION : NULL ; 


$_GET['url'] = array_key_exists('url',$_GET) ? $_GET['url'] : NULL;

//var_dump($_GET['url']);

//se estiver a sessão tiver indice 'logado' e o indice logado for igual a TRUE
if (array_key_exists('logado', $sessao) && $sessao['logado']==TRUE){

	$url = $_GET['url'];
	
	//se for uma tentativa de login deixar prosseguir com a url
}else if( $_GET['url']=='seguranca/seguranca/entrar' ){
	$url = $_GET['url'];
//caso não seja nenhuma das duas opções acima redireciona para a pagina de segurança para logar no sistema.	
}else{

	$url = 'seguranca/seguranca/index' ;
}

//acesso anonimo ao cadastro
if( $_GET['url'] == 'discipulo/novoAnonimo' ){

	$url = $_GET['url'];

}

$perfil = explode('/',$_GET['url']);
//var_dump($perfil);exit;
if(isset($perfil[2]) && $perfil[2] == 'perfil' ){

	$url = $_GET['url'];

}


$url = explode('/' ,$url) ;

$modulo = $url[0] ;
$controlador = $url[1] ;
$acao = ( array_key_exists(2, $url) ) ? $url[2] : 'index' ;

$url['post'] = isset($_POST) ? $_POST : NULL;
require_once 'config/autoload.php' ;

include 'modulos/seguranca/ACL/assets/php/database.php';
include 'modulos/seguranca/ACL/assets/php/acl.php';

require_once $modulo.'/controlador/'.$controlador.'.php' ;


$controlador = $modulo.'\controlador\\'.$controlador ;

$app = new $controlador();

$app->$acao($url);

?>
