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

    public function popularDadosEvento($dadosForm, $files = NULL) {
        if (isset($dadosForm['id_anunciante'])):
            $this->setIdAnunciante($dadosForm['id_anunciante']);
        endif;
        $this->setDescricao($dadosForm['descricao']);
        $this->setNomeEvento($dadosForm['nome_evento']);
        $this->setDatetime(str_replace('T', ' ', $dadosForm['data'] . ':00'));
        if ($files != NULL):
            $this->setFlyer($files);
        endif;
    }

    function getDatetime() {
        return $this->datetime;
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
            $uploadImagem->Image($this->flyer, $this->id, 400);
            return "Evento cadastrado com sucesso!";
        else:
            return "Ops, ocorreu alguma falha no cadastro do evento!";
        endif;
    }

    public function updateEvento() {
        $update = new Update();
        $dadosEvento = [
            'descricao' => $this->descricao,
            'nome_evento' => $this->nomeEvento,
            'data' => $this->datetime];
        $update->ExeUpdate('nm_evento', $dadosEvento, 'WHERE id=:idEvento', "idEvento={$this->id}");

        if ($update->getResult()):
            if ($this->flyer != NULL):
                $uploadImagem = new Upload();
                $uploadImagem->Image($this->flyer, $this->id, 400);
            endif;
            return "Evento atualizado com sucesso";
        else:
            return "Ops, ocorreu alguma falha ao atualizar o evento.";
        endif;
    }

    public function cancelar() {
        $update = new Update();
        $dadosEvento = ['cancelado' => 1];
        $update->ExeUpdate('nm_evento', $dadosEvento, 'WHERE id=:idEvento', "idEvento={$this->id}");
        if ($update->getResult()):
            return "Evento cancelado.";
        else:
            return "Ops, ocorreu alguma falha ao cancelar o evento.";
        endif;
    }
    
    public function ativar() {
        $update = new Update();
        $dadosEvento = ['cancelado' => 0];
        $update->ExeUpdate('nm_evento', $dadosEvento, 'WHERE id=:idEvento', "idEvento={$this->id}");
        if ($update->getResult()):
            return "Evento ativado.";
        else:
            return "Ops, ocorreu alguma falha ao ativar o evento.";
        endif;
    }

    public static function rolandoHoje() {
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
