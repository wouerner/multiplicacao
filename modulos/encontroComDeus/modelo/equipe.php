<?php
namespace encontroComDeus\modelo ;

use \framework\modelo\modeloFramework ;

class equipe extends modeloFramework
{
  private $id ;
  private $equipeId ;
  private $discipuloId ;
  private $encontroComDeusId ;
  private $tipoEquipeId ;
  private $ativo ;

  public function __get($prop)
  {
         return $this->$prop ;
  }

  public function __set($prop, $valor)
  {
         $this->$prop = $valor ;

  }
  public function salvarMuitos($ids)
  {
      $pdo = self::pegarConexao() ;
      $sql = "INSERT INTO  Equipe ( encontroComDeusId, tipoEquipeId, discipuloId )
                              VALUES (?,?,?)";

      $stm = $pdo->prepare($sql);

        foreach ($ids as $id) {

      $stm->bindParam(1, $this->encontroComDeusId) ;
      $stm->bindParam(2, $this->tipoEquipeId) ;
      $stm->bindParam(3, $id ) ;

      $stm->execute();

        }

        $this->id = $pdo->lastInsertId();
      $pdo = null ;

    }

  public function salvar()
  {
      $pdo = self::pegarConexao() ;
      $sql = "INSERT INTO  Equipe ( encontroComDeusId, tipoEquipeId )
                              VALUES (?,?)";

      $stm = $pdo->prepare($sql);

      $stm->bindParam(1, $this->encontroComDeusId) ;
      $stm->bindParam(2, $this->tipoEquipeId) ;

      $stm->execute();
        //var_dump($stm->errorInfo());exit();

      $pdo = null ;

    }

  public function eMembro()
  {
      $pdo = self::pegarConexao() ;
      $sql = 'select * from EquipeDiscipulos where equipeId = ?  and discipuloId = ?';

      $stm = $pdo->prepare($sql);

      $stm->bindParam(1, $this->equipeId) ;
      $stm->bindParam(2, $this->discipuloId) ;

      $stm->execute();

      return $stm->fetch() ? TRUE : FALSE ;
  }

