<?php

session_start();

require '../../../config/autoload.php';
//verificar se tem post
/*if( ! $_POST){
	///header('Location:cadastro.php');
	exit();
}*/
//criar o objeto ususario

//require '../discipulo/Modelo/Discipulo.php';

use discipulo\Modelo\Discipulo;
$discipulo = new Discipulo();

//recuperar dados do post e atribuir ao objeto

$discipulo->usuario = $_POST['usuario'];
$discipulo->senha = $_POST['senha'];

//$discipulo->login = 'wouerner';
//$discipulo->senha = '123';

$discipuloLogado = $discipulo->entrar();

if($discipuloLogado){
	$_SESSION['usuario_nome'] = $discipuloLogado['nome'];
	$_SESSION['usuario_id'] = $discipuloLogado['id'];
	$_SESSION['logado'] = TRUE;

	header('Location:../../discipulo/acao/listar.php');
	exit();

}else{

	$_SESSION['mensagem'] = 'Discipulo n�o encontrado';
	header('Location:../formularios/index.php');
	exit();

}
