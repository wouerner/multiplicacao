<?php
namespace encontroComDeus\controlador;

use \Discipulo\Modelo\Discipulo as discipulo;

class participantesEncontro
{
    public function index($url)
    {
        $participante = new \EncontroComDeus\Modelo\ParticipantesEncontro() ;
        $participante->encontroComDeusId =$url[4] ;
        $discipulos = $participante->listarTodos();

        $total = count ($discipulos) ;
        $ativo = 'active' ;

        require_once 'modulos/EncontroComDeus/visao/participantesEncontro/listarTodos.php';
    }

    public function imprimir($url)
    {
        $participante = new \EncontroComDeus\Modelo\ParticipantesEncontro() ;
        $participante->encontroComDeusId =$url[4] ;
        $discipulos = $participante->listarTodos();

        $total = count ($discipulos) ;
        $ativo = 'active' ;

        require_once 'modulos/EncontroComDeus/visao/participantesEncontro/imprimir.php';
    }

    public function lista($url)
    {
        $participante = new \EncontroComDeus\Modelo\ParticipantesEncontro() ;
        $participante->encontroComDeusId =$url[4] ;
        $discipulos = $participante->listarTodos();

        $redes =	new \Rede\Modelo\TipoRede();
        $redes = $redes->listarTodos();

        $total = count ($discipulos) ;
        $ativo = 'active' ;

        require_once 'modulos/EncontroComDeus/visao/participantesEncontro/lista2.php';
        //require_once 'modulos/EncontroComDeus/visao/participantesEncontro/lista.php';
    }

    public function novo($url)
    {
        $encontroId = $url[4] ;
      if ( empty ( $url['post'] ) ) {

            $discipulos = new discipulo();
            $discipulos = $discipulos->listarTodos($_SESSION['usuario_id']);
            require_once 'modulos/EncontroComDeus/visao/participantesEncontro/novo.php';

        } else {

        $post = $url['post'] ;

        $participantes = new \EncontroComDeus\Modelo\ParticipantesEncontro() ;

        $participantes->encontroComDeusId = $post['encontroId'] ;
        $participantes->salvarMuitos($post['participantes']) ;

        header ('location:/encontroComDeus/encontroComDeus' );
        exit();
        }

        }

    public function novoParticipante($url)
    {
        $id = isset($url[4])?$url[4] :NULL  ;

        if ( empty ( $url['post'] ) ) {
            $discipulo = new discipulo();
            $discipulo->id = $id ;
            $discipulo = $discipulo->listarUm();

            $encontro = new \EncontroComDeus\Modelo\EncontroComDeus();
            $encontro = $encontro->listarTodosAtivos();

        } else {
            $post = $url['post'] ;
            $participantes = new \EncontroComDeus\Modelo\ParticipantesEncontro() ;

            $participantes->encontroComDeusId = $post['encontroId'] ;
            $participantes->discipuloId = $post['id'] ;

            if(!$participantes->eParticipante()){
                $participantes->salvar() ;
                $_SESSION['mensagem'] = array('mensagem'	=> 'Cadastro Realizado com Sucesso!',
                                                                  'class' => 'alert alert-success');
            }
            else
            {
                $_SESSION['mensagem'] = array('mensagem'	=> 'Já está cadastrado!',
                                                                  'class' => 'alert alert-info');
            }
            header ('location:/discipulo/discipulo' );
            exit();
        }
        require_once 'modulos/EncontroComDeus/visao/participantesEncontro/novoParticipante.php';

    }

    public function preEncontroAtivar($url)
    {
        $participante = new \EncontroComDeus\Modelo\ParticipantesEncontro();
        $participante->id = $url[4] ;
        $participante->preEncontroAtivar();
        $redirecionar = $_SERVER['HTTP_REFERER'];
        //var_dump($redirecionar);exit();
        header ('location:'.$redirecionar );
    }

    public function preEncontroDesativar($url)
    {
        $participante = new \EncontroComDeus\Modelo\ParticipantesEncontro();
        $participante->id = $url[4] ;
        $participante->preEncontroDesativar();
        $redirecionar = $_SERVER['HTTP_REFERER'];
        //var_dump($redirecionar);exit();
        header ('location:'.$redirecionar );
    }

