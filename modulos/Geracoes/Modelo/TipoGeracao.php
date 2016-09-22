<?php

namespace geracoes\modelo ;

class tipoGeracao
{
    private $id;
    private $nome;

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
        $sql = "INSERT INTO TipoGeracao (nome)
                VALUES (?)";

        $stm = $pdo->prepare($sql);
        $stm->bindParam(1, $this->nome);

        $resposta = $stm->execute();

        $pdo = null ;

        return $resposta;
    }

    public function listarTodos()
    {
        $pdo = new \PDO (DSN,USER,PASSWD);

        $sql = 'SELECT * FROM TipoGeracao';

        $stm = $pdo->prepare($sql);

        $stm->execute();

        $resposta = array();

        while ( $obj = $stm->fetchObject('\geracoes\modelo\tipoGeracao') ) {
            $resposta[$obj->id] = $obj ;
        }

        return $resposta;
    }

    public function quantidade()
    {
        $pdo = new \PDO (DSN,USER,PASSWD);

        $sql = 'SELECT count(*) FROM TipoGeracao as tg inner join Geracoes as g on g.tipoGeracaoId = tg.id  where tg.id = ? ';

        $stm = $pdo->prepare($sql);
        $stm->bindParam(1, $this->id);

        $stm->execute();
        
        $resposta = $stm->fetch();

        //while ( $obj = $stm->fetchObject('\geracoes\modelo\tipoGeracao') ) {
            //$resposta[$obj->id] = $obj ;
        //}

        return $resposta[0];
    }

    public function listarUm()
    {
        $pdo = new \PDO (DSN,USER,PASSWD);

        $sql = 'SELECT * FROM TipoGeracao WHERE id = ?';

        $stm = $pdo->prepare($sql);

        $stm->bindParam(1, $this->id);

        $stm->execute();

        return $stm->fetchObject();

    }

    public function atualizar()
    {
        $pdo = new \PDO(DSN, USER, PASSWD);
        //cria sql
        $sql = " UPDATE TipoGeracao SET nome = ? WHERE id = ? ";
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

    public function excluir()
    {
    try {
        $pdo = new \PDO (DSN,USER,PASSWD);

        $sql = 'DELETE FROM TipoStatusCelular WHERE id = ?';

        $stm = $pdo->prepare($sql);

        $stm->bindParam(1, $this->id);

        $resposta = $stm->execute();
        $erro = $stm->errorCode();

        if ($erro != '0000') {

             throw new \Exception ('Existe discípulos cadastrados') ;
        }
        } catch ( \Exception $e ) {

                  $this->erro= $e->getMessage();
    }

    }

}
