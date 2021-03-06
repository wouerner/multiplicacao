<?php
use discipulo\Modelo\Discipulo;
namespace celula\controlador;
use aviso\modelo\tipoAviso;
use aviso\modelo\aviso;
use celula\modelo\relatorioCelula as relatorioModelo;
use celula\modelo\temaRelatorioCelula as temaModelo;
use celula\modelo\celula as celulaModelo;

class relatorio
{
    public function index($url)
    {
        $relatorioCelula = new \celula\modelo\relatorioCelula();
        $relatorioCelula->celulaId  = $url[4];
        $relatorios = $relatorioCelula->listarTodos();

        require_once 'modulos/Celula/visao/relatorioCelula/listar.php';

    }

    public function blog()
    {
        $celula = new \Celula\Modelo\Celula();


        $celula->alias =$_GET['d'];

        $celula = $celula->porAlias();
        $lider = $celula->pegaLider();
        $discipulos = $lider->listarDiscipulos();

        $relatorioCelula = new \celula\modelo\relatorioCelula();
        $relatorioCelula->celulaId  = $celula->id;

        $relatorios = $relatorioCelula->listarTodos();

        require_once 'modulos/Celula/visao/relatorioCelula/blog.php';
    }

        public function novo($url)
        {
            $dataEnvio = date('d/m/Y');
            $post = $url['post'] ? $url['post'] : '' ;

            if ( empty ( $post ) ) {
                $celulaId = $url[4];

                $celula = new \Celula\Modelo\Celula($celulaId);
                $temas = new \celula\modelo\temaRelatorioCelula();

                $temas = $temas->listarTodosAtivos();
                $lider = $celula->pegaLider();

                $discipulos = $celula->listarDiscipulos();
                require_once 'modulos/Celula/visao/relatorioCelula/novo.php';
            } else {

                $relatorioCelula = new \celula\modelo\relatorioCelula() ;
                $relatorioCelula->dataEnvio = date('Y-m-d H:i:s') ;
                $relatorioCelula->texto = $post ['texto'] ;
                $relatorioCelula->titulo = $post ['titulo'] ;
                $relatorioCelula->lider = $post ['lider'] ;
                $relatorioCelula->celulaId = $post ['celulaId'] ;
                $relatorioCelula->temaRelatorioCelulaId = $post ['temaRelatorioCelulaId'] ;
                $discipulos = $post['discipulos'] ;

                $relatorioCelula->salvar();
                $relatorioCelula->salvarParticipacao($discipulos);

                //$aviso = new aviso();

                //$aviso->tipoAviso = tipoAviso::relatorioNovo ;
                //$aviso->identificacao = $relatorioCelula->id ;
                //$aviso->emissor = $_SESSION['usuario_id'];
                //$aviso->salvar();

                header ('location:/celula/relatorio/index/celulaId/'.$relatorioCelula->celulaId) ;

            }

        }

    public function atualizar($url)
    {
        if (empty($url['post'])) {

            $relatorio =	new \celula\modelo\relatorioCelula();

            $relatorio->id =  $url[4] ;
            $relatorio = $relatorio->listarUm() ;
            //var_dump($relatorio);exit;

            require_once 'modulos/Celula/visao/relatorioCelula/atualizar.php';

        } else {

            $relatorio = new \celula\modelo\relatorioCelula();

            $post = $url['post'] ;
            $relatorio->titulo = $post['titulo'];
            $relatorio->texto = $post['texto'];
            $relatorio->id = $post['id'];

            $relatorio->atualizar();

            header('location:/celula/relatorio/detalhar/id/'.$relatorio->id);
            exit();
        }
    }

        public function excluir($url)
        {
                $celula =	new \Celula\Modelo\Celula();
                $celula->id = $url[3];
                $celula->excluir();

                $_SESSION['mensagem'] = !is_null($celula->erro) ? $celula->erro : NULL ;
                header ('location:/celula');
                exit();

        }

        public function detalhar($url)
        {
            $relatorio =	new \celula\modelo\relatorioCelula() ;
            $relatorio->id = $url[4] ;

            $participacao = $relatorio->listarParticipacao() ;

            $relatorio = $relatorio->listarUm() ;

            $tema = $relatorio->pegarTemaRelatorio() ;

            //var_dump($tema);
            //var_dump($participacao);
            //exit;

            require 'Celula/visao/relatorioCelula/detalhar.php';

        }

        public function chamar ()
        {
            $nome = isset($_GET['nome']) ? $_GET['nome'] : NULL ;
            $celula =	new \Celula\Modelo\Celula();
            $celula->nome = $nome;
            $celulas = $celula->chamar($nome);
            require_once 'Celula/visao/chamar.php';

        }

        public function lideresCelula()
        {
            $lideres = new \Celula\Modelo\Celula();
            $lideres = $lideres->listarLideresCelula() ;

            require_once 'Celula/visao/listarLideresCelula.php';

        }
    /*
         * Relatorio de Célula por mês.
         * */
        public function porMes($url)
        {
            $ids = isset($url['post']['temasId']) ? $url['post']['temasId']: '';

            if ($ids) {
      foreach ($ids as $id) {
                $t = new temaModelo();
                $t->id = $id;
              $tem[] = $t->listarUm();
            }}
      //var_dump($tem);

      $temas = new temaModelo();
      $temas = $temas->listarTodos();

            $relatorio = new relatorioModelo();
            $relatorios = $relatorio->porMes($ids);
            //var_dump($relatorios);

            $rel = array();
            foreach ($relatorios as $celula) {
                $rel[$celula['celulaNome']][$celula['tId']] = $celula['tId'] ;
            }

            //var_dump($ids);
            //var_dump($rel);
            //die();
            require_once 'Celula/visao/relatorioCelula/porMes.php';

        }

        public function lerPorTema($url)
        {
      $temas = new temaModelo();
      $temas = $temas->listarTodos();
            $relatorio = new relatorioModelo();
            $relatorio->temaRelatorioCelulaId = isset($url['post']['temaId']) ? $url['post']['temaId'] : $url[4] ;
            $relatorios = $relatorio->lerPorTema();
            require_once 'Celula/visao/relatorioCelula/lerPorTema.php';
        }

        public function lerPorCelula($url)
        {
      $celula = new celulaModelo();
      $celulas = $celula->listarTodos();
            $relatorio = new relatorioModelo();
            $relatorio->celulaId = isset($url['post']['temaId']) ? $url['post']['temaId'] : $url[4] ;
            $relatorios = $relatorio->lerPorCelula();
            require_once 'Celula/visao/relatorioCelula/lerPorCelula.php';
        }

}