    public function encontroAtivar($url)
    {
        $participante = new \EncontroComDeus\Modelo\ParticipantesEncontro();
        $participante->id = $url[4] ;
        $participante->encontroAtivar();
        $redirecionar = $_SERVER['HTTP_REFERER'];
        //var_dump($redirecionar);exit();
        header ('location:'.$redirecionar );
    }

    public function encontroDesativar($url)
    {
        $participante = new \EncontroComDeus\Modelo\ParticipantesEncontro();
        $participante->id = $url[4] ;
        $participante->encontroDesativar();
        $redirecionar = $_SERVER['HTTP_REFERER'];
        header ('location:'.$redirecionar );
    }

    public function posEncontroAtivar($url)
    {
        $participante = new \EncontroComDeus\Modelo\ParticipantesEncontro();
        $participante->id = $url[4] ;
        $participante->posEncontroAtivar();
        $redirecionar = $_SERVER['HTTP_REFERER'];
        header ('location:'.$redirecionar );
    }

    public function posEncontroDesativar($url)
    {
        $participante = new \EncontroComDeus\Modelo\ParticipantesEncontro();
        $participante->id = $url[4] ;
        $participante->posEncontroDesativar();
        $redirecionar = $_SERVER['HTTP_REFERER'];
        header ('location:'.$redirecionar );
    }

    public function desistiuAtivar($url)
    {
        $participante = new \EncontroComDeus\Modelo\ParticipantesEncontro();
        $participante->id = $url[4] ;
        $participante->desistiuAtivar();
        $redirecionar = $_SERVER['HTTP_REFERER'];
        header ('location:'.$redirecionar );
    }

    public function desistiuDesativar($url)
    {
        $participante = new \EncontroComDeus\Modelo\ParticipantesEncontro();
        $participante->id = $url[4] ;
        $participante->desistiuDesativar();
        $redirecionar = $_SERVER['HTTP_REFERER'];
        header ('location:'.$redirecionar );
    }

    public function preEncontro($url)
    {
        $participante = new \EncontroComDeus\Modelo\ParticipantesEncontro();
        $participante->encontroComDeusId = $url[4] ;
        $discipulos = $participante->preEncontroAtivos();
        $discipulosInativos = $participante->preEncontroInativos();
        $total = count ($discipulos) ;
        $totalInativos = count ($discipulosInativos) ;
        $preEncontro= 'active';
        require_once 'modulos/EncontroComDeus/visao/participantesEncontro/listar.php';
        //header ('location:/encontroComDeus/participantesEncontro/x/id/'.$url[4] );
    }
    public function encontro($url)
    {
        $participante = new \EncontroComDeus\Modelo\ParticipantesEncontro();
        $participante->encontroComDeusId = $url[4] ;
        $discipulos = $participante->encontroAtivos();
        $discipulosInativos = $participante->encontroInativos();
        $total = count ($discipulos) ;
        $totalInativos = count ($discipulosInativos) ;
        $encontro= 'active';
        require_once 'modulos/EncontroComDeus/visao/participantesEncontro/listar.php';
        //header ('location:/encontroComDeus/participantesEncontro/x/id/'.$url[4] );
    }
    public function posEncontro($url)
    {
        $participante = new \EncontroComDeus\Modelo\ParticipantesEncontro();
        $participante->encontroComDeusId = $url[4] ;
        $discipulos = $participante->posEncontroAtivos();
        $discipulosInativos = $participante->posEncontroInativos();
        $total = count ($discipulos) ;
        $totalInativos = count ($discipulosInativos) ;
        $posEncontro= 'active';
        require_once 'modulos/EncontroComDeus/visao/participantesEncontro/listar.php';
        //header ('location:/encontroComDeus/participantesEncontro/x/id/'.$url[4] );
    }
    public function igrejaAtivar($url)
    {
        $participante = new \EncontroComDeus\Modelo\ParticipantesEncontro();
        $participante->id = $url[4] ;
        $participante->igrejaAtivar();
        $redirecionar = $_SERVER['HTTP_REFERER'];
        //var_dump($redirecionar);exit();
        header ('location:'.$redirecionar );
    }

