<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        require ('..\Config.inc.php');
        
        //Test validar email
        $email = 'emailTest@test.com';
        if(Validar::Email($email)):
            echo 'Email correto <hr>';
        else:
            echo 'Email errado <hr>';
        endif;
        
        $name = 'Téstândo úrl ãmigavèl';
        echo Validar::Nome($name).'<hr>';
        
        $data = '10/04/2016 13:14:15';
        echo Validar::Data($data).'<hr>';
        
        $String = 'Testando funçãozinha de cortar frases haha';
        echo Validar::Palavras($String, 5, '<small>perdeu playba........</small>').'<hr>';
        
        $evento = new Evento();
        $evento->setId(14);
        
        echo Validar::Image($evento->getId(), 'lalala',500,200);
        ?>
        
        
    </body>
</html>
