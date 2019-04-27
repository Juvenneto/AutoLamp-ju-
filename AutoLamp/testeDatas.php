<?php
       if ($_POST) {
              $id  =(isset($_POST['id']) ? $_POST['id'] : '');
            $inicio = new DateTime(isset($_POST['data_inicio']) ? $_POST['data_inicio'] : '');
            $fim = new DateTime(isset($_POST['data_fim']) ? $_POST['data_fim'] : '');

//define o intervalo
$fim->modify('+1 day');
$interval = new DateInterval('P1D');
$periodo = new DatePeriod($inicio, $interval ,$fim);
                
                //define o fuso
                $fuso = new DateTimeZone('America/Belem');
                $data = new DateTime();
                $data->setTimezone($fuso);
            $datafim=  date( 'd/m/Y', strtotime( $fim->format('d-n-Y')));
                
    $s = array();
    foreach ($_POST as $chave => $valor) {
        if (is_array($valor)) {

            foreach ($valor as $ch => $va) {
                foreach($periodo as $data){
    if($dia = date( 'w', strtotime( $data->format('d-n-Y')) )!=0){
    if($dia = date( 'w', strtotime( $data->format('d-n-Y')) )==$va ){
    echo 'id'.$id.'dia '.$dia = date( 'd/m/Y', strtotime( $data->format('d-n-Y')) ).'<br>';
    echo 'dtafinal'.$datafim;
    }
}
                }
            
              
            }
           
        } else {
           
        }
    }
}

               
          



         

