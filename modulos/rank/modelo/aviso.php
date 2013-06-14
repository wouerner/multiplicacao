<?php

namespace aviso\modelo;

class aviso
{
          private $id;
          private $emissor;
          private $tipoAviso;
          private $dataAviso;
          private $identificacao;

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
              $pdo = new \PDO(DSN, USER, PASSWD);

              $sql = "INSERT INTO Avisos (emissor , tipoAvisoId, dataAviso ,  identificacao )
                              VALUES (?, ?, NOW(),?)";

              $stm = $pdo->prepare($sql);

              $stm->bindParam( 1 , $this->emissor );
              $stm->bindParam( 2 , $this->tipoAviso );
              $stm->bindParam( 3 , $this->identificacao );

              $resposta = $stm->execute();

              $pdo = null ;

              return $resposta;
          }

          public function listarTodos()
          {
        $pdo = new \PDO (DSN,USER,PASSWD);

        $sql = 'SELECT d.nome, a.identificacao, a.dataAviso, ta.modulo, ta.acao FROM
Discipulo AS d
inner join
Avisos AS a on d.id = a.emissor
inner join
TipoAviso AS ta
on a.tipoAvisoId = ta.id
order by a.dataAviso DESC
';

        $stm = $pdo->prepare($sql);

        $stm->execute();

        return $stm->fetchAll();

    }
        public function listarUltimos()
        {
        $pdo = new \PDO (DSN,USER,PASSWD);

        $sql = 'SELECT d.nome, a.identificacao, a.dataAviso, ta.modulo, ta.acao FROM
Discipulo AS d
inner join
Avisos AS a on d.id = a.emissor
inner join
TipoAviso AS ta
on a.tipoAvisoId = ta.id
order by a.dataAviso DESC
limit 5
';

        $stm = $pdo->prepare($sql);

        $stm->execute();

        return $stm->fetchAll();

    }

    /* Exclui um evento associado a um discipulo.
     *
     *
     *
     */
    public function excluir()
    {
        $pdo = new \PDO (DSN,USER,PASSWD);

        $sql = 'DELETE FROM DiscipuloTemEvento WHERE discipuloId = ? AND eventoId = ?';

        $stm = $pdo->prepare($sql);

        $stm->bindParam(1, $this->discipuloId);
        $stm->bindParam(2, $this->eventoId);

        $stm->execute();

    }

    /*Lista apenas um Disicpulo
    */

    public function listarUm()
    {
        $pdo = new \PDO (DSN,USER,PASSWD);

        $sql = 'SELECT * FROM Admissao, TipoAdmissao WHERE discipuloId = ? AND Admissao.tipoAdmissao = TipoAdmissao.id Limit 1';

        $stm = $pdo->prepare($sql);

        $stm->bindParam(1, $this->discipuloId);

        $stm->execute();

        return $stm->fetch();

    }

    public function atualizar()
    {
    //abrir conexao com o banco
    $pdo = new \PDO(DSN, USER, PASSWD);
    //cria sql
    $sql = "UPDATE Admissao SET 	tipoAdmissao = ?	WHERE discipuloId = ?
                    ";
    //prepara sql
    $stm = $pdo->prepare($sql);
    //trocar valores
    $stm->bindParam(1, $this->tipoAdmissao);
    $stm->bindParam(2, $this->discipuloId);

    $resposta = $stm->execute();

    var_dump($stm->errorInfo());

    //fechar conexÃ£o
    $pdo = null ;

    return $resposta;

    }

    public function listarTodosDiscipulo($url)
    {
        $pdo = new \PDO(DSN, USER, PASSWD);

        $sql = '
        SELECT DISTINCT id , nome
        FROM DiscipuloTemEvento , Evento
        WHERE DiscipuloTemEvento.discipuloId = ? AND Evento.id = DiscipuloTemEvento.eventoId
        ' ;

        $stm = $pdo->prepare($sql);

        $stm->bindParam(1, $url);

        $stm->execute() ;

        return $stm->fetchAll();

    }

}
