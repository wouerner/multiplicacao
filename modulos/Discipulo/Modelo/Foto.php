<?php
namespace discipulo\Modelo;
use \framework\modelo\modeloFramework;

class foto extends modeloFramework
{
    private $id ;
    private $url ;
    private $discipuloId ;

    public function __construct ()
    {
    }

    public function __get($prop)
    {
          return $this->$prop;
    }

    public function __set($prop , $valor)
    {
              $this->$prop = $valor;
    }

    public function getNomeAbreviado()
    {
              $nome = explode(' ',$this->nome	) ;
              $nome = $nome[0].' '.$nome[count($nome)-1];

              return $nome ;
    }

    public function getNome()
    {
              return  $this->nome ;
    }

    public function getAlcunha()
    {
              return  $this->alcunha ? $this->alcunha : $this->nome ;
    }

    public function setDataNascimento($valor)
    {
    try {

        $this->dataNascimento = \DateTime::createFromFormat('d/m/Y',$valor,new \DateTimeZone('America/Sao_Paulo'));

    } catch ( \Exception $e ) {
         echo 'Erro ao instanciar objeto.';
         echo $e->getMessage();
         exit();
        }

    }

    public function getDataNascimento()
    {
              try {
                  $this->dataNascimento = new \DateTime($this->dataNascimento, new \DateTimeZone('America/Sao_Paulo'));

                  return $this->dataNascimento;
              } catch ( \Exception $e ) {
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

        return $rede ;

    }

    public function getMinisterio()
    {
        $ministerio = new \ministerio\modelo\ministerioTemDiscipulo();
        $ministerio->discipuloId = $this->id;
        $ministerio =  $ministerio->pegarMinisterioDiscipulo();

        return $ministerio ;

    }

    public function eLider()
    {
      $pdo = self::pegarConexao() ;
      $sql = "select * from Discipulo AS d Where d.lider = ? AND d.ativo = 1 And d.arquivo = 0 limit 1";
      $stm = $pdo->prepare($sql);
        $stm->bindParam(1, $this->id);
         $stm->execute();
        $resposta = $stm->fetchAll();
        //var_dump($this->id);
        //var_dump($stm->errorInfo());
        //var_dump($resposta);exit;

        if ( count($resposta) > 0) {
            return true ;
        } else {
            return false ;
        }

    }

    public function eLiderCelula()
    {
      $pdo = self::pegarConexao() ;
      $sql = "select * from Celula AS c Where c.lider = ? limit 1";
      $stm = $pdo->prepare($sql);
        $stm->bindParam(1, $this->id);
         $stm->execute();
        $resposta = $stm->fetchAll();
        //var_dump($this->id);
        //var_dump($stm->errorInfo());
        //var_dump($resposta);exit;

        if ( count($resposta) > 0) {
            return true ;
        } else {
            return false ;
        }

    }

    public function salvar()
    {
      $pdo = self::pegarConexao() ;
      $sql = "INSERT INTO Foto (
                              url, discipuloId
                              )
                  VALUES (?,?)";
              //prepara sql
              $stm = $pdo->prepare($sql);
              //trocar valores
         $stm->bindParam(1, $this->url);
         $stm->bindParam(2, $this->discipuloId);

         $resposta = $stm->execute();

         $this->id = $pdo->lastInsertId();

         $erro =  $stm->errorInfo();

         $this->erro = $erro[0];

          //fechar conexão
         $pdo = null ;
         //var_dump($resposta);exit;
         return $resposta;
    }

    public function atualizar()
    {
        try {

              //abrir conexao com o banco
              $pdo = self::pegarConexao();
              //cria sql
              $sql = "UPDATE Foto SET url=?	  WHERE discipuloId = ?
                              ";

              //prepara sql
              $stm = $pdo->prepare($sql);
              //trocar valores
              $stm->bindParam(1, $this->url);
              $stm->bindParam(2, $this->discipuloId);

              $resposta = $stm->execute();
              $erro = $stm->errorCode();

              if ($erro != '0000') {

                    throw new \Exception ('Não foi possivel atualizar') ;
                }

            } catch ( \Exception $e ) {

                $this->erro= $e->getMessage();

            }
          //fechar conexÃ£o
          $pdo = null ;

          return $resposta;

    }

