<?php
/**
 * <b>Delete.class:</b>
 * Classe responsável por deletar genéricamente no banco de dados!
 * 
 * @copyright (c) 2016, Adriano Boese
 */

class Delete extends Conn {

    private $Tabela;
    private $Termos;
    private $Places;
    private $Result;

    /** @var PDOStatement */
    private $Delete;

    /** @var PDO */
    private $Conn;

     /**
     * <b>ExeDelete:</b> Deletas registro do banco de dados.
     * Basta informar o nome da tabela e os termos que são as condições do WHERE 
     * 
     * @param STRING $Tabela = Informe o nome da tabela no banco!
     * @param ARRAY $Termos = Informe as condições do WHERE ( Nome Da Coluna => :Nome do campo na parseString ).
     * @param ARRAY $ParseString = Informe os valores dos campos na clausula WHERE ( Nome Do Campo => :Valor ).
     * @example ExeDelete('tabela_tal','WHERE id = :id_do_campo','id_do_campo = {$Valor}') 
     */
    public function ExeDelete($Tabela, $Termos, $ParseString) {
        $this->Tabela = (string) $Tabela;
        $this->Termos = (string) $Termos;

        parse_str($ParseString, $this->Places);
        $this->getSyntax();
        $this->Execute();
    }

    /**
     * <b>getResult:</b> Retorna resultado
    */
    public function getResult() {
        return $this->Result;
    }

    /**
     * <b>getRowCount:</b> Retorna numero de registros deletados
     * @return INT $Var = Quantidade de linhas alteradas
    */
    public function getRowCount() {
        return $this->Delete->rowCount();
    }

    /**
     * <b>setPlaces:</b> Altera os valores passados anteriormente no ExeDelete 
     * para efetuar outra operação sem a nescecidade de instanciar outro objeto.
    */
    public function setPlaces($ParseString) {
        parse_str($ParseString, $this->Places);
        $this->getSyntax();
        $this->Execute();
    }

    /**
     * ****************************************
     * *********** PRIVATE METHODS ************
     * ****************************************
     */
    //Obtém o PDO e Prepara a query
    private function Connect() {
        $this->Conn = parent::getConn();
        $this->Delete = $this->Conn->prepare($this->Delete);
    }

    //Cria a sintaxe da query para Prepared Statements
    private function getSyntax() {
        $this->Delete = "DELETE FROM {$this->Tabela} {$this->Termos}";
    }

    //executa a query!
    private function Execute() {
        $this->Connect();
        try {
            $this->Delete->execute($this->Places);
            $this->Result = true;
        } catch (PDOException $e) {
            $this->Result = null;
            NMErro("<b>Erro ao Deletar:</b> {$e->getMessage()}", $e->getCode());
        }
    }

}