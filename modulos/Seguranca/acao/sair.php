<?php
session_start();

if (!isset($_SESSION['logado'])) exit();

//importar discipulo
require '../../../config/autoload.php';

//criar o objeto ususario

//use discipulo\Modelo\Discipulo;

$discipulo = new discipulo\Modelo\Discipulo() ;

$discipulo->sair();
header('location:../formularios/index.php');
?> 
