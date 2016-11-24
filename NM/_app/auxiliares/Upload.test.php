<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>WS PHP - Helpers :: Helper de Gestão de Uploads</title>
        <link rel="stylesheet" href="../../css/reset.css" />
    </head>
    <body>
        <?php
        require('../Config.inc.php');

        $form = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if ($form && $form['sendImage']):

            $upload = new Upload('../../uploads/');
            $imagem = $_FILES['imagem'];

            $upload->Image($imagem,2);
            if (!$upload->getResult()):
                NMErro("Erro ao enviar Imagem:<br><small>{$upload->getError()}</small>", NM_ERROR);
            else:
                NMErro("Imagem enviada com sucesso:<br><small>{$upload->getResult()}</small>", NM_ACCEPT);
            endif;

            echo "<hr>";

        endif;
        ?>

        <form name="fileForm" action="" method="post" enctype="multipart/form-data">
            <label>
                <input type="file" name="imagem"/>
            </label>

            <input type="submit" name="sendImage" value="enviar arquivo!"/>
        </form>
    </body>
</html>
