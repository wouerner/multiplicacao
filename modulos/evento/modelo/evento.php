<?php

namespace evento\modelo;

class evento
{
          private $id;
          private $nome;
          private $erro;

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
              //abrir conexao com o banco
              $pdo = new \PDO(DSN, USER, PASSWD);
              //cria sql
              $sql = "INSERT INTO Evento (nome )
                          VALUES (?)";
              //prepara sql
              $stm = $pdo->prepare($sql);
              //trocar valores
              $stm->bindParam(1, $this->nome);

              $resposta = $stm->execute();

              //fechar conexÃ£o
              $pdo = null ;

              return $resposta;

          }

          public function salvarDiscipuloEvento($discipuloId, $eventoId)
          {
              //abrir conexao com o banco
              $pdo = new \PDO(DSN, USER, PASSWD);
              //cria sql
              $sql = "INSERT INTO DiscipuloTemEvento (discipuloId, eventoId )
                          VALUES (?,?)";
              //prepara sql
              $stm = $pdo->prepare($sql);
              //trocar valores
              $stm->bindParam(1, $discipuloId);
              $stm->bindParam(2, $eventoId);

              $resposta = $stm->execute();

              var_dump($stm->errorInfo());

              //fechar conexÃ£o
              $pdo = null ;

              return $resposta;

          }

          public function salvarEventos($eventos, $discipuloId)
          {
              //abrir conexao com o banco
              $pdo = new \PDO(DSN, USER, PASSWD);
              //cria sql
              $sql = "INSERT INTO DiscipuloTemEvento (discipuloId, eventoId )
                          VALUES (?,?)";

              foreach ($eventos as $evento) {
                         $id = $evento;
                            //prepara sql
                         $stm = $pdo->prepare($sql);
                         //trocar valores
                         $stm->bindParam(1, $discipuloId);
                         $stm->bindParam(2, $id);

                         $resposta = $stm->execute();

              }

              foreach ($eventos as $evento) {

                         $ev[$evento] =  $evento;

              }

              foreach ($this->listarTodos() as $evento) {
                        $remover[$evento['id']] = array('id' => $evento['id'] , 'nome' => $evento['nome'] );

              }

            $dif = array_diff_key($remover,$ev) ;

              $sql = "DELETE FROM DiscipuloTemEvento
                          WHERE discipuloId = ?AND eventoId = ?";

                foreach ($dif as $d) {
                         $id = $evento['id'];
                        //prepara sql
                         $stm = $pdo->prepare($sql);
                         //trocar valores
                         $stm->bindParam(1, $discipuloId);
                         $stm->bindParam(2, $d['id']);

                        // $resposta =
                                      $stm->execute();

                         //var_dump($stm->errorInfo());

                }

              //fechar conexÃ£o
              $pdo = null ;

              return $resposta;

          }

          public function listarTodos()
          {
        $pdo = new \PDO (DSN,USER,PASSWD);

        $sql = 'SELECT * FROM Evento';

        $stm = $pdo->prepare($sql);

        $stm->execute();

        $resp = $stm->fetchAll();

        $resposta = '' ;

        foreach ($resp as $r) {
                  $resposta[$r['id']] = array('id' => $r['id'] , 'nome' => $r['nome'] );
            }

        return $resposta;

    }

    public function excluir()
    {
        try {
        $pdo = new \PDO (DSN,USER,PASSWD);

        $sql = 'DELETE FROM Evento WHERE id = ?';

        $stm = $pdo->prepare($sql);

        $stm->bindParam(1, $this->id);

        $resposta = $stm->execute();
        $erro = $stm->errorCode();

        if ($erro != '0000') {

             throw new \Exception ('Existe discípulos cadastrados nesse evento') ;
        }
        } catch ( \Exception $e ) {

                  $this->erro= $e->getMessage();
    }
    }

    /* Exclui um evento associado a um discipulo.
     *
     *
     *
     */
    public function excluirParticipacao()
    {
        $pdo = new \PDO (DSN,USER,PASSWD);

        $sql = 'DELETE FROM DiscipuloTemEvento WHERE discipuloId = ? AND eventoId = ?';

        $stm = $pdo->prepare($sql);

        $stm->bindParam(1, $this->discipuloId);
        $stm->bindParam(1, $this->eventoId);

        $stm->execute();

    }

    /*Lista apenas um Disicpulo
    */

    public function listarUm()
    {
        $pdo = new \PDO (DSN,USER,PASSWD);

        $sql = 'SELECT * FROM Evento WHERE id = ?';

        $stm = $pdo->prepare($sql);

        $stm->bindParam(1, $this->id);

        $stm->execute();

        return $stm->fetch();

    }

    public function atualizar()
    {
    //abrir conexao com o banco
    $pdo = new \PDO(DSN, USER, PASSWD);
    //cria sql
    $sql = "UPDATE Evento SET 	nome = ?	WHERE id = ?
                    ";
    //prepara sql
    $stm = $pdo->prepare($sql);
    //trocar valores
    $stm->bindParam(1, $this->nome);
    $stm->bindParam(2, $this->id);

    $resposta = $stm->execute();

    //fechar conexÃ£o
    $pdo = null ;

    return $resposta;

    }

    public function listarTodosDiscipulo($url)
    {
        $pdo = new \PDO(DSN, USER, PASSWD);

        $sql = '
        SELECT DISTINCT id , nome , DiscipuloTemEvento.discipuloId
        FROM DiscipuloTemEvento , Evento
        WHERE DiscipuloTemEvento.discipuloId = ? AND Evento.id = DiscipuloTemEvento.eventoId
        ' ;

        $stm = $pdo->prepare($sql);

        $stm->bindParam(1, $url);

        $stm->execute() ;

        $resposta = $stm->fetchAll();

        //var_dump($resposta);
        $re = array();

            foreach ($resposta as $r) {
                $re[$r['id']] = array('id' => $r['id'], 'nome' => $r['nome'] , 'discipuloId' => $url)  ;
            }

        return $re;

    }

}
