<?php
use celula\modelo\celula;
use discipulo\Modelo\Discipulo;
namespace celula\controlador;

class celula
{
    /* Metodo padrão para o controler
     *
     **/
    public function index()
    {
        $celulas =	new \celula\modelo\celula();

        //include("seguranca/ACL/assets/php/database.php");
        $acl = new \seguranca\modelo\acl($_SESSION['usuario_id']);
        //$redes =	new \rede\modelo\tipoRede();
        //$redes =	$redes->listarTodos();

        if ($acl->hasPermission('admin_acesso') == true) {

            $celulasInativas = $celulas->listarTodosInativos();
            $celulas = $celulas->listarTodosAtivos();
            //$celulas = $celulas->listarCelulasPorRede();
            //$totalCelulas = \celula\modelo\celula::totalCelulas();
            $totalCelulas = count($celulas);
        } else {
            $celulas->lider = $_SESSION['usuario_id'];
            $celulasInativas = $celulas->listarCelulasLiderInativos();
            $celulas = $celulas->listarCelulasLider();
            $totalCelulas = count($celulas);
        }

        require_once 'modulos/celula/visao/listar.php';

    }
        public function novo($url)
        {
            if ( empty ( $url['post'] ) ) {

                $lideres = new \discipulo\Modelo\Discipulo();
                $lideres = $lideres->listarLideres();

                $tiposRedes = new \rede\modelo\tipoRede() ;
                $tiposRedes = $tiposRedes->listarTodos() ;

                require_once 'modulos/celula/visao/novo.php';

            } else {
                $celula =	new \celula\modelo\celula();

                $post = $url['post'] ;
                $celula->nome = $post['nome'];
                $celula->horarioFuncionamento = $post['horarioFuncionamento'];
                $celula->endereco = $post['endereco'];
                $celula->lider = $post['lider'];

                $celula->salvar();
                header ('location:/celula/celula');
                exit();
            }

        }

        public function atualizar($url)
        {
            if ( empty ( $url['post'] ) ) {

                $celula =	new \celula\modelo\celula();
                $lideres = $celula->listarLideres();

                $celula->id =  $url[4] ;
                $celula = $celula->listarUm() ;

                $lider =	new \discipulo\Modelo\Discipulo() ;
                $lider->id = $celula->lider ;
                $lider = $lider->listarUm($celula->lider) ;

                $tipoRede = new \rede\modelo\tipoRede();
                $tipoRede->id = $celula->tipoRedeId;
                $tiposRedes = $tipoRede->listarTodos();
                $tipoRede = $tipoRede->listarUm();

                require_once 'modulos/celula/visao/atualizar.php';

            } else {

                $celula =	new \celula\modelo\celula();

                $post = $url['post'] ;
                $celula->nome = $post['nome'];
                $celula->horarioFuncionamento = $post['horarioFuncionamento'];
                $celula->endereco = $post['endereco'];
                $celula->lider = $post['lider'];
                $celula->ativa = (isset($post['ativa']))? 1 : 0;
                $celula->multiplicacao = (isset($post['multiplicao']))? 1 : 0;
                $celula->tipoRedeId = $post['tipoRedeId'];
                $celula->id = $post['id'];
                //var_dump(isset($post['ativa']));exit;

                $celula->atualizar();

                header ('location:/celula/celula/atualizar/id/'.$celula->id);
                exit();
            }

        }

        public function excluir($url)
        {
                $celula =	new \celula\modelo\celula();
                $celula->id = $url[4];
                $celula->excluir();

                $_SESSION['mensagem'] = !is_null($celula->erro) ? $celula->erro : NULL ;
                header ('location:/celula/celula');
                exit();

        }

    public function detalhar($url)
    {
        $celula =	new \celula\modelo\celula() ;
        $celula->id = $url[4] ;
        $discipulos= $celula->listarDiscipulos() ;
        $celula = $celula->listarUm() ;

        $lider =	new \discipulo\Modelo\Discipulo() ;
        $lider->id = $celula->lider ;
        $lider = $lider->listarUm($celula->lider) ;

                    //var_dump($discipulos);

        require 'celula/visao/detalhar.php';

    }

        public function chamar ()
        {
            $nome = isset($_GET['nome']) ? $_GET['nome'] : NULL ;
            $celula =	new \celula\modelo\celula();
            $celula->nome = $nome;
            $celulas = $celula->chamar($nome);
            require_once 'celula/visao/chamar.php';

        }

