<?php
namespace discipulo\Modelo;

use \Framework\Modelo\ModeloFramework;
use \Geracoes\Modelo\Geracoes as geracaoModelo;

class Discipulo extends ModeloFramework implements \JsonSerializable
{
    private $id;
    private $nome;
    private $alcunha;
    private $dataNascimento;

    /* Sexo da pessoa: m = Maculino, f = Feminino.
     * */
    private $sexo = 'm';

    private $estadoCivilId;
    private $ativo;
    private $telefone;
    private $email;
    private $endereco;
    private $nivel;
    private $lider;
    private $celula;
    private $senha;
    private $statusCelular;
    private $admissao;
    private $arquivo;
    private $erro;
    private $rede;
    private $foto;
    private $geracao;
    private $observacao;

    public function __construct ()
    {
    }

    public function __get($prop)
    {
        switch ($prop) {
            case 'dataNascimento':
                return $this->getDataNascimento();
                break;
            default:
                return $this->$prop;
        }
    }

    public function __set($prop, $valor)
    {
              $this->$prop = $valor;

    }

    public function getNomeAbreviado()
    {
              $nome = explode(' ', trim($this->nome));
              $nome = $nome[0].' '.$nome[count($nome)-1];

              return $nome;
    }

    public function getNome()
    {
              return  $this->nome;
    }

    public function getAlcunha()
    {
        if ($this->alcunha) {
            $nome = $this->alcunha;
        } else if($this->getNomeAbreviado()) {
            $nome = $this->getNomeAbreviado();
        } else {
           $nome = $this->nome;
        }

        return  $nome;
    }

    public function setDataNascimento($valor)
    {
        try {

            $this->dataNascimento = \DateTime::createFromFormat(
                'd/m/Y',
                $valor,
                new \DateTimeZone('America/Sao_Paulo')
            );

        } catch (\Exception $e) {
             echo 'Erro ao instanciar objeto.';
             echo $e->getMessage();
             exit();
        }

    }

    public function getDataNascimento()
    {
        try {
            $this->dataNascimento = new \DateTime(
                $this->dataNascimento,
                new \DateTimeZone('America/Sao_Paulo')
            );

            return $this->dataNascimento;
        } catch (\Exception $e) {
            echo 'Erro ao instanciar objeto.';
            echo $e->getMessage();
            exit();
        }
    }

    /*Pega a célula que o discipulo participa.
     *
     *
     * */
    public function getCelula()
    {
        $celula = new \Celula\Modelo\Celula();
        $celula->id = $this->celula;
        $this->celula = $celula->listarUm();

        return $this->celula	;

    }

    public function getCelulaLider()
    {
        $celula = new \Celula\Modelo\Celula();
        $celula->lider = $this->id;
        $this->celulaLidera = $celula->listarCelulasLider();

        return $this->celulaLidera;

    }

    /*
     *Listar todos os eventos do discipulo
     *
     * */
    public function getEventos()
    {
        $evento = new \Evento\Modelo\Evento();
        $evento = $evento->listarTodosDiscipulo($this->id);

        return $evento	;

    }

    public function getEstatoCivil()
    {
        $estadoCivil = new estadoCivil();
        $estadoCivil->id = $this->estadoCivilId;
        $estadoCivil = $estadoCivil->listarUm();

        return $estadoCivil	;

    }

    public function getLider()
    {
        $lider = new Discipulo();
        $lider->id = $this->lider;
        $lider = $lider->listarUm();

        return $lider	;

    }

    public function getStatusCelular()
    {
        $status = new \StatusCelular\Modelo\StatusCelular();
        $status->discipuloId = $this->id;
        $status = $status->pegarStatusCelular();

        return $status	;

    }

    public function getAdmissao()
    {
        $admissao = new \Admissao\Modelo\Admissao();
        $admissao->discipuloId = $this->id;
        $admissao=  $admissao->listarUm();

        return $admissao	;

    }

    public function getRede()
    {
        $rede = new \Rede\Modelo\Rede();
        $rede->discipuloId = $this->id;
        $rede =  $rede->pegarRedeDiscipulo();

        return $rede;

    }

    public function getFuncaoRede()
    {
        $rede = new \Rede\Modelo\Rede();
        $rede->discipuloId = $this->id;
        $rede =  $rede->pegarFuncaoRede();

        return $rede;
    }

    public function getMinisterio()
    {
        $ministerio = new \Ministerio\Modelo\MinisterioTemDiscipulo();
        $ministerio->discipuloId = $this->id;
        $ministerio =  $ministerio->pegarMinisterioDiscipulo();

        return $ministerio;

    }