    public function igrejaDesativar($url)
    {
        $participante = new \EncontroComDeus\Modelo\ParticipantesEncontro();
        $participante->id = $url[4] ;
        $participante->igrejaDesativar();
        $redirecionar = $_SERVER['HTTP_REFERER'];
        header ('location:'.$redirecionar );
    }

        public function novaFuncao($url)
        {
            if ( empty ( $url['post'] ) ) {

                require_once 'modulos/ministerio/visao/novaFuncao.php';

            } else {

            $funcao =	new \Ministerio\Modelo\Funcao() ;

            $post = $url['post'] ;
            $funcao->nome = $post['nome'] ;

            $funcao->salvar();
            header ('location:/ministerio/listarFuncao') ;
            exit();
            }

        }

        public function listarMinisterio()
        {
                  $ministerios =	new \Ministerio\Modelo\Ministerio();
                  $ministerios = $ministerios->listarTodos();

                  require 'modulos/ministerio/visao/listarMinisterio.php';

        }

        public function listarFuncao()
        {
                  $funcoes =	new \Ministerio\Modelo\Funcao();
                  $funcoes = $funcoes->listarTodos();

                  require 'modulos/ministerio/visao/listarFuncao.php';

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

        public function atualizarMinisterio($url)
        {
            if ( empty ( $url['post'] ) ) {

                $ministerio =	new \Ministerio\Modelo\Ministerio();
                $ministerio->id = $url[3] ;
                $ministerio = $ministerio->listarUm();

                require_once 'modulos/ministerio/visao/atualizarMinisterio.php';

            } else {
                $ministerio =	new \Ministerio\Modelo\Ministerio();

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

                $funcao =	new \Ministerio\Modelo\Funcao();
                $funcao->id = $url[3] ;
                $funcao = $funcao->listarUm();

                require_once 'modulos/ministerio/visao/atualizarFuncao.php';

            } else {
                $funcao =	new \Ministerio\Modelo\Funcao();

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
                $participante =	new \EncontroComDeus\Modelo\ParticipantesEncontro();
                $participante->id = $url[4];
                $participante->excluir();

                $redirecionar = $_SERVER['HTTP_REFERER'];
                header ('location:'.$redirecionar );
                exit();
        }

        public function excluirFuncao($url)
        {
                $funcao =	new \Ministerio\Modelo\Funcao();
                $funcao->id = $url[3];
                $funcao->excluir();

                $_SESSION['mensagem'] = !is_null($funcao->erro) ? $funcao->erro : null ;
                header ('location:/ministerio/listarFuncao');
                exit();
        }

        public function detalhar ($url)
        {
            $discipulo = new \Discipulo\Modelo\Discipulo() ;

            $discipulo->id = $url[3] ;
            $discipulo = $discipulo->listarUm() ;

            require 'Discipulo/visao/detalhar.php';

        }

        public function detalharFuncao ($url)
        {
            $funcao = new \Ministerio\Modelo\Funcao() ;

            $funcao->id = $url[3] ;
            $funcao = $funcao->listarUm() ;

            require 'ministerio/visao/detalharFuncao.php';

        }

        public function detalharMinisterio ($url)
        {
            $ministerio = new \Ministerio\Modelo\Ministerio() ;

            $ministerio->id = $url[3] ;
            $ministerio = $ministerio->listarUm() ;

            require 'ministerio/visao/detalharMinisterio.php';

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

                      //echo "url" ;
                     //var_dump($url);
                     $id = $post['discipuloId'];

                     header ('location:/discipulo/evento/id/'.$id);
                     exit();

            }

        }

    public function cracha($url)
    {
            $encontro = new \EncontroComDeus\Modelo\ParticipantesEncontro() ;
            $encontro->encontroComDeusId =  $url[4];
            $discipulos = $encontro->cracha() ;
        //	var_dump($discipulos);

            require 'ext/fpdf17/fpdf.php';
            $pdf = new \FPDF('L','mm','A4');
            $pdf->SetTextColor(0,0,0);
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
            $pdf->Image('modulos/EncontroComDeus/visao/participantesEncontro/cracha.png',$x,$y,114,$t);
            $pdf->SetY($y+20);
            $pdf->SetX($x);
            $pdf->Cell(70,10,utf8_decode($d->getAlcunha()));

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
            $encontro = new \EncontroComDeus\Modelo\ParticipantesEncontro() ;
            $encontro->encontroComDeusId =  $url[4];
            $discipulos = $encontro->cracha() ;

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
            $pdf->Image('modulos/EncontroComDeus/visao/participantesEncontro/mga.jpg',$x,$y,30,$t);
            $pdf->SetY($y+10);
            $pdf->SetX($x+30);
            $pdf->Cell(70,10,' Encontro com Deus dias 20, 21 e 22/03/2015');

            $pdf->SetFont('Arial','B',14);
            $pdf->SetY($y+20);
            $pdf->SetX($x);
            $nome = empty($d->alcunha)?  $d->getNomeAbreviado() : $d->alcunha;
            $pdf->Cell(70,10,'Nome: '.utf8_decode($nome));

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

            $txt = utf8_decode('
Condições de Pagamento:
a) Valor do encontro para encontrista: R$100,00 à vista e  R$ 110,00 - a prazo;
b) O pagamento a prazo e/ou parcelamento somente será aceito em CHEQUE OU CARTÃO.
OBS I: Crianças de 0 até 12 anos, passando pela avaliação dos Apostólos, pagará 50% do valor do adulto.
OBS II: Não haverá ressarcimento ou alteração dos valores acordados, bem como das formas de pagamento.
até o dia 20/03/2015.
Assinatura do Encontrista:_______________________________________________________________
Menor de Idade (Ass. do Responsável):_____________________________________________________
Membro de outra Igreja (Ass. do Pastor):____________________________________________________
');

            $pdf->SetFont('Arial','B',10);
            $pdf->SetY($y+60);
            $pdf->SetX($x);
            $pdf->MultiCell(0,5,$txt );

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

    public function fichaIndividual($url)
    {
            $discipulo = new Discipulo() ;
            $discipulo->id =  $url[4];
            $d =$discipulo->listarUm();
            //var_dump($d);exit;

            require 'ext/fpdf17/fpdf.php';
            $pdf = new \FPDF('P','mm','A4');
            $x = 10 ;
            $y = 6 ;
            $t = 20 ;

            $pdf->AddPage();
            $pdf->SetFont('Arial','B',20);
            $pdf->Image('modulos/EncontroComDeus/visao/participantesEncontro/mga.jpg',$x,$y,30,$t);
            $pdf->SetY($y+10);
            $pdf->SetX($x+30);
            $pdf->Cell(70,10,' Encontro com Deus dias 20, 21 e 22/03/2015');

            $pdf->SetFont('Arial','B',14);
            $pdf->SetY($y+20);
            $pdf->SetX($x);
            $pdf->Cell(70,10,'Nome: '.utf8_decode($d->getNomeAbreviado()));

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

            $txt = utf8_decode('
Condições de Pagamento:
a) Valor do encontro para encontrista: R$100,00 à vista e  R$ 110,00 - a prazo;
b) O pagamento a prazo e/ou parcelamento somente será aceito em CHEQUE OU CARTÃO.
OBS I: Crianças de 0 até 12 anos, passando pela avaliação dos Apostólos, pagará 50% do valor do adulto.
OBS II: Não haverá ressarcimento ou alteração dos valores acordados, bem como das formas de pagamento.
até o dia 20/03/2015.
Assinatura do Encontrista:_______________________________________________________________
Menor de Idade (Ass. do Responsável):_____________________________________________________
Membro de outra Igreja (Ass. do Pastor):____________________________________________________
');

            $pdf->SetFont('Arial','B',10);
            $pdf->SetY($y+60);
            $pdf->SetX($x);
            $pdf->MultiCell(0,5,$txt );


            $pdf->Output();
    }

    }
