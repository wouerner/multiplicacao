<?php

//iniciar sessão
session_start();

//verificar se tem post

//importar discipulo
require '../../../config/autoload.php';


//criar o objeto ususario

use discipulo\Modelo\Discipulo;
$discipulo = new Discipulo();

//recuperar dados do post e atribuir ao objeto
$discipulo->id = $_GET['id'];

$discipulo->excluir();

header('location:listar.php');

?> 