    public function getFoto()
    {
        $foto = new \Discipulo\Modelo\Foto();
        $foto->discipuloId = $this->id;
        $this->foto = $foto->listarUm();

        return $this->foto;
    }

    public function getMeta()
    {
        $meta = new \Metas\Modelo\Metas();
        $meta->discipuloId = $this->id;
        $this->meta = $meta->listarUm();
        if ($this->meta) {
                        return $this->meta	;
        } else {
            return 0;
        }

    }

    /*Pega a Batismo.
     *
     *
     * */
    public function getBatismo()
    {
        $batismo = new \batismo\modelo\batismos();
        $batismo->discipuloId = $this->id;

        return $batismo->listarUm();

    }

    /*.
     * */
    public function getGeracao()
    {
        $geracao = new geracaoModelo();
        $geracao->discipuloId = $this->id;
        $this->geracao = $geracao->listarUm();

        return $this->geracao;
    }

    public function eLider()
    {
        $pdo = self::pegarConexao();
        $sql = "select * from Discipulo AS d Where d.lider = ? AND d.ativo = 1 And d.arquivo = 0 limit 1";
        $stm = $pdo->prepare($sql);
        $stm->bindParam(1, $this->id);
        $stm->execute();
        $resposta = $stm->fetchAll();

        if (count($resposta) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function eLiderCelula()
    {
        $pdo = self::pegarConexao();
        $sql = "select * from Celula AS c Where c.lider = ? limit 1";
        $stm = $pdo->prepare($sql);
        $stm->bindParam(1, $this->id);
         $stm->execute();
        $resposta = $stm->fetchAll();

        if (count($resposta) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function ofertasMesAno($ano, $tipo = null, $mes = ['inicio' => 1, 'fim'=> 12], $rede = null)
    {
        $oferta = new \Oferta\Modelo\Oferta();
        $oferta->discipuloId = $this->id;

        $mes = empty($mes) ? ['inicio'=> 1, 'fim'=> 12] : $mes;
        $ofertasMesAno = array();
        for($i = $mes['inicio']; $i <= $mes['fim'] ; $i++ ){
            $ofertasMesAno[$i] = $oferta->discipuloMesAno($i, $ano, $tipo, $rede ? $rede : null);
        }

        $resultado = $ofertasMesAno;

        return $resultado	;
    }

    public function salvar()
    {
        $pdo = self::pegarConexao();
        $sql = "INSERT INTO Discipulo (
                              nome, telefone, email,endereco, nivel,
                              lider, celula,  senha, alcunha
                             )
                  VALUES (?,?,?,?,?,?,?,?,?)";
              //prepara sql
              $stm = $pdo->prepare($sql);
              //trocar valores
         $stm->bindParam(1, $this->nome);
         $stm->bindParam(2, $this->telefone);
         $stm->bindParam(3, $this->email);
         $stm->bindParam(4, $this->endereco);
         $stm->bindParam(5, $this->nivel);
         $stm->bindParam(6, $this->lider);
         $stm->bindParam(7, $this->celula);
         $stm->bindParam(8, md5($this->senha));
         $stm->bindParam(9, $this->alcunha);

         $resposta = $stm->execute();

         $this->id = $pdo->lastInsertId();

         $erro =  $stm->errorInfo();

         $this->erro = $erro[0];

              //fechar conexão
         $pdo = null;

         return $resposta;
    }

    public function salvarCompleto()
    {
        $pdo = self::pegarConexao();
        $sql = "INSERT INTO Discipulo (
                              nome, ativo, datanascimento, sexo, estadoCivilId, telefone, email,endereco,
                              lider, celula,  senha, alcunha, igreja
                             )
                  VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";
              //prepara sql
        $stm = $pdo->prepare($sql);
              //trocar valores
        $stm->bindParam(1, $this->nome);
        $stm->bindParam(2, $this->ativo);
        $stm->bindParam(3, $this->dataNascimento->format('Y-m-d'));
        $stm->bindParam(4, $this->sexo);
        $stm->bindParam(5, $this->estadoCivilId);
        $stm->bindParam(6, $this->telefone);
        $stm->bindParam(7, $this->email);
        $stm->bindParam(8, $this->endereco);
        $stm->bindParam(9, $this->lider);
        $stm->bindParam(10, $this->celula);
        $stm->bindParam(11, md5($this->senha));
        $stm->bindParam(12, $this->alcunha);
        $stm->bindParam(13, $this->igreja);

        $resposta = $stm->execute();

        $this->id = $pdo->lastInsertId();

        $erro =  $stm->errorInfo();

        $this->erro = $erro[0];

        $pdo = null;

        return $resposta;
    }

    //public function insert()
    //{
        //return parent::insert($this);
    //}


    public function emailUnico()
    {
        $pdo = self::pegarConexao();
        $sql = "SELECT email FROM Discipulo WHERE email = ?";
        $stm = $pdo->prepare($sql);
        $stm->bindParam(1, $this->email);

        $stm->execute();

        if ($stm->fetch() == false) {
            return true;
        }

        return false;
    }

    public function atualizar()
    {
        try {

            //abrir conexao com o banco
            $pdo = self::pegarConexao();
            //cria sql
            $sql = "UPDATE Discipulo SET 	nome = :nome, telefone = :telefone, email = :email, endereco = :endereco, nivel = :nivel,
            lider = :lider, celula = :celula, dataNascimento = :dataNascimento , estadoCivilId = :estadoCivilId ,sexo = :sexo,igreja= :igreja";
	    $sql .= isset($this->alcunha) ?	 ',alcunha = :alcunha ' : '';
            $sql.=" WHERE id = :id ";

            $stm = $pdo->prepare($sql);

            $stm->bindParam(':nome', $this->nome, \PDO::PARAM_STR);
            $stm->bindParam(':telefone', $this->telefone, \PDO::PARAM_STR);
            $stm->bindParam(':email', $this->email, \PDO::PARAM_STR);
            $stm->bindParam(':endereco', $this->endereco, \PDO::PARAM_STR);
            $stm->bindParam(':nivel', $this->nivel,  \PDO::PARAM_STR);
            $stm->bindParam(':lider', $this->lider,  \PDO::PARAM_STR);
            $stm->bindParam(':celula', $this->celula,  \PDO::PARAM_INT);
            $stm->bindParam(':dataNascimento', $this->dataNascimento->format('Y-m-d'), \PDO::PARAM_STR);
            $stm->bindParam(':estadoCivilId', $this->estadoCivilId, \PDO::PARAM_INT);
            $stm->bindParam(':sexo', $this->sexo, \PDO::PARAM_STR);
            $stm->bindParam(':id', $this->id, \PDO::PARAM_INT);
            $stm->bindParam(':igreja', $this->igreja, \PDO::PARAM_INT);

            isset($this->alcunha) ? $stm->bindParam(':alcunha', $this->alcunha, \PDO::PARAM_STR): null;

            $resposta = $stm->execute();
            $erro = $stm->errorCode();

            if ($erro != '0000') {

                throw new \Exception('Não foi possivel atualizar');
            }

        } catch (\Exception $e) {

            $this->erro= $e->getMessage();
        }
        //fechar conexÃ£o
        $pdo = null;

        return $resposta;
    }

    public function atualizarConjuge()
    {
        try {

            //abrir conexao com o banco
            $pdo = self::pegarConexao();
            //cria sql
            $sql = "UPDATE Discipulo SET conjuge = :conjuge ";
            $sql.=" WHERE id = :id ";

            $stm = $pdo->prepare($sql);

            $stm->bindParam(':conjuge', $this->conjuge, \PDO::PARAM_INT);
            $stm->bindParam(':id', $this->id, \PDO::PARAM_INT);

            $resposta = $stm->execute();
            $erro = $stm->errorCode();

            if ($erro != '0000') {
                throw new \Exception('Não foi possivel atualizar');
            }

        } catch (\Exception $e) {

            $this->erro= $e->getMessage();
        }
        //fechar conexÃ£o
        $pdo = null;

        return $resposta;
    }

    public function trocarSenha()
    {
        $pdo = new \PDO(DSN, USER, PASSWD);

        $sql = 'UPDATE Discipulo SET  senha = md5(?) WHERE email = ?';

        $stm = $pdo->prepare($sql);
        $stm->bindParam(1, $this->senha);
        $stm->bindParam(2, $this->email);

        return $stm->execute();
    }

    /*Recebe o id para nÃ£o listar este cadastro.
     *
     * */
    public function listarTodos($id)
    {
        $pdo = self::pegarConexao();

        $sql = 'SELECT * FROM Discipulo WHERE id != ? ORDER BY nome';

        $stm = $pdo->prepare($sql);
        $stm->bindParam(1, $id);
        $stm->execute();

        $resposta = array();
        while ($obj = $stm->fetchObject(get_class())) {
            $resposta[$obj->id] = $obj;
        }

        return $resposta;

    }

    public function aniversarioHoje()
    {
        $pdo = self::pegarConexao();

        $sql = '
                select *
                From Discipulo as d
                where day(d.dataNascimento) = day(curdate()) and month(d.dataNascimento) = month(curdate())
                ';

        $stm = $pdo->prepare($sql);
        $stm->execute();

        $resposta = array();
        while ($obj = $stm->fetchObject(get_class())) {
            $resposta[$obj->id] = $obj;
        }

        return $resposta;
    }

    /*Pesquisa os nome dos discipulos.
     *Retorna apenas os nomes.
     *
     * */
    public function pesquisaJson($nome)
    {
        $nome = "%$nome%"; // os '%%' funcionam como curingas na expressÃ£o revelando mais resultados.

        $pdo = self::pegarConexao();

        $sql = 'SELECT nome AS value FROM Discipulo WHERE nome LIKE ?';

        $stm = $pdo->prepare($sql);

        $stm->bindParam(1, $nome);

        $stm->execute();

        $resposta = $stm->fetchAll();

        return $resposta;

    }

    public function listarTodosDiscipulos()
    {
        $pdo = self::pegarConexao();

        $sql = 'SELECT * FROM Discipulo order by nome';

        $stm = $pdo->prepare($sql);

        $stm->execute();

        $resposta = array();

        while ($ob = $stm->fetchObject('\Discipulo\Modelo\Discipulo')) {
            $resposta[$ob->id] = $ob;
        }
        return $resposta;
    }

    public function inativos()
    {
        $pdo = self::pegarConexao();

        $sql = 'SELECT * FROM Discipulo WHERE ativo = 0 AND arquivo = 0 order by nome';

        $stm = $pdo->prepare($sql);

        $stm->execute();

        $resposta = array();

        while ($ob = $stm->fetchObject('\Discipulo\Modelo\Discipulo')) {
            $resposta[$ob->id] = $ob;
        }

        return $resposta;
    }

    public function inativosPorLider()
    {
        $pdo = self::pegarConexao();

        $sql = 'SELECT * FROM Discipulo WHERE ativo = 0 AND arquivo = 0 AND lider = ? order by nome';

        $stm = $pdo->prepare($sql);

        $stm->BindParam(1, $this->lider);

        $stm->execute();

        $resposta = array();

        while ($ob = $stm->fetchObject('\Discipulo\Modelo\Discipulo')) {
            $resposta[$ob->id] = $ob;
        }

        return $resposta;
    }

    public function arquivados()
    {
        $pdo = self::pegarConexao();

        $sql = 'SELECT * FROM Discipulo WHERE arquivo = 1 order by nome';

        $stm = $pdo->prepare($sql);

        $stm->execute();

        $resposta = array();

        while ($ob = $stm->fetchObject('\Discipulo\Modelo\Discipulo')) {
            $resposta[$ob->id] = $ob;
        }

        return $resposta;
    }

    public static function totalAtivos($igrejaId)
    {
        $pdo = self::pegarConexao();

        $sql = 'SELECT count(*) AS total FROM Discipulo WHERE ativo = 1 and arquivo=0 and igreja = ? ';

        $stm = $pdo->prepare($sql);

        $stm->BindParam(1, $igrejaId);
        $stm->execute();

        return $stm->fetch();

    }

    public static function totalInativos($igrejaId)
    {
        $pdo = self::pegarConexao();

        $sql = 'SELECT count(*) AS total FROM Discipulo WHERE ativo = 0 AND arquivo =0 and igreja=?';

        $stm = $pdo->prepare($sql);

        $stm->BindParam(1, $igrejaId);
        $stm->execute();

        return $stm->fetch();

    }

    public static function totalArquivados($igrejaId)
    {
        $pdo = self::pegarConexao();

        $sql = 'SELECT count(*) AS total FROM Discipulo WHERE arquivo = 1 and igreja=?';

        $stm = $pdo->prepare($sql);

        $stm->BindParam(1, $igrejaId);
        $stm->execute();

        return $stm->fetch();

    }

    public static function totalAtivosLider($id)
    {
        $pdo = self::pegarConexao();

        $sql = 'SELECT count(*) AS total FROM Discipulo WHERE ativo = 1 and lider=? ';

        $stm = $pdo->prepare($sql);
        $stm->bindParam(1, $id);

        $stm->execute();

        return $stm->fetch();

    }

    public static function totalInativosLider($id)
    {
        $pdo = self::pegarConexao();

        $sql = 'SELECT count(*) AS total FROM Discipulo WHERE ativo = 0 and lider=? ';

        $stm = $pdo->prepare($sql);
        $stm->bindParam(1, $id);

        $stm->execute();

        return $stm->fetch();

    }

    public function ativar()
    {
        $pdo = self::pegarConexao();

        $sql = 'UPDATE Discipulo SET  ativo = 1, arquivo = 0 WHERE id = ?';

        $stm = $pdo->prepare($sql);
        $stm->bindParam(1, $this->id);

        return $stm->execute();
    }

    public function desativar()
    {
        $pdo = self::pegarConexao();

        $sql = 'UPDATE Discipulo SET  ativo = 0, observacao = ?  WHERE id = ?';

        $stm = $pdo->prepare($sql);
        $stm->bindParam(1, $this->observacao);
        $stm->bindParam(2, $this->id);

        return $stm->execute();
    }

    public function arquivar()
    {
        $pdo = new \PDO(DSN, USER, PASSWD);

        $sql = 'UPDATE Discipulo SET  arquivo = 1, ativo = 0 WHERE id = ?';

        $stm = $pdo->prepare($sql);
        $stm->bindParam(1, $this->id);

        return $stm->execute();
    }

    public function desarquivar()
    {
        $pdo = new \PDO(DSN, USER, PASSWD);

        $sql = 'UPDATE Discipulo SET  arquivo = 0, ativo = 1 WHERE id = ?';

        $stm = $pdo->prepare($sql);
        $stm->bindParam(1, $this->id);

        return $stm->execute();
    }

    public static function rank()
    {
        $pdo = self::pegarConexao();

        $sql = 'SELECT   l.nome as lider, d.nome as nome, count(d.id) as total
                        FROM `Discipulo` as l  inner join Discipulo as d on d.lider = l.id and d.ativo = 1 WHERE 1
                        group by l.id
                        order by total DESC, l.nome ';

        $stm = $pdo->prepare($sql);

        $stm->execute();

        return $stm->fetchAll();
    }

    public static function rankInativos()
    {
        $pdo = self::pegarConexao();

        $sql = 'SELECT   l.nome as lider, d.nome as nome, count(d.id) as total
                        FROM `Discipulo` as l  inner join Discipulo as d on d.lider = l.id and d.ativo = 0 WHERE 1
                        group by l.id
                        order by total DESC, l.nome ';

        $stm = $pdo->prepare($sql);

        $stm->execute();

        return $stm->fetchAll();
    }

    /*Listar todos os lideres do sistema
     * mostra apenas os id e nomes.
     *
     * */

    public function listarLideres()
    {
        $pdo = self::pegarConexao();

        $sql = 'SELECT id, nome,alcunha FROM Discipulo';

        $stm = $pdo->prepare($sql);
        $stm->bindParam(1, $id);

        $stm->execute();

        $resposta = array();

        while ($ob = $stm->fetchObject('\Discipulo\Modelo\Discipulo')) {
            $resposta[$ob->id] = $ob;
        }

        return $resposta;
    }

    public function liderCelula()
    {
        $pdo = self::pegarConexao();

        $sql = 'SELECT c.nome AS nomeCelula, c.id AS id
                    FROM Discipulo AS d, Celula AS c
                    WHERE d.id = ? AND d.id = c.lider';

        $stm = $pdo->prepare($sql);
        $stm->bindParam(1, $this->id);

        $stm->execute();

        return $stm->fetchAll();

    }

    public function discipulosPorLider()
    {
        $pdo = self::pegarConexao();

        $sql = 'SELECT l.id AS liderId, l.nome AS Lider, d.id AS discipuloId,
                d.nome AS nomeDiscipulo, d.lider AS discipuloLiderId
                FROM Discipulo AS d
                INNER JOIN Discipulo AS l ON d.lider = l.id
                ORDER BY l.nome';

        $stm = $pdo->prepare($sql);

        $stm->execute();

        $respostas = $stm->fetchAll();

        $aux = array();

        foreach ($respostas as $valor) {
            $i = $valor['liderId'];
            $j = $valor['discipuloId'];

            foreach ($valor as $v) {

                $aux[$i]['lider']	= $valor['Lider'];
                $aux[$i]['liderId']	= $valor['liderId'];

                $aux[$i]['discipulos'][$j] = array('nomeDiscipulo' => $valor['nomeDiscipulo'],
                                                              'discipuloId' => $valor['discipuloId'],
                                                            'discipulos' => array());

            }
        }

        $teste = array_chunk($aux, 1, true);

        $teste = array_merge($teste[0], $teste[1]);

        //var_dump($teste);
        return $aux;

    }

    /*Lista todos os Discipulos sem célula
     *
     *
     * */
    public function semCelula($numPagina, $pagina)
    {
        $numPagina = (int) $numPagina;
        $pagina = (int) $pagina;

        (int) $primeiroRegistro = ($pagina * $numPagina) - $numPagina;

        $pdo = new \PDO(DSN, USER, PASSWD);

        $sql = 'SELECT * FROM Discipulo AS d WHERE ISNULL(d.celula) LIMIT ?, ?';

        $stm = $pdo->prepare($sql);
        $stm->bindParam(1, $primeiroRegistro, \PDO::PARAM_INT);
        $stm->bindParam(2, $numPagina, \PDO::PARAM_INT);

        $stm->execute();

        $resposta = array();

        while ($ob = $stm->fetchObject('\Discipulo\Modelo\Discipulo')) {
            $resposta[$ob->id] = $ob;

        }

        return $resposta;

    }

    public function semLider($numPagina, $pagina)
    {
        $numPagina = (int) $numPagina;
        $pagina = (int) $pagina;

        (int) $primeiroRegistro = ($pagina * $numPagina) - $numPagina;

        $pdo = new \PDO(DSN, USER, PASSWD);

        $sql = 'SELECT * FROM Discipulo AS d WHERE ISNULL(d.lider) LIMIT ?, ?';

        $stm = $pdo->prepare($sql);
        $stm->bindParam(1, $primeiroRegistro, \PDO::PARAM_INT);
        $stm->bindParam(2, $numPagina, \PDO::PARAM_INT);

        $stm->execute();

        $resposta = array();

        while ($ob = $stm->fetchObject('\Discipulo\Modelo\Discipulo')) {
            $resposta[$ob->id] = $ob;

        }

        return $resposta;

    }

    public function participaCelula()
    {
        $pdo = self::pegarConexao();

        $sql = 'SELECT c.nome AS nomeCelula FROM Discipulo AS d, Celula AS c WHERE c.id = d.celula and d.id = ? ';

        $stm = $pdo->prepare($sql);
        $stm->bindParam(1, $this->id);

        $stm->execute();

        return $stm->fetch();

    }

    /* listar todos menos os usuario logado atualmente, e com paginação
     *
     * */

    public function listarTodosPag($id, $numPagina, $pagina)
    {
        $numPagina = (int) $numPagina;

        (int) $primeiroRegistro = ($pagina * $numPagina) - $numPagina;

        $pdo = self::pegarConexao();

        $sql = 'SELECT * FROM Discipulo WHERE id != ? ORDER BY nome LIMIT ?, ? ';

        $stm = $pdo->prepare($sql);

        $stm->bindParam(1, $id, \PDO::PARAM_INT);
        $stm->bindParam(2, $primeiroRegistro, \PDO::PARAM_INT);
        $stm->bindParam(3, $numPagina, \PDO::PARAM_INT);

        $stm->execute();

        $stm->errorInfo();

        $resposta = array();

        while ($ob = $stm->fetchObject('\Discipulo\Modelo\Discipulo')) {
            $resposta[$ob->id] = $ob;

        }

        return $resposta;
    }

    /* total de discipulos cadastrados no sistema*/

    public static function totalDiscipulos()
    {
        $pdo = new \PDO(DSN, USER, PASSWD);

        $sql = 'SELECT COUNT(*) AS total FROM Discipulo';

        $stm = $pdo->prepare($sql);

        $stm->execute();

        return $stm->fetch();

    }

    public static function totalDiscipulosSemCelula()
    {
        $pdo = new \PDO(DSN, USER, PASSWD);

        $sql = 'SELECT COUNT(*) AS total FROM Discipulo AS d WHERE ISNULL(d.celula) ';

        $stm = $pdo->prepare($sql);

        $stm->execute();

        return $stm->fetch();

    }

    public static function totalDiscipulosSemLider()
    {
        $pdo = new \PDO(DSN, USER, PASSWD);

        $sql = 'SELECT COUNT(*) AS total FROM Discipulo AS d WHERE ISNULL(d.lider) ';

        $stm = $pdo->prepare($sql);

        $stm->execute();

        return $stm->fetch();

    }

    /* recebe total de registros, e numero por pagina de registros.*/
    public static function mostrarPaginacao($total, $numPagina, $pagina)
    {
        $total_paginas = $total/$numPagina;

        $prev = $pagina - 1;
        $next = $pagina + 1;

        // se página maior que 1 (um), então temos link para a página anterior
        if ($pagina > 1) {
                $prev_link = '<a class = "btn" href=';
                $prev_link .= $_SERVER['REDIRECT_URL'];
                $prev_link .= "?pagina=$prev> Anterior </a>";
        } else { // senão não há link para a página anterior
                $prev_link = '<a href="#" class = "btn disabled" >Anterior<a>';
        }

        // se número total de páginas for maior que a página corrente,
        // então temos link para a próxima página
        if ($total_paginas > $pagina) {
                $next_link = '<a  class = "btn" href='.$_SERVER['REDIRECT_URL'].'?pagina='.$next.'>Proxima</a>';
        } else {
            // senão não há link para a próxima página
            $next_link = '<a class = "btn disabled" href="#">Proxima</a>';
        }

        // vamos arredondar para o alto o número de páginas  que serão necessárias para exibir todos os
        // registros. Por exemplo, se  temos 20 registros e mostramos 6 por página, nossa variável
        // $total_paginas será igual a 20/6, que resultará em 3.33. Para exibir os  2 registros
        // restantes dos 18 mostrados nas primeiras 3 páginas (0.33),  será necessária a quarta página.
        // Logo, sempre devemos arredondar uma  fração de número real para um inteiro de cima e isto é
        // feito com a  função ceil()/
        $total_paginas = ceil($total_paginas);

        $painel = '';

        for ($x=1; $x<= $total_paginas; $x++) {
            if ($x==$pagina) {
                // se estivermos na página corrente, não exibir o link para visualização desta página
                $painel .= '<a class = "btn disabled" > '.$x.'</a> ';
            } else {
                $painel .= ' <a  class = "btn" href=';
                $painel .= $_SERVER['REDIRECT_URL'];
                $painel .= '?pagina='.$x.'>'.$x.'</a>';
            }
        }
        // exibir painel na tela
        echo ''.$prev_link.' | '.$painel.' | '.$next_link.'';
    }

    public function excluir()
    {
        $pdo = self::pegarConexao();

        $sql = 'DELETE FROM Discipulo WHERE id = ?';

        $stm = $pdo->prepare($sql);

        $stm->bindParam(1, $this->id);

        $stm->execute();
        //var_dump($stm->errorInfo());exit();

    }

    /*Lista apenas um Disicpulo
    */

    public function listarUm()
    {
        $pdo =self::pegarConexao();

        $sql = 'SELECT * FROM Discipulo WHERE id = ?';

        $stm = $pdo->prepare($sql);

        $stm->bindParam(1, $this->id);

        $stm->execute();

        return $stm->fetchObject('\Discipulo\Modelo\Discipulo');

    }

    public function entrar()
    {
        try {
            //conectar ao banco de dados
            $pdo = self::pegarConexao();
            //montar o comando
            $sql = "SELECT * FROM Discipulo  WHERE email =? AND senha =? AND ativo = ?";
            //preparar o comando
            $stm = $pdo->prepare($sql);
            $ativo = 1;

            //trocar valores
            $stm->bindParam(1, $this->email);
            $stm->bindParam(2, md5($this->senha));
            $stm->bindParam(3, $ativo);

            //executar o comando
            $resposta =$stm->execute();
            $erros = $stm->errorInfo();

            if (!empty($erros[2])) {
                throw new \Exception($erros[2]);

            }

            //fechar conexao
            $pdo=null;

            if ($resposta) {
                return  $stm -> fetch();

            }

            return false;
        } catch (\Exception $e) {
            $this->erros['banco'] = $e->getMessage();

        }

    }

    /* destroi a sessÃ£o do usuario
     *
     * */
    public function sair()
    {
        session_start();
        session_destroy();

    }

    /* devolve uma lista de discipulos com nome especificado.
     *
     * */

    public function chamar($nome)
    {
        $nome = "%$nome%"; // os '%%' funcionam como curingas na expressÃ£o revelando mais resultados.
        //$nome = utf8_decode($nome);
        //var_dump($nome);exit();

        $pdo = self::pegarConexao();

        $sql = 'SELECT * FROM Discipulo WHERE nome  LIKE  ?	 ORDER BY nome ';

        $stm = $pdo->prepare($sql);

        $stm->bindParam(1, $nome);

        $stm->execute();

        $resposta = array();

        while ($ob = $stm->fetchObject('\Discipulo\Modelo\Discipulo')) {
            $resposta[$ob->id] = $ob;

        }

        return $resposta;

    }

    public function chamarPorId($id)
    {
         // os '%%' funcionam como curingas na expressÃ£o revelando mais resultados.

        $options = array(
            \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
        );
        $pdo = new \PDO(DSN, USER, PASSWD, $options);
        //var_dump($pdo);exit;

        $sql = 'SELECT * FROM Discipulo WHERE nome  LIKE  ?	  ';

        $stm = $pdo->prepare($sql);

        $stm->bindParam(1, $id);

        $stm->execute();

        $resposta = array();

        while ($ob = $stm->fetchObject('\Discipulo\Modelo\Discipulo')) {
            $resposta[$ob->id] = $ob;

        }

        return $resposta;

    }

    public function fichaPorStatus($idStatus)
    {
        $options = array(
            \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
        );

        $pdo = new \PDO(DSN, USER, PASSWD, $options);

        $sql = "
                SELECT *
                FROM Discipulo AS d, StatusCelular st
                WHERE d.id = st.discipuloId
                AND st.tipoStatusCelular = ? and st.ativo = 1 order by d.nome";

              $stm = $pdo->prepare($sql);

              $stm->bindParam(1, $idStatus);

              $stm->execute();

        $resposta = array();

        while ($ob = $stm->fetchObject('\Discipulo\Modelo\Discipulo')) {
            $resposta[$ob->id] = $ob;

        }

        return $resposta;

    }

    public function listarDiscipulos()
    {
        $pdo = self::pegarConexao();

        $sql = 'SELECT * FROM Discipulo WHERE lider = ?  and ativo = 1 ORDER BY nome';

        $stm = $pdo->prepare($sql);

        $stm->bindParam(1, $this->id);

        $stm->execute();

        $resposta = array();

        while ($ob = $stm->fetchObject('\Discipulo\Modelo\Discipulo')) {
            $resposta[$ob->id] = $ob;

        }

        return $resposta;
    }

    public function listarDiscipulosArquivo()
    {
        $pdo = self::pegarConexao();

        $sql = 'SELECT * FROM Discipulo WHERE ativo = 0 AND arquivo = 1  AND lider = ? order by nome';

        $stm = $pdo->prepare($sql);
        $stm->bindParam(1, $this->lider);

        $stm->execute();

        $resposta = array();

        while ($ob = $stm->fetchObject('\Discipulo\Modelo\Discipulo')) {
            $resposta[$ob->id] = $ob;
        }

        return $resposta;
    }

    public function listarAtivos()
    {
        $pdo = self::pegarConexao();

        $sql = 'SELECT * FROM Discipulo WHERE ativo = 1 AND arquivo = 0  order by nome';

        $stm = $pdo->prepare($sql);
        $stm->bindParam(1, $this->lider);

        $stm->execute();

        $resposta = array();

        while ($ob = $stm->fetchObject('\Discipulo\Modelo\Discipulo')) {
            $resposta[$ob->id] = $ob;
        }

        return $resposta;
    }

    public function jsonSerialize() {
        return [
            'id' => $this->id,
            'nome' => $this->nome,
        ];
    }

    public function listarTodosLista($limit = 100, $page = null, $filter)
    {
        $limit = (int)$limit;

        $init = $page == 1 ? 0 : $limit*($page-1);

        $pdo = self::pegarConexao();

        $sql = ' SELECT * FROM Discipulo ';

        if ($filter){
            $sql.= ' where nome like :nome ';
        }

        $sql .= ' order by nome limit :init,:limit';

        $stm = $pdo->prepare($sql);
        $stm->bindParam(':init', $init, \PDO::PARAM_INT);
        $stm->bindParam(':limit', $limit, \PDO::PARAM_INT);

        if ($filter){
            $nome = '%'.$filter['nome'].'%';
            $stm->bindParam(':nome', $nome, \PDO::PARAM_STR);
        }

        $stm->execute();

        $resposta = array();

        while ($ob = $stm->fetchObject('\Discipulo\Modelo\Discipulo')) {
            $resposta[] = $ob;
        }
        return $resposta;
    }

    public function totalParam($filter)
    {
        $pdo = self::pegarConexao();

        $sql = ' SELECT count(*) total FROM Discipulo ';

        if ($filter){
            $sql.= ' where nome like :nome ';
        }

        $stm = $pdo->prepare($sql);

        if ($filter){
            $nome = '%'.$filter['nome'].'%';
            $stm->bindParam(':nome', $nome, \PDO::PARAM_STR);
        }

        $stm->execute();

        $resposta = array();

        $resposta = $stm->fetch() ;

        return $resposta['total'];
    }

    public function lideres()
    {
        $pdo = self::pegarConexao();

        $sql =
            '
                SELECT l.id as id, d.nome AS Discipulo, l.nome AS Lider
                FROM Discipulo AS d
                INNER JOIN Discipulo AS l ON l.id = d.lider
                WHERE d.ativo =1
                AND d.arquivo =0
                ORDER BY l.nome
            '
        ;

        $stm = $pdo->prepare($sql);

        $stm->execute();

        $resposta = array();

        while ($ob = $stm->fetchObject('\Discipulo\Modelo\Discipulo')) {
            $resposta[$ob->id] = $ob;
        }

        return $resposta;
    }

    public function listarFiltro($filtro = null)
    {
        $pdo = self::pegarConexao();

        $sql = 'SELECT * FROM Discipulo WHERE ativo = 1 AND arquivo = 0  ';

        if (!empty($filtro['celula'])) {
            $sql .= ' AND celula = :celula ';
        }

        $sql .= ' order by nome';

        $stm = $pdo->prepare($sql);

        if (!empty($filtro['celula'])) {
            $stm->bindParam(':celula', $filtro['celula']);
        }

        $stm->execute();

        $resposta = array();

        while ($ob = $stm->fetchObject('\Discipulo\Modelo\Discipulo')) {
            $resposta[$ob->id] = $ob;
        }

        return $resposta;
    }

}
