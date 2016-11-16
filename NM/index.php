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
        require('_app/Config.inc.php');
        if (isset($_POST['acao'])) {
            switch ($_POST['acao']):
                case 'preCadastro':
                    $anunciante = new Anunciante();
                    $anunciante->populaDados($_POST);
                    $msg = $anunciante->cadastraDadosAnunciante();
                    break;
                case 'login':
                    $sistema = new Sistema();
                    $sistema->efetuarLogin($_POST['login'], $_POST['senha']);
                    if ($sistema->getSession()):
                        if ($sistema->getTipo() == 0):
                            $direcionar = 'pgAnunciante.php';
                        elseif ($sistema->getTipo() == 1):
                            $direcionar = 'pgAdmin.php';
                        endif;
                        if ($direcionar):
                            $_SESSION['sistema'] = serialize($sistema);
                            var_dump($sistema->getSession());
                            header("Location: {$direcionar}");
                        endif;
                    endif;
                    break;

            endswitch;
        }
        ?>  
        <div class="container">
            <nav class="navbar  navbar-inverse ">
                <div class="container-fluid">

                    <div class="navbar-header">
                        <a class="navbar-brand" href="#">
                            <span>
                                <img id="brand-image" alt="logo" src="img/bussula2.png" width="50" height="200">
                            </span>Night Mess</a>


                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="modal fade" id="msgAviso" role="dialog">
                        <div class="modal-dialog">

                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>  
                                </div>
                                <h4>Aviso</h4>

                                <div class="modal-body">
                                    <div class="container-fluid">
                                        <span><?= $msg ?></span>
                                        <?php if ($msg != "") {
                                            ?>
                                            <span id="aviso"></span>
                                        <?php }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="collapse navbar-collapse" id="myNavbar">
                        <ul class="nav navbar-nav navbar-right">
                            <li><a data-toggle="modal" data-target="#cadastro"><span class="glyphicon glyphicon-user"></span> Anuncie Aqui!</a></li>
                            <li><a data-toggle="modal" data-target="#entrar"><span class="glyphicon glyphicon-log-in"></span> Entrar</a></li>

                            <div class="modal fade" id="cadastro" role="dialog">
                                <div class="modal-dialog">

                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Cadastro</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="container-fluid">
                                                <form class="form-signin modal-header" action="#" method="post">
                                                    <input type="hidden" name="acao" value="preCadastro">

                                                    <label for="NomeE">Nome da Empresa*</label>
                                                    <input type="text" class="form-control" id="NomeE" name="nomeEmpresa">
                                                    <br>
                                                    <label for="Nomef">Nome Fantasia*</label>
                                                    <input type="text" class="form-control" id="Nomef" name="nomeFantasia">
                                                    <br>
                                                    <div class="form-group col-sm-6">
                                                        <label for="CNPJ">CNPJ*</label>
                                                        <input type="CNPJ"  class="form-control" id="CNPJ" name="cnpj" placeholder="00.000.000/0000-00"> 
                                                    </div>
                                                    <div class="form-group col-sm-6">
                                                        <label for="Estado">Estado*</label>
                                                        <input type="text" class="form-control" id="estado" name="estado" placeholder="RS" >                                                        
                                                    </div>
                                                    <div class="form-group col-sm-6">
                                                        <label for="Cidade">Cidade*</label>
                                                        <input type="text" class="form-control" id="cidade" name="cidade" placeholder="Porto Alegre">                                                                      
                                                    </div>
                                                    <div class="form-group col-sm-6">
                                                        <label for="Endereço">Endereço*</label>
                                                        <input type="Endereço"  class="form-control" id="Endereço" name="endereco" placeholder="rua de tal,n°00"> 

                                                    </div>
                                                    <div class="form-group col-sm-6">
                                                        <label for="Cep">Cep*</label>
                                                        <input type="Cep"  class="form-control" id="Cep" name="cep" placeholder="00000-000"> 

                                                    </div>
                                                    <div class="form-group col-sm-6">
                                                        <label for="Bairro">Bairro*</label>
                                                        <input type="Bairro"  class="form-control" id="Bairro" name="bairro" placeholder="Cafundo do Judas"> 

                                                    </div>
                                                    <div class="form-group col-sm-6">
                                                        <label for="Nomer">Nome do Resposavel*</label>
                                                        <input type="text" class="form-control" id="nomer" name="nomeResponsavel">

                                                    </div>
                                                    <div class="form-group col-sm-6">
                                                        <label for="sobrenomer">Sobrenome do Resposavel*</label>
                                                        <input type="text" class="form-control" id="sobrenomer" name="sobrenomeResponsavel">

                                                    </div>
                                                    <div class="form-group col-sm-6">
                                                        <label for="E-mail">E-mail*</label>
                                                        <input type="email"  class="form-control" id="email" name="email" placeholder="email@exemplo.com"> 
                                                    </div>
                                                    <div class="form-group col-sm-6">
                                                        <label for="telef">Telefone de contato*</label>
                                                        <input type="telef"  class="form-control" id="telef" name="telefoneContato" placeholder="(00)0000-0000"> 
                                                    </div>
                                                    <div class="form-group col-sm-6">
                                                        <label for="celu">Celular/ whatsapp*</label>
                                                        <input type="telef"  class="form-control" id="celu" name="whatsapp" placeholder="(00)0000-0000"> 
                                                    </div>
                                                    <div class="form-group col-sm-6">
                                                        <label for="senha">Senha*</label>
                                                        <input type="password" name="senha" id="senha" class="form-control" placeholder="Senha" required="" name="senha">
                                                    </div>
                                                    <div class="form-group col-sm-6">
                                                        <label for="senha">Confirmar Senha*</label>
                                                        <input type="password" name="senha" id="senha" class="form-control" placeholder="Senha" required="" name="senha">
                                                    </div>
                                                    <br>
                                                    <div class="form-group col-sm-8">
                                                    <button type="submit" class="btn btn-primary" href="" >Cadastrar-se</button>
                                                    </div>
                                                </form> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>	
                            <div class="modal fade" id="entrar" role="dialog">
                                <div class="modal-dialog">

                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Login</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="container-fluid ">
                                                <form class="form-signin modal-header" method="post">
                                                    <input type="hidden" name="acao" value="login">
                                                    
                                                    <label for="E-mail">E-mail*</label>
                                                    <input type="email"  class="form-control required" id="email" name="login" placeholder="email@exemplo.com" required="true"> 
                                                    <br>
                                                    <label for="senha">Senha*</label>
                                                    <input type="password" id="inputPassword" class="form-control" placeholder="Senha" name="senha" required="true">
                                                    <br>
                                                    <button  type="submit" class="btn btn-primary" id="formLogin">ENTRAR</button>
                                                </form>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>	
                        </ul>

                        <ul class="nav navbar-nav navbar-right">
                            <li class="active"><a href="index.php">Home</a></li>                            
                            <li><a href="rolando.php">Rolando Hoje</a></li> 
                        </ul>
                    </div>
                </div>
            </nav>
            <div id="myCarousel" class="carousel slide">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li class="item1 active"></li>
                    <li class="item2"></li>
                    <li class="item3"></li>
                    <li class="item4"></li>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">

                    <div class="item active">
                        <img   class=" embed-responsive-item" src="img/b1.jpg"  >
                    </div>

                    <div class="item">
                        <img class="embed-responsive-item" src="img/b2.jpg"  >
                    </div>

                    <div class="item">
                        <img  class="embed-responsive-item" src="img/b3.jpg"  >
                    </div>

                    <div class="item">
                        <img  class="embed-responsive-item" src="img/b4.jpg" >
                    </div>

                </div>

                <!-- Left and right controls -->
                <a class="left embed-responsive-item carousel-control" href="#myCarousel" role="button">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#myCarousel" role="button">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            <br>
            <div class="container-fluid">
                <div class="row">
                    <center><h2>Apoiadores</h2></center>
                    <div class="col-xs-4">
                        <img src="img/910.jpg" class="img-responsive">
                    </div>
                    <div class="col-xs-4">
                        <img src="img/opiniao.png" class="img-responsive">
                    </div>
                    <div class="col-xs-4">
                        <img src="img/203.png" class="img-responsive">
                    </div>
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
