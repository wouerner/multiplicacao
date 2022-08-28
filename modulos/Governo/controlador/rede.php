<?php
namespace governo\controlador;

use \Discipulo\Modelo\Discipulo ;
use \Rede\Modelo\TipoRede as TipoRedeModelo;

class rede
{
    public function index()
    {
//			require_once  'modulos/Discipulo/visao/listar.php';

    }

    public function novo($url)
    {
        if ( empty ( $url['post'] ) ) {
            $post = $url['post'] ;

            $rede =	new \Rede\Modelo\Rede() ;
            $funcaoRede =	new \Rede\Modelo\FuncaoRede() ;
            $tipoRede =	new \Rede\Modelo\TipoRede() ;

            $rede->discipuloId = $url[3];
            $rede->tipoRedeId = $url[3];
            $rede->funcaoRedeId = $url[3];

            $discipulo = new \Discipulo\Modelo\Discipulo() ;
            $discipulo->id = $url[3] ;
            $discipulo = $discipulo->listarUm();

            require_once 'modulos/Rede/visao/novo.php';

        } else {
            $rede =	new \Rede\Modelo\Rede();

            $post = $url['post'] ;
            $rede->discipuloId = $post['discipuloId'];
            $rede->tipoRedeId = $post['tipoRedeId'];
            $rede->funcaoRedeId = $post['funcaoRedeId'];

            if (!$rede->salvar()) {

                $rede->atualizar();

            }
        }

        header ('location:/discipulo/detalhar/id/'.$post['discipuloId']);
        exit();

    }

    public function novoTipoRede($url)
    {
        if ( empty ( $url['post'] ) ) {

            require_once 'modulos/Rede/visao/tipoRede/novo.php';

        } else {

        $tipoRede =	new \Rede\Modelo\TipoRede() ;

        $post = $url['post'] ;
        $tipoRede->nome = $post['nome'] ;

        $tipoRede->salvar();
        header ('location:/rede/listarTipoRede') ;
        exit();
        }

    }

    public function novaFuncaoRede($url)
    {
        if ( empty ( $url['post'] ) ) {

            require_once 'modulos/Rede/visao/funcaoRede/nova.php';

        } else {

        $funcao =	new \Rede\Modelo\FuncaoRede() ;

        $post = $url['post'] ;
        $funcao->nome = $post['nome'] ;

        $funcao->salvar();
        header ('location:/rede/listarFuncaoRede') ;
        exit();
        }

    }

    public function listarTipoRede()
    {
              $redes =	new \Rede\Modelo\TipoRede();
              $redes = $redes->listarTodos();
                $totalMeta= 0 ;
                $totalDisc= 0 ;

              require 'modulos/Rede/visao/tipoRede/listar.php';

    }

    public function listarFuncaoRede()
    {
              $funcoes =	new \Rede\Modelo\FuncaoRede();
              $funcoes = $funcoes->listarTodos();

              require 'modulos/Rede/visao/funcaoRede/listar.php';

    }

public function listarMembrosRede($url)
{
    $redeId = $url[4];

    $rede =	new \Rede\Modelo\Rede();
    $funcao =	new \Rede\Modelo\FuncaoRede();
    $tipoRede = new \Rede\Modelo\TipoRede();
    $tipoRede->id = $redeId;
    $lideresRede = $tipoRede->lideresRede();
    $tipoRede = $tipoRede->listarUm();
    $rede->tipoRedeId = $redeId;

    $idLideres = null;
    foreach ($lideresRede as $lider) {
        $idLideres[] = $lider['discipuloId'];
    }

    $liderRede = in_array($_SESSION['usuario_id'], $idLideres);

    $funcoes = $funcao->listarTodos();

    $redeMembros = $rede->pegarMembrosAtivos();

    $redeInativos = $rede->pegarMembrosInativos();
    $redeArquivados = $rede->pegarMembrosArquivados();
    $cont = 1 ;
    $metaTotal=0;
    $metaTotalLider=0;

    require 'modulos/Rede/visao/rede/listar.php';

}

