<?php

namespace oferta\modelo ;

class oferta {

    private $id ;
    private $discipuloId ;
    private $tipoOfertaId ;
    private $dataOferta ;

    public function __get($prop){

        return $this->$prop ;
    }

		  public function __set($prop, $valor){

					 $this->$prop = $valor ;

		  }
    public function salvar(){
        $pdo = new \PDO(DSN, USER, PASSWD);
        $sql = "INSERT INTO  Oferta ( discipuloId, tipoOfertaId , data, contaId,valor) VALUES (?,?,?,?,?)";

        //prepara sql
        $stm = $pdo->prepare($sql);
        //trocar valores
        $stm->bindParam(1, $this->discipuloId);
        $stm->bindParam(2, $this->tipoOfertaId);
        $stm->bindParam(3, $this->dataOferta);
        $stm->bindParam(4, $this->conta);
        $stm->bindParam(5, $this->valor);

        $resposta = $stm->execute();

        //fechar conexÃ£o
        $pdo = null ;

        return $resposta;
    }

    public function atualizar(){

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

    public function pegarOfertasDiscipulo(){

    //abrir conexao com o banco
    $pdo = new \PDO(DSN, USER, PASSWD);
    //cria sql
    $sql = "SELECT * , c.nome contaNome, tp.nome nomeOferta FROM Oferta o
        LEFT JOIN  TipoOferta tp ON o.tipoOfertaId = tp.id
        LEFT JOIN Conta c ON c.id = o.contaId
        WHERE  o.discipuloId = ?  ORDER BY data";

    //prepara sql
    $stm = $pdo->prepare($sql);
    //trocar valores
    $stm->bindParam(1, $this->discipuloId);

    $stm->execute();

    //fechar conexÃ£o
    $pdo = null ;

    return $stm->fetchAll();
    }

    public function discipuloMesAno($mes, $ano, $tipo = null){

        //abrir conexao com o banco
        $pdo = new \PDO(DSN, USER, PASSWD);
        //cria sql
        $sql = "
            select * from Oferta o inner join TipoOferta tp ON tp.id = o.tipoOfertaId
                where discipuloId = ? and
            month(data) = ?  and year(data) = ?
        ";

        if ($tipo){
            $sql .= '  and tp.id in (?)';
        }

        //prepara sql
        $stm = $pdo->prepare($sql);
        //trocar valores
        $stm->bindParam(1, $this->discipuloId);
        $stm->bindParam(2, $mes);
        $stm->bindParam(3, $ano);

        if ($tipo){
            $stm->bindParam(4, implode(',',$tipo));
        }

        $stm->execute();

        //fechar conexÃ£o
        $pdo = null ;

        return $stm->fetchAll();
    }

    public function excluir(){
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

    public static function valorTotal () {

        $pdo = new \PDO (DSN,USER,PASSWD);

        $sql = 'SELECT sum(valor) as total FROM Oferta';

        $stm = $pdo->prepare($sql);

        $stm->execute();

        $resposta = array();

        while ( $obj = $stm->fetchObject('\oferta\modelo\oferta') ) {
            $resposta = $obj;
        }

        return $resposta ;
    }
}
