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
    private $datetime;
    private $flyer;

    public function popularDadosEvento($dadosForm, $files) {
        $this->setIdAnunciante($dadosForm['id_anunciante']);
        $this->setDescricao($dadosForm['descricao']);
        $this->setNomeEvento($dadosForm['nome_evento']);
        $this->setDatetime(Validar::Data(str_replace('-', '/', str_replace('T', ' ', $dadosForm['data'] . ':00'))));
        $this->setFlyer($files);
    }

    public function cadastraEvento() {
        $cadastra = new Create;
        $dadosEvento = [
            'id_anunciante' => $this->idAnunciante,
            'descricao' => $this->descricao,
            'nome_evento' => $this->nomeEvento,
            'data' => $this->datetime];
        $cadastra->ExeCreate('nm_evento', $dadosEvento);
        $this->setId($cadastra->getResult());

        if ($this->id):
            $uploadImagem = new Upload();
            $uploadImagem->Image($this->flyer, $this->id);
            return "Pré-cadastro realizado com sucesso, em breve entraremos em contato.";
        else:
            return "Ops, ocorreu alguma falha no seu pré-cadastro.";
        endif;
    }

    public function listarEventosAnunciante() {
        $readEventos = new Read;
        $readEventos->ExeRead('nm_evento', 'WHERE id_anunciante = :id', "id={$this->idAnunciante}");
        return $readEventos->getResult();
    }
    
    public function rolandoHoje() {
        $readEventos = new Read;
        $now = date('Y-m-d');
        $readEventos->ExeRead('nm_evento', 'WHERE CAST(data AS DATE)= :now', "now={$now}");
        return $readEventos->getResult();
    }
    
    function setDatetime($datetime) {
        $this->datetime = $datetime;
    } 
    
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

}
