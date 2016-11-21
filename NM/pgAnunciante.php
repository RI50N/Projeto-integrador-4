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
                width: 500px;
                height: 600px;                
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
                    $evento->popularDadosEvento($form,$_FILES['flyer']);
                    $evento->cadastraEvento();
                    break;
            endswitch;
        }
        $usuario = Validar::UsuarioOnline();
        if ($usuario['logado']):
            $anunciante = new Anunciante();
            $anunciante->setId($usuario['idUsuario']);
            $anunciante->buscaDadosAnunciante();
            var_dump($anunciante ->getNomeResponsavel());
            ?>
            <div class="container-fluid">
                <nav class="navbar  navbar-inverse ">


                    <div class="navbar-header">
                        <a class="navbar-brand" href="#">
                            <span class="bv act aoq">
                                <img  id="brand-image"  alt="logo" src="img/bussula2.png" href="img/bussula.png" width="30" height="30" >
                            </span>Night Mess</a>


                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
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
                                                <form class="form-signin modal-header" action="pagAnunciante.php" method="post">
                                                    <div class="form-group col-sm-6">
                                                        <label for="estado">Estado*</label>
                                                        <input type="text" class="form-control" id="estado" name="estado" value="<?=$anunciante->getEstado()?>" placeholder="RS" >                                                        
                                                    </div>
                                                    <div class="form-group col-sm-6">
                                                        <label for="cidade">Cidade*</label>
                                                        <input type="text" class="form-control" id="cidade" name="cidade" value="<?=$anunciante->getCidade()?>" placeholder="Porto Alegre">                                                                      
                                                    </div>
                                                    <div class="form-group col-sm-6">
                                                        <label for="Endereco">Endereço*</label>
                                                        <input type="Endereço"  class="form-control" id="Endereco" name="Endereco" value="<?=$anunciante->getEndereco()?>" placeholder="rua de tal,n°00"> 

                                                    </div>
                                                    <div class="form-group col-sm-6">
                                                        <label for="CEP">Cep*</label>
                                                        <input type="Cep"  class="form-control" id="CEP" name="CEP" value="<?=$anunciante->getCEP()?>" placeholder="00000-000"> 

                                                    </div>
                                                    <div class="form-group col-sm-6">
                                                        <label for="bairro">Bairro*</label>
                                                        <input type="Bairro"  class="form-control" id="bairro" name="bairro" value="<?=$anunciante->getBairro()?>" placeholder="Cafundo do Judas"> 

                                                    </div>
                                                    <div class="form-group col-sm-6">
                                                        <label for="nomeResponsavel">Nome do Resposavel*</label>
                                                        <input type="text" class="form-control" id="nomeResponsavel" name="nomeResponsavel" value="<?=$anunciante->getNomeResponsavel()?>">

                                                    </div>
                                                    <div class="form-group col-sm-6">
                                                        <label for="sobrenomeResponsavel">Sobrenome do Resposavel*</label>
                                                        <input type="text" class="form-control" id="sobrenomeResponsavel" name="sobrenomeResponsavel" value="<?=$anunciante->getSobrenomeResponsavel()?>">

                                                    </div>
                                                    <div class="form-group col-sm-6">
                                                        <label for="E-mail">E-mail*</label>
                                                        <input type="email"  class="form-control" id="email" name="email" placeholder="email@exemplo.com" value="<?=$anunciante->getEmail()?>"> 
                                                    </div>
                                                    <div class="form-group col-sm-6">
                                                        <label for="telef">Telefone de contato*</label>
                                                        <input type="telef"  class="form-control" id="telef" name="telef" placeholder="(00)0000-0000" value="<?=$anunciante->getTelefoneContato()?>" > 
                                                    </div>
                                                    <div class="form-group col-sm-6">
                                                        <label for="celu">Celular/ What's App*</label>
                                                        <input type="telef"  class="form-control" id="celu" name="celu" placeholder="(00)0000-0000" value="<?=$anunciante->getWhatsapp()?>"> 
                                                    </div>
                                                    <div class="form-group col-sm-6">
                                                        <label for="senha">Nova Senha*</label>
                                                        <input type="password" name="senha" id="senha" class="form-control" placeholder="Senha" required="">
                                                    </div>
                                                    <div class="form-group col-sm-6">
                                                        <label for="senha">Confirmar Senha*</label>
                                                        <input type="password" name="senha" id="senha" class="form-control" placeholder="Senha" required="">
                                                    </div>
                                                    <br>
                                                    <div class="form-group col-sm-8">
                                                        <button type="submit" class="btn btn-primary" href="" >Alterar</button>
                                                    </div>
                                                </form> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="#">Home</a></li>                                
                            <li><a href="rolando.php">Rolando Hoje</a></li> 
                        </ul>
                    </div>

                </nav>



                <div class="container text-center">
                    <div class="row">
                        <div class="col-sm-3 well">
                            <div class="well">
                                <!-- some CSS styling changes and overrides -->
                                <style>
                                    .kv-avatar .file-preview-frame,.kv-avatar .file-preview-frame:hover {
                                        margin: 0;
                                        padding: 0;
                                        border: none;
                                        box-shadow: none;
                                        text-align: center;
                                    }
                                    .kv-avatar .file-input {
                                        display: table-cell;
                                        max-width: 220px;
                                    }
                                </style>

                                <!-- the avatar markup -->
                                <div id="kv-avatar-errors-1" class="center-block" style="width:800px;display:none"></div>
                                <form class="text-center" action="/avatar_upload.php" method="post" enctype="multipart/form-data">
                                    <div class="kv-avatar center-block" style="width:200px">
                                        <input id="avatar-1" name="avatar-1" type="file" class="file-loading">
                                    </div>
                                    <!-- include other inputs if needed and include a form submit (save) button -->
                                </form>
                                <!-- your server code `avatar_upload.php` will receive `$_FILES['avatar']` on form submission -->

                                <!-- the fileinput plugin initialization -->
                                <script>
                                    var btnCust = '<button type="button" class="btn btn-default" title="Add picture tags" ' +
                                            'onclick="alert(\'Call your custom code here.\')">' +
                                            '<i class="glyphicon glyphicon-tag"></i>' +
                                            '</button>';
                                    $("#avatar-1").fileinput({
                                        overwriteInitial: true,
                                        maxFileSize: 1500,
                                        showClose: false,
                                        showCaption: false,
                                        browseLabel: '',
                                        removeLabel: '',
                                        browseIcon: '<i class="glyphicon glyphicon-folder-open"></i>',
                                        removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
                                        removeTitle: 'Cancel or reset changes',
                                        elErrorContainer: '#kv-avatar-errors-1',
                                        msgErrorClass: 'alert alert-block alert-danger',
                                        defaultPreviewContent: '<img src="/uploads/default_avatar_male.jpg" alt="Your Avatar" style="width:160px">',
                                        layoutTemplates: {main2: '{preview} ' + btnCust + ' {remove} {browse}'},
                                        allowedFileExtensions: ["jpg", "png", "gif"]
                                    });
                                </script>
                                <p><a href="#">My Profile</a></p>
                                <img src="img/910.jpg" class="img-circle" height="65" width="65" alt="Avatar">
                            </div>
                            <div class="well">
                                <p><a href="#">Contato</a></p>
                                <p>
                                <p>Endereço: Rua de tal,n°00</p>

                            </div>

                            <p><a href="#">site do local</a></p>
                            <p><a href="#">Link</a></p>
                            <p><a href="#">Link</a></p>
                        </div>
                        <div class="col-sm-7">
                            <div class="row">
                                <div class="col-sm-12">          
                                    <div class="panel panel-default text-left">             
                                        <div class="panel-body">
                                            <form enctype="multipart/form-data"  method="post" >
                                                <input type="hidden" name="acao" value="cadastrarEvento">
                                                <input type="hidden" name="id_anunciante" value="<?=$anunciante->getIdAnunciante()?>">
                                                <div class="form-group col-sm-6">
                                                    <label for="NomeEvento">Nome do evento*</label>
                                                    <input type="NomeEvento"  class="form-control" id="nomeEvento" name="nome_evento"> 

                                                </div>
                                                <div class="form-group col-sm-6">
                                                    <label for="Horario">Horário de funcionamento*</label>
                                                    <input type="time"  class="form-control" id="horario" name="horario"> 

                                                </div>
                                                <div class="form-group col-sm-6">
                                                    <label for="Data">Data*</label>
                                                    <input type="date"  class="form-control" id="Data" name="Data"> 

                                                </div>

                                                <div class="form-group col-sm-6">                                                                                                      
                                                    <label>Selecione a Imagem*</label>
                                                    <input id="file-3" type="file" name="flyer">
                                                </div>

                                                <div class="form-group col-sm-6">
                                                <label>Descrição do evento*: </label>
                                                <br/>
                                                <textarea type="text" cols="30" rows="5" name="descricao" id="descricao" placeholder="Descreva o evento." ></textarea>
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

                            <div class="row">

                                <div class="col-sm-12">
                                    <div class="scroll">
                                        <div class="well">
                                            <p>Exemplo</p>
                                            <div class="container-fluid">
                                                <div class="col-xs-12">
                                                    <img  class="img-responsive" src="img/b1.jpg" >
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-6">
                                                        <p>Evento: </p>
                                                    </div>
                                                    <div class="col-xs-6">
                                                        <p>Horário: </p>
                                                    </div>
                                                    <div class="col-xs-6">
                                                        <p>Data: </p>
                                                    </div>
                                                    <div class="col-xs-12">
                                                        <div class="col-xs-6">                                                        
                                                            <button type="button" class="btn btn-warning">Alterar</button>
                                                        </div>
                                                        <div class="col-xs-6">                                                        
                                                            <button type="button" class="btn btn-danger">Cancelar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="well">
                                            <p>Just Forgot that I had to mention something about someone to someone about how I forgot something, but now I forgot it. Ahh, forget it! Or wait. I remember.... no I don't.</p>
                                        </div>
                                        <div class="well">
                                            <p>Just Forgot that I had to mention something about someone to someone about how I forgot something, but now I forgot it. Ahh, forget it! Or wait. I remember.... no I don't.</p>
                                        </div>
                                        <div class="well">
                                            <p>Just Forgot that I had to mention something about someone to someone about how I forgot something, but now I forgot it. Ahh, forget it! Or wait. I remember.... no I don't.</p>
                                        </div>
                                        <div class="well">
                                            <p>Just Forgot that I had to mention something about someone to someone about how I forgot something, but now I forgot it. Ahh, forget it! Or wait. I remember.... no I don't.</p>
                                        </div>
                                        <div class="well">
                                            <p>Just Forgot that I had to mention something about someone to someone about how I forgot something, but now I forgot it. Ahh, forget it! Or wait. I remember.... no I don't.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>



                        </div>
                        <div class="col-sm-2 well">
                            <div class="thumbnail">
                                <p>Proximos Eventos:</p>
                                <img src="img/b1.jpg" alt="Paris" width="400" height="300">
                                <p><strong>Estação</strong></p>
                                <p>Sexta 00 mes 2015</p>
                                <button class="btn btn-primary">Info</button>
                            </div>
                            <div class="well">
                                <p>ADS</p>
                            </div>
                            <div class="well">
                                <p>ADS</p>
                            </div>
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