    public function listarCelulas($url)
    {
                $redeId = $url[4];

                $tipoRede = new \Rede\Modelo\TipoRede();
                $tipoRede->id = $redeId;
                $celulas = $tipoRede->listarCelulas();
                $cont = 0;

              require 'modulos/Rede/visao/tipoRede/celulas.php';

    }

    public function atualizar($url)
    {
        if ( empty ( $url['post'] ) ) {

            $discipulo =	new \Discipulo\Modelo\Discipulo();
            $lideres = $discipulo->listarLideres();

            $discipulo->id =  $url[3] ;
            $discipulo = $discipulo->listarUm();

            $lider =	new \Discipulo\Modelo\Discipulo();
            $lider->id = $discipulo['lider'] ;
            $lider = $lider->listarUm($discipulo['lider']);

            $celula = new \Celula\Modelo\Celula();
            $celula->id = $discipulo['celula'];
            $celula = $celula->listarUm();

            $celulas = new \Celula\Modelo\Celula();
            $celulas = $celulas->listarTodos();

            require_once 'modulos/Discipulo/visao/atualizar.php';

        } else {
            $discipulo =	new \Discipulo\Modelo\Discipulo();

            $post = $url['post'] ;

            $discipulo->id = $post['id'];
            $discipulo->nome = $post['nome'];
            $discipulo->telefone = $post['telefone'];
            $discipulo->endereco = $post['endereco'];
            $discipulo->email = $post['email'];
            $discipulo->celula = $post['celula'];
            $discipulo->ativo =isset( $post['ativo']) ? $post['ativo']: null;
            $discipulo->lider = $post['lider'];

            $discipulo->atualizar();

            header ('location:/discipulo/atualizar/id/'.$discipulo->id);
            exit();
        }
    }

    public function atualizarTipoRede($url)
    {
        if ( empty ( $url['post'] ) ) {

            $rede =	new \Rede\Modelo\TipoRede();
            $rede->id = $url[4] ;
            $rede = $rede->listarUm();

            require_once 'modulos/Rede/visao/tipoRede/atualizar.php';

        } else {
            $rede =	new \Rede\Modelo\TipoRede();

            $post = $url['post'] ;

            $rede->id = $post['id'];
            $rede->nome = $post['nome'];

            $rede->atualizar();

            header ('location:/rede/rede/atualizarTipoRede/id/'.$rede->id);
            exit();
        }

    }

    public function atualizarFuncaoRede($url)
    {
        $funcao = new \Rede\Modelo\FuncaoRede();
        $funcao->id = $url[4] ;
        $funcao = $funcao->listarUm();

        require_once 'modulos/Rede/visao/funcaoRede/atualizar.php';
    }

    public function excluirTipoRede($url)
    {
            $rede =	new \Rede\Modelo\TipoRede();
            $rede->id = $url[4];
            $rede->excluir();

            $_SESSION['mensagem'] = !is_null($rede->erro) ? $rede->erro : null ;
            header ('location:/rede/rede/listartipoRede');
            exit();
    }

    public function excluirFuncaoRede($url)
    {
            $funcao =	new \Rede\Modelo\FuncaoRede();
            $funcao->id = $url[4];
            $funcao->excluir();

            $_SESSION['mensagem'] = !is_null($funcao->erro) ? $funcao->erro : null ;
            header ('location:/rede/listarFuncaoRede');
            exit();
    }

    public function excluir($url)
    {
            $rede =	new \Rede\Modelo\RedeTemDiscipulo();
            $rede->discipuloId = $url[4];
            $rede->redeId = $url[4];
            $rede->excluir();
            header ('location:/rede/novo/id/'.$rede->discipuloId);
            exit();
    }

    public function detalhar ($url)
    {
        $discipulo = new \Discipulo\Modelo\Discipulo() ;

        $discipulo->id = $url[4] ;
        $discipulo = $discipulo->listarUm() ;

        require 'Discipulo/visao/detalhar.php';

    }