    /*Recebe o id para nÃ£o listar este cadastro.
     *
     * */
    public function listarTodos($id)
    {
        $pdo = self::pegarConexao();

        $sql = 'SELECT * FROM Discipulo WHERE id != ? ORDER BY nome';

        $stm = $pdo->prepare($sql);
        $stm->bindParam(1,$id);
        $stm->execute();

        $resposta = array();
        while ($obj = $stm->fetchObject ( get_class() ) ) {
            $resposta[$obj->id] = $obj ;
        }

        return $resposta ;

    }

    /*Pesquisa os nome dos discipulos.
     *Retorna apenas os nomes.
     *
     * */
    public function pesquisaJson($nome)
    {
        $nome = "%$nome%" ; // os '%%' funcionam como curingas na expressÃ£o revelando mais resultados.

        $pdo = self::pegarConexao();

        $sql = 'SELECT nome AS value FROM Discipulo WHERE nome LIKE ?';

        $stm = $pdo->prepare($sql);

        $stm->bindParam(1, $nome);

        $stm->execute();

        $resposta = $stm->fetchAll();

        return $resposta ;

    }

    public function listarTodosDiscipulos()
    {
        $pdo = self::pegarConexao();

        $sql = 'SELECT * FROM Discipulo order by nome';

        $stm = $pdo->prepare($sql);

        $stm->execute();

        return $stm->fetchAll();

    }

    public function inativos()
    {
        $pdo = self::pegarConexao();

        $sql = 'SELECT * FROM Discipulo WHERE ativo = 0 AND arquivo = 0 order by nome';

        $stm = $pdo->prepare($sql);

        $stm->execute();

        $resposta = array();

        while ($ob = $stm->fetchObject('\Discipulo\Modelo\Discipulo')) {
            $resposta[$ob->id] = $ob ;
        }

        return $resposta ;
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
            $resposta[$ob->id] = $ob ;
        }

