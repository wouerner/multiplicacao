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
}
