<?php

class Alarme {

    private $id;
    private $aula;
    private $hora_final;
    private $data;
    private $hora_inicio;
    private $fuso;
    private $formatoData;
    private $formatoHora;
    private $periodo;
    private $data_inicio;
    private $data_fim;
    private $cod_dis;
    private $cod_sala;

    function getCod_sala() {
        return $this->cod_sala;
    }

    function setCod_sala($cod_sala) {
        $this->cod_sala = $cod_sala;
    }

    function getPeriodo() {
        return $this->periodo;
    }

    function setPeriodo($periodo) {
        $this->periodo = $periodo;
    }

    function getData_inicio() {
        return $this->data_inicio;
    }

    function getData_fim() {
        return $this->data_fim;
    }

    function getCod_dis() {
        return $this->cod_dis;
    }

    function setData_inicio($data_inicio) {
        $this->data_inicio = $data_inicio;
    }

    function setData_fim($data_fim) {
        $this->data_fim = $data_fim;
    }

    function setCod_dis($cod_dis) {
        $this->cod_dis = $cod_dis;
    }

    function getId() {
        return $this->id;
    }

    function getAula() {
        return $this->aula;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setAula($aula) {
        $this->aula = $aula;
    }

    function __construct() {
        $this->fuso = 'America/Belem';
        $this->formatoData = 'd/m/Y';
        $this->formatoHora = 'H:i';
    }

    function getData() {
        return $this->data;
    }

    function getFuso() {
        return $this->fuso;
    }

    function getFormatoData() {
        return $this->formatoData;
    }

    function getFormatoHora() {
        return $this->formatoHora;
    }

    function setData($data) {
        $this->data = $data;
    }

    function getHora_final() {
        return $this->hora_final;
    }

    function getHora_inicio() {
        return $this->hora_inicio;
    }

    function setHora_final($hora_final) {
        $this->hora_final = $hora_final;
    }

    function setHora_inicio($hora_inicio) {
        $this->hora_inicio = $hora_inicio;
    }

    function setFuso($fuso) {
        $this->fuso = $fuso;
    }

    function setFormatoData($formatoData) {
        $this->formatoData = $formatoData;
    }

    function setFormatoHora($formatoHora) {
        $this->formatoHora = $formatoHora;
    }

}
