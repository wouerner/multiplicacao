<?php

namespace oferta\modelo ;

class oferta
{
          private $id ;
          private $discipuloId ;
          private $tipoOfertaId ;
          private $dataOferta ;

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
              $sql = "INSERT INTO  Oferta ( discipuloId, tipoOfertaId , data)

                  VALUES (?,?,?)";

              //prepara sql
              $stm = $pdo->prepare($sql);
              //trocar valores
              $stm->bindParam(1, $this->discipuloId);
              $stm->bindParam(2, $this->tipoOfertaId);
              $stm->bindParam(3, $this->dataOferta);

              $resposta = $stm->execute();

              //fechar conexÃ£o
              $pdo = null ;

              return $resposta;
    }

              public function atualizar()
              {
              //abrir conexao com o banco
              $pdo = new \PDO(DSN, USER, PASSWD);
              //cria sql
              $sql = "UPDATE StatusCelular SET 	tipoOferta = ?
                  WHERE discipuloId = ?
                              ";

              //prepara sql
              $stm = $pdo->prepare($sql);
              //trocar valores
              $stm->bindParam(1, $this->tipoOferta );
              $stm->bindParam(2, $this->discipuloId );

              $resposta = $stm->execute();

              $erro = $stm->errorInfo();
              //var_dump($erro);
              //exit();

              //fechar conexÃ£o
              $pdo = null ;

              return $resposta;

              }

              public function pegarOfertasDiscipulo()
              {
              //abrir conexao com o banco
              $pdo = new \PDO(DSN, USER, PASSWD);
              //cria sql
              $sql = "SELECT * FROM Oferta, TipoOferta WHERE  discipuloId = ? AND Oferta.tipoOfertaId = TipoOferta.id ORDER BY data";

              //prepara sql
              $stm = $pdo->prepare($sql);
              //trocar valores
              $stm->bindParam(1, $this->discipuloId);

              $stm->execute();

              //fechar conexÃ£o
              $pdo = null ;

              return $stm->fetchAll();
    }

            public function excluir()
            {
              //abrir conexao com o banco
              $pdo = new \PDO(DSN, USER, PASSWD);
              //cria sql
              $sql = "DELETE FROM Oferta WHERE  id = ?";

              //prepara sql
              $stm = $pdo->prepare($sql);
              //trocar valores
              $stm->bindParam(1, $this->id);

              $stm->execute();

              //fechar conexÃ£o
              $pdo = null ;

            }

}
