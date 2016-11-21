<?php

/**
 * <b>Anunciante.class:</b>
 * Classe que contem os dados e funcionalidades de um anunciante
 *
 * @copyright (c) 2016, Adriano Boese
 */
class Anunciante {

    private $idAnunciante;
    private $nomeEmpresa;
    private $nomeFantasia;
    private $CNPJ;
    private $endereco;
    private $estado;
    private $cidade;
    private $CEP;
    private $bairro;
    private $nomeResponsavel;
    private $sobrenomeResponsavel;
    private $email;
    private $telefoneContato;
    private $whatsapp;
    private $senha;
    private $idUsuario;

    public function setId($id) {
        $this->idUsuario = $id;
    }
    
    function getIdAnunciante() {
        return $this->idAnunciante;
    }
    function getNomeEmpresa() {
        return $this->nomeEmpresa;
    }

    function getNomeFantasia() {
        return $this->nomeFantasia;
    }

    function getCNPJ() {
        return $this->CNPJ;
    }

    function getEndereco() {
        return $this->endereco;
    }

    function getEstado() {
        return $this->estado;
    }

    function getCidade() {
        return $this->cidade;
    }

    function getCEP() {
        return $this->CEP;
    }

    function getBairro() {
        return $this->bairro;
    }

    function getNomeResponsavel() {
        return $this->nomeResponsavel;
    }

    function getSobrenomeResponsavel() {
        return $this->sobrenomeResponsavel;
    }

    function getEmail() {
        return $this->email;
    }

    function getTelefoneContato() {
        return $this->telefoneContato;
    }

    function getWhatsapp() {
        return $this->whatsapp;
    }

    function getIdUsuario() {
        return $this->idUsuario;
    }

            /**
     * <b>populaDados:</b> Popula os dados da classe a partir de um array associativo
     * @param array $dadosAnunciante = dados do anunciante
     * Obs.: O campo senha só será preenchido quando mandado pela interface.
     */
    public function populaDados(array $dadosAnunciante) {
        $this->idAnunciante = (isset($dadosAnunciante['id']) ? $dadosAnunciante['id'] : null);
        $this->CEP = $dadosAnunciante['cep'];
        $this->CNPJ = $dadosAnunciante['cnpj'];
        $this->endereco = $dadosAnunciante['endereco'];
        $this->bairro = $dadosAnunciante['bairro'];
        $this->email = $dadosAnunciante['email'];
        $this->nomeEmpresa = $dadosAnunciante['nomeEmpresa'];
        $this->nomeFantasia = $dadosAnunciante['nomeFantasia'];
        $this->nomeResponsavel = $dadosAnunciante['nomeResponsavel'];
        $this->sobrenomeResponsavel = $dadosAnunciante['sobrenomeResponsavel'];
        $this->estado = $dadosAnunciante['estado'];
        $this->cidade = $dadosAnunciante['cidade'];
        $this->senha = (isset($dadosAnunciante['senha']) ? $dadosAnunciante['senha'] : null);
        $this->telefoneContato = $dadosAnunciante['telefoneContato'];
        $this->whatsapp = $dadosAnunciante['whatsapp'];
    }

    public function cadastraDadosAnunciante() {
        $Cadastra = new Create;

        $DadosLogin = ['email' => $this->email,
            'senha' => md5($this->senha),
            'tipo' => 0,
            'ativo' => 0];
        $Cadastra->ExeCreate('nm_user', $DadosLogin);
        $this->setId($Cadastra->getResult());

        if ($this->idUsuario):
            $Dados = [
                'id_user' => $this->idUsuario,
                'nomeEmpresa' => $this->nomeEmpresa,
                'nomeFantasia' => $this->nomeFantasia,
                'CNPJ' => $this->CNPJ,
                'endereco' => $this->endereco,
                'cidade' => $this->cidade,
                'estado' => $this->estado,
                'CEP' => $this->CEP,
                'bairro' => $this->bairro,
                'nomeResponsavel' => $this->nomeResponsavel,
                'sobrenomeResponsavel' => $this->sobrenomeResponsavel,
                'telefoneContato' => $this->telefoneContato,
                'whatsapp' => $this->whatsapp,
            ];

            $Cadastra->ExeCreate('nm_anunciante', $Dados);
            return "Pré-cadastro realizado com sucesso, em breve entraremos em contato.";
        else:
            return "Ops, ocorreu alguma falha no seu pré-cadastro.";
        endif;
    }

