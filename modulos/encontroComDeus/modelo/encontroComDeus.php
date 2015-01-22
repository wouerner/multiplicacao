<?php

namespace encontroComDeus\modelo ;
use \framework\modelo\modeloFramework ;

class encontroComDeus extends modeloFramework
{
  private $id ;
  private $nome ;
  private $dataEncontroComDeus ;
  private $endereco ;
  private $ativo ;

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
      //var_dump($this->dataEncontroComDeus);exit;
              $pdo = self::pegarConexao() ;
              $sql = "INSERT INTO  EncontroComDeus ( nome, dataEncontroComDeus, endereco )
                              VALUES (?,?,?)";

              $stm = $pdo->prepare($sql);

              $stm->bindParam(1, $this->nome);
              $stm->bindParam(2, $this->dataEncontroComDeus);
              $stm->bindParam(3, $this->endereco);

              $resposta = $stm->execute();

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

              public function ativar()
              {
              //abrir conexao com o banco
              $pdo = new \PDO(DSN, USER, PASSWD);
              //cria sql
              $sql = "UPDATE EncontroComDeus SET 	 ativo = 1
                  WHERE id = ?
                              ";

              //prepara sql
              $stm = $pdo->prepare($sql);
              //trocar valores
              $stm->bindParam(1, $this->id );

              $resposta = $stm->execute();

              $erro = $stm->errorInfo();
              //var_dump($erro);
              //exit();

              //fechar conexÃ£o
              $pdo = null ;

              return $resposta;
              }

              public function desativar()
              {
              //abrir conexao com o banco
              $pdo = new \PDO(DSN, USER, PASSWD);
              //cria sql
              $sql = "UPDATE EncontroComDeus SET 	 ativo = 0
                  WHERE id = ?
                              ";

              //prepara sql
              $stm = $pdo->prepare($sql);
              //trocar valores
              $stm->bindParam(1, $this->id );

              $resposta = $stm->execute();

              $erro = $stm->errorInfo();
              //var_dump($erro);
              //exit();

              //fechar conexÃ£o
              $pdo = null ;

              return $resposta;
              }

    public function listarTodos()
    {
        $pdo = self::pegarConexao() ;

        $sql = 'SELECT *
                 FROM EncontroComDeus
                 ORDER BY dataEncontroComDeus DESC ' ;

        $stm = $pdo->prepare($sql);

        $resposta = $stm->execute();

        $pdo = null ;
        $resposta = array();

        while ( $obj = $stm->fetchObject (get_class($this))  ) {
            $resposta[$obj->id] = $obj ;
        }

        return $resposta ;
    }

              public function listarTodosAtivos()
              {
              $pdo = self::pegarConexao() ;

              $sql = 'SELECT *
                         FROM EncontroComDeus
                         WHERE ativo = 1
                         ORDER BY nome ' ;

              $stm = $pdo->prepare($sql);

              $resposta = $stm->execute();

              $pdo = null ;
                $resposta = array();

                while ( $obj = $stm->fetchObject (get_class($this))  ) {
                    $resposta[$obj->id] = $obj ;
                }

              return $resposta ;
                }

              public function excluir()
              {
              //abrir conexao com o banco
              $pdo = new \PDO(DSN, USER, PASSWD);
              //cria sql
              $sql = "DELETE FROM EncontroComDeus WHERE id = ?
                              ";

              //prepara sql
              $stm = $pdo->prepare($sql);
              //trocar valores
              $stm->bindParam(1, $this->id );

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
