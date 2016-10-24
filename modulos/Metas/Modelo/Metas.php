<?php
namespace Metas\Modelo ;
use \Framework\Modelo\ModeloFramework ;
use \Metas\Modelo\ParticipantesMetas 	as participantesMetasModelo;

class Metas extends ModeloFramework
{
  private $id ;
  private $quantidade ;
  private $discipuloId ;
  private $intervaloMetasId ;
  private $tipoRedeId ;

  public function __get($prop)
  {
         return $this->$prop ;
  }

    public function __set($prop, $valor)
    {
        $this->$prop = $valor ;
    }

  public function participantesTotal()
  {
    $participante = new participantesMetasModelo() ;
    $participante->metasId = $this->id ;
    $participante = $participante->listar() ;

    return count($participante) ;

  }

    public function metaPorRede()
    {
        $pdo = self::pegarConexao() ;

        $sql ='
            SELECT sum(m.quantidade) FROM Metas as m inner join TipoRede as tr on tr.id = m.tipoRedeId WHERE tr.id = ?
            group by tr.id
            ';

        $stm = $pdo->prepare($sql);
        $id = $this->id ;

        $stm->bindParam(1, $id);

        $stm->execute();
        $resposta = $stm->fetch();

        $pdo = null ;

        return $resposta;
    }

  public function salvar()
  {
              self::insert($this) ;
    }

              public function atualizar()
              {
              //abrir conexao com o banco
              $pdo = new \PDO(DSN, USER, PASSWD);
              //cria sql
              $sql = "UPDATE MinisterioTemDiscipulo SET 	 ministerioId= ?  , funcaoId = ?
                  WHERE discipuloId = ?
                              ";

              //prepara sql
              $stm = $pdo->prepare($sql);
              //trocar valores
              $stm->bindParam(1, $this->ministerioId );
              $stm->bindParam(2, $this->funcaoId );
              $stm->bindParam(3, $this->discipuloId );

              $resposta = $stm->execute();

              $erro = $stm->errorInfo();
              //var_dump($erro);
              //exit();

              //fechar conexÃ£o
              $pdo = null ;

              return $resposta;

              }

    public static function listarPorTodos()
    {
        $pdo = self::pegarConexao() ;

        $sql = 'SELECT d.id AS id, d.nome AS nome, m.quantidade AS quantidade, m.id AS metaId, tr.nome AS redeNome
FROM Discipulo AS d
INNER JOIN Metas AS m ON d.id = m.discipuloId
JOIN TipoRede AS tr ON tr.id = m.tipoRedeId
WHERE 1' ;

        $stm = $pdo->prepare($sql);

        $resposta = $stm->execute();

        $pdo = null ;
        $resposta = array();

        while ( $obj = $stm->fetchObject ('\Discipulo\Modelo\Discipulo')  ) {
              $resposta[$obj->id] = $obj ;
        }

        return $resposta ;
    }

              public function listarUm()
              {
              $pdo = self::pegarConexao() ;

              $sql = 'SELECT *
                                FROM Metas
                                WHERE discipuloId = ?
                          ' ;

              $stm = $pdo->prepare($sql);
              $stm->bindParam(1, $this->discipuloId ) ;

              $stm->execute();

              $pdo = null ;
                //var_dump($stm->errorInfo());
              return $stm->fetchObject() ;
                }

              public function listar()
              {
              $pdo = self::pegarConexao() ;

              $sql = '
                  SELECT  m.id , im.nome, m.intervaloMetasId, im.id as intervaloId, im.dataInicio, im.dataFim, m.quantidade
FROM Metas as m
inner join IntervaloMetas as im on im.id = m.intervaloMetasId
WHERE discipuloId = ?
                          ' ;

              $stm = $pdo->prepare($sql);
              $stm->bindParam(1, $this->discipuloId ) ;

              $stm->execute();

              $pdo = null ;
                //var_dump($stm->errorInfo());
              $resposta = array();

            while ( $obj = $stm->fetchObject ('\metas\modelo\metas')  ) {
                    $resposta[$obj->id] = $obj ;
                }

              return $resposta ;
                }

              public function excluir()
              {
                 return self::delete($this) ;

              }

              public function listarStatusCelularTodos()
              {
              //abrir conexao com o banco
              $pdo = new \PDO(DSN, USER, PASSWD);
              //cria sql
              $sql = "SELECT Discipulo.nome AS discipulo , TipoStatusCelular.nome AS status FROM Discipulo,StatusCelular, TipoStatusCelular
                         WHERE Discipulo.id = StatusCelular.discipuloId And StatusCelular.tipoOferta = TipoStatusCelular.id ORDER BY discipulo";

              //prepara sql
              $stm = $pdo->prepare($sql);
              //trocar valores

              $resposta = $stm->execute();

              //fechar conexÃ£o
              $pdo = null ;

              return $stm->fetchAll();
    }

              public function listarStatusCelularPorTipo()
              {
              //abrir conexao com o banco
              $pdo = new \PDO(DSN, USER, PASSWD);
              //cria sql
              $sql = "SELECT Discipulo.nome AS discipulo , TipoStatusCelular.nome AS status
 FROM Discipulo,StatusCelular, TipoStatusCelular  WHERE
Discipulo.id = StatusCelular.discipuloId AND TipoStatusCelular.id = ?  AND TipoStatusCelular.id = StatusCelular.tipoOferta" ;

              //prepara sql
              $stm = $pdo->prepare($sql);
              //trocar valores
              //
              $stm->bindParam(1, $this->tipoOferta);

              $resposta = $stm->execute();

              //fechar conexÃ£o
              $pdo = null ;

              return $stm->fetchAll();
    }

}
