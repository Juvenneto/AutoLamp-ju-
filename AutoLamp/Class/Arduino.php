<?php


class Arduino {
    private $id;
    private $ip;
    private $cod_porta;
    private $porta_sever;
    
    function __construct() {
        $this->ip = "192.168.0.140";
        $this->porta_sever = "80";
        
    }
    
    
    
    function getPorta_sever() {
        return $this->porta_sever;
    }

    function setPorta_sever($porta_sever) {
        $this->porta_sever = $porta_sever;
    }

        function getId() {
        return $this->id;
    }

    function getIp() {
        return $this->ip;
    }

    function getCod_porta() {
        return $this->cod_porta;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setIp($ip) {
        $this->ip = $ip;
    }

    function setCod_porta($cod_porta) {
        $this->cod_porta = $cod_porta;
    }


}
