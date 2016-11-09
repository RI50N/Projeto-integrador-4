<!DOCTYPE html>
<html lang="pt-br">
	<meta charset="utf-8">
	<title>Night Mess </title>
		<link href="css/bootstrap.min.css" rel="stylesheet">
		
		<link rel="icon" class="img-circle" alt="Cinque Terre" width="304" height="236" href="img/bussola.png">
	</head>
	
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
  <style>
    /* Set black background color, white text and some padding */
    footer {
      background-color: #555;
      color: white;
      padding: 15px;
    }
  </style>
</head>
<body class="container">
		<nav class="navbar  navbar-inverse ">
			<div class="container-fluid">
			
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
                                <li><a href="index.php"><span class="glyphicon glyphicon-log-out"></span> Sair</a></li>
				
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
													<label for="Endereço">Endereço*</label>
													<input type="Endereço"  class="form-control" id="Endereço" name="Endereço" placeholder="rua de tal,n°00"> 
													
													</div>
													<div class="form-group col-sm-6">
													<label for="Cep">Cep*</label>
													<input type="Cep"  class="form-control" id="Cep" name="Cep" placeholder="00000-000"> 
													
													</div>
													<div class="form-group col-sm-6">
													<label for="Bairro">Bairro*</label>
													<input type="Bairro"  class="form-control" id="Bairro" name="Bairro" placeholder="Cafundo do Judas"> 
													
													</div>
													<div class="form-group col-sm-6">
													<label for="Nomer">Nome do Resposavel*</label>
													<input type="text" class="form-control" id="nomer" name="nomer">
													
													</div>
													<div class="form-group col-sm-6">
													<label for="sobrenomer">Sobrenome do Resposavel*</label>
													<input type="text" class="form-control" id="sobrenomer" name="sobrenomer">
													
													</div>
													<div class="form-group col-sm-6">
													<label for="E-mail">E-mail*</label>
													<input type="email"  class="form-control" id="email" name="email" placeholder="email@exemplo.com"> 
													</div>
													<div class="form-group col-sm-6">
													<label for="telef">Telefone de contato*</label>
													<input type="telef"  class="form-control" id="telef" name="telef" placeholder="(00)0000-0000"> 
													</div>
													<div class="form-group col-sm-6">
													<label for="celu">Celular/ What's App*</label>
													<input type="telef"  class="form-control" id="celu" name="celu" placeholder="(00)0000-0000"> 
													</div>
													<div class="form-group col-sm-6">
													<label for="senha">Nova Senha*</label>
													<input type="password" name="senha" id="senha" class="form-control" placeholder="Senha" required="" name="senha">
													</div>
													<div class="form-group col-sm-6">
													<label for="senha">Confirmar Senha*</label>
													<input type="password" name="senha" id="senha" class="form-control" placeholder="Senha" required="" name="senha">
													</div>
													<br>
													<button type="submit" class="btn btn-primary" href="" >Cadastrar-se</button>
													</form> 
												</div>
											</div>
										</div>
									</div>
								</div>
				</ul>
				<ul class="nav navbar-nav navbar-right">
				<li class="active"><a href="#">Home</a></li>
				<li><a href="#">Promotores</a></li>
				<li><a href="#">Rolando Hoje</a></li> 
			</ul>
			</div>
			</div>
		</nav>

    
     
<div class="container text-center">
  <div class="row">
    <div class="col-sm-3 well">
      <div class="well">
        <p><a href="#">My Profile</a></p>
        <img src="img/910.jpg" class="img-circle" height="65" width="65" alt="Avatar">
      </div>
      <div class="well">
        <p><a href="#">Contato</a></p>
        <p>
          <p>Endereço: Rua de tal,n°00</p>
		  
        </p>
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
              <p contenteditable="true">Status: Feeling Blue</p>
              <button type="button" class="btn btn-default btn-sm">
                <span class="glyphicon glyphicon-thumbs-up"></span> Like
              </button>
            </div>
          </div>
        </div>
      </div>
      
      <div class="row">
        <div class="col-sm-3">
          <div class="well">
           <p>John</p>
           <img src="bird.jpg" class="img-circle" height="55" width="55" alt="Avatar">
          </div>
        </div>
        <div class="col-sm-9">
          <div class="well">
            <p>Just Forgot that I had to mention something about someone to someone about how I forgot something, but now I forgot it. Ahh, forget it! Or wait. I remember.... no I don't.</p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-3">
          <div class="well">
           <p>Bo</p>
           <img src="bandmember.jpg" class="img-circle" height="55" width="55" alt="Avatar">
          </div>
        </div>
        <div class="col-sm-9">
          <div class="well">
            <p>Just Forgot that I had to mention something about someone to someone about how I forgot something, but now I forgot it. Ahh, forget it! Or wait. I remember.... no I don't.</p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-3">
          <div class="well">
           <p>Jane</p>
           <img src="bandmember.jpg" class="img-circle" height="55" width="55" alt="Avatar">
          </div>
        </div>
        <div class="col-sm-9">
          <div class="well">
            <p>Just Forgot that I had to mention something about someone to someone about how I forgot something, but now I forgot it. Ahh, forget it! Or wait. I remember.... no I don't.</p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-3">
          <div class="well">
           <p>Anja</p>
           <img src="bird.jpg" class="img-circle" height="55" width="55" alt="Avatar">
          </div>
        </div>
        <div class="col-sm-9">
          <div class="well">
            <p>Just Forgot that I had to mention something about someone to someone about how I forgot something, but now I forgot it. Ahh, forget it! Or wait. I remember.... no I don't.</p>
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

<footer class="container-fluid text-center">
  <p>Footer Text</p>
