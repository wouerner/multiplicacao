<?php

namespace encontroComDeus\modelo ;
use \framework\modelo\modeloFramework ;
class participantesEncontro extends modeloFramework
{
  private $id ;
  private $discipuloId ;
  private $encontroComDeusId ;
  private $encontro ;
  private $preEncontro ;
  private $posEncontro ;
  private $desistiu ;

  public function __get($prop)
  {
         return $this->$prop ;
  }

  public function __set($prop, $valor)
  {
         $this->$prop = $valor ;

  }
  public function salvar()
  {
         $pdo = self::pegarConexao() ;
         $sql = "INSERT INTO ParticipantesEncontro ( discipuloId, encontroComDeusId )
                              VALUES (?,?)";

         $stm = $pdo->prepare($sql);

         $stm->bindParam(1, $this->discipuloId);
         $stm->bindParam(2, $this->encontroComDeusId );

         $resposta = $stm->execute();

         $pdo = null ;

         return $resposta;
    }

  public function salvarMuitos($ids)
  {
      $pdo = self::pegarConexao() ;
        $sql = "INSERT INTO
                            ParticipantesEncontro ( discipuloId, encontroComDeusId )
                          VALUES (?,?)";

      $stm = $pdo->prepare($sql);

        foreach ($ids as $id) {

          $stm->bindParam(1, $id);
          $stm->bindParam(2, $this->encontroComDeusId );

          $stm->execute();
        }
          $pdo = null ;

          return $resposta;
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

      public function eParticipante()
      {
          $pdo = self::pegarConexao() ;

          $sql = 'SELECT *
                    FROM ParticipantesEncontro AS p
                    WHERE p.encontroComDeusId = ?
                    AND p.discipuloId = ?
                    LIMIT 1';

          $stm = $pdo->prepare($sql);
          $stm->bindParam(1, $this->encontroComDeusId ) ;
          $stm->bindParam(2, $this->discipuloId ) ;

          $stm->execute();
          //var_dump($this);
          //var_dump($stm->fetch());die;

          return $stm->fetch() ? TRUE : FALSE;
      }

              public function listarTodos()
              {
              $pdo = self::pegarConexao() ;

                  $sql = 'SELECT d.*, pe.preEncontro, pe.encontro, pe.posEncontro, pe.igrejaLocal, pe.desistiu
                         FROM Discipulo AS d inner join ParticipantesEncontro AS pe ON pe.discipuloId = d.id
                         WHERE pe.encontroComDeusId = ?
                         ORDER BY d.nome ' ;

              $stm = $pdo->prepare($sql);
              $stm->bindParam(1, $this->encontroComDeusId ) ;

              $stm->execute();

                $resposta = array();

                while ( $obj = $stm->fetchObject ('discipulo\Modelo\Discipulo')  ) {
                    $resposta[$obj->id] = $obj ;
                }

              $pdo = null ;
              return $resposta ;
                }

    public function preEncontroAtivar()
    {
     $pdo = self::pegarConexao() ;

     $sql = 'UPDATE ParticipantesEncontro SET preEncontro = 1 WHERE id = ? ' ;

     $stm = $pdo->prepare($sql);
     $stm->bindParam(1, $this->id ) ;

     $stm->execute();

    }

    public function preEncontroDesativar()
    {
     $pdo = self::pegarConexao() ;

     $sql = 'UPDATE ParticipantesEncontro SET preEncontro = 0 WHERE id = ? ' ;

     $stm = $pdo->prepare($sql);
     $stm->bindParam(1, $this->id ) ;

     $stm->execute();

    }

    public function encontroAtivar()
    {
     $pdo = self::pegarConexao() ;

     $sql = 'UPDATE ParticipantesEncontro SET encontro = 1 WHERE id = ? ' ;

     $stm = $pdo->prepare($sql);
     $stm->bindParam(1, $this->id ) ;

     $stm->execute();

    }

    public function encontroDesativar()
    {
     $pdo = self::pegarConexao() ;

     $sql = 'UPDATE ParticipantesEncontro SET encontro = 0 WHERE id = ? ' ;

     $stm = $pdo->prepare($sql);
     $stm->bindParam(1, $this->id ) ;

     $stm->execute();

    }

    public function posEncontroAtivar()
    {
     $pdo = self::pegarConexao() ;

     $sql = 'UPDATE ParticipantesEncontro SET posEncontro = 1 WHERE id = ? ' ;

     $stm = $pdo->prepare($sql);
     $stm->bindParam(1, $this->id ) ;

     $stm->execute();

    }

    public function posEncontroDesativar()
    {
     $pdo = self::pegarConexao() ;

     $sql = 'UPDATE ParticipantesEncontro SET posEncontro = 0 WHERE id = ? ' ;

     $stm = $pdo->prepare($sql);
     $stm->bindParam(1, $this->id ) ;

     $stm->execute();

    }

    public function desistiuAtivar()
    {
     $pdo = self::pegarConexao() ;

     $sql = 'UPDATE ParticipantesEncontro SET desistiu = 1 WHERE id = ? ' ;

     $stm = $pdo->prepare($sql);
     $stm->bindParam(1, $this->id ) ;

     $stm->execute();

    }

    public function desistiuDesativar()
    {
     $pdo = self::pegarConexao() ;

     $sql = 'UPDATE ParticipantesEncontro SET desistiu = 0 WHERE id = ? ' ;

     $stm = $pdo->prepare($sql);
     $stm->bindParam(1, $this->id ) ;

     $stm->execute();

    }

    public function igrejaAtivar()
    {
     $pdo = self::pegarConexao() ;

     $sql = 'UPDATE ParticipantesEncontro SET igrejaLocal = 1 WHERE id = ? ' ;

     $stm = $pdo->prepare($sql);
     $stm->bindParam(1, $this->id ) ;

     $stm->execute();

    }

    public function igrejaDesativar()
    {
     $pdo = self::pegarConexao() ;

     $sql = 'UPDATE ParticipantesEncontro SET igrejaLocal = 0 WHERE id = ? ' ;

     $stm = $pdo->prepare($sql);
     $stm->bindParam(1, $this->id ) ;

     $stm->execute();

    }

    public function preEncontroAtivos()
    {
     $pdo = self::pegarConexao() ;

     $sql = 'SELECT *
                 FROM Discipulo AS d inner join ParticipantesEncontro AS pe ON pe.discipuloId = d.id AND pe.preEncontro = 1 AND pe.desistiu = 0
                 WHERE pe.encontroComDeusId = ?
                 ORDER BY d.nome ' ;

     $stm = $pdo->prepare($sql);
     $stm->bindParam(1, $this->encontroComDeusId ) ;

     $stm->execute();
     $resposta = array();

        while ( $obj = $stm->fetchObject ('discipulo\Modelo\Discipulo')  ) {
            $resposta[$obj->id] = $obj ;
        }

      $pdo = null ;

      return $resposta ;

    }
    public function encontroAtivos()
    {
     $pdo = self::pegarConexao() ;

     $sql = 'SELECT *
                 FROM Discipulo AS d inner join ParticipantesEncontro AS pe ON pe.discipuloId = d.id AND pe.encontro = 1 AND pe.desistiu = 0
                 WHERE pe.encontroComDeusId = ?
                 ORDER BY d.nome ' ;

     $stm = $pdo->prepare($sql);
     $stm->bindParam(1, $this->encontroComDeusId ) ;

     $stm->execute();
     $resposta = array();

        while ( $obj = $stm->fetchObject ('discipulo\Modelo\Discipulo')  ) {
            $resposta[$obj->id] = $obj ;
        }

      $pdo = null ;

      return $resposta ;

    }

    public function posEncontroAtivos()
    {
     $pdo = self::pegarConexao() ;

     $sql = 'SELECT *
                 FROM Discipulo AS d inner join ParticipantesEncontro AS pe ON pe.discipuloId = d.id AND pe.posEncontro = 1  AND pe.desistiu = 0
                 WHERE pe.encontroComDeusId = ?
                 ORDER BY d.nome ' ;

     $stm = $pdo->prepare($sql);
     $stm->bindParam(1, $this->encontroComDeusId ) ;

     $stm->execute();
     $resposta = array();

        while ( $obj = $stm->fetchObject ('discipulo\Modelo\Discipulo')  ) {
            $resposta[$obj->id] = $obj ;
        }

      $pdo = null ;

      return $resposta ;

    }

    public function preEncontroInativos()
    {
     $pdo = self::pegarConexao() ;

     $sql = 'SELECT *
                 FROM Discipulo AS d inner join ParticipantesEncontro AS pe ON pe.discipuloId = d.id AND pe.preEncontro = 0 AND pe.desistiu = 0
                 WHERE pe.encontroComDeusId = ?
                 ORDER BY d.nome ' ;

     $stm = $pdo->prepare($sql);
     $stm->bindParam(1, $this->encontroComDeusId ) ;

     $stm->execute();
     $resposta = array();

        while ( $obj = $stm->fetchObject ('discipulo\Modelo\Discipulo')  ) {
            $resposta[$obj->id] = $obj ;
        }

      $pdo = null ;

      return $resposta ;

    }

    public function encontroInativos()
    {
     $pdo = self::pegarConexao() ;

     $sql = 'SELECT *
                 FROM Discipulo AS d inner join ParticipantesEncontro AS pe ON pe.discipuloId = d.id AND pe.encontro = 0 AND pe.desistiu = 0
                 WHERE pe.encontroComDeusId = ?
                 ORDER BY d.nome ' ;

     $stm = $pdo->prepare($sql);
     $stm->bindParam(1, $this->encontroComDeusId ) ;

     $stm->execute();
     $resposta = array();

        while ( $obj = $stm->fetchObject ('discipulo\Modelo\Discipulo')  ) {
            $resposta[$obj->id] = $obj ;
        }

      $pdo = null ;

      return $resposta ;

    }

    public function posEncontroInativos()
    {
     $pdo = self::pegarConexao() ;

     $sql = 'SELECT *
                 FROM Discipulo AS d inner join ParticipantesEncontro AS pe ON pe.discipuloId = d.id AND pe.posEncontro = 0 AND pe.desistiu = 0
                 WHERE pe.encontroComDeusId = ?
                 ORDER BY d.nome ' ;

     $stm = $pdo->prepare($sql);
     $stm->bindParam(1, $this->encontroComDeusId ) ;

     $stm->execute();
     $resposta = array();

        while ( $obj = $stm->fetchObject ('discipulo\Modelo\Discipulo')  ) {
            $resposta[$obj->id] = $obj ;
        }

      $pdo = null ;

      return $resposta ;

    }

    public function cracha()
    {
     $pdo = self::pegarConexao() ;

     $sql = 'SELECT *
                    FROM Discipulo AS d
                    INNER JOIN ParticipantesEncontro AS pe ON d.id = pe.discipuloId
                    WHERE pe.encontroComDeusId = ? ' ;

     $stm = $pdo->prepare($sql);
     $stm->bindParam(1, $this->encontroComDeusId ) ;

     $stm->execute();
     $resposta = array();

        while ( $obj = $stm->fetchObject ('discipulo\Modelo\Discipulo')  ) {
            $resposta[$obj->id] = $obj ;
        }

      $pdo = null ;

      return $resposta ;

    }

  public function excluir()
  {
     $pdo = self::pegarConexao() ;
              //cria sql
     $sql = "DELETE FROM ParticipantesEncontro WHERE id = ?
                              ";

              //prepara sql
      $stm = $pdo->prepare($sql);
              //trocar valores
        $stm->bindParam(1, $this->id );

        $resposta = $stm->execute();

        $erro = $stm->errorInfo();

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
