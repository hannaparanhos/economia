<?php

require_once 'database.php';

class Query{

    public $connection;

    public function __construct(){
        $db = new Database();
        $this->connection = $db->connection();
    }

    public function getPessoasPorHabilidade($dados){
        $query = "SELECT f.id, f.nome, h.habilidades_id, hb.nome
                  FROM funcionarios_has_habilidades h, funcionarios f, habilidades hb
                  WHERE f.id = h.funcionarios_id AND hb.id = h.habilidades_id AND hb.nome = :habilidade;";
        $stmt = $this->connection->prepare($query);
        $stmt->execute($dados);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

}


?>