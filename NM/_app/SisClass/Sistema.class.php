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
        
    /**
     * <b>efetuarLogin:</b> Efetua login do usuario no sistema
     * @param STRING $login = Email do usuario
     * @param STRING $senha = Senha do usuario
     */
    public function efetuarLogin($login, $senha) {
        $read = new Read();
        $read->ExeRead('nm_user', "WHERE email = '{$login}' AND senha = '{$senha}' AND ativo=0 OR ativo =1");;
        $usuario = $read->getResult();
        if ($usuario):
            $this->setSession(md5(rand(1, 10000)));//hash unico para validar session
            $this->setTipoUser($usuario[0]['tipo']);
        endif;
    }
    
    public function getSession() {
        return $this->session;
    }
    
    public function getTipo() {
        return $this->tipoUser;
    }
    
    private function setSession($session) {
        $this->session = $session;
    }

    private function setTipoUser($tipoUser) {
        $this->tipoUser = $tipoUser;
    }

    
}
