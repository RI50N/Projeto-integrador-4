<?php

header('Content-Type: text/html; charset=utf-8');




function emailValidation($email){
    if(filter_var($email, FILTER_VALIDATE_EMAIL)):
        return true; 
    else:
        return false;
    endif;
}

$nome = "Adriano";
$email = "adrianoBoese@gmail.com";

if(empty($nome) || empty($email)):
    echo "informe seu nome e email!";
elseif (!emailValidation($email)):
    echo "Ops: Informe um email valido";
else:
    $Users=[
        'adrianoBoese@gmail.com',
        'deboese@gmail.com'
    ];
    if (in_array($email, $Users)):
        echo "Ops. você ja é cadastrado, quer logar? <a href='#'>Sim</a>";
    else:
        echo "cadastro com sucesso";
    endif;
endif;