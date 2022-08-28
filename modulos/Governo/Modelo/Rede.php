<?php

namespace Rede\Modelo ;

class Rede
{
          private $tipoRedeId ;
          private $discipuloId ;
          private $funcaoRedeId ;

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
              $sql = "INSERT INTO  Redes ( tipoRedeId, discipuloId, funcaoRedeId)

                  VALUES (?,?,?)";

              //prepara sql
              $stm = $pdo->prepare($sql);
              //trocar valores
              $stm->bindParam(1, $this->tipoRedeId);
              $stm->bindParam(2, $this->discipuloId);
              $stm->bindParam(3, $this->funcaoRedeId);

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
              $sql = "UPDATE Redes SET 	tipoRedeId = ? , funcaoRedeId = ?
                  WHERE discipuloId = ?
                              ";

              //prepara sql
              $stm = $pdo->prepare($sql);
              //trocar valores
              $stm->bindParam(1, $this->tipoRedeId );
              $stm->bindParam(2, $this->funcaoRedeId );
              $stm->bindParam(3, $this->discipuloId );

              $resposta = $stm->execute();

              $erro = $stm->errorInfo();

              //fechar conexÃ£o
              $pdo = null ;

              return $resposta;

              }

              public function pegarRedeDiscipulo()
              {
              //abrir conexao com o banco
              $pdo = new \PDO(DSN, USER, PASSWD);
              //cria sql
              $sql = '
             select tpRede.nome AS tipoRede,
                    tpRede.id AS tpRedeId,
                    fRede.id AS funcaoId,
                    fRede.nome AS funcaoRede
                    FROM Redes AS r inner join  TipoRede AS tpRede on r.tipoRedeId = tpRede.id
					inner join FuncaoRede AS fRede on r.funcaoRedeId = fRede.id
                    WHERE r.discipuloId = ?
                            ';

              //prepara sql
              $stm = $pdo->prepare($sql);
              //trocar valores
              $stm->bindParam(1, $this->discipuloId);

              $stm->execute();

              //fechar conexÃ£o
              $pdo = null ;

              return $stm->fetchAll();
                }

    public function pegarFuncaoRede()
    {
        //abrir conexao com o banco
        $pdo = new \PDO(DSN, USER, PASSWD);

        $sql = '
        select *
            FROM Redes AS r inner join  TipoRede AS tpRede on r.tipoRedeId = tpRede.id
            inner join FuncaoRede AS fRede on r.funcaoRedeId = fRede.id
            WHERE r.discipuloId = ?
                ';

        //prepara sql
        $stm = $pdo->prepare($sql);
        //trocar valores
        $stm->bindParam(1, $this->discipuloId);

        $stm->execute();

        //fechar conexÃ£o
        $pdo = null ;

        $result = $stm->fetchObject('\Rede\Modelo\FuncaoRede');
        return $result;
    }

              public static function pegarTodasRedes()
              {
                  //abrir conexao com o banco
                  $pdo = new \PDO(DSN, USER, PASSWD);
                  //cria sql
                  $sql = '
                      SELECT tr.id, tr.nome, count( * ) AS total
                        FROM Discipulo AS d
                        INNER JOIN Redes AS r ON d.id = r.discipuloId
                        INNER JOIN TipoRede AS tr ON r.tipoRedeId = tr.id
                        AND d.ativo =1
                        GROUP BY r.tipoRedeId
                                ';

                  //prepara sql
                  $stm = $pdo->prepare($sql);
                  //trocar valores

                  $stm->execute();

                  $pdo = null ;

                  return $stm->fetchAll();
                }

    public static function pegarTodasRedesPorLider($id)
    {
              //abrir conexao com o banco
              $pdo = new \PDO(DSN, USER, PASSWD);
              //cria sql
              $sql = 'select tr.nome, count(*) as total from Discipulo AS d
inner join
Redes AS r on d.id = r.discipuloId
inner join
TipoRede AS tr on r.tipoRedeId = tr.id

Where d.lider = ?
and d.ativo = 1
group by r.tipoRedeId
                            ';

              //prepara sql
              $stm = $pdo->prepare($sql);
              //trocar valores
              $stm->bindParam(1, $id);

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
              $sql = "DELETE FROM Redes WHERE discipuloId = ?
                  AND tipoRedeId = ?
                              ";

              //prepara sql
              $stm = $pdo->prepare($sql);
              //trocar valores
              $stm->bindParam(1, $this->discipuloId );
              $stm->bindParam(2, $this->tipoRedeId );

              $resposta = $stm->execute();

              $erro = $stm->errorInfo();
                //var_dump($erro); exit;

              //fechar conexÃ£o
              $pdo = null ;

              return $resposta;

              }

              public function listarUm()
              {
              //abrir conexao com o banco
              $pdo = new \PDO(DSN, USER, PASSWD);
              //cria sql
              $sql = "SELECT FuncaoRede.id AS funcaoId ,FuncaoRede.nome AS funcaoNome, TipoRede.id AS tipoId, TipoRede.nome AS tipoNome  FROM Redes, TipoRede, FuncaoRede
                         WHERE Redes.DiscipuloId = ? And Redes.tipoRedeId = TipoRede.id AND Redes.FuncaoRedeId = FuncaoRede.id LIMIT 1";

              //prepara sql
              $stm = $pdo->prepare($sql);
              //trocar valores
              $stm->bindParam(1, $this->discipuloId );

              $resposta = $stm->execute();

              //fechar conexÃ£o
              $pdo = null ;

              return $stm->fetch();
    }

                /*
                retorna um array de objetos dos discipulos por rede que é membro.

                */
              public function pegarMembros()
              {
              //abrir conexao com o banco
              $pdo = new \PDO(DSN, USER, PASSWD);
              //cria sql
              $sql = "
                    SELECT
                        d.id AS id , d.nome AS nome, d.telefone , d.endereco , 
                        d.email , d.lider AS lider, d.endereco
                    FROM Discipulo AS d inner join Redes AS r ON d.id = r.discipuloId
                                  inner join TipoRede AS tp ON r.tipoRedeId = tp.id
                    WHERE r.tipoRedeId = ?
                        ";

              //prepara sql
              $stm = $pdo->prepare($sql);
              //trocar valores
              $stm->bindParam(1, $this->tipoRedeId );

              $resposta = $stm->execute();

              //fechar conexÃ£o
              $pdo = null ;
                $resposta = array();
                while ( $obj = $stm->fetchObject('\Discipulo\Modelo\Discipulo') ) {
                        $resposta[ $obj->id ] = $obj ;
                }

              return $resposta ;
    }
              public function pegarMembrosAtivos()
              {
              //abrir conexao com o banco
              $pdo = new \PDO(DSN, USER, PASSWD);
              //cria sql
              $sql = "
                    SELECT
                        d.id AS id , d.nome AS nome, d.telefone , d.endereco , d.email , 
                        d.lider AS lider, d.observacao, d.endereco, d.dataNascimento
                    FROM Discipulo AS d inner join Redes AS r ON d.id = r.discipuloId AND d.ativo = 1
                                  inner join TipoRede AS tp ON r.tipoRedeId = tp.id
                    WHERE r.tipoRedeId = ?
                    ORDER BY nome
                        ";

              //prepara sql
              $stm = $pdo->prepare($sql);
              //trocar valores
              $stm->bindParam(1, $this->tipoRedeId );

              $resposta = $stm->execute();

              //fechar conexÃ£o
              $pdo = null ;
                $resposta = array();
                while ( $obj = $stm->fetchObject('\Discipulo\Modelo\Discipulo') ) {
                        $resposta[ $obj->id ] = $obj ;
                }

              return $resposta;
    }

    public function pegarMembrosInativos()
    {
        //abrir conexao com o banco
        $pdo = new \PDO(DSN, USER, PASSWD);
        //cria sql
        $sql = "
            SELECT
                        d.id AS id , d.nome AS nome, d.telefone , d.endereco , d.email , d.lider AS lider, d.observacao
            FROM Discipulo AS d inner join Redes AS r ON d.id = r.discipuloId AND d.ativo = 0 and d.arquivo= 0
                          inner join TipoRede AS tp ON r.tipoRedeId = tp.id
            WHERE r.tipoRedeId = ?
            ORDER BY nome
                ";

        //prepara sql
        $stm = $pdo->prepare($sql);
        //trocar valores
        $stm->bindParam(1, $this->tipoRedeId );

        $resposta = $stm->execute();

        //fechar conexÃ£o
        $pdo = null ;
        $resposta = array();
        while ( $obj = $stm->fetchObject('\Discipulo\Modelo\Discipulo') ) {
                $resposta[ $obj->id ] = $obj ;
        }

        return $resposta ;
    }

    public function pegarMembrosArquivados()
    {
        //abrir conexao com o banco
        $pdo = new \PDO(DSN, USER, PASSWD);
        //cria sql
        $sql = "
            SELECT
                        d.id AS id , d.nome AS nome, d.telefone , d.endereco , d.email , d.lider AS lider, d.observacao
            FROM Discipulo AS d inner join Redes AS r ON d.id = r.discipuloId AND d.arquivo = 1
                          inner join TipoRede AS tp ON r.tipoRedeId = tp.id
            WHERE r.tipoRedeId = ?
            ORDER BY nome
                ";

        //prepara sql
        $stm = $pdo->prepare($sql);
        //trocar valores
        $stm->bindParam(1, $this->tipoRedeId );

        $resposta = $stm->execute();

        //fechar conexÃ£o
        $pdo = null ;
        $resposta = array();
        while ( $obj = $stm->fetchObject('\Discipulo\Modelo\Discipulo') ) {
                $resposta[ $obj->id ] = $obj ;
        }

        return $resposta ;
    }

}