    public function updateDadosAnunciante() {
        $update = new Update();
        $Dados = [
            'nomeEmpresa' => $this->nomeEmpresa,
            'nomeFantasia' => $this->nomeFantasia,
            'CNPJ' => $this->CNPJ,
            'endereco' => $this->endereco,
            'cidade' => $this->cidade,
            'estado' => $this->estado,
            'CEP' => $this->CEP,
            'bairro' => $this->bairro,
            'nomeResponsavel' => $this->nomeResponsavel,
            'sobrenomeResponsavel' => $this->sobrenomeResponsavel,
            'telefoneContato' => $this->telefoneContato,
            'whatsapp' => $this->whatsapp,
        ];

        $update->ExeUpdate('nm_anunciante', $Dados, "WHERE id_user = :id", "id={$this->idUsuario}");
        if ($update->getResult()):
            $DadosLogin = ['email' => $this->email,
                'senha' => $this->senha,
            ];

            $update->ExeUpdate('nm_user', $DadosLogin, "WHERE id = :id", "id={$this->idUsuario}");
            return "Update realizado com sucesso.";
        else:
            return "Ops, ocorreu alguma falha.";
        endif;
    }

    public function ativa() {
        $update = new Update();
        if ($this->idUsuario):
            $DadosLogin = ['ativo' => 1];
            $update->ExeUpdate('nm_user', $DadosLogin, "WHERE id = :idUsuario", "idUsuario={$this->idUsuario}");
            if($update->getResult()):
                return true;
            else:
                return false;
            endif;
        endif;
    }

    public function desativa() {
        $update = new Update();
        if ($this->idUsuario):
            $DadosLogin = ['ativo' => 0];
            $update->ExeUpdate('nm_user', $DadosLogin, "WHERE id = :idUsuario", "idUsuario={$this->idUsuario}");
            if($update->getResult()):
                return true;
            else:
                return false;
            endif;
        endif;
    }

    public function buscaDadosAnunciante() {
        $listarAnunciantes = new Read();
        if (isset($this->idUsuario)):
            $listarAnunciantes->ExeRead('nm_anunciante INNER JOIN nm_user ON nm_user.id = nm_anunciante.id_user', 'WHERE nm_user.id = :id_usuario', "id_usuario={$this->idUsuario}", array('nm_anunciante.id', 'cep', 'cnpj', 'endereco', 'bairro', 'email', 'nomeEmpresa', 'nomeFantasia', 'nomeResponsavel', 'sobrenomeResponsavel', 'estado', 'cidade', 'telefoneContato', 'whatsapp'));
            $anunciante = $listarAnunciantes->getResult();
            $this->populaDados($anunciante[0]);
        else:
            $listarAnunciantes->ExeRead('nm_anunciante INNER JOIN nm_user ON nm_user.id = nm_anunciante.id_user ');
            return $listarAnunciantes->getResult();
        endif;
    }

    public function deletaAnunciante() {
        $deletaAnunciante = new Delete();
        $deletaAnunciante->ExeDelete('nm_user', 'WHERE id = :id', "id={$this->idUsuario}");
        if ($deletaAnunciante->getResult()) {
            $deletaAnunciante->ExeDelete('nm_anunciante', 'WHERE id_user = :id', "id={$this->idUsuario}");
        }
    }

}
