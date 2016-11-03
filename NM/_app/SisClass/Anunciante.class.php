<?php

/**
 * <b>Anunciante.class:</b>
 * Classe que contem os dados e funcionalidades de um anunciante
 *
 * @copyright (c) 2016, Adriano Boese
 */
class Anunciante {

    private $nomeEmpresa;
    private $nomeFantasia;
    private $CNPJ;
    private $endereco;
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

     /**
     * <b>populaDados:</b> Popula os dados da classe a partir de um array associativo
     * @param array $dadosAnunciante = dados do anunciante
     * Obs.: O campo senha só será preenchido quando mandado pela interface.
     */
    public function populaDados(array $dadosAnunciante) {
        $this->CEP = $dadosAnunciante['cep'];
        $this->CNPJ = $dadosAnunciante['cnpj'];
        $this->endereco = $dadosAnunciante['endereco'];
        $this->bairro = $dadosAnunciante['bairro'];
        $this->email = $dadosAnunciante['email'];
        $this->nomeEmpresa = $dadosAnunciante['nomeEmpresa'];
        $this->nomeFantasia = $dadosAnunciante['nomeFantasia'];
        $this->nomeResponsavel = $dadosAnunciante['nomeResponsavel'];
        $this->sobrenomeResponsavel = $dadosAnunciante['sobrenomeResponsavel'];
        if(isset($dadosAnunciante['senha'])):
            $this->senha = $dadosAnunciante['senha'];
        endif;
        $this->telefoneContato = $dadosAnunciante['telefoneContato'];
        $this->whatsapp = $dadosAnunciante['whatsapp'];
    }

    public function cadastraDadosAnunciante() {
        $Cadastra = new Create;
        $Dados = ['nomeEmpresa' => $this->nomeEmpresa,
            'nomeFantasia' => $this->nomeFantasia,
            'CNPJ' => $this->CNPJ,
            'endereco' => $this->endereco,
            'CEP' => $this->CEP,
            'bairro' => $this->bairro,
            'nomeResponsavel' => $this->nomeResponsavel,
            'sobrenomeResponsavel' => $this->sobrenomeResponsavel,
            'telefoneContato' => $this->telefoneContato,
            'whatsapp' => $this->whatsapp,
        ];

        $Cadastra->ExeCreate('nm_anunciante', $Dados);
        $this->idUsuario = $Cadastra->getResult();
        if ($this->idUsuario):
            $DadosLogin = ['email' => $this->email,
                'senha' => $this->senha,
                'id_anunciante' => $this->idUsuario,
                'ativo' => 0
            ];

            $Cadastra->ExeCreate('nm_user', $DadosLogin);
            return "Pré-cadastro realizado com sucesso, em breve entraremos em contato.";
        else:
            return "Ops, ocorreu alguma falha no seu pré-cadastro.";
        endif;
    }

    public function updateDadosAnunciante() {
        $update = new Update();
        $Dados = ['nomeEmpresa' => $this->nomeEmpresa,
            'nomeFantasia' => $this->nomeFantasia,
            'CNPJ' => $this->CNPJ,
            'endereco' => $this->endereco,
            'CEP' => $this->CEP,
            'bairro' => $this->bairro,
            'nomeResponsavel' => $this->nomeResponsavel,
            'sobrenomeResponsavel' => $this->sobrenomeResponsavel,
            'telefoneContato' => $this->telefoneContato,
            'whatsapp' => $this->whatsapp,
        ];

        $update->ExeUpdate('nm_anunciante', $Dados, "WHERE id = :id","id={$this->idUsuario}");
        $this->idUsuario = $update->getResult();
        if ($this->idUsuario):
            $DadosLogin = ['email' => $this->email,
                'senha' => $this->senha,
            ];

            $update->ExeUpdate('nm_user', $DadosLogin, "WHERE id_anunciante = :id","id={$this->idUsuario}");
            return "Update realizado com sucesso.";
        else:
            return "Ops, ocorreu alguma falha.";
        endif;
    }

    public function ativa() {
        $update = new Update();
        if ($this->idUsuario):
            $DadosLogin = ['ativo' => 1];
            $update->ExeUpdate('nm_user', $DadosLogin, "WHERE id_anunciante = {$this->idUsuario}");
        endif;
    }
    
     public function desativa() {
        $update = new Update();
        if ($this->idUsuario):
            $DadosLogin = ['ativo' => 0];
            $update->ExeUpdate('nm_user', $DadosLogin, "WHERE id_anunciante = {$this->idUsuario}");
        endif;
    }

    public function buscaDadosLogin($id) {
        $listarAnunciantes = new Read();
        $listarAnunciantes->ExeRead('nm_anunciante', 'WHERE id =' . $id);
        $anunciantes = $listarAnunciantes->getResult();
        return $anunciantes;
    }

}