</footer>

</body>
</html>

=======
<!DOCTYPE html>
<html lang="pt-br">
	<meta charset="utf-8">
	<title>Night Mess </title>
		<link href="css/bootstrap.min.css" rel="stylesheet">
		
		<link rel="icon" class="img-circle" alt="Cinque Terre" width="304" height="236" href="img/bussola.png">
	</head>
	
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
  <style>
    /* Set black background color, white text and some padding */
    footer {
      background-color: #555;
      color: white;
      padding: 15px;
    }
  </style>
</head>
<body class="container">
		<nav class="navbar  navbar-inverse ">
			<div class="container-fluid">
			
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
				<li><a href="new1.html"><span class="glyphicon glyphicon-log-out"></span> Sair</a></li>
				
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
													<label for="Endereço">Endereço*</label>
													<input type="Endereço"  class="form-control" id="Endereço" name="Endereço" placeholder="rua de tal,n°00"> 
													
													</div>
													<div class="form-group col-sm-6">
													<label for="Cep">Cep*</label>
													<input type="Cep"  class="form-control" id="Cep" name="Cep" placeholder="00000-000"> 
													
													</div>
													<div class="form-group col-sm-6">
													<label for="Bairro">Bairro*</label>
													<input type="Bairro"  class="form-control" id="Bairro" name="Bairro" placeholder="Cafundo do Judas"> 
													
													</div>
													<div class="form-group col-sm-6">
													<label for="Nomer">Nome do Resposavel*</label>
													<input type="text" class="form-control" id="nomer" name="nomer">
													
													</div>
													<div class="form-group col-sm-6">
													<label for="sobrenomer">Sobrenome do Resposavel*</label>
													<input type="text" class="form-control" id="sobrenomer" name="sobrenomer">
													
													</div>
													<div class="form-group col-sm-6">
													<label for="E-mail">E-mail*</label>
													<input type="email"  class="form-control" id="email" name="email" placeholder="email@exemplo.com"> 
													</div>
													<div class="form-group col-sm-6">
													<label for="telef">Telefone de contato*</label>
													<input type="telef"  class="form-control" id="telef" name="telef" placeholder="(00)0000-0000"> 
													</div>
													<div class="form-group col-sm-6">
													<label for="celu">Celular/ What's App*</label>
													<input type="telef"  class="form-control" id="celu" name="celu" placeholder="(00)0000-0000"> 
													</div>
													<div class="form-group col-sm-6">
													<label for="senha">Nova Senha*</label>
													<input type="password" name="senha" id="senha" class="form-control" placeholder="Senha" required="" name="senha">
													</div>
													<div class="form-group col-sm-6">
													<label for="senha">Confirmar Senha*</label>
													<input type="password" name="senha" id="senha" class="form-control" placeholder="Senha" required="" name="senha">
													</div>
													<br>
													<button type="submit" class="btn btn-primary" href="" >Cadastrar-se</button>
													</form> 
												</div>
											</div>
										</div>
									</div>
								</div>
				</ul>
				<ul class="nav navbar-nav navbar-right">
				<li class="active"><a href="#">Home</a></li>
				<li><a href="#">Promotores</a></li>
				<li><a href="#">Rolando Hoje</a></li> 
			</ul>
			</div>
			</div>
		</nav>

    
     
<div class="container text-center">
  <div class="row">
    <div class="col-sm-3 well">
      <div class="well">
        <p><a href="#">My Profile</a></p>
        <img src="img/910.jpg" class="img-circle" height="65" width="65" alt="Avatar">
      </div>
      <div class="well">
        <p><a href="#">Contato</a></p>
        <p>
          <p>Endereço: Rua de tal,n°00</p>
		  
        </p>
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
              <p contenteditable="true">Status: Feeling Blue</p>
              <button type="button" class="btn btn-default btn-sm">
                <span class="glyphicon glyphicon-thumbs-up"></span> Like
              </button>
            </div>
          </div>
        </div>
      </div>
      
      <div class="row">
        <div class="col-sm-3">
          <div class="well">
           <p>John</p>
           <img src="bird.jpg" class="img-circle" height="55" width="55" alt="Avatar">
          </div>
        </div>
        <div class="col-sm-9">
          <div class="well">
            <p>Just Forgot that I had to mention something about someone to someone about how I forgot something, but now I forgot it. Ahh, forget it! Or wait. I remember.... no I don't.</p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-3">
          <div class="well">
           <p>Bo</p>
           <img src="bandmember.jpg" class="img-circle" height="55" width="55" alt="Avatar">
          </div>
        </div>
        <div class="col-sm-9">
          <div class="well">
            <p>Just Forgot that I had to mention something about someone to someone about how I forgot something, but now I forgot it. Ahh, forget it! Or wait. I remember.... no I don't.</p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-3">
          <div class="well">
           <p>Jane</p>
           <img src="bandmember.jpg" class="img-circle" height="55" width="55" alt="Avatar">
          </div>
        </div>
        <div class="col-sm-9">
          <div class="well">
            <p>Just Forgot that I had to mention something about someone to someone about how I forgot something, but now I forgot it. Ahh, forget it! Or wait. I remember.... no I don't.</p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-3">
          <div class="well">
           <p>Anja</p>
           <img src="bird.jpg" class="img-circle" height="55" width="55" alt="Avatar">
          </div>
        </div>
        <div class="col-sm-9">
          <div class="well">
            <p>Just Forgot that I had to mention something about someone to someone about how I forgot something, but now I forgot it. Ahh, forget it! Or wait. I remember.... no I don't.</p>
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

<footer class="container-fluid text-center">
  <p>Footer Text</p>
</footer>

</body>
</html>
