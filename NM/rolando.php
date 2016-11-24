<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Night Mess </title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link rel="icon" class="img-circle" href="img/bussola.png">
        <script src="js/jquery-3.1.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="sisJs/index.js"></script> 
        <style>
            #brand-image{
                height: 25px;
            }
        </style>
    </head>
    <body>      
        <?php
        require ('_app/Config.inc.php');
        $form = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (isset($form['acao'])) {
            switch ($form['acao']):
                case 'home':
                    Validar::Home(unserialize($_SESSION['sistema']));
                    break;
            endswitch;
        }
        $rolandoHoje = Evento::rolandoHoje();
        ?>
        <div class="container-fluid">
            <nav class="navbar  navbar-inverse ">


                <div class="navbar-header">
                    <a class="navbar-brand" href="#">
                        <span>
                            <img  id="brand-image"  alt="logo" src="img/bussula2.png"  >
                        </span>Night Mess</a>


                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <form id="homeForm" method="post">
                    <input type="hidden" name="acao" value="home">
                </form>
                <div class="collapse navbar-collapse" id="myNavbar">               
                    <ul class="nav navbar-nav navbar-right">
                        <li><a id="Home">Home</a></li>    

                        <script>
                            $(document).ready(function () {
                                $('#Home').click(function () {
                                    $('#homeForm').submit();
                                });
                            });
                        </script>
                        <li class="active"><a href="#">Rolando Hoje</a></li> 
                    </ul>
                </div>

            </nav>
            <div class="container">
                <div class="row">

                    <?php
                    for ($i = 0; $i < count($rolandoHoje); $i++):
                        ?>
                        <div class="col-xs-4">
                            <span data-toggle="modal" data-target="#alterardados<?= $rolandoHoje[$i]['id'] ?>" ><?= Validar::Image($rolandoHoje[$i]['id'], $rolandoHoje[$i]['nome_evento'], 400, 300) ?></span>
                            <div class="modal fade" id="alterardados<?= $rolandoHoje[$i]['id'] ?>" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Alterar dados</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="container-fluid">
                                                <div class="form-group col-sm-6">
                                                    <p>Evento: <?= $rolandoHoje[$i]['nome_evento'] ?></p>                                                   
                                                </div>
                                                <div class="form-group col-sm-6">
                                                    <p>Data/Horário: <?= $rolandoHoje[$i]['data'] ?></p>                                                                     
                                                </div>
                                                <div class="form-group col-sm-6">
                                                    <p>descrição: <?= $rolandoHoje[$i]['descricao'] ?></p> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    endfor;
                    ?>
                </div>
            </div>
            <hr>
            <footer >
                <nav class="navbar navbar-inverse">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <a class="navbar-brand" href="#">© 2016 Hurry Up!, Inc.</a>
                        </div>
                        <ul class="nav navbar-nav">
                            <li><a href="#">Terms</a></li> 
                            <li><a href="#">Privacy</a></li> 
                        </ul>
                    </div>
                </nav>
            </footer>

        </div>
    </body>
