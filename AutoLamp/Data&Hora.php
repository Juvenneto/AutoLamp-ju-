<?php

class DataHora {

    public $date;
    public $time;
    public $fuso;
    public $formato;
    public $formatoHora;
    
    
    function __construct() {
        $this->fuso = 'America/Belem';
        $this->formato = 'd/m/y';
        $this->formatoHora = 'H:i:s';
    }

    function getFormato() {
        return $this->formato;
    }

    function setFormato($formato) {
        $this->formato = $formato;
    }

    function getFuso() {
        return $this->fuso;
    }

    function setFuso($fuso) {
        $this->fuso = $fuso;
    }

    function getDate() {
        return $this->date;
    }

    function getTime() {
        return $this->time;
    }

    function setDate($date) {
        $this->date = $date;
    }

    function setTime($time) {
        $this->time = $time;
    }
      function getFormatoHora() {
        return $this->formatoHora;
    }

    function setFormatoHora($formatoHora) {
        $this->formatoHora = $formatoHora;
    }

}

$dataHora = new DataHora();

$fuso1 = new DateTimeZone($dataHora->getFuso());

$data = new DateTime();

$data->setTimezone($fuso1);


    $fuso = new DateTimeZone($dataHora->getFuso());
    $hora = new DateTime();
    $hora->setTimezone($fuso);


$dataHora->setDate($data->format($dataHora->getFormato()));
$dataHora->setTime($hora->format($dataHora->getFormatoHora()));


if ($dataHora->getDate() == $data->format($dataHora->getFormato()) && $dataHora->getTime()== $hora->format($dataHora->getFormatoHora())){
    echo 'Data e igual a de hj: ' . $dataHora->getDate().' e hora: '.$dataHora->getTime();
} else {
    echo 'a data não e igaul ' . $data->format($dataHora->getFormato()) . '<br>' . 'nova: ' . $dataHora->getDate();
}
   