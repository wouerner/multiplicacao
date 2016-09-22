<?php
namespace batismo\modelo;

use \framework\modelo\modeloFramework ;
use \metas\modelo\participantesMetas 	as participantesMetasModelo;

class batismos extends modeloFramework
{
  private $id ;
  private $discipuloId ;
  private $criadoEm ;
  private $diploma ;

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

        //prepara sql
        $stm = $pdo->prepare($sql);
        //var_dump($this);
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

    public function excluir()
    {
        $pdo = self::pegarConexao() ;

        $sql ='
              DELETE FROM Batismos WHERE discipuloId = ?
              ';

        $stm = $pdo->prepare($sql);
        $id = $this->id ;

        $stm->bindParam(1, $this->discipuloId);

        $stm->execute();
        $resposta = $stm->fetch();

        $pdo = null ;

        return $resposta;
    }

    public function atualizarDiploma()
    {
        //abrir conexao com o banco
        $pdo = new \PDO(DSN, USER, PASSWD);
        //cria sql
        $sql = "UPDATE Batismos SET diploma	= ?
                  WHERE discipuloId = ?
              ";

        //prepara sql
        $stm = $pdo->prepare($sql);
        //trocar valores
        $stm->bindParam(1, $this->diploma );
        $stm->bindParam(2, $this->discipuloId );

        $resposta = $stm->execute();

        $erro = $stm->errorInfo();

        $pdo = null ;

        return $resposta;
    }


    public function listarUm()
    {
        $pdo = self::pegarConexao() ;

        $sql = 'SELECT *
                FROM Batismos
                WHERE discipuloId = ?
                LIMIT 1
        ';

        $stm = $pdo->prepare($sql);
        $stm->bindParam(1, $this->discipuloId ) ;

        $stm->execute();

        $pdo = null ;
        return $stm->fetchObject('batismo\modelo\batismos') ;
    }

    public function listar()
    {
        $pdo = self::pegarConexao() ;
        $sql = '
            SELECT *
            FROM Batismos 
        ';

        $stm = $pdo->prepare($sql);

        $stm->execute();

        $pdo = null ;
        $resposta = array();

        while ( $obj = $stm->fetchObject ('discipulo\Modelo\Discipulo')  ) {
            $obj->id = $obj->discipuloId ;
            $resposta[$obj->id] = $obj->listarUm();
        }

        return $resposta ;
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
