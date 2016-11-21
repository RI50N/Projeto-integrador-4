<?php
define('HOME', 'http://localhost/Projeto-integrador-4/NM/');

//Session
session_start();

// CONFIGRAÇÕES DO SITE ####################
define('HOST', 'localhost');
define('USER', 'root');
define('PASS', '');
define('DBSA', 'nmdb');

// AUTO LOAD DE CLASSES ####################
function __autoload($Class) {

    $cDir = ['Conn','SisClass','auxiliares'];
    $iDir = null;

    foreach ($cDir as $dirName):
        if (!$iDir && file_exists(__DIR__ . "\\{$dirName}\\{$Class}.class.php") && !is_dir(__DIR__ . "\\{$dirName}\\{$Class}.class.php")):
            include_once (__DIR__ . "\\{$dirName}\\{$Class}.class.php");
            $iDir = true;
        endif;
    endforeach;

    if (!$iDir):
        trigger_error("Não foi possível incluir {$Class}.class.php", E_USER_ERROR);
        die;
    endif;
}

// TRATAMENTO DE ERROS #####################
//CSS constantes :: Mensagens de Erro
define('NM_ACCEPT', 'accept');
define('NM_INFOR', 'infor');
define('NM_ALERT', 'alert');
define('NM_ERROR', 'error');

//NMErro :: Exibe erros lançados :: Front
function NMErro($ErrMsg, $ErrNo, $ErrDie = null) {
    $CssClass = ($ErrNo == E_USER_NOTICE ? NM_INFOR : ($ErrNo == E_USER_WARNING ? NM_ALERT : ($ErrNo == E_USER_ERROR ? NM_ERROR : $ErrNo)));
    echo "<p class=\"trigger {$CssClass}\">{$ErrMsg}</p>";

    if ($ErrDie):
        die;
    endif;
}

//PHPErro :: personaliza o gatilho do PHP
function PHPErro($ErrNo, $ErrMsg, $ErrFile, $ErrLine) {
    $CssClass = ($ErrNo == E_USER_NOTICE ? NM_INFOR : ($ErrNo == E_USER_WARNING ? NM_ALERT : ($ErrNo == E_USER_ERROR ? NM_ERROR : $ErrNo)));
    echo "<p class=\"trigger {$CssClass}\">";
    echo "<b>Erro na Linha: #{$ErrLine} ::</b> {$ErrMsg}<br>";
    echo "<small>{$ErrFile}</small>";
    echo "<span class=\"ajax_close\"></span></p>";

    if ($ErrNo == E_USER_ERROR):
        die;
    endif;
}

set_error_handler('PHPErro');
