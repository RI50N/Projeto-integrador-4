<?php

/**
 * <b>Sistema.class:</b>
 * Classe responsável por upload de imagens
 *
 * @copyright (c) 2016, Adriano Boese
 */
class Upload {

    private $File;
    private $Name;
    private $Send;

    /** IMAGE UPLOAD */
    private $Width;
    private $Image;

    /** RESULTSET */
    private $Result;
    private $Error;

    /** DIRETÓTIOS */
    private $Folder;
    private static $BaseDir;

    /**
     * Verifica e cria o diretório padrão de uploads no sistema!<br>
     * <b>../uploads/</b>
     */
    function __construct($BaseDir = null) {
        self::$BaseDir = ( (string) $BaseDir ? $BaseDir : '../NM/uploads/');
        if (!file_exists(self::$BaseDir) && !is_dir(self::$BaseDir)):
            mkdir(self::$BaseDir, 0777);
        endif;
    }

    /**
     * <b>Enviar Imagem:</b> Basta envelopar um $_FILES de uma imagem e caso queira um nome e uma largura personalizada.
     * Caso não informe a largura será 1024!
     * @param FILES $Image = Enviar envelope de $_FILES (JPG ou PNG)
     * @param STRING $Name = Nome da imagems ( ou do artigo )
     * @param INT $Width = Largura da imagem ( 1024 padrão )
     * @param STRING $Folder = Pasta personalizada
     */
    public function Image(array $Image, $Name = null, $Width = null, $Folder = null) {
        $this->File = $Image;
        $this->Name = ( (string) $Name ? $Name : substr($Image['name'], 0, strrpos($Image['name'], '.')) );
        $this->Width = ( (int) $Width ? $Width : 1024 );
        $this->Folder = ( (string) $Folder ? $Folder : '' );

        $this->CheckFolder($this->Folder);
        $this->setFileName();
        $this->UploadImage();
    }

    /**
     * <b>Verificar Upload:</b> Executando um getResult é possível verificar se o Upload foi executado ou não. Retorna
     * uma string com o caminho e nome do arquivo ou FALSE.
     * @return STRING  = Caminho e Nome do arquivo ou False
     */
    public function getResult() {
        return $this->Result;
    }

    /**
     * <b>Obter Erro:</b> Retorna um array associativo com um code, um title, um erro e um tipo.
     * @return ARRAY $Error = Array associatico com o erro
     */
    public function getError() {
        return $this->Error;
    }

    /*
     * ***************************************
     * **********  PRIVATE METHODS  **********
     * ***************************************
     */

    //Verifica e cria os diretórios com base em tipo de arquivo, ano e mês!
    private function CheckFolder($Folder) {
        /*list($y, $m) = explode('/', date('Y/m'));
        $this->CreateFolder("{$Folder}");
        $this->CreateFolder("{$Folder}/{$y}");
        $this->CreateFolder("{$Folder}/{$y}/{$m}/");*/
        $this->Send = $Folder;
    }

    //Verifica e cria o diretório base!
    private function CreateFolder($Folder) {
        if (!file_exists(self::$BaseDir . $Folder) && !is_dir(self::$BaseDir . $Folder)):
            mkdir(self::$BaseDir . $Folder, 0777);
        endif;
    }

    //Verifica e monta o nome dos arquivos tratando a string!
    private function setFileName() {
        $FileName = Validar::Nome($this->Name) . strrchr($this->File['name'], '.');
        if (file_exists(self::$BaseDir . $this->Send . $FileName)):
            if (unlink(self::$BaseDir . $this->Send . $FileName)):
            endif;
            $FileName = Validar::Nome($this->Name).strrchr($this->File['name'], '.');
        endif;
        $this->Name = $FileName;
    }

    //Realiza o upload de imagens redimensionando a mesma!
    private function UploadImage() {
        switch ($this->File['type']):
            case 'image/jpg':
            case 'image/jpeg':
            case 'image/pjpeg':
                $this->Image = imagecreatefromjpeg($this->File['tmp_name']);
                break;
            case 'image/png':
            case 'image/x-png':
                $this->Image = imagecreatefrompng($this->File['tmp_name']);
                break;
        endswitch;

        if (!$this->Image):
            $this->Result = false;
            $this->Error = 'Tipo de arquivo inválido, envie imagens JPG ou PNG!';
        else:
            $x = imagesx($this->Image);
            $y = imagesy($this->Image);
            $ImageX = ( $this->Width < $x ? $this->Width : $x );
            $ImageH = ($ImageX * $y) / $x;

            $NewImage = imagecreatetruecolor($ImageX, $ImageH);
            imagealphablending($NewImage, false);
            imagesavealpha($NewImage, true);
            imagecopyresampled($NewImage, $this->Image, 0, 0, 0, 0, $ImageX, $ImageH, $x, $y);

            switch ($this->File['type']):
                case 'image/jpg':
                case 'image/jpeg':
                case 'image/pjpeg':
                    imagejpeg($NewImage, self::$BaseDir . $this->Send . $this->Name);
                    break;
                case 'image/png':
                case 'image/x-png':
                    imagepng($NewImage, self::$BaseDir . $this->Send . $this->Name);
                    break;
            endswitch;

            if (!$NewImage):
                $this->Result = false;
                $this->Error = 'Tipo de arquivo inválido, envie imagens JPG ou PNG!';
            else:
                $this->Result = $this->Send . $this->Name;
                $this->Error = null;
            endif;

            imagedestroy($this->Image);
            imagedestroy($NewImage);
        endif;
    }

}
