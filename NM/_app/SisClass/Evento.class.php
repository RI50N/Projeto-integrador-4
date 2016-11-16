<?php

/**
 * <b>Evento.class:</b>
 * Classe responsavel por manipular dados referentes a eventos
 *
 *  @copyright (c) 2016, Adriano Boese
 */
class Evento {
    private $id;
    private $idAnunciante;
    private $descricao;
    private $nomeEvento;
    private $flyer;
    
    public function setId($id) {
        $this->id = $id;
    }

    public function setIdAnunciante($idAnunciante) {
        $this->idAnunciante = $idAnunciante;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    public function setNomeEvento($nomeEvento) {
        $this->nomeEvento = $nomeEvento;
    }

    public function setFlyer($flyer) {
        $this->flyer = $flyer;
    }

    public function getId() {
        return $this->id;
    }

    public function getIdAnunciante() {
        return $this->idAnunciante;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function getNomeEvento() {
        return $this->nomeEvento;
    }

    public function getFlyer() {
        return $this->flyer;
    }
    
    public function popularDadosEvento($param) {
        
    }
}