  public function salvarMembro($id)
  {
      $pdo = self::pegarConexao() ;
      $sql = "INSERT INTO  EquipeDiscipulos ( equipeId, discipuloId )
                              VALUES (?,?)";

      $stm = $pdo->prepare($sql);

      $stm->bindParam(1, $this->id) ;
      $stm->bindParam(2, $id ) ;

      $stm->execute();
        //var_dump($stm->errorInfo());exit();

      $pdo = null ;

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

              public function listarEquipes()
              {
              $pdo = self::pegarConexao() ;

              $sql = 'SELECT e.id AS id, e.encontroComDeusId as encontroComDeusId , te.id as tipoId , te.nome AS nome, ecd.nome AS encontroNome
                                FROM
                                Equipe AS e
                                inner join TipoEquipe AS te on te.id = e.tipoEquipeId
                                inner join EncontroComDeus as ecd ON ecd.id = e.encontroComDeusId
                         ORDER BY nome ' ;

              $stm = $pdo->prepare($sql);
              $resposta = $stm->execute();

              $pdo = null ;
                $resposta = array();

                while ( $obj = $stm->fetchObject ('\encontroComDeus\modelo\equipe')  ) {
                    $resposta[$obj->id] = $obj ;
                }

              return $resposta ;
                }

    public function listarUm()
    {
        $pdo = self::pegarConexao() ;

        $sql = '
            SELECT te.id, te.nome, ecd.nome as nomeEncontro, ecd.id as encontroId
                        FROM
                        Equipe AS e
                        inner join TipoEquipe AS te on te.id = e.tipoEquipeId
                        inner join EncontroComDeus as ecd ON ecd.id = e.encontroComDeusId
                        WHERE e.id = ?
                        ORDER BY te.nome 
                        ' ;

        $stm = $pdo->prepare($sql);
        $stm->bindParam(1, $this->id);
        $resposta = $stm->execute();

        $pdo = null ;
        $resposta = $stm->fetchObject ('\encontroComDeus\modelo\equipe');

        //while ( $obj = $stm->fetchObject ('\encontroComDeus\modelo\equipe')  ) {
            //$resposta[$obj->id] = $obj ;
        //}

        //var_dump($stm->errorInfo());
        return $resposta ;
    }

              public function listarTodasEquipes()
              {
              $pdo = self::pegarConexao() ;

                $sql = '
SELECT d.id , d.nome as dNome , te.id as eId, te.nome as eNome FROM Discipulo as d
inner join EquipeDiscipulos as ed
on d.id = ed.discipuloId
inner join `Equipe` as e
on ed.equipeId = e.id
inner join TipoEquipe as te on te.id = e.tipoEquipeId
WHERE e.encontroComDeusId = ?
                                ' ;

              $stm = $pdo->prepare($sql);
              $stm->bindParam(1, $this->encontroComDeusId);
              $resposta = $stm->execute();

              $pdo = null ;
                $resposta = $stm->fetchAll();

                //var_dump($stm->errorInfo());
              return $resposta ;
                }

              public function listarEquipeEncontro()
              {
              $pdo = self::pegarConexao() ;

              $sql = 'SELECT e.id AS id, e.encontroComDeusId as encontroComDeusId , te.id as tipoId , te.nome AS nome
                                FROM
                                Equipe AS e
                                inner join TipoEquipe AS te on te.id = e.tipoEquipeId
                                WHERE e.encontroComDeusId =  ?
                         ORDER BY nome ' ;

              $stm = $pdo->prepare($sql);
                $stm->bindParam(1, $this->encontroComDeusId );
              $resposta = $stm->execute();

              $pdo = null ;
                $resposta = array();

                while ( $obj = $stm->fetchObject ('\encontroComDeus\modelo\equipe')  ) {
                    $resposta[$obj->id] = $obj ;
                }

                //var_dump($stm->errorInfo());
              return $resposta ;
                }

              public function membros()
              {
              $pdo = self::pegarConexao() ;

              $sql = 'SELECT *
                                FROM
                                Discipulo AS d inner join EquipeDiscipulos AS ed ON d.id = ed.discipuloId
                                WHERE ed.equipeId =  ?
                         ORDER BY nome ' ;

              $stm = $pdo->prepare($sql);
                $stm->bindParam(1, $this->id );
              $resposta = $stm->execute();

              $pdo = null ;
                $resposta = array();

                while ( $obj = $stm->fetchObject ('\discipulo\Modelo\Discipulo')  ) {
                    $resposta[$obj->id] = $obj ;
                }

              return $resposta ;
                }

              public function excluir()
              {
              //abrir conexao com o banco
              $pdo = new \PDO(DSN, USER, PASSWD);
              //cria sql
              $sql = "DELETE FROM EquipeDiscipulos WHERE discipuloId = ?
                  AND equipeId = ?
                              ";

              //prepara sql
              $stm = $pdo->prepare($sql);
              //trocar valores
              $stm->bindParam(1, $this->discipuloId );
              $stm->bindParam(2, $this->equipeId );

              $resposta = $stm->execute();

              $erro = $stm->errorInfo();

              //fechar conexÃ£o
              $pdo = null ;

              return $resposta;

              }

              public function excluirEquipe()
              {
              //abrir conexao com o banco
              $pdo = new \PDO(DSN, USER, PASSWD);
              //cria sql
              $sql = "DELETE FROM Equipe WHERE id = ?
                              ";

              //prepara sql
              $stm = $pdo->prepare($sql);
              //trocar valores
              $stm->bindParam(1, $this->equipeId );

              $resposta = $stm->execute();

              $erro = $stm->errorInfo();

              //fechar conexÃ£o
              $pdo = null ;

                return $resposta;
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
