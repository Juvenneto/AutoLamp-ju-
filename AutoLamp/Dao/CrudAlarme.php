<?php

include './class/conexao.php';

class CrudAlarme {

    public function queryInsert($aula, $hora_inicio, $hora_fim, $periodo, $data_fim, $data_inicio, $dia, $sala) {

        try {
            $con = new conexao();
            $stmt = $con->conectar()->prepare("INSERT INTO `alarme`(`aula`,`hora_inicio`,`hora_fim`,`periodo`,`data_fim`,`data_inicio`,`dia`,`sala_id`) VALUES (:aula,:hora_inicio,:hora_fim,:periodo,STR_TO_DATE(:data_fim,'%d/%m/%Y'),STR_TO_DATE(:data_inicio,'%d/%m/%Y'),STR_TO_DATE(:dia,'%d/%m/%Y'),:sala);");
            $stmt->bindParam(':aula', $aula);
            $stmt->bindParam(':hora_inicio', $hora_inicio);
            $stmt->bindParam(':hora_fim', $hora_fim);
            $stmt->bindParam(':periodo', $periodo);
            $stmt->bindParam(':data_fim', $data_fim);
            $stmt->bindParam(':data_inicio', $data_inicio);
            $stmt->bindParam(':dia', $dia);
            $stmt->bindParam(':sala', $sala);
            if ($stmt->execute()) {
                return 'ok';
            } else {
                return 'erro';
            }
        } catch (ErrorException $ex) {
            echo "<p>Atenção!! Falha na conexao com o banco de dados....</p><br>"
            . "<p>Verifique a sua conexão com a Internet</p>";
        }
    }

