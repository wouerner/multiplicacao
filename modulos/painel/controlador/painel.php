<?php
namespace painel\controlador;

use \rede\modelo\tipoRede as TipoRede;
use \igreja\modelo\igreja as igrejaModelo;

    class painel
    {
        /* Mostra a lista de todos os discipulos cadastrados no sistema
        *
        * */

        public function index()
        {
                    $usuarioId= $_SESSION['usuario_id'];
                    $status = new \statusCelular\modelo\statusCelular() ;
                    $status = $status->quantidadePorStatusCelular();

                    $totalDiscipulos = null;
                    foreach ($status as $s) {
                            $totalDiscipulos += (int) $s['total'] ;
                    }

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

                    $totalAtivos =  \discipulo\Modelo\Discipulo::totalAtivos() ;
                    $totalInativos = \discipulo\Modelo\Discipulo::totalInativos() ;
                    $totalArquivados =  \discipulo\Modelo\Discipulo::totalArquivados() ;

                    $totalAtivosLider =  \discipulo\Modelo\Discipulo::totalAtivosLider($usuarioId) ;
                    $totalInativosLider = \discipulo\Modelo\Discipulo::totalInativosLider($usuarioId) ;

                    $totalRedes =  \rede\modelo\rede::pegarTodasRedes();
                    $totalRedesLideres =  \rede\modelo\rede::pegarTodasRedesPorLider($usuarioId);
                //var_dump($totalRedes);

                    $tiposRedes = new TipoRede();
                    $tiposRedes = $tiposRedes->listarTodos();

                    //foreach ($totalRedes as $t) {
                        //$somaRede += $t['total'];
                    //}

                    ////var_dump($totalRedes);

                    $somaRedeDiscipulos=NULL;
                    foreach ($totalRedesLideres as $t) {
                        $somaRedeDiscipulos += $t['total'];
                    }

                    $avisos = new \aviso\modelo\aviso();
                    $avisos = $avisos->listarUltimos();
                    //var_dump($avisos);

                    $celulas =	new \celula\modelo\celula();
                    $celulas->lider = $usuarioId;
                    $celulas = $celulas->listarCelulasLider();
                    $totalCelulas = count($celulas);

                    $discipulos = new \discipulo\Modelo\Discipulo();
                    $discipulos->id = $usuarioId ;
                    $discipulos = $discipulos->listarDiscipulos();

                    //$totalDiscipulos = count($discipulos) ;
                    //var_dump($totalDiscipulos);

                    //aniversarios

                    $discipulosAniver = new \discipulo\Modelo\Discipulo();
                    $discipulosAniver = $discipulosAniver->aniversarioHoje();
                    $totalAniver = count($discipulosAniver);
                    $contator = 0 ;

                    $geracoes = new \geracoes\modelo\tipoGeracao();
                    $geracoes = $geracoes->listarTodos();


                    $encontro = new \encontroComDeus\modelo\encontroComDeus() ;
                    $encontros = $encontro->listarTodosAtivos();

        $igreja = new igrejaModelo() ;
        $idade = $igreja->mediaIdade();

        require_once 'modulos/painel/visao/painel.php';
    }

}
