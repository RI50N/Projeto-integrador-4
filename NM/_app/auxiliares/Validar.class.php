<?php

/**
 * Validar.class [AUXILIAR]
 * Classe responsavel por manipular e validar os dados do sistema
 * 
 * @copyright (c) 2016, Adriano Boese
 */
class Validar {

    private static $Data;
    private static $Format;

    public static function Email($Email) {
        self::$Data = (string) $Email;
        self::$Format = '/[a-z0-9_\.\-]+@[a-z0-9_\.\-]*[a-z0-9_\.\-]+\.[a-z]{2,4}$/';

        if (preg_match(self::$Format, self::$Data)):
            return TRUE;
        else:
            return FALSE;
        endif;
    }

    public static function Nome($nome) {
        self::$Format = array();
        self::$Format['a'] = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]/?;:.,\\\'<>°ºª';
        self::$Format['b'] = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr';

        self::$Data = strtr(utf8_decode($nome), utf8_decode(self::$Format['a']), self::$Format['b']);
        self::$Data = strip_tags(trim(self::$Data));
        self::$Data = str_replace(' ', '-', self::$Data);
        self::$Data = str_replace(array('-----', '----', '---', '--'), '-', self::$Data);
        return strtolower(utf8_encode(self::$Data));
    }

    public static function Data($data) {
        self::$Format = explode(' ', $data);
        self::$Data = explode('/', self::$Format[0]);

        if (empty(self::$Format[1])):
            self::$Format[1] = date('H:i:s');
        endif;

        self::$Data = self::$Data[2] . '-' . self::$Data[1] . '-' . self::$Data[0] . ' ' . self::$Format[1];

        return self::$Data;
    }

    public static function Palavras($String, $Limite, $Pointer = null) {
        self::$Data = strip_tags(trim($String));
        self::$Format = (int) $Limite;

        $arrayPalavras = explode(' ', self::$Data);
        $numeroPalavras = count($arrayPalavras);
        $novasPalavras = implode(' ', array_slice($arrayPalavras, 0, self::$Format));

        $Pointer = (empty($Pointer) ? '...' : ' ' . $Pointer);
        $Result = ( self::$Format < $numeroPalavras ? $novasPalavras . $Pointer : $novasPalavras);
        return $Result;
    }

    //nm_session
    public static function UsuarioOnline() {
        $result['logado'] = TRUE;
        $result['msg'] = '';
        $result['idUsuario']= null;
        
        $now = date('Y-m-d H:i:s');
        $deleteUserOnline = new Delete;
        $deleteUserOnline->ExeDelete('nm_session', "WHERE timeout < :now", "now={$now}");
        
        if (isset($_SESSION['sistema'])):
            $sistema = unserialize($_SESSION['sistema']);
            $result['idUsuario']= $sistema->getIdUsuario();
            $readUserOnline = new Read;
            $readUserOnline->ExeRead('nm_session', 'WHERE id_user = :id AND session = :session_user', "id={$sistema->getIdUsuario()}&session_user={$sistema->getSession()}");
            $usuario = $readUserOnline->getResult();
            if (!$usuario):
                $result['logado'] = FALSE;
                $result['msg'] = 'Sua sessão expirou';
            else:
                $update = new Update();
                $timestamp = strtotime("+20 minute");
                $newTimeOut = date('Y-m-d H:i:s', $timestamp);
                $update->ExeUpdate('nm_session', array('timeout' => $newTimeOut), 'WHERE session = :user_session', "user_session={$sistema->getSession()}");
            endif;
        else:
            $result['logado'] = FALSE;
            $result['msg'] = 'Você não esta logado';
        endif;

        return $result;
    }

    public static function Image($Image, $ImageDesc, $ImageW = null, $ImageH = null) {

        self::$Data = '../../uploads/' . $Image;
               
        if (file_exists(self::$Data.".jpg") && !is_dir(self::$Data.".jpg")):
            $patch = HOME;
            $imagem = self::$Data.".jpg";
            return "<img src=\"{$patch}/tim.php?src={$patch}/{$imagem}&w={$ImageW}&h={$ImageH}\" alt=\"{$ImageDesc}\" title=\"{$ImageDesc}\"/>";
        elseif(file_exists(self::$Data.".png") && !is_dir(self::$Data.".png")):
            $patch = HOME;
            $imagem = self::$Data.".png";
            return "<img src=\"{$patch}/tim.php?src={$patch}/{$imagem}&w={$ImageW}&h={$ImageH}\" alt=\"{$ImageDesc}\" title=\"{$ImageDesc}\"/>";
            return false;
        endif;
    }

}
