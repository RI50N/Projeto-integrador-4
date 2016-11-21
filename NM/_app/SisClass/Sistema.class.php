<?php

/**
 * <b>Sistema.class:</b>
 * Classe responsável por funçoes base do sistema
 *
 * @copyright (c) 2016, Adriano Boese
 * 
 */
class Sistema {

    private $session;
    private $tipoUser;
    private $idUsuario;

    /**
     * <b>efetuarLogin:</b> Efetua login do usuario no sistema
     * @param STRING $login = Email do usuario
     * @param STRING $senha = Senha do usuario
     */
    public function efetuarLogin($login, $senha) {
        $read = new Read();
        $read->ExeRead('nm_user', "WHERE email = :email AND senha = md5(:senha) AND ativo =1", "email={$login}&senha={$senha}");
        $usuario = $read->getResult();
        if ($usuario):
            $this->setSession(md5(rand(1, 10000))); //hash unico para validar session
            $this->setTipoUser($usuario[0]['tipo']);
            $this->seIdUsuario($usuario[0]['id']);
            $inserirSessao = new Create();
            $timestamp = strtotime("+20 minute");
            $timeOut = date('Y-m-d H:i:s', $timestamp);
            $inserirSessao->ExeCreate('nm_session', array('id_user' => $this->idUsuario, 'session' => $this->session, 'timeout' => $timeOut));
        endif;
    }
    
    public function logOut() {
        $deleteUserOnline = new Delete;
        $deleteUserOnline->ExeDelete('nm_session', "WHERE id_user=:id AND session=:session_user", "id={$this->idUsuario}&session_user={$this->session}");
    }
    
    public function getSession() {
        return $this->session;
    }

    public function getTipo() {
        return $this->tipoUser;
    }

    public function getIdUsuario() {
        return $this->idUsuario;
    }

    private function setSession($session) {
        $this->session = $session;
    }

    private function setTipoUser($tipoUser) {
        $this->tipoUser = $tipoUser;
    }

    private function seIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

}
