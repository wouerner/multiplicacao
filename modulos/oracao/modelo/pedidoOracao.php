<?php

namespace oracao\modelo;

use \framework\modelo\modeloFramework;

class pedidoOracao extends modeloFramework
{

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
        $pdo = self::pegarConexao();

        $sql = "INSERT INTO PedidoOracao (discipuloId, publico, texto )
        VALUES (?, ?, ?)";

        $stm = $pdo->prepare($sql);

        $stm->bindParam( 1 , $this->discipuloId );
        $stm->bindParam( 2 , $this->publico );
        $stm->bindParam( 3 , $this->texto );

        $resposta = $stm->execute();

        $pdo = null ;

        return $resposta;
    }

    public function getDiscipulo()
    {
        $pdo = self::pegarConexao();

        $sql = 'select * from Discipulo where id = ?';

        $stm = $pdo->prepare($sql);
        $stm->bindParam(1, $this->discipuloId);

        $stm->execute();

        $resposta = $stm->fetchObject('\discipulo\Modelo\Discipulo');

        return $resposta;
    }
    public function listar($publico)
    {
        $pdo = self::pegarConexao();

        $sql = 'select * from PedidoOracao where publico = ?';

        $stm = $pdo->prepare($sql);
        $stm->bindParam(1, $publico);

        $stm->execute();

        //return $stm->fetchAll();

        $resposta = array();
        while ($obj = $stm->fetchObject(get_class())) {
            $resposta[$obj->id] = $obj;
        }

        return $resposta;
    }

    public function listarTimeline()
    {
        $pdo = self::pegarConexao();

        $sql = '
            SELECT d.nome, a.id, a.identificacao, a.dataAviso AS startDate, ta.modulo,
            ta.controlador, ta.acao, ta.link,ta.mensagem, ta.icone
                         FROM
                        Discipulo AS d
                        inner join
                        Avisos AS a on d.id = a.emissor
                        inner join
                        TipoAviso AS ta
                        on a.tipoAvisoId = ta.id
                        order by a.dataAviso DESC
                        limit 1
                        ';

        $stm = $pdo->prepare($sql);

        $stm->execute();

        return $stm->fetchAll();

    }
    public function listarUltimos()
    {
        $pdo = self::pegarConexao();

        $sql = 'SELECT d.nome , d.alcunha , a.id, a.identificacao, a.dataAviso, ta.modulo,
            ta.controlador, ta.acao, ta.link,ta.mensagem, ta.icone, f.url FROM
        Discipulo AS d
        inner join
        Avisos AS a on d.id = a.emissor
        inner join
        TipoAviso AS ta
        on a.tipoAvisoId = ta.id
        left join
        Foto as f
        on d.id = f.discipuloId
        order by a.dataAviso DESC
        limit 10
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

        $sql = 'DELETE FROM Avisos WHERE id = ?';

        $stm = $pdo->prepare($sql);

        $stm->bindParam(1, $this->id);

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
