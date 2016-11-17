<!DOCTYPE html>
<html lang="pt-br">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Night Mess </title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" class="img-circle" alt="Cinque Terre" width="304" height="236" href="img/bussola.png">
</head>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="sisJs/comum.js"></script>
<script>
    function mostrar_abas(obj) {

        $('.ativo1').hide();
        $('.ativo0').hide();


        switch (obj.id)
        {

            case 'ativa':
                $('.ativo1').show();
                break

            case 'desativadas':
                $('.ativo0').show();
                break

            case 'todas':
                $('.ativo1').show();
                $('.ativo0').show();
                break

        }
    }
</script>
<script>
    function mostrar_abas_AL(obj) {
        document.getElementById('div_aba4').style.display = "none";
        switch (obj.id)
        {
            case 'mostra_aba4':
                document.getElementById('div_aba4').style.display = "block";
                break
        }
    }
</script>
<style>
    #brand-image{
        height: 25px;
    }
    #panel-MediumOrchid
    {
        background-color:#BA55D3;
    }
</style>
<body>
    <?php
    require('_app/Config.inc.php');
    if (isset($_POST['acao'])) {
        $anunciante = new Anunciante();
        
        switch ($_POST['acao']):
            case 'preCadastro':
                $anunciante->populaDados($_POST);
                $msg = $anunciante->cadastraDadosAnunciante();
                break;
            case 'alterarStatus':    
                $anunciante->setId($_POST['idAnunciante']);
                if ($_POST['status'] == 1):
                    $anunciante->ativa();
                elseif ($_POST['status'] == 2):
                    $anunciante->desativa();
                endif;
                break;
            case 'logout':
                unset($_SESSION['sistema']);
                $direcionar = 'index.php';
                header("Location: {$direcionar}");
                break;
            case 'alterarDadosAnunciante':
                $anunciante->setId($_POST['idUsuario']);
                $anunciante->populaDados($_POST);
                $anunciante->updateDadosAnunciante();
                break;
            case 'excluirAnunciante':
                $anunciante->setId($_POST['idUsuario']);
                $anunciante->deletaAnunciante();
                break;


        endswitch;
    }
    /** @var Sistema */
    if (isset($_SESSION['sistema'])):
        $sistema = unserialize($_SESSION['sistema']);
    endif;

    if (isset($sistema) && $sistema->getSession()):
        ?>
        <div class="container">
            <nav class="navbar  navbar-inverse ">
                <div class="container-fluid">

                    <div class="navbar-header ">
                        <a class="navbar-brand" href="#">
                            <span class="bv act aoq">
                                <img  id="brand-image"  alt="logo" src="img/bussula2.png" href="img/bussula.png" width="50" height="200" >
                            </span>Night Mess</a>


                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>

                    <div class="collapse navbar-collapse" id="myNavbar">
                        <ul class="nav navbar-nav navbar-right">
                            <li><a data-toggle="modal" data-target="#cadastro"><span class="glyphicon glyphicon-user"></span> Pré-Cadastro</a></li>
                            <li><a onclick="logout();"><span class="glyphicon glyphicon-log-out"></span> Sair</a></li>
                            <form id="formSair" method="post"><input type="hidden" name="acao" value="logout"></form>
                            <div class="modal fade" id="cadastro" role="dialog">
                                <div class="modal-dialog">

                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Cadastro</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="container-fluid">
                                                <form class="form-signin modal-header" method="post">
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
                                                        <input type="Endereço"  class="form-control" id="Endereço" name="endereco" > 

                                                    </div>
                                                    <div class="form-group col-sm-6">
                                                        <label for="Cep">Cep*</label>
                                                        <input type="Cep"  class="form-control" id="Cep" name="cep" placeholder="00000-000"> 

                                                    </div>
                                                    <div class="form-group col-sm-6">
                                                        <label for="Bairro">Bairro*</label>
                                                        <input type="Bairro"  class="form-control" id="Bairro" name="bairro" > 

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
                                                    <br>
                                                    <button type="submit" class="btn btn-primary" href="" >Cadastrarvar</button>
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
                </div>
            </nav>
            <br>
            <br>
            <br>
            <div class="container">
                <div class="col-sm-4 text-center container ">
                    <h2>Night Mess</h2>
                    <img src="img/bussula2.png" class="img-circle" alt="Cinque Terre" width="304" height="236" style="margin-bottom: 20px">

                </div>
               
                <div class="col-sm-8">
                    <div class="panel panel-primary bnt-primary test">
                        <div class="panel-heading">Contas</div>
                    </div>

                    <div class="col-md-3">
                        <button class="btn btn-sm btn-primary btn-block" type="submit" onclick="mostrar_abas(this);" id="todas" >Todas as contas</button>
                    </div> 

                    <div class="col-md-3">
                        <button class="btn btn-sm btn-primary btn-block" type="submit" onclick="mostrar_abas(this);" id="ativas" >Ativadas</button>
                    </div>

                    <div class="col-md-3"> 
                        <button class="btn btn-sm btn-primary btn-block" type="submit" onclick="mostrar_abas(this);" id="desativadas">Desativadas</button>
                    </div>

                    <div class="col-md-2"> 
                        <form class="form-search">
                            <input class="form-control " id="ex1" type="text">

                            </div>	

                            <div class="col-md-1">
                                <button type="submit" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-search"></span></button></input>
                        </form>
                    </div>

                    <br><br>

                    <table border="1" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nome Cliente</th>
                                <th>Status</th>
                                <th>Alterar Dados do Cliente</th>
                                <th>Excluir</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $listaAnunciantes = new Anunciante();
                            $anunciantes = $listaAnunciantes->buscaDadosAnunciante();
                            for ($i = 0; $i < count($anunciantes); $i++):
                                ?>
                                <tr class="info ativo<?= $anunciantes[$i]['ativo'] ?>">
                                    <td><?php echo $anunciantes[$i]['nomeResponsavel'] . $anunciantes[$i]['sobrenomeResponsavel']; ?></td>
                                    <td><a data-toggle="modal" data-target="#myModal<?= $anunciantes[$i]['id'] ?>"><?php
                                            if ($anunciantes[$i]['ativo'] == 1) {
                                                echo 'Ativo';
                                            } else {
                                                echo 'Inativo';
                                            }
                                            ?></a>
                                        <div class="modal fade" id="myModal<?= $anunciantes[$i]['id'] ?>" role="dialog">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title">Status <?= $anunciantes[$i]['nomeResponsavel'] ?></h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="container-fluid">
                                                            <form method="post">
                                                                <input type="hidden" name="acao" value="alterarStatus">
                                                                <input type="hidden" name="idAnunciante" value="<?= $anunciantes[$i]['id'] ?>">
                                                                <label class="radio-inline"><input type="radio" name="status" <?php
                                                                    if ($anunciantes[$i]['ativo'] == 1) {
                                                                        echo ' selected ';
                                                                    }
                                                                    ?> value="1">Ativar</label>
                                                                <label class="radio-inline"><input type="radio" name="status" <?php
                                                                    if ($anunciantes[$i]['ativo'] == 0) {
                                                                        echo ' selected ';
                                                                    }
                                                                    ?> value="2">Desativar</label>
                                                                <br>
                                                                <button type="submit" class="btn btn-primary">Salvar</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>							
                                    </td>
                                    <td><a data-toggle="modal" data-target="#myModalDados<?= $anunciantes[$i]['id'] ?>">Alterar Dados</a>
                                        <div class="modal fade" id="myModalDados<?= $anunciantes[$i]['id'] ?>" role="dialog">
                                            <div class="modal-dialog">

                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title">Alteração de Dados</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="container-fluid">
                                                            <form class="form-signin modal-header" method="POST">
                                                                <input type="hidden" name="idUsuario" value="<?= $anunciantes[$i]['id_user'] ?>">
                                                                <input type="hidden" name="acao" value="alterarDadosAnunciante">
                                                                <label for="NomeE">Nome da Empresa*</label>
                                                                <input type="text" class="form-control" value="<?= $anunciantes[$i]['nomeEmpresa'] ?>" id="NomeE" name="nomeEmpresa" >
                                                                <br>
                                                                <label for="Nomef">Nome Fantasia*</label>
                                                                <input type="text" class="form-control" id="Nomef" name="nomeFantasia" value="<?= $anunciantes[$i]['nomeFantasia'] ?>">
                                                                <br>
                                                                <div class="form-group col-sm-6">
                                                                    <label for="CNPJ">CNPJ*</label>
                                                                    <input type="CNPJ"  class="form-control" id="CNPJ" name="cnpj" placeholder="00.000.000/0000-00" value="<?= $anunciantes[$i]['cnpj'] ?>"> 
                                                                </div>
                                                                <div class="form-group col-sm-6">
                                                                    <label for="Estado">Estado*</label>
                                                                    <input type="text" class="form-control" id="estados" name="estado"  placeholder="RS" value="<?= $anunciantes[$i]['estado'] ?>" >                                                                                
                                                                </div>
                                                                <div class="form-group col-sm-6">
                                                                    <label for="Cidade">Cidade*</label>
                                                                    <input type="text" class="form-control" id="cidade" name="cidade" placeholder="Porto Alegre" value="<?= $anunciantes[$i]['cidade'] ?>">                                                                      
                                                                </div>
                                                                <div class="form-group col-sm-6">
                                                                    <label for="Endereço">Endereço*</label>
                                                                    <input type="Endereço"  class="form-control" id="Endereço" name="endereco" placeholder="rua de tal,n°00" value="<?= $anunciantes[$i]['endereco'] ?>"> 
                                                                </div>
                                                                <div class="form-group col-sm-6">
                                                                    <label for="Cep">Cep*</label>
                                                                    <input type="Cep"  class="form-control" id="Cep" name="cep" placeholder="00000-000" value="<?= $anunciantes[$i]['cep'] ?>"> 
                                                                </div>
                                                                <div class="form-group col-sm-6">
                                                                    <label for="Bairro">Bairro*</label>
                                                                    <input type="Bairro"  class="form-control" id="Bairro" name="bairro" placeholder="Cafundo do Judas" value="<?= $anunciantes[$i]['bairro'] ?>"> 
                                                                </div>
                                                                <div class="form-group col-sm-6">
                                                                    <label for="Nomer">Nome do Resposavel*</label>
                                                                    <input type="text" class="form-control" id="nomer" name="nomeResponsavel" value="<?= $anunciantes[$i]['nomeResponsavel'] ?>">
                                                                </div>
                                                                <div class="form-group col-sm-6">
                                                                    <label for="sobrenomer">Sobrenome do Resposavel*</label>
                                                                    <input type="text" class="form-control" id="sobrenomer" name="sobrenomeResponsavel" value="<?= $anunciantes[$i]['sobrenomeResponsavel'] ?>">

                                                                </div>
                                                                <div class="form-group col-sm-6">
                                                                    <label for="E-mail">E-mail*</label>
                                                                    <input type="email"  class="form-control" id="email" name="email" placeholder="email@exemplo.com" value="<?= $anunciantes[$i]['email'] ?>"> 
                                                                </div>
                                                                <div class="form-group col-sm-6">
                                                                    <label for="telef">Telefone de contato*</label>
                                                                    <input type="telef"  class="form-control" id="telefone" name="telefoneContato" placeholder="(00)0000-0000" value="<?= $anunciantes[$i]['telefoneContato'] ?>"> 
                                                                </div>
                                                                <div class="form-group col-sm-6">
                                                                    <label for="celu">Celular/ whatsapp*</label>
                                                                    <input type="telef"  class="form-control" id="celular" name="whatsapp" placeholder="(00)0000-0000" value="<?= $anunciantes[$i]['whatsapp'] ?>"> 
                                                                </div>
                                                                <button type="submit" class="btn btn-primary" href="" >Alterar</button>
                                                            </form>
                                                        </div>	
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>

                                            </div>
                                    </td>
                                    <td>
                                        <form method="post">
                                            <input type="hidden" name="acao" value="excluirAnunciante">
                                            <input type="hidden" name="idUsuario" value="<?= $anunciantes[$i]['id_user'] ?>">
                                            <Button type="submit" name="excluir" alt="Excluir" title="Excluir" class="btn btn-primary" > X </Button>
                                        </form>

                                    </td>
                                </tr>
                                <?php
                            endfor;
                            ?>
                        </tbody>
                    </table>

                </div>
            </div>
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
        echo 'não esta logado';
    endif;
    ?>
</body>
</html>