        return $resposta ;
    }

    public function arquivados()
    {
        $pdo = self::pegarConexao();

        $sql = 'SELECT * FROM Discipulo WHERE arquivo = 1 order by nome';

        $stm = $pdo->prepare($sql);

        $stm->execute();

        $resposta = array();

        while ($ob = $stm->fetchObject('\Discipulo\Modelo\Discipulo')) {
            $resposta[$ob->id] = $ob ;
        }

        return $resposta ;
    }

    public static function totalAtivos()
    {
        $pdo = self::pegarConexao();

        $sql = 'SELECT count(*) AS total FROM Discipulo WHERE ativo = 1 ';

        $stm = $pdo->prepare($sql);

        $stm->execute();

        return $stm->fetch() ;

    }

    public static function totalInativos()
    {
        $pdo = self::pegarConexao();

        $sql = 'SELECT count(*) AS total FROM Discipulo WHERE ativo = 0 ';

        $stm = $pdo->prepare($sql);

        $stm->execute();

        return $stm->fetch() ;

    }

    public static function totalAtivosLider($id)
    {
        $pdo = self::pegarConexao();

        $sql = 'SELECT count(*) AS total FROM Discipulo WHERE ativo = 1 and lider=? ';

        $stm = $pdo->prepare($sql);
        $stm->bindParam(1, $id);

        $stm->execute();

        return $stm->fetch() ;

    }

    public static function totalInativosLider($id)
    {
        $pdo = self::pegarConexao();

        $sql = 'SELECT count(*) AS total FROM Discipulo WHERE ativo = 0 and lider=? ';

        $stm = $pdo->prepare($sql);
        $stm->bindParam(1, $id);

        $stm->execute();

        return $stm->fetch() ;

    }

    public function ativar()
    {
        $pdo = self::pegarConexao();

        $sql = 'UPDATE Discipulo SET  ativo = 1 WHERE id = ?';

        $stm = $pdo->prepare($sql);
        $stm->bindParam(1, $this->id );

        return $stm->execute() ;
    }

    public function desativar()
    {
        $pdo = self::pegarConexao();

        $sql = 'UPDATE Discipulo SET  ativo = 0 WHERE id = ?';

        $stm = $pdo->prepare($sql);
        $stm->bindParam(1, $this->id );

        return $stm->execute() ;
    }

    public function arquivar()
    {
        $pdo = new \PDO (DSN,USER,PASSWD);

        $sql = 'UPDATE Discipulo SET  arquivo = 1 WHERE id = ?';

        $stm = $pdo->prepare($sql);
        $stm->bindParam(1, $this->id );

        return $stm->execute() ;
    }

    public function desarquivar()
    {
        $pdo = new \PDO (DSN,USER,PASSWD);

        $sql = 'UPDATE Discipulo SET  arquivo = 0 WHERE id = ?';

        $stm = $pdo->prepare($sql);
        $stm->bindParam(1, $this->id );

        return $stm->execute() ;
    }

    public static function rank()
    {
        $pdo = self::pegarConexao();

        $sql = 'SELECT   l.nome as lider, d.nome as nome , count(d.id) as total
                        FROM `Discipulo` as l  inner join Discipulo as d on d.lider = l.id and d.ativo = 1 WHERE 1
                        group by l.id
                        order by total DESC, l.nome ';

        $stm = $pdo->prepare($sql);

        $stm->execute() ;

        return $stm->fetchAll() ;
    }

    public static function rankInativos()
    {
        $pdo = self::pegarConexao();

        $sql = 'SELECT   l.nome as lider, d.nome as nome , count(d.id) as total
                        FROM `Discipulo` as l  inner join Discipulo as d on d.lider = l.id and d.ativo = 0 WHERE 1
                        group by l.id
                        order by total DESC, l.nome ';

        $stm = $pdo->prepare($sql);

        $stm->execute() ;

        return $stm->fetchAll() ;
    }

    /*Listar todos os lideres do sistema
     * mostra apenas os id e nomes.
     *
     * */

    public function listarLideres()
    {
        $pdo = self::pegarConexao();

        $sql = 'SELECT id , nome FROM Discipulo';

        $stm = $pdo->prepare($sql);
        $stm->bindParam(1,$id);

        $stm->execute();

        $resposta = array();

        while ($ob = $stm->fetchObject('\Discipulo\Modelo\Discipulo')) {
            $resposta[$ob->id] = $ob ;
        }

        return $resposta ;
    }

    public function liderCelula()
    {
        $pdo = self::pegarConexao();

        $sql = 'SELECT c.nome AS nomeCelula , c.id AS id
                    FROM Discipulo AS d, Celula AS c
                    WHERE d.id = ? AND d.id = c.lider' ;

        $stm = $pdo->prepare($sql);
        $stm->bindParam(1,$this->id);

        $stm->execute();

        return $stm->fetchAll();

    }

    public function discipulosPorLider()
    {
        $pdo = self::pegarConexao();

        $sql = 'SELECT l.id AS liderId, l.nome AS Lider, d.id AS discipuloId, d.nome AS nomeDiscipulo, d.lider AS discipuloLiderId
                FROM Discipulo AS d
                INNER JOIN Discipulo AS l ON d.lider = l.id
                ORDER BY l.nome';

        $stm = $pdo->prepare($sql);

        $stm->execute();

        $respostas = $stm->fetchAll();

//		var_dump($respostas);

        $aux = array();

        foreach ($respostas as $valor) {
                $i = $valor['liderId'] ;
                $j = $valor['discipuloId'] ;

                foreach ($valor as  $v) {

                      $aux[$i]['lider']	= $valor['Lider'] ;
                      $aux[$i]['liderId']	= $valor['liderId'] ;

                    $aux[$i]['discipulos'][$j] = array('nomeDiscipulo' => $valor['nomeDiscipulo'],
                                                                      'discipuloId' => $valor['discipuloId'] ,
                                                                    'discipulos' => array()  ) ;

                }
        }

        $teste = array_chunk($aux, 1,true);

        $teste = array_merge($teste[0],$teste[1]) ;

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

        (int) $primeiroRegistro = ( $pagina * $numPagina ) - $numPagina ;

        $pdo = new \PDO(DSN , USER , PASSWD) ;

        $sql = 'SELECT * FROM Discipulo AS d WHERE ISNULL(d.celula) LIMIT ? , ?' ;

        $stm = $pdo->prepare($sql);
        $stm->bindParam(1, $primeiroRegistro ,\PDO::PARAM_INT);
        $stm->bindParam(2, $numPagina , \PDO::PARAM_INT );

        $stm->execute();

        $resposta = array();

        while ($ob = $stm->fetchObject('\Discipulo\Modelo\Discipulo')) {
            $resposta[$ob->id] = $ob ;

        }

        return $resposta ;

    }

    /* listar todos menos os usuario logado atualmente, e com paginação
     *
     * */

    public function listarTodosPag($id, $numPagina , $pagina)
    {
        $numPagina = (int) $numPagina;

        (int) $primeiroRegistro = ( $pagina * $numPagina ) - $numPagina ;

        $pdo = self::pegarConexao();

        $sql = 'SELECT * FROM Discipulo WHERE id != ? ORDER BY nome LIMIT ? , ? ';

        $stm = $pdo->prepare($sql);

        $stm->bindParam( 1 , $id, \PDO::PARAM_INT ) ;
        $stm->bindParam( 2 , $primeiroRegistro, \PDO::PARAM_INT ) ;
        $stm->bindParam( 3 , $numPagina, \PDO::PARAM_INT ) ;

        $stm->execute();

        $stm->errorInfo();

        $resposta = array();

        while ($ob = $stm->fetchObject('\Discipulo\Modelo\Discipulo')) {
            $resposta[$ob->id] = $ob ;

        }

        return $resposta ;
    }

    public function excluir()
    {
        $pdo = self::pegarConexao();

        $sql = 'DELETE FROM Foto WHERE id = ?';

        $stm = $pdo->prepare($sql);

        $stm->bindParam(1, $this->id);

        $stm->execute();
        //var_dump($stm->errorInfo());exit();

    }

    /*Lista apenas um Disicpulo
    */

    public function listarUm()
    {
        $pdo =self::pegarConexao() ;

        $sql = 'SELECT * FROM Foto WHERE discipuloId = ?';

        $stm = $pdo->prepare($sql);

        $stm->bindParam(1, $this->discipuloId );

        $stm->execute();

        return $stm->fetchObject('\discipulo\Modelo\foto');

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
            $ativo = 1 ;

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
        $nome = "%$nome%" ; // os '%%' funcionam como curingas na expressÃ£o revelando mais resultados.
        //$nome = utf8_decode($nome);
        //var_dump($nome);exit();

        $pdo = self::pegarConexao();

        $sql = 'SELECT * FROM Discipulo WHERE nome  LIKE  ?	 ORDER BY nome ';

        $stm = $pdo->prepare($sql);

        $stm->bindParam(1, $nome);

        $stm->execute();

        $resposta = array();

        while ($ob = $stm->fetchObject('\Discipulo\Modelo\Discipulo')) {
            $resposta[$ob->id] = $ob ;

        }

        return $resposta ;

    }

    public function chamarPorId($id)
    {
         // os '%%' funcionam como curingas na expressÃ£o revelando mais resultados.

$options = array(
    \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
);
        $pdo = new \PDO (DSN,USER,PASSWD, $options);
        //var_dump($pdo);exit;

        $sql = 'SELECT * FROM Discipulo WHERE nome  LIKE  ?	  ';

        $stm = $pdo->prepare($sql);

        $stm->bindParam(1, $id);

        $stm->execute();

        $resposta = array();

        while ($ob = $stm->fetchObject('\Discipulo\Modelo\Discipulo')) {
            $resposta[$ob->id] = $ob ;

        }

        return $resposta ;

    }

    public function fichaPorStatus($idStatus)
    {
$options = array(
    \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
);

              $pdo = new \PDO ( DSN, USER, PASSWD, $options ) ;

        $sql = "


SELECT *
          FROM Discipulo AS d, StatusCelular st
          WHERE d.id = st.discipuloId
          AND st.tipoStatusCelular = ? and st.ativo = 1 order by d.nome" ;

/*$sql = '
                select s2.id AS idStatus, ultimo, nome , ,s3.id  from StatusCelular s2 inner join

                (select
                d.id AS id , d.nome AS nome ,
                (
                SELECT  id
                FROM StatusCelular AS s1
                WHERE s1.discipuloId = d.id
                ORDER BY dataInicio DESC
                limit 1
                )  AS ultimo
                from Discipulo AS d
                where  1
                group by d.id
                ) AS s3 on ultimo = s2.id

                WHERE s2.tipoStatusCelular = ?
                order by nome
';*/

              $stm = $pdo->prepare($sql);

              $stm->bindParam(1, $idStatus);

              $stm->execute();

        $resposta = array();

        while ($ob = $stm->fetchObject('\Discipulo\Modelo\Discipulo')) {
            $resposta[$ob->id] = $ob ;

        }

        return $resposta ;

    }

    public function listarDiscipulos()
    {
        $pdo = self::pegarConexao();

        $sql = 'SELECT * FROM Discipulo WHERE lider = ?  and ativo = 1 ORDER BY nome' ;

        $stm = $pdo->prepare($sql);

        $stm->bindParam(1,$this->id);

        $stm->execute();

        $resposta = array();

        while ($ob = $stm->fetchObject('\Discipulo\Modelo\Discipulo')) {
            $resposta[$ob->id] = $ob ;

        }

        return $resposta ;

    }

}