    public function detalharFuncao ($url)
    {
        $funcao = new \rede\modelo\funcao() ;

        $funcao->id = $url[4] ;
        $funcao = $funcao->listarUm() ;

        require 'rede/visao/detalharFuncao.php';

    }

    public function detalharTipoRede ($url)
    {
        $rede = new \Rede\Modelo\TipoRede() ;

        $rede->id = $url[4] ;
        $rede = $rede->listarUm() ;

        require 'rede/visao/tipoRede/detalhar.php';

    }

    public function chamar ()
    {
        $nome = (!empty($_GET['nome'])) ? $_GET['nome'] : NULL;
        $discipulo =	new \Discipulo\Modelo\Discipulo();
        $discipulo->nome = $nome;
        $discipulos = $discipulo->chamar($nome);
        require_once 'Discipulo/visao/chamar.php';

    }

    public function evento($url)
    {
        if ( empty ( $url['post'] ) ) {

              $eventos = new \Evento\Modelo\Evento();

              $id = $url[3];
              $eventosDiscipulos = $eventos->listarTodosDiscipulo($id);
            $eventos = $eventos->listarTodos();

        require_once 'modulos/Discipulo/visao/evento.php';
        } else {
                  $post = $url['post'];
                 $discipuloEvento = new \Evento\Modelo\Evento();
                  $eventoId = $post['eventoId'];
                    $discipuloId = $post['discipuloId'];

                 $discipuloEvento->salvarDiscipuloEvento($discipuloId, $eventoId );

                  echo "url" ;
                 var_dump($url);
                 $id = $post['discipuloId'];

                 header ('location:/discipulo/evento/id/'.$id);
                 exit();
        }
    }

    /**
     * relatorioSemanal
     *
     * @param mixed $url
     * @access public
     * @return void
     */
    public function relatorioSemanal($url)
    {
        $redeId = $url[4];

        $tipoRede = new TipoRedeModelo();
        $tipoRede->id = $redeId;
        $tipoRede = $tipoRede->listarUm();

        $rede = new \Rede\Modelo\ConsolidacaoRedeSemanal();
        $rede->tipoRedeId = $redeId;

        $redeMembros = $rede->listarPorRedeData($redeId);
        $resumoRede = $rede->resumoRede($redeId);

        require 'modulos/Rede/visao/rede/ConsolidacaoRedeSemanal.php';
    }

    public function compararRelatorio($url)
    {
        $redeId = $url[4];
        $data = $url[6];

        $tipoRede = new TipoRedeModelo();
        $tipoRede->id = $redeId;
        $tipoRede = $tipoRede->listarUm();

        $rede = new \Rede\Modelo\ConsolidacaoRedeSemanal();
        $dataFinal =  $rede->proximaDataRelatorio($redeId, $data);
        $relatorio =  $rede->redePorData($redeId, $data);
        $relatorioProximo =  $rede->redePorData($redeId, $dataFinal[0]['data']);
        $estavel = array();
        foreach($relatorio as $rel){
            foreach($relatorioProximo as $relNovo) {
                if ($rel->discipuloId == $relNovo->discipuloId){
                    $estavel[$rel->discipuloId] = $rel;
                    break;
                }
            }
        }
        $totalEstavel = count($estavel);

        $adicionados = $relatorioProximo;
        foreach($estavel as $rel){
            foreach($relatorioProximo as $relNovo) {
                if ($rel->discipuloId == $relNovo->discipuloId){
                    unset($adicionados[$relNovo->discipuloId]);
                    break;
                }
            }
        }
        $totalAdicionados = count($adicionados);

        $sairam = $relatorio;
        foreach($relatorio as $rel){
            foreach($estavel as $relNovo) {
                if ($rel->discipuloId == $relNovo->discipuloId) {
                    unset($sairam[$relNovo->discipuloId]);
                    break;
                }
            }
        }

        $totalSairam = count($sairam);

        require 'modulos/Rede/visao/rede/compararRelatorioSemanal.php';
    }
}
