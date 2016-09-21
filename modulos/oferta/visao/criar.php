<?php

//iniciar sessão
session_start();

//verificar se tem post
if( ! $_POST){
	///header('Location:cadastro.php');
	exit();
}

//importar discipulo
require '../../../config/autoload.php';


//criar o objeto ususario

use discipulo\Modelo\Discipulo;
$discipulo = new Discipulo();

//recuperar dados do post e atribuir ao objeto

$discipulo->nome = $_POST['nome'];
$discipulo->telefone = $_POST['telefone'];
$discipulo->endereco = $_POST['endereco'];
$discipulo->email = $_POST['email'];
$discipulo->usuario = $_POST['usuario'];
$discipulo->senha = $_POST['senha'];


$discipulo->salvar();

header('location:../acao/listar.php');

?> 