        public function lideresCelula()
        {
            $lideres = new \celula\modelo\celula();
            $lideres = $lideres->listarLideresCelula() ;

            $tipoStatus= new \statusCelular\modelo\tipoStatusCelular();

            $statusCelulares = $tipoStatus->listarTodos() ;

            require_once 'celula/visao/listarLideresCelula.php';

        }

    public function participacao($url)
    {
        $celulas =	new \celula\modelo\celula();
        $celulas->id =	$url[4];
        $participacao =	$celulas->listarParticipacao() ;

        require_once 'modulos/celula/visao/participacao.php';

    }

        public function listarPorStatus($url)
        {
            $post = $url['post'] ;
            $tipoStatus = new \statusCelular\modelo\tipoStatusCelular() ;
            $tipoStatus = $tipoStatus->listarTodos() ;

            if (empty($post)) {

                require_once 'modulos/celula/visao/lideresPorStatus.php';
            } else {
                $id = $post['statusId'] ;
                $celula = new \celula\modelo\celula();
                $lideres = $celula->lideresPorStatus($id);
                $lideresSem = $celula->lideresSemStatus($id);

                //var_dump($lideres);

                $resposta = array() ;
                $lider= array();

                foreach ($lideres as $l) {
                    $lider[$l['lider']][$l['discipulo']] = array($l['status'], $l['discipuloId']);
                    //$lider[$l['lider']][$l['discipulo']] = $l['discipuloId'];
                    $lider[$l['lider']]['total'] = !isset($lider[$l['lider']]['total']) ? $t=1 : ++$t ;

                }
                $cont = 0 ;
                $totalDiscipulos=0;
                foreach ($lider as $l) {
                    $totalDiscipulos += $l['total'] ;
                }

                $liderSem= array() ;
                foreach ($lideresSem as $l) {
                    $liderSem[$l['lider']][$l['discipulo']] = $l['status'];
                    $liderSem[$l['lider']]['total'] = !isset($liderSem[$l['lider']]['total']) ? $t=1 : ++$t ;

                }

                $totalDiscipulosSem=0;
                foreach ($liderSem as $ls) {
                    $totalDiscipulosSem += $ls['total'] ;
                }

                    require_once 'modulos/celula/visao/lideresPorStatus.php';
            }
        }

        public function statusPorLiderCelula($url)
        {
            $post = $url['post'] ;
            $tipoStatus = new \statusCelular\modelo\tipoStatusCelular() ;
            $tipoStatus = $tipoStatus->listarTodos() ;

            if (empty($post)) {

            } else {
                $id = $post['statusId'] ;
                $celula = new \celula\modelo\celula();
                $lideres = $celula->statusPorLiderCelula($id);

                //var_dump($lideres);

                $resposta = array() ;
                $lider= array();

                foreach ($lideres as $l) {
                    $lider[$l['dnome']][$l['nome']] = array('id'=>$l['id'], 'nome'=>$l['nome'],'tem'=>$l['tem']);

                    //$lider[$l['dnome']]['total'] = !isset ($i)? $i =1 : ++$i ;

                }

                $totalDiscipulos=0;
                $total = 0 ;
                foreach ($lider as $k => $l) {
                    foreach ($l as $d) {
                        //var_dump($l);
                        $total = is_null ($d['id']) ? 0 : count($l);
                        break;
                    }
                    $lider[$k]['total'] = $total ;
                    $totalDiscipulos+= $total;

                }

                $cont = 0 ;
                //var_dump($lider);
                //exit();

            }
                    require_once 'modulos/celula/visao/statusPorLiderCelula.php';
        }

        public function listarPorStatusTodos($url)
        {
            $tipoStatus = new \statusCelular\modelo\tipoStatusCelular() ;
            $tipoStatus = $tipoStatus->listarTodos() ;

                $celula = new \celula\modelo\celula();
                $lideres = $celula->lideresPorTodosStatus();

                $resposta = array() ;

                foreach ($lideres as $l) {
                    $lider[$l['lider']][$l['discipulo']] = $l['status'];
                    $lider[$l['lider']]['total'] = !isset($lider[$l['lider']]['total']) ? $t=1 : ++$t ;
                }
                $cont = 0 ;

                $totalDiscipulos=0;
                foreach ($lider as $l) {
                    $totalDiscipulos += $l['total'] ;
                }
                    require_once 'modulos/celula/visao/lideresPorStatus.php';

            }

    }
