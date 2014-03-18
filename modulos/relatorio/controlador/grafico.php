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
        var_dump($tipoStatus);

        $aux = array();
        foreach($tipoStatus as $tipo){
            $aux[$tipo->nome] = $begin->crescimentoStatus('2014-02-10', date('Y-m-d'), $tipo->id);
        }
        var_dump($aux);

        $status = new \relatorio\modelo\discipulos();
        $status = $status->crescimentoStatus('2014-02-10',date('Y-m-d'));

        require 'relatorio/visao/grafico/index.php';
    }
}
