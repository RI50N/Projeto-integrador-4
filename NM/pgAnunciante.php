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
        <script src="sisJs/comum.js"></script>
        <link href="css/fileinput.css" media="all" rel="stylesheet" type="text/css" />
        <script src="js/fileinput.js" type="text/javascript"></script>
        <script src="js/fileinput_locale_fr.js" type="text/javascript"></script>
        <script src="js/fileinput_locale_es.js" type="text/javascript"></script>
        <style>
            #brand-image{
                height: 25px;
            }
        </style>
    </head>
    <body>
        <style>
            div.scroll {
                background-color:  #1E88E5;
                height: 600px;               
                overflow-y: scroll;
            }
            div.scroll2 {                
                height: 150px;               
                overflow-y: scroll;
            }
        </style>

        <?php
        require('_app/Config.inc.php');
        $form = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (isset($form['acao'])) {
            switch ($form['acao']):
                case 'logout':
                    $sistema = unserialize($_SESSION['sistema']);
                    $sistema->logOut();
                    unset($_SESSION['sistema']);
                    $direcionar = 'index.php';
                    header("Location: {$direcionar}");
                    break;
                case 'cadastrarEvento':
                    $evento = new Evento();
                    $evento->popularDadosEvento($form, $_FILES['flyer']);
                    $msg = $evento->cadastraEvento();
                    break;
                case 'updateEvento':
                    $evento = new Evento();
                    $evento->setId($form['id_evento']);
                    if (isset($_FILES['flyer2'])):
                        $evento->popularDadosEvento($form, $_FILES['flyer2']);
                    else:
                        $evento->popularDadosEvento($form);
                    endif;
                    $msg = $evento->updateEvento();
                    break;
                case 'cancelarEvento':
                    $evento = new Evento();
                    $evento->setId($form['id_evento']);
                    $msg = $evento->cancelar();
                    break;
                case 'ativarEvento':
                    $evento = new Evento();
                    $evento->setId($form['id_evento']);
                    $msg = $evento->ativar();
                    break;
                case 'alterarDadosAnunciante':
                    var_dump($form);
                    if (!empty($form['cep']) &&
                            !empty($form['cnpj']) &&
                            !empty($form['endereco']) &&
                            !empty($form['bairro']) &&
                            !empty($form['email']) &&
                            !empty($form['nomeEmpresa']) &&
                            !empty($form['nomeFantasia']) &&
                            !empty($form['nomeResponsavel']) &&
                            !empty($form['estado']) &&
                            !empty($form['cidade']) &&
                            !empty($form['telefoneContato'])):
                        $anunciante = new Anunciante();
                        $anunciante->setId($form['idUsuario']);
                        $anunciante->populaDados($form);
                        $msg = $anunciante->updateDadosAnunciante();
                    else:
                        $msg = 'Campo obrigatorio não preenchido';
                    endif;
                    break;
                case 'rolando':
                    header("Location: rolando.php");
                    break;
            endswitch;
        }
        $usuario = Validar::UsuarioOnline();
        if ($usuario['logado']):
            $anunciante = new Anunciante();
            $anunciante->setId($usuario['idUsuario']);
            $anunciante->buscaDadosAnunciante();
            $eventosAnunciante = $anunciante->listarEventosAnunciante();
            $rolandoHoje = Evento::rolandoHoje();
            ?>
            <div class="container-fluid">
                <nav class="navbar  navbar-inverse ">


                    <div class="navbar-header">
                        <a class="navbar-brand" href="#">
                            <span class="bv act aoq">
                                <img  id="brand-image"  alt="logo" src="img/bussula2.png"  >
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
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="col-sm-6">
                                            <h4>Aviso</h4>
                                        </div>
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>  
                                        </div>
                                    </div>


                                    <div class="col-sm-12">                                
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
                        </div>
                    </div>
                    <div class="collapse navbar-collapse" id="myNavbar">
                        <ul class="nav navbar-nav navbar-right">
                            <li><a data-toggle="modal" data-target="#alterardados"><span class="glyphicon glyphicon-user"></span> Alterar Dados</a></li>
                            <li><a onclick="logout();"><span class="glyphicon glyphicon-log-out"></span> Sair</a></li>
                            <form id="formSair" method="post"><input type="hidden" name="acao" value="logout"></form>
                            <div class="modal fade" id="alterardados" role="dialog">
                                <div class="modal-dialog">

                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Alterar dados</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="container-fluid">
                                                <form class="form-signin modal-header" method="POST">
                                                    <input type="hidden" name="idUsuario" value="<?= $anunciante->getIdUsuario() ?>">
                                                    <input type="hidden" name="acao" value="alterarDadosAnunciante">
                                                    <label for="NomeE">Nome da Empresa*</label>
                                                    <input type="text" class="form-control" value="<?= $anunciante->getNomeEmpresa() ?>" id="NomeE" name="nomeEmpresa" >
                                                    <br>
                                                    <label for="Nomef">Nome Fantasia*</label>
                                                    <input type="text" class="form-control" id="Nomef" name="nomeFantasia" value="<?= $anunciante->getNomeFantasia() ?>">
                                                    <br>
                                                    <div class="form-group col-sm-6">
                                                        <label for="CNPJ">CNPJ*</label>
                                                        <input type="CNPJ"  class="form-control" id="CNPJ" name="cnpj" placeholder="00.000.000/0000-00" value="<?= $anunciante->getCNPJ() ?>"> 
                                                    </div>
                                                    <div class="form-group col-sm-6">
                                                        <label for="Estado">Estado*</label>
                                                        <input type="text" class="form-control" id="estados" name="estado"  placeholder="RS" value="<?= $anunciante->getEstado() ?>" >                                                                                
                                                    </div>
                                                    <div class="form-group col-sm-6">
                                                        <label for="Cidade">Cidade*</label>
                                                        <input type="text" class="form-control" id="cidade" name="cidade" placeholder="Porto Alegre" value="<?= $anunciante->getCidade() ?>">                                                                      
                                                    </div>
                                                    <div class="form-group col-sm-6">
                                                        <label for="Endereço">Endereço*</label>
                                                        <input type="Endereço"  class="form-control" id="Endereço" name="endereco" placeholder="rua de tal,n°00" value="<?= $anunciante->getEndereco() ?>"> 
                                                    </div>
                                                    <div class="form-group col-sm-6">
                                                        <label for="Cep">Cep*</label>
                                                        <input type="Cep"  class="form-control" id="Cep" name="cep" placeholder="00000-000" value="<?= $anunciante->getCEP() ?>"> 
                                                    </div>
                                                    <div class="form-group col-sm-6">
                                                        <label for="Bairro">Bairro*</label>
                                                        <input type="Bairro"  class="form-control" id="Bairro" name="bairro" placeholder="Cafundo do Judas" value="<?= $anunciante->getBairro() ?>"> 
                                                    </div>
                                                    <div class="form-group col-sm-6">
                                                        <label for="Nomer">Nome do Resposavel*</label>
                                                        <input type="text" class="form-control" id="nomer" name="nomeResponsavel" value="<?= $anunciante->getNomeResponsavel() ?>">
                                                    </div>
                                                    <div class="form-group col-sm-6">
                                                        <label for="sobrenomer">Sobrenome do Resposavel*</label>
                                                        <input type="text" class="form-control" id="sobrenomer" name="sobrenomeResponsavel" value="<?= $anunciante->getSobrenomeResponsavel() ?>">

                                                    </div>
                                                    <div class="form-group col-sm-6">
                                                        <label for="E-mail">E-mail*</label>
                                                        <input type="email"  class="form-control" id="email" name="email" placeholder="email@exemplo.com" value="<?= $anunciante->getEmail() ?>"> 
                                                    </div>
                                                    <div class="form-group col-sm-6">
                                                        <label for="telef">Telefone de contato*</label>
                                                        <input type="telef"  class="form-control" id="telefone" name="telefoneContato" placeholder="(00)0000-0000" value="<?= $anunciante->getTelefoneContato() ?>"> 
                                                    </div>
                                                    <div class="form-group col-sm-6">
                                                        <label for="celu">Celular/ whatsapp*</label>
                                                        <input type="telef"  class="form-control" id="celular" name="whatsapp" placeholder="(00)0000-0000" value="<?= $anunciante->getWhatsapp() ?>"> 
                                                    </div>
                                                    <div class="form-group col-sm-8">
                                                        <button type="submit" class="btn btn-primary" href="" >Alterar</button>
                                                    </div>
                                                </form>
                                            </div>	
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </ul>
                        <form id="RolandForm" method="post">
                            <input type="hidden" name="acao" value="rolando">
                        </form>
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="#">Home</a></li>                                
                            <li><a id="Rolando">Rolando Hoje</a></li> 

                            <script>
                                $(document).ready(function () {
                                    $('#Rolando').click(function () {
                                        $('#RolandForm').submit();
                                    });
                                });
                            </script>
                        </ul>
                    </div>

                </nav>



                <div class="container text-center">
                    <div class="row">
                        <div class="col-sm-3 well">



                            <div class="well">
                                <p><b>Meus dados</b></p>

                                <p>Nome da Empresa: <?= $anunciante->getNomeEmpresa() ?></p>
                                <p>Nome Fantasia: <?= $anunciante->getNomeFantasia() ?></p>
                                <p>CNPJ: <?= $anunciante->getCNPJ() ?></p>
                                <p>Estado: <?= $anunciante->getEstado() ?></p>
                                <p>Cidade: <?= $anunciante->getCidade() ?></p>
                                <p>Endereço: <?= $anunciante->getEndereco() ?></p>
                                <p>Cep: <?= $anunciante->getCEP() ?></p>
                                <p>Bairro: <?= $anunciante->getBairro() ?></p>
                                <p>Nome do Resposavel: <?= $anunciante->getNomeResponsavel() . ' ' . $anunciante->getSobrenomeResponsavel() ?></p>
                                <p>E-mail: <?= $anunciante->getEmail() ?></p>
                                <p>Telefone de contato: <?= $anunciante->getTelefoneContato() ?></p>
                                <p>Celular/ whatsapp: <?= $anunciante->getWhatsapp() ?></p>
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="row">
                                <div class="col-sm-12">          
                                    <div class="panel panel-default text-left">             
                                        <div class="panel-body">
                                            <form enctype="multipart/form-data"  method="post" >
                                                <input type="hidden" name="acao" value="cadastrarEvento">
                                                <input type="hidden" name="id_anunciante" value="<?= $anunciante->getIdAnunciante() ?>">
                                                <div class="form-group col-sm-6">
                                                    <label for="NomeEvento">Nome do evento*</label>
                                                    <input type="NomeEvento"  class="form-control" id="nomeEvento" name="nome_evento"> 

                                                </div>
                                                <div class="form-group col-sm-6">
                                                    <label for="Data">Data e harário de funcionamento*</label>
                                                    <input type="datetime-local"  class="form-control" id="data" name="data"> 
                                                </div>
                                                <div class="form-group col-sm-6">                                                                                                      
                                                    <label>Selecione a Imagem*</label>
                                                    <input id="file-3" type="file" name="flyer">
                                                </div>
                                                <div class="form-group col-sm-6 scroll2">
                                                    <label>Descrição do evento*: </label>
                                                    <br/>
                                                    <textarea class="form-control" type="text" cols="30" rows="5" name="descricao" id="descricao" placeholder="Descreva o evento." ></textarea>
                                                </div>
                                                <br/>
                                                <div class="form-group col-sm-12">
                                                    <center><button type="submit" class="btn btn-primary" name="submit" ><b>Publicar</b></button>
                                                        <button type="reset" class="btn btn-default" name="reset" value="Limpar"><b>Limpar</b></button></center>
                                                </div>
                                            </form>                                            
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="scroll col-sm-12">
                                <div class="row">                                   


                                    <?php
                                    for ($i = 0; $i < count($eventosAnunciante); $i++):
                                        ?>
                                        <div class="well">
                                            <div class="container-fluid">
                                                <div class="col-xs-12">
                                                    <?= Validar::Image($eventosAnunciante[$i]['id'], $eventosAnunciante[$i]['nome_evento'], 1024, 600) ?>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-6">
                                                        <p>Evento: <?= $eventosAnunciante[$i]['nome_evento'] ?></p>
                                                    </div>
                                                    <div class="col-xs-6">
                                                        <p>Data/Horário: <?= $eventosAnunciante[$i]['data'] ?></p>
                                                    </div>
                                                    <div class="col-xs-12">
                                                        <div class="col-xs-6">  
                                                            <button type="button" data-toggle="modal" data-target="#alterarEvento<?= $eventosAnunciante[$i]['id'] ?>" class="btn btn-warning"> Alterar Evento</button>
                                                            <div class="modal fade" id="alterarEvento<?= $eventosAnunciante[$i]['id'] ?>" role="dialog">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                            <h4 class="modal-title">Alterar Evento</h4>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="container-fluid">
                                                                                <form enctype="multipart/form-data" class="form-signin modal-header" method="post">
                                                                                    <input type="hidden" name="id_evento" value="<?= $eventosAnunciante[$i]['id'] ?>">
                                                                                    <input type="hidden" name="acao" value="updateEvento">
                                                                                    <div class="form-group col-sm-6">
                                                                                        <label for="evento">Nome do evento*</label>
                                                                                        <input type="text" class="form-control" id="evento" name="nome_evento" value="<?= $eventosAnunciante[$i]['nome_evento'] ?>">                                                        
                                                                                    </div>
                                                                                    <div class="form-group col-sm-6">
                                                                                        <label for="Data">Data/Horário*</label>
                                                                                        <?php $date = (new DateTime($eventosAnunciante[$i]['data']))->format('d/m/Y H:i'); ?>
                                                                                        <input type="datetime-local"  class="form-control" id="data" name="data"><?= $date ?></input>                                                                     
                                                                                    </div>  
                                                                                    <div class="form-group col-sm-6">                                                                                                      
                                                                                        <label>Selecione a Imagem*</label>
                                                                                        <input type="file" name="flyer2">
                                                                                    </div>
                                                                                    <div class="form-group col-sm-6 scroll2">
                                                                                        <label>Descrição do evento*: </label>
                                                                                        <br/>
                                                                                        <textarea class="form-control" type="text" cols="20" rows="5" name="descricao" id="descricao" ><?= $eventosAnunciante[$i]['descricao'] ?></textarea>
                                                                                    </div>
                                                                                    <div class="form-group col-sm-8">
                                                                                        <button type="submit" class="btn btn-primary" href="" >Alterar</button>
                                                                                    </div>
                                                                                </form> 
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>                                                            
                                                        </div>
                                                        <?php
                                                        if ($eventosAnunciante[$i]['cancelado'] == 0):
                                                            ?>
                                                            <form method="post">
                                                                <input type="hidden" name="id_evento" value="<?= $eventosAnunciante[$i]['id'] ?>">
                                                                <input type="hidden" name="acao" value="cancelarEvento">
                                                                <div class="col-xs-6">                                                        
                                                                    <button type="submit" class="btn btn-danger">cancelar</button>
                                                                </div>
                                                            </form>
                                                            <?php
                                                        else:
                                                            ?>    
                                                            <form method="post">
                                                                <input type="hidden" name="id_evento" value="<?= $eventosAnunciante[$i]['id'] ?>">
                                                                <input type="hidden" name="acao" value="ativarEvento">
                                                                <div class="col-xs-6">                                                        
                                                                    <button type="submit" class="btn btn-danger">ativar</button>
                                                                </div>
                                                            </form>
                                                        <?php
                                                        endif;
                                                        ?>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    endfor;
                                    ?>


                                </div>


                            </div>
                        </div>

                        <div class="col-sm-2 well">
                            <p>Proximos Eventos:</p>
                            <?php
                            for ($i = 0; $i < count($rolandoHoje); $i++):
                                ?>
                                <div class="thumbnail">
                                    <?= Validar::Image($rolandoHoje[$i]['id'], $rolandoHoje[$i]['nome_evento'], 400, 300) ?>
                                    <p><strong><?= $rolandoHoje[$i]['nome_evento'] ?></strong></p>
                                    <p> <?= $rolandoHoje[$i]['data'] ?></p>
                                </div>
                                <?php
                            endfor;
                            ?>
                        </div>
                    </div>
                </div>
                <hr>
                <footer>
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
            <?php
        else:
            echo $usuario['msg'];
        endif;
        ?>
        <script>
            $('#file-fr').fileinput({
                language: 'fr',
                uploadUrl: '#',
                allowedFileExtensions: ['jpg', 'png', 'gif'],
            });
            $('#file-es').fileinput({
                language: 'es',
                uploadUrl: '#',
                allowedFileExtensions: ['jpg', 'png', 'gif'],
            });
            $("#file-0").fileinput({
                'allowedFileExtensions': ['jpg', 'png', 'gif'],
            });
            $("#file-1").fileinput({
                uploadUrl: '#', // you must set a valid URL here else you will get an error
                allowedFileExtensions: ['jpg', 'png', 'gif'],
                overwriteInitial: false,
                maxFileSize: 1000,
                maxFilesNum: 10,
//allowedFileTypes: ['image', 'video', 'flash'],
                slugCallback: function (filename) {
                    return filename.replace('(', '_').replace(']', '_');
                }
            });
            /*
             $(".file").on('fileselect', function(event, n, l) {
             alert('File Selected. Name: ' + l + ', Num: ' + n);
             });
             */
            $("#file-3").fileinput({
                showUpload: false,
                showCaption: false,
                browseClass: "btn btn-primary btn-lg",
                fileType: "any",
                previewFileIcon: "<i class='glyphicon glyphicon-king'></i>"
            });
            $("#file-4").fileinput({
                uploadExtraData: {kvId: '10'}
            });
            $(".btn-warning").on('click', function () {
                if ($('#file-4').attr('disabled')) {
                    $('#file-4').fileinput('enable');
                } else {
                    $('#file-4').fileinput('disable');
                }
            });
            $(".btn-info").on('click', function () {
                $('#file-4').fileinput('refresh', {previewClass: 'bg-info'});
            });
            /*
             $('#file-4').on('fileselectnone', function() {
             alert('Huh! You selected no files.');
             });
             $('#file-4').on('filebrowse', function() {
             alert('File browse clicked for #file-4');
             });
             */
            $(document).ready(function () {
                $("#test-upload").fileinput({
                    'showPreview': false,
                    'allowedFileExtensions': ['jpg', 'png', 'gif'],
                    'elErrorContainer': '#errorBlock'
                });
                /*
                 $("#test-upload").on('fileloaded', function(event, file, previewId, index) {
                 alert('i = ' + index + ', id = ' + previewId + ', file = ' + file.name);
                 });
                 */
            });
        </script>
    </body>
