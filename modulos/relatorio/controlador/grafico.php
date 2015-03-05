<?php
namespace relatorio\controlador ;

class grafico
{
    public function index()
    {
        $begin = new \relatorio\modelo\discipulos();
        $crescimento = $begin->crescimento('2014-02-10',date('Y-m-d'));

        $max = max($crescimento);
        $min = min($crescimento);

        $tipoStatus =	new \statusCelular\modelo\tipoStatusCelular() ;
        $tipoStatus = $tipoStatus->listarTodos();

        $redes = new	\relatorio\modelo\discipulos();
        $redes = $redes->crescimentoRede('2014-04-14',date('Y-m-d'));

        $aux = array();
        foreach($tipoStatus as $tipo){
            $aux[$tipo->nome] = $begin->crescimentoStatus('2014-02-16', date('Y-m-d'), $tipo->id);
        }
        $status = $aux;
        $aux = array();
        foreach($redes as $r) {
            $aux[utf8_encode($r['nomeRede'])] = $r;
        }
        $redes = $aux;
        foreach(array_keys($redes) as $r) {
            unset($redes[$r]['nomeRede']);
        }
        $range = array_keys($redes['Entre Elas']);

        require 'relatorio/visao/grafico/index.php';
    }

    public function status()
    {
        $status = new \statusCelular\modelo\statusCelular() ;
        $status = $status->quantidadePorStatusCelular();

        $aux = array();
        foreach ($status as $st) {
            $aux[$st['tipoNome']] = $st['total'];
        }
        echo json_encode($aux);

        header('Content-type: application/json; charset=utf-8');
    }

    public function redes()
    {
        $tiposRedes = new \rede\modelo\tipoRede();
        $tiposRedes = $tiposRedes->listarTodos();

        $aux = array();
        foreach ($tiposRedes as $rede) {
            $aux[$rede->nome] = $rede->totalDiscipulosPorRede();
        }
        echo json_encode($aux);

        header('Content-type: application/json; charset=utf-8');
    }
    public function ativos()
    {
        $totalAtivos =  \discipulo\Modelo\Discipulo::totalAtivos() ;
        $totalInativos = \discipulo\Modelo\Discipulo::totalInativos() ;
        $totalArquivados =  \discipulo\Modelo\Discipulo::totalArquivados() ;

        echo json_encode(array('ativo'=> $totalAtivos['total'], 'inativos'=> $totalInativos['total'], 'arquivado' => $totalArquivados['total']));

        header('Content-type: application/json; charset=utf-8');

    }

    public function crescimento()
    {
        $begin = new \relatorio\modelo\discipulos();
        $crescimento = $begin->crescimento('2014-02-10',date('Y-m-d'));
        //var_dump($crescimento);
        echo json_encode($crescimento);

        header('Content-type: application/json; charset=utf-8');

    }
    public function crescimentoRedes()
    {
        $redes = new	\relatorio\modelo\discipulos();
        $redes = $redes->crescimentoRede('2014-04-14',date('Y-m-d'));

        $chaves = array_keys($redes[0]);
        unset($chaves[0]);
        array_unshift($chaves, 'x');
        //var_dump($chaves);exit;

        $valor = array();
        foreach( $redes as $rede){
            $valor[] = array_values($rede);
        }

        $aux = array();
        foreach( $valor as $rede){
            $rede[0] = utf8_encode($rede[0]);
            $aux[] = $rede;
        }

        $aux[] = $chaves;
        //$redes = array_merge($chaves, $aux);
        //var_dump($aux);

        echo json_encode($aux);

        header('Content-type: application/json; charset=utf-8');
    }

    public function crescimentoStatus()
    {
        $begin = new \relatorio\modelo\discipulos();
        $tipoStatus =	new \statusCelular\modelo\tipoStatusCelular() ;
        $tipoStatus = $tipoStatus->listarTodos();

        $aux = array();
        $chaves = array();
        foreach($tipoStatus as $tipo){
            $status = array_values($begin->crescimentoStatus('2014-02-16', date('Y-m-d'), $tipo->id));
            $chaves = array_keys($begin->crescimentoStatus('2014-02-16', date('Y-m-d'), $tipo->id));
            //var_dump($status);
            array_unshift($status, $tipo->nome);
            $aux[] = $status;
            //$aux[$tipo->nome] = $begin->crescimentoStatus('2014-02-16', date('Y-m-d'), $tipo->id);
            //$aux[$tipo->nome] = $begin->crescimentoStatus('2014-02-16', date('Y-m-d'), $tipo->id);

        }
        array_unshift($chaves, 'x');
        $aux[] = $chaves;
        //var_dump($aux);

        echo json_encode($aux);

        header('Content-type: application/json; charset=utf-8');
    }

    public function encontro($url)
    {
        $encontro = new \encontroComDeus\modelo\encontroComDeus() ;
        $encontro->id = $url[4] ;
        $encontro = $encontro->grafico();

        $aux = array();
        foreach ($encontro as $st) {
            $aux[$st['tipo']] = $st['total'];
        }
        echo json_encode($aux);

        header('Content-type: application/json; charset=utf-8');
    }
}
