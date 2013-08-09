<?php
namespace batismo\controlador;

use \batismo\modelo\batismos as batismoModelo;
use \discipulo\Modelo\Discipulo as discipulo;
use \rede\modelo\tipoRede as TipoRede;

class batismo
{
    public function index()
    {
        $discipulos = new batismoModelo() ;
        $discipulos = $discipulos->listar() ;

        $total = count ($discipulos) ;

        require_once 'modulos/batismo/visao/listar.php';

    }

    public function diploma($url){
        $discipulos = $url['post']['ids'];


        require 'ext/fpdf17/fpdf.php';
        $pdf = new \FPDF('L','mm','A4');

        $novaPagina = true ;
        $x = 10 ;
        $y = 20 ;
        $t = 20 ;
        $colunas = 0 ;
        $linhas = 0 ;
        $qtdColunas = 1 ;
        $qtdLinhas = 2 ;

        foreach ($discipulos as $disc) {

            $d = new discipulo() ;
            $d->id =  $disc;
            $d = $d->listarUm() ;

            $pdf->AddPage();

            $pdf->SetFont('Arial','B',55);
            $pdf->Image('modulos/batismo/visao/batismo.jpg',0,0,50,210);
            $pdf->Image('modulos/encontroComDeus/visao/participantesEncontro/mga.jpg',250,185,40,$t);
            $pdf->SetY(20);
            $pdf->SetX($x+50);
            $pdf->Cell(70,10,' Certificado de Batismo');

            $pdf->SetFont('Arial','B',40);
            $pdf->SetY(60);
            $pdf->SetX(60);
            $pdf->Cell(220,20,'Certificamos que',0,0,'C');

            $pdf->SetFont('Arial','B',30);
            $pdf->SetY($y+80);
            $pdf->SetX($x+50);
            $pdf->Cell(220 ,10,utf8_decode($d->nome),0,0,'C');

            $pdf->SetFont('Arial','B',25);
            $pdf->SetY($y+110);
            $pdf->SetX($x+50);
            $pdf->Cell(220,10,'foi batizado em 11 de Agosto de 2013',0,0,'C');

            $pdf->SetY($y+140);
            $pdf->SetX($x+50);
            $pdf->Cell(220,10,utf8_decode('____________________________________________'),0,0,'C');

            $pdf->SetY($y+150);
            $pdf->SetX($x+50);
            $pdf->Cell(220,10,utf8_decode(' Aps. Sebastião e Marlene Veloso '),0,0,'C');


            $txt = utf8_decode('
            "...Arrependei-vos, e cada um de vós seja batizado em nome de Jesus Cristo..." Atos 2:38
            ');

            $pdf->SetFont('Arial','B',15);
            $pdf->SetY($y+20);
            $pdf->SetX($x+30);
            $pdf->MultiCell(0,5,$txt );


            }

        $pdf->Output();
    }


    public function novo($url)
    {
        $discipuloId = isset($url[4])? $url[4]: '' ;
        if ( empty ( $url['post'] ) ) {

            $discipulo = new discipulo();
            $discipulo->id =$discipuloId ;
            $discipulo = $discipulo->listarUm();

            require_once 'modulos/batismo/visao/novo.php';

        } else {

            $post = $url['post'] ;

            $batismo = new batismoModelo() ;

            if ($post['batismo'] == 1 )
            {
                $batismo->discipuloId = $post['discipuloId'] ;
                $batismo->salvar();
            }

            header ('location:/discipulo/discipulo' );
            exit();
        }

    }

    public function novoparticipante($url)
    {
        $id = $url[4] ;

      if ( empty ( $url['post'] ) ) {
        $discipulo = new discipulo();
        $discipulo->id = $id ;
        $discipulo = $discipulo->listarUm();

        $encontro = new \encontroComDeus\modelo\encontroComDeus();
        $encontro = $encontro->listarTodos();

        } else {
        $post = $url['post'] ;
        $participantes = new \encontroComDeus\modelo\participantesEncontro() ;

        $participantes->encontroComDeusId = $post['encontroId'] ;
        $participantes->discipuloId = $post['id'] ;
        $participantes->salvar() ;

        header ('location:/discipulo/discipulo' );
        exit();
        }
        require_once 'modulos/encontroComDeus/visao/participantesEncontro/novoParticipante.php';

    }

    public function preEncontroAtivar($url)
    {
        $participante = new \encontroComDeus\modelo\participantesEncontro();
        $participante->id = $url[4] ;
        $participante->preEncontroAtivar();
        $redirecionar = $_SERVER['HTTP_REFERER'];
        //var_dump($redirecionar);exit();
        header ('location:'.$redirecionar );
    }

    public function preEncontroDesativar($url)
    {
        $participante = new \encontroComDeus\modelo\participantesEncontro();
        $participante->id = $url[4] ;
        $participante->preEncontroDesativar();
        $redirecionar = $_SERVER['HTTP_REFERER'];
        //var_dump($redirecionar);exit();
        header ('location:'.$redirecionar );
    }

    public function encontroAtivar($url)
    {
        $participante = new \encontroComDeus\modelo\participantesEncontro();
        $participante->id = $url[4] ;
        $participante->encontroAtivar();
        $redirecionar = $_SERVER['HTTP_REFERER'];
        //var_dump($redirecionar);exit();
        header ('location:'.$redirecionar );
    }

    public function encontroDesativar($url)
    {
        $participante = new \encontroComDeus\modelo\participantesEncontro();
        $participante->id = $url[4] ;
        $participante->encontroDesativar();
        $redirecionar = $_SERVER['HTTP_REFERER'];
        header ('location:'.$redirecionar );
    }

    public function posEncontroAtivar($url)
    {
        $participante = new \encontroComDeus\modelo\participantesEncontro();
        $participante->id = $url[4] ;
        $participante->posEncontroAtivar();
        $redirecionar = $_SERVER['HTTP_REFERER'];
        header ('location:'.$redirecionar );
    }

    public function posEncontroDesativar($url)
    {
        $participante = new \encontroComDeus\modelo\participantesEncontro();
        $participante->id = $url[4] ;
        $participante->posEncontroDesativar();
        $redirecionar = $_SERVER['HTTP_REFERER'];
        header ('location:'.$redirecionar );
    }

    public function desistiuAtivar($url)
    {
        $participante = new \encontroComDeus\modelo\participantesEncontro();
        $participante->id = $url[4] ;
        $participante->desistiuAtivar();
        $redirecionar = $_SERVER['HTTP_REFERER'];
        header ('location:'.$redirecionar );
    }

    public function desistiuDesativar($url)
    {
        $participante = new \encontroComDeus\modelo\participantesEncontro();
        $participante->id = $url[4] ;
        $participante->desistiuDesativar();
        $redirecionar = $_SERVER['HTTP_REFERER'];
        header ('location:'.$redirecionar );
    }

    public function preEncontro($url)
    {
        $participante = new \encontroComDeus\modelo\participantesEncontro();
        $participante->encontroComDeusId = $url[4] ;
        $discipulos = $participante->preEncontroAtivos();
        $discipulosInativos = $participante->preEncontroInativos();
        $total = count ($discipulos) ;
        $totalInativos = count ($discipulosInativos) ;
        $preEncontro= 'active';
        require_once 'modulos/encontroComDeus/visao/participantesEncontro/listar.php';
        //header ('location:/encontroComDeus/participantesEncontro/x/id/'.$url[4] );
    }
    public function encontro($url)
    {
        $participante = new \encontroComDeus\modelo\participantesEncontro();
        $participante->encontroComDeusId = $url[4] ;
        $discipulos = $participante->encontroAtivos();
        $discipulosInativos = $participante->encontroInativos();
        $total = count ($discipulos) ;
        $totalInativos = count ($discipulosInativos) ;
        $encontro= 'active';
        require_once 'modulos/encontroComDeus/visao/participantesEncontro/listar.php';
        //header ('location:/encontroComDeus/participantesEncontro/x/id/'.$url[4] );
    }
    public function posEncontro($url)
    {
        $participante = new \encontroComDeus\modelo\participantesEncontro();
        $participante->encontroComDeusId = $url[4] ;
        $discipulos = $participante->posEncontroAtivos();
        $discipulosInativos = $participante->posEncontroInativos();
        $total = count ($discipulos) ;
        $totalInativos = count ($discipulosInativos) ;
        $posEncontro= 'active';
        require_once 'modulos/encontroComDeus/visao/participantesEncontro/listar.php';
        //header ('location:/encontroComDeus/participantesEncontro/x/id/'.$url[4] );
    }

        public function novoMinisterio($url)
        {
            if ( empty ( $url['post'] ) ) {

                require_once 'modulos/ministerio/visao/novoMinisterio.php';

            } else {

            $ministerio =	new \ministerio\modelo\ministerio() ;

            $post = $url['post'] ;
            $ministerio->nome = $post['nome'] ;

            $ministerio->salvar();
            header ('location:/ministerio/listarMinisterio') ;
            exit();
            }

        }

        public function novaFuncao($url)
        {
            if ( empty ( $url['post'] ) ) {

                require_once 'modulos/ministerio/visao/novaFuncao.php';

            } else {

            $funcao =	new \ministerio\modelo\funcao() ;

            $post = $url['post'] ;
            $funcao->nome = $post['nome'] ;

            $funcao->salvar();
            header ('location:/ministerio/listarFuncao') ;
            exit();
            }

        }

        public function listarFuncao()
        {
                  $funcoes =	new \ministerio\modelo\funcao();
                  $funcoes = $funcoes->listarTodos();

                  require 'modulos/ministerio/visao/listarFuncao.php';

        }

        public function atualizar($url)
        {
            if ( empty ( $url['post'] ) ) {

                $discipulo =	new \discipulo\Modelo\Discipulo();
                $lideres = $discipulo->listarLideres();

                $discipulo->id =  $url[3] ;
                $discipulo = $discipulo->listarUm();

                $lider =	new \discipulo\Modelo\Discipulo();
                $lider->id = $discipulo['lider'] ;
                $lider = $lider->listarUm($discipulo['lider']);

                $celula = new \celula\modelo\celula();
                $celula->id = $discipulo['celula'];
                $celula = $celula->listarUm();

                $celulas = new \celula\modelo\celula();
                $celulas = $celulas->listarTodos();

                require_once 'modulos/discipulo/visao/atualizar.php';

            } else {
                $discipulo =	new \discipulo\Modelo\Discipulo();

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

        public function atualizarMinisterio($url)
        {
            if ( empty ( $url['post'] ) ) {

                $ministerio =	new \ministerio\modelo\ministerio();
                $ministerio->id = $url[3] ;
                $ministerio = $ministerio->listarUm();

                require_once 'modulos/ministerio/visao/atualizarMinisterio.php';

            } else {
                $ministerio =	new \ministerio\modelo\ministerio();

                $post = $url['post'] ;

                $ministerio->id = $post['id'];
                $ministerio->nome = $post['nome'];

                $ministerio->atualizarMinisterio();

                header ('location:/ministerio/atualizarMinisterio/id/'.$ministerio->id);
                exit();
            }

        }

        public function atualizarFuncao($url)
        {
            if ( empty ( $url['post'] ) ) {

                $funcao =	new \ministerio\modelo\funcao();
                $funcao->id = $url[3] ;
                $funcao = $funcao->listarUm();

                require_once 'modulos/ministerio/visao/atualizarFuncao.php';

            } else {
                $funcao =	new \ministerio\modelo\funcao();

                $post = $url['post'] ;

                $funcao->id = $post['id'];
                $funcao->nome = $post['nome'];

                $funcao->atualizarFuncao();

                header ('location:/ministerio/atualizarFuncao/id/'.$funcao->id);
                exit();
            }

        }

        public function excluir($url)
        {
                $meta =	new batismoModelo();
                $meta->id = $url[4];
                $meta->excluir();

                $redirecionar = $_SERVER['HTTP_REFERER'];
                header ('location:'.$redirecionar );
                exit();
        }

        public function excluirFuncao($url)
        {
                $funcao =	new \ministerio\modelo\funcao();
                $funcao->id = $url[3];
                $funcao->excluir();

                $_SESSION['mensagem'] = !is_null($funcao->erro) ? $funcao->erro : null ;
                header ('location:/ministerio/listarFuncao');
                exit();
        }

        public function detalhar ($url)
        {
            $discipulo = new \discipulo\Modelo\Discipulo() ;

            $discipulo->id = $url[4] ;
            $discipulo = $discipulo->listarUm() ;

            $meta = new \metas\modelo\metas() ;
            $meta->discipuloId = $url[4] ;
            $metas = $meta->listar() ;
            //var_dump($metas);

            require 'metas/visao/metas/detalhar.php';

        }

        public function detalharFuncao ($url)
        {
            $funcao = new \ministerio\modelo\funcao() ;

            $funcao->id = $url[3] ;
            $funcao = $funcao->listarUm() ;

            require 'ministerio/visao/detalharFuncao.php';

        }

        public function detalharMinisterio ($url)
        {
            $ministerio = new \ministerio\modelo\ministerio() ;

            $ministerio->id = $url[3] ;
            $ministerio = $ministerio->listarUm() ;

            require 'ministerio/visao/detalharMinisterio.php';

        }

        public function chamar ()
        {
            $nome = (!empty($_GET['nome'])) ? $_GET['nome'] : NULL;
            $discipulo =	new \discipulo\Modelo\Discipulo();
            $discipulo->nome = $nome;
            $discipulos = $discipulo->chamar($nome);
            require_once 'discipulo/visao/chamar.php';

        }

        public function evento($url)
        {
            if ( empty ( $url['post'] ) ) {

                  $eventos = new \evento\modelo\evento();

                  $id = $url[3];
                  $eventosDiscipulos = $eventos->listarTodosDiscipulo($id);
                $eventos = $eventos->listarTodos();

            require_once 'modulos/discipulo/visao/evento.php';
            } else {
                      $post = $url['post'];
                     $discipuloEvento = new \evento\modelo\evento();
                      $eventoId = $post['eventoId'];
                        $discipuloId = $post['discipuloId'];

                     $discipuloEvento->salvarDiscipuloEvento($discipuloId, $eventoId );

                      //echo "url" ;
                     //var_dump($url);
                     $id = $post['discipuloId'];

                     header ('location:/discipulo/evento/id/'.$id);
                     exit();

            }

        }

    public function cracha($url)
    {
            $encontro = new \encontroComDeus\modelo\participantesEncontro() ;
            $encontro->encontroComDeusId =  $url[4];
            $discipulos = $encontro->cracha() ;
        //	var_dump($discipulos);

            require 'ext/fpdf17/fpdf.php';
            $pdf = new \FPDF('L','mm','A4');

            $novaPagina = true ;
            $x = 10 ;
            $y = 6 ;
            $t = 75 ;
            $colunas = 0 ;
            $linhas = 0 ;
            $qtdColunas = 2 ;
            $qtdLinhas = 4 ;

            foreach ($discipulos as $d) {
            ++$colunas ;
            ++$linhas ;
                    if ($novaPagina) {
                                    $pdf->AddPage();
                                    $novaPagina = false ;
                    }
            $pdf->SetFont('Arial','B',25);
            $pdf->Image('modulos/encontroComDeus/visao/participantesEncontro/cracha.png',$x,$y,114,$t);
            $pdf->SetY($y+20);
            $pdf->SetX($x);
            $pdf->Cell(70,10,$d->getNomeAbreviado());

            $x += 120 ;

            if ($colunas >= $qtdColunas) {
                $y += 80 ;
                $x = 10 ;
                $colunas = 0 ;
            }

            if ($linhas >= $qtdLinhas) {
                $y = 6 ;
                $x = 10 ;
                $novaPagina = true ;
                $linhas = 0 ;
            }

            }

            $pdf->Output();
    }

    public function ficha($url)
    {
            $encontro = new \encontroComDeus\modelo\participantesEncontro() ;
            $encontro->encontroComDeusId =  $url[4];
            $discipulos = $encontro->cracha() ;
        //	var_dump($discipulos);

            require 'ext/fpdf17/fpdf.php';
            $pdf = new \FPDF('P','mm','A4');

            $novaPagina = true ;
            $x = 10 ;
            $y = 6 ;
            $t = 20 ;
            $colunas = 0 ;
            $linhas = 0 ;
            $qtdColunas = 1 ;
            $qtdLinhas = 2 ;

            foreach ($discipulos as $d) {
            ++$colunas ;
            ++$linhas ;
                    if ($novaPagina) {
                                    $pdf->AddPage();
                                    $novaPagina = false ;
                    }

            $pdf->SetFont('Arial','B',20);
            $pdf->Image('modulos/encontroComDeus/visao/participantesEncontro/mga.jpg',$x,$y,30,$t);
            $pdf->SetY($y+10);
            $pdf->SetX($x+30);
            $pdf->Cell(70,10,' Encontro com Deus dias 15, 16 e 17/03/2013');

            $pdf->SetFont('Arial','B',14);
            $pdf->SetY($y+20);
            $pdf->SetX($x);
            $pdf->Cell(70,10,'Nome: '.$d->getNomeAbreviado());

            $pdf->SetY($y+20);
            $pdf->SetX($x+80);
            $pdf->Cell(70,10,'Data Nasc.: '.$d->getDataNascimento()->format('d/m/Y'));

            $pdf->SetY($y+30);
            $pdf->SetX($x);
            $pdf->Cell(70,10,'Endereco: '.$d->endereco);

            $pdf->SetY($y+40);
            $pdf->SetX($x);
            $pdf->Cell(70,10,'Telefone: '.$d->telefone);

            $pdf->SetY($y+40);
            $pdf->SetX($x+70);
            $pdf->Cell(70,10,'Lider: '.utf8_decode($d->getLider()->nome) );

            $txt = utf8_decode('Condições de Pagamento:
a) Valor do encontro para encontrista: R$ 100,00 - à vista; R$ 120,00 - a prazo;
b) Valor do Encontro para crianças até 11 anos de idade: R$ 40,00 – à vista; R$ 50,00 – a prazo;
c) O pagamento a prazo e/ou parcelamento somente será aceito em CHEQUE OU CARTÃO.
OBS: Não haverá ressarcimento ou alteração dos valores acordados, bem como das formas de pagamento.
Estou CIENTE da minha participação no ENCONTRO COM DEUS e concordo em realizar o pagamento
até o dia 15/03/2013.
Assinatura do Encontrista:_______________________________________________________________
Menor de Idade (Ass. do Responsável):_____________________________________________________
Membro de outra Igreja (Ass. do Pastor):____________________________________________________');

            $pdf->SetFont('Arial','B',10);
            $pdf->SetY($y+60);
            $pdf->SetX($x);
            $pdf->MultiCell(0,5,$txt );

            //$pdf->WriteHTML( 'encontroComDeus/visao/participantesEncontro/ficha.php' );
            //include 'encontroComDeus/visao/participantesEncontro/ficha.php' ;

            $x += 120 ;

            if ($colunas >= $qtdColunas) {
                $y += 120 ;
                $x = 10 ;
                $colunas = 0 ;
            }

            if ($linhas >= $qtdLinhas) {
                $y = 6 ;
                $x = 10 ;
                $novaPagina = true ;
                $linhas = 0 ;
            }

            }

            $pdf->Output();
    }

    }
