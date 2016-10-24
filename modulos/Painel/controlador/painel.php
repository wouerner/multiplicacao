<?php
namespace painel\controlador;

use \Rede\Modelo\TipoRede as TipoRede;
use \Igreja\Modelo\Igreja as igrejaModelo;
use \Discipulo\Modelo\Discipulo as DiscipuloModelo;
use \Rede\Modelo\Rede as RedeModelo;
use \Aviso\Modelo\Aviso as AvisoModelo;
use \Celula\Modelo\Celula as CelulaModelo;
use \Geracoes\Modelo\TipoGeracao as TipoGeracaoModelo;
use \EncontroComDeus\Modelo\EncontroComDeus as EncontroComDeusModelo;

class painel
{
    /* Mostra a lista de todos os discipulos cadastrados no sistema
    *
    * */

    public function index()
    {
        $usuarioId= $_SESSION['usuario_id'];
        $status = new \StatusCelular\Modelo\StatusCelular() ;
        $status = $status->quantidadePorStatusCelular();

        $totalDiscipulos = null;
        foreach ($status as $s) {
                $totalDiscipulos += (int) $s['total'] ;
        }

        $porc = null;
        foreach ($status as $k => $v) {
                $porc [$k]= $v ;
                $porc [$k]['porcentagem']= (100 *  $porc[$k]['total'])/$totalDiscipulos ;
        }

        $status = $porc ;

        $statusDiscipulos = new \statusCelular\modelo\statusCelular() ;
        $statusDiscipulos = $statusDiscipulos->pegarStatusCelularPorLider($_SESSION['usuario_id']);
        $statusDiscipulosTotal = null ;

        foreach ($statusDiscipulos as $st) {
            $statusDiscipulosTotal += $st['total'];

        }

        $totalAtivos =  DiscipuloModelo::totalAtivos() ;
        $totalInativos = \Discipulo\Modelo\Discipulo::totalInativos() ;
        $totalArquivados =  \Discipulo\Modelo\Discipulo::totalArquivados() ;

        $totalAtivosLider =  \Discipulo\Modelo\Discipulo::totalAtivosLider($usuarioId) ;
        $totalInativosLider = \Discipulo\Modelo\Discipulo::totalInativosLider($usuarioId) ;

        $totalRedes =  RedeModelo::pegarTodasRedes();
        $totalRedesLideres =  \rede\modelo\rede::pegarTodasRedesPorLider($usuarioId);

        $tiposRedes = new TipoRede();
        $tiposRedes = $tiposRedes->listarTodos();

        $somaRedeDiscipulos=NULL;
        foreach ($totalRedesLideres as $t) {
            $somaRedeDiscipulos += $t['total'];
        }

        $avisos = new AvisoModelo();
        $avisos = $avisos->listarUltimos();

        $celulas = new CelulaModelo();
        $celulas->lider = $usuarioId;
        $celulas = $celulas->listarCelulasLider();
        $totalCelulas = count($celulas);

        $discipulos = new DiscipuloModelo();
        $discipulos->id = $usuarioId ;
        $discipulos = $discipulos->listarDiscipulos();

        $discipulosAniver = new \Discipulo\Modelo\Discipulo();
        $discipulosAniver = $discipulosAniver->aniversarioHoje();
        $totalAniver = count($discipulosAniver);
        $contator = 0 ;

        $geracoes = new TipoGeracaoModelo();
        $geracoes = $geracoes->listarTodos();

        $encontro = new EncontroComDeusModelo() ;
        $encontros = $encontro->listarTodosAtivos();

        $igreja = new igrejaModelo() ;
        $idade = $igreja->mediaIdade();

        require_once 'modulos/Painel/visao/painel.php';
    }

}