    public function querySelect() {
        try {

            $con = new conexao();

            $stmt = $con->conectar()->prepare("SELECT distinct usuario_professor.nome as prof_nome,
usuario_professor.id as id_prof,
disciplina.id as id_aula,
disciplina.nome as aula_nome,
alarme.periodo as periodo,
alarme.data_fim as data_fim,
alarme.data_inicio as data_inicio,
sala.id as id_sala, 
sala.nome as sala, 
alarme.hora_inicio as hora_inicio,
alarme.hora_fim as hora_fim
from disciplina, alarme, sala ,usuario_professor
WHERE disciplina.id=alarme.aula and 
sala.id=alarme.sala_id and 
disciplina.professor_id=usuario_professor.id");
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (ErrorException $ex) {
            echo "<p>Atenção!! Falha na conexao com o banco de dados....</p><br>"
            . "<p>Verifique a sua conexão com a Internet</p>";
        }
    }
    public function querySelectDia() {
        try {

            $con = new conexao();

            $stmt = $con->conectar()->prepare("SELECT usuario_professor.nome as prof_nome,
alarme.id as id_alarme,
date_format(alarme.dia,'%d/%m/%Y') as dia,
usuario_professor.id as id_prof,
disciplina.id as id_aula,
disciplina.nome as aula_nome,
alarme.periodo as periodo,
alarme.data_fim as data_fim,
alarme.data_inicio as data_inicio,
sala.id as id_sala, 
sala.nome as sala, 
alarme.hora_inicio as hora_inicio,
alarme.hora_fim as hora_fim
from disciplina, alarme, sala ,usuario_professor
WHERE disciplina.id=alarme.aula and 
sala.id=alarme.sala_id and 
disciplina.professor_id=usuario_professor.id");
            $stmt->execute();
            $retorno = $stmt->rowCount();
            if ($retorno == 0 || $retorno== NULL) {
            return 'erro';
            
            } else {
        return $stmt->fetchAll();
                
            }
        } catch (ErrorException $ex) {
            echo "<p>Atenção!! Falha na conexao com o banco de dados....</p><br>"
            . "<p>Verifique a sua conexão com a Internet</p>";
        }
    }

    public function querySelect3() {
        try {

            $con = new conecta();

            $stmt = $con->conectar()->prepare("SELECT e.id,e.nome as nome_equi,p.nome as nome_porta ,s.nome as nome_sala from equipamento e ,porta p, sala s where e.cod_porta=p.id and e.cod_equipamento=s.id");
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (ErrorException $ex) {
            echo "<p>Atenção!! Falha na conexao com o banco de dados....</p><br>"
            . "<p>Verifique a sua conexão com a Internet</p>";
        }
    }

    public function querySelectSala() {
        try {

            $con = new conecta();

            $stmt = $con->conectar()->prepare("SELECT * from sala");
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (ErrorException $ex) {
            echo "<p>Atenção!! Falha na conexao com o banco de dados....</p><br>"
            . "<p>Verifique a sua conexão com a Internet</p>";
        }
    }

    public function querySeleciona($id) {
        try {
             $con = new conexao();
            $stmt = $con->conectar()->prepare("SELECT usuario_professor.nome as prof_nome,
alarme.id as id_alarme,
alarme.dia as dia,
usuario_professor.id as id_prof,
disciplina.id as id_aula,
disciplina.nome as aula_nome,
alarme.periodo as periodo,
alarme.data_fim as data_fim,
alarme.data_inicio as data_inicio,
sala.id as id_sala, 
sala.nome as sala, 
alarme.hora_inicio as hora_inicio,
alarme.hora_fim as hora_fim
from disciplina, alarme, sala ,usuario_professor
WHERE disciplina.id=alarme.aula and 
sala.id=alarme.sala_id and 
disciplina.professor_id=usuario_professor.id AND alarme.id =:id;");
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $ex) {
            return 'error ' . $ex->getMessage();
        }
    }
    public function querySelecionaAlarmes($id_aula,$id_prof,$id_periodo,$id_sala) {
        try {
             $con = new conexao();
            $stmt = $con->conectar()->prepare("  
SELECT alarme.id as id_alarme,
usuario_professor.nome as prof_nome,
disciplina.nome as aula_nome,
alarme.periodo as periodo,
alarme.data_fim as data_fim,
alarme.data_inicio as data_inicio,
sala.nome as sala, 
alarme.hora_inicio as hora_inicio,
alarme.hora_fim as hora_fim,
DATE_FORMAT(alarme.dia,'%d/%m/%Y') as dia
from disciplina, alarme, sala ,usuario_professor
WHERE disciplina.id=alarme.aula and 
sala.id=alarme.sala_id and 
disciplina.professor_id=usuario_professor.id AND 
disciplina.id =:id_aula and 
usuario_professor.id=:id_prof AND
alarme.periodo=:id_periodo AND
sala.id =:id_sala  
ORDER by SUBSTR( alarme.dia, 7, 4), SUBSTR( alarme.dia, 4, 2), SUBSTR( alarme.dia, 1, 2)
;");
            $stmt->bindParam(":id_aula", $id_aula);
            $stmt->bindParam(":id_prof", $id_prof);
            $stmt->bindParam(":id_periodo", $id_periodo);
            $stmt->bindParam(":id_sala", $id_sala);
            $stmt->execute();
               return $stmt->fetchAll();
        } catch (PDOException $ex) {
            return 'error ' . $ex->getMessage();
        }
    }

 
  
    public function querySeleciona2($id) {
        try {
            $con = new conecta();
            $stmt = $con->conectar()->prepare("SELECT p.nome as nome_porta,p.id as porta_id from "
                    . "equipamento e ,porta p, sala s where e.cod_porta=p.id and e.cod_equipamento=s.id and e.cod_porta = :id;");
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $ex) {
            return 'error ' . $ex->getMessage();
        }
    }

    public function querySeleciona3($id) {
        try {
            $con = new conecta();
            $stmt = $con->conectar()->prepare("SELECT equipamento.nome, porta.nome as nome_Porta FROM equipamento, porta, sala WHERE equipamento.cod_equipamento = sala.id and porta.id = equipamento.cod_porta and sala.id =:id;");
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $ex) {
            return 'error ' . $ex->getMessage();
        }
    }

    public function querySeleciona4($id) {
        try {
            $con = new conecta();
            $stmt = $con->conectar()->prepare("SELECT s.nome as nome_sala, s.id as sala_id FROM equipamento e,porta p, sala s where e.cod_porta=p.id and e.cod_equipamento = s.id and e.id = :id");
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $ex) {
            return 'error ' . $ex->getMessage();
        }
    }

    public function querySelecionaN() {
        try {
            $con = new conecta();
            $stmt = $con->conectar()->prepare("SELECT e.nome as nome_equip,p.nome as porta_nome from equipamento e, porta p where e.cod_porta=p.id and e.nome = :nome;");
            $stmt->bindParam(":nome", $nome);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $ex) {
            return 'error ' . $ex->getMessage();
        }
    }

    public function querySeleciona5($id) {
        try {
            $con = new conecta();
            $stmt = $con->conectar()->prepare("SELECT DISTINCT sala.nome as sala_nome, sala.id as sala_id FROM `equipamento`, sala WHERE equipamento.cod_equipamento=sala.id and sala.id <> :id;");
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $ex) {
            return 'error ' . $ex->getMessage();
        }
    }

    public function queryDelete($id) {
        try {
            $con = new conexao();
            $stmt = $con->conectar()->prepare("DELETE FROM `equipamento` WHERE `id` = :id;");
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            if ($stmt->execute()) {
                return 'ok';
            } else {
                return 'erro';
            }
        } catch (PDOException $ex) {
            echo "<p>Atenção!! Falha na conexao com o banco de dados....</p><br>"
            . "<p>Verifique a sua conexão com a Internet</p>";
        }
    }
    public function queryDeleteAlarme($id) {
        try {
            $con = new conexao();
            $stmt = $con->conectar()->prepare("DELETE FROM `alarme` WHERE `id` = :id;");
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            if ($stmt->execute()) {
                return 'ok';
            } else {
                return 'erro';
            }
        } catch (PDOException $ex) {
            echo "<p>Atenção!! Falha na conexao com o banco de dados....</p><br>"
            . "<p>Verifique a sua conexão com a Internet</p>";
        }
    }

    public function queryUpdate($id, $nome, $cod_porta, $cod_sala) {
        try {
            $con = new conecta();

            $stmt = $con->conectar()->prepare("UPDATE `equipamento` SET  `nome` = :nome,`cod_porta` = :cod ,`cod_equipamento`=:cod_sala WHERE `id` = :id;");
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
            $stmt->bindParam(":cod", $cod_porta);
            $stmt->bindParam(":cod_sala", $cod_sala);
            if ($stmt->execute()) {
                return 'ok';
            } else {
                return 'erro';
            }
        } catch (PDOException $ex) {
            echo "<p>Atenção!! Falha na conexao com o banco de dados....</p><br>"
            . "<p>Verifique a sua conexão com a Internet</p>";
        }
    }
    public function queryUpdateAlarme($id_alarme,$hora_inicio, $hora_fim, $data) {
        try {
            $con = new conexao();

            $stmt = $con->conectar()->prepare("UPDATE alarme set 
alarme.data_fim= if(alarme.data_fim>=:data,alarme.data_fim,:data),               
alarme.dia=:data,
alarme.hora_inicio=:hora_inicio,
alarme.hora_fim=:hora_fim where alarme.id=:alarme_id");
            $stmt->bindParam(":alarme_id", $id_alarme);
            $stmt->bindParam(":hora_inicio", $hora_inicio);
            $stmt->bindParam(":hora_fim", $hora_fim);
            $stmt->bindParam(":data", $data);
            if ($stmt->execute()) {
                return 'ok';
            } else {
                return 'erro';
            }
        } catch (PDOException $ex) {
            echo "<p>Atenção!! Falha na conexao com o banco de dados....</p><br>"
            . "<p>Verifique a sua conexão com a Internet</p>";
        }
    }

}
