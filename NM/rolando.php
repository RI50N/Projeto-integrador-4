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
        
    </head>
    <body>        
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

                    <div class="collapse navbar-collapse" id="myNavbar">               
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="#">Home</a></li>                            
                            <li class="active"><a href="#">Rolando Hoje</a></li> 
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
