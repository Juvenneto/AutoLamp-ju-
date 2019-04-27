<?php

include './Class/conecta.php';

$id = $_REQUEST['id'];

if(!empty($id)){
    
    
    $con = new conecta();
  
    $limit = 1;
    $result_aluno = "SELECT usuario_professor.nome as nome from disciplina, usuario_professor WHERE 
            usuario_professor.id=disciplina.professor_id and disciplina.id=:id LIMIT :limit";
    
    $resultado_aluno = $con->conectar()->prepare($result_aluno);
    $resultado_aluno->bindParam(':id', $id, PDO::PARAM_STR);
    $resultado_aluno->bindParam(':limit', $limit, PDO::PARAM_INT);
    $resultado_aluno->execute();
    
    $array_valores = array();
    
    if($resultado_aluno->rowCount() != 0){
        $row_aluno = $resultado_aluno->fetch(PDO::FETCH_ASSOC);
        $array_valores['nome_prof'] = $row_aluno['nome']; 
    }else{
        $array_valores['nome_prof'] = 'Aluno não encontrado';        
    }
    echo json_encode($array_valores);
}