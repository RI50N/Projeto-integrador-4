<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
       <?php
        require('_app/Config.inc.php');  
        $anunciante= new Anunciante();
        var_dump($_POST);
        ?><hr><?php
        $anunciante->populaDados($_POST);
        $anunciante->cadastra();
        var_dump($anunciante);
        
        ?>
    </body>
</html>
