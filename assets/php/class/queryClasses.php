<?php

require_once 'database.php';

class Query{

    public $connection;

    public function __construct(){
        $db = new Database();
        $this->connection = $db->connection();
    }

    public function getPessoasPorHabilidade($dados){
        $query = "SELECT f.id, f.nome, h.habilidades_id, hb.nome, h.nivel
                  FROM funcionarios_has_habilidades h, funcionarios f, habilidades hb
                  WHERE f.id = h.funcionarios_id AND hb.id = h.habilidades_id AND hb.nome = :habilidade;";
        $stmt = $this->connection->prepare($query);
        $stmt->execute($dados);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }


    public function getPessoasDisponiveisPorHabilidade($dados){ 
        // seleciona pessoas e suas habilidades onde elas nào estão alocadas em nenhum projeto naquele periodo de tempo
        $query = "SELECT f.id, f.nome, h.habilidades_id, hb.nome, h.nivel
                  FROM funcionarios_has_habilidades h, funcionarios f, habilidades hb
                  WHERE f.id = h.funcionarios_id AND hb.id = h.habilidades_id AND hb.nome = :habilidade
                  AND f.id NOT IN (SELECT ff.funcionarios_idf FROM projetos_has_funcionarios ff, projetos pp WHERE pp.idprojetos = ff.projetos_id 
                  AND (pp.inicio BETWEEN :data_inicio AND :data_fim OR pp.fim BETWEEN :data_inicio AND :data_fim));";
        $stmt = $this->connection->prepare($query);
        $stmt->execute($dados);
        return $stmt->fetchAll(PDO::FETCH_OBJ);

    }

    public function verificaPessoaAlocadaEmProjeto($dados){
        $query = "SELECT * 
                  FROM projetos_has_funcionarios
                  WHERE funcionarios_idf = :id_funcionario";
        $stmt = $this->connection->prepare($query);
        $stmt->execute($dados);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function assinaProjeto($dados){
        $query = "INSERT INTO projetos VALUES (NULL, :tipo_projeto, :reqnf, :requ1, :requ2, :requ3, :inicio, :fim, :valor)";
        $stmt = $this->connection->prepare($query);
        try{
            $stmt->execute($dados);
            return $this->connection->lastInsertId();
        }catch(PDOException $e){
            echo $e->getMessage();
            return 0;
        }
    }

    public function inserePessoaProjeto($dados){
        $query = "INSERT INTO projetos_has_funcionarios VALUES (:proj_id, :func_id, :func)";
        $stmt = $this->connection->prepare($query);
        try{
            $stmt->execute($dados);
            return 1;
        }catch(PDOException $e){
            echo $e->getMessage();
            return 0;
        }
    }

    public function getPessoasPorProjeto($dados){
        $query = "SELECT DISTINCT f.nome,pf.funcionarios_idf, f.foto, fh.nivel, h.nome as hab_nome 
                  FROM projetos_has_funcionarios pf, funcionarios f, funcionarios_has_habilidades fh, habilidades h 
                  WHERE f.id = pf.funcionarios_idf AND fh.funcionarios_id = f.id AND h.id = fh.habilidades_id 
                  AND projetos_id = :projeto_id;";
        $stmt = $this->connection->prepare($query);
        $stmt->execute($dados);
        return $stmt->fetchAll(PDO::FETCH_GROUP);
    }
}


?>