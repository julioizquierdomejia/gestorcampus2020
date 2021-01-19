<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">



    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="{{ asset('/css/campus.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/app.css') }}">

    <title>Campus Aspefam</title>
  </head>
  <body>
    <div class="contenedor navheader d-flex justify-content-end">
        <nav>

            @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/home') }}" class="btn btn-primary">Inicio</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary">Acceder</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-danger">Registrate</a>
                        @endif
                    @endif
            @endif

        </nav>
    </div>

    <div class="contenedor bg-white containerBody">

        <div class="header">
            <div class="row">
                <div class="col-sm-6 logo d-flex align-items-center">
                    <a href="/">
                        <img src="https://www.desarrollo.aspefam.org.pe/pluginfile.php/1/theme_mb2nl/logo/1602177358/campus%20virtual.png">
                    </a>
                </div>
                <div class="col socialButtons">
                    <ul class="d-flex justify-content-end align-items-center h-100">
                        <li>
                            <a href="" class="bg-facebook"><i class="fab fa-facebook-f"></i></a>
                        </li>
                        <li>
                            <a href="" class="bg-twitter"><i class="fab fa-twitter"></i></a>
                        </li>
                        <li>
                            <a href="" class="bg-fliker"><i class="fab fa-flickr"></i></a>
                        </li>
                        <li>
                            <a href="" class="bg-youtube"><i class="fab fa-youtube"></i></a>
                        </li>
                        <li>
                            <a href="https://www.aspefam.org.pe/" class="bg-blueaspefam"><i class="fal fa-globe-americas"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="barheader">
            <a href=""><i class="fas fa-home" style="color: white;"></i></a>
        </div>

        <div class="slider">
            <div id="carouselExampleInterval" class="carousel slide" data-ride="carousel">
              <div class="carousel-inner">
                <div class="carousel-item active" data-interval="10000">
                  <img src="images/portada1.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item" data-interval="2000">
                  <img src="images/portada2.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                  <img src="images/portada3.jpg" class="d-block w-100" alt="...">
                </div>
              </div>
              <a class="carousel-control-prev" href="#carouselExampleInterval" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next" href="#carouselExampleInterval" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
            </div>
        </div>

        <div class="content">

            
        	@yield('content')


            <footer class="p-4">
                <div class="row p-3">
                    <div class="col-3 d-flex align-items-center text-white">
                        <ul>
                            <li>
                                <a href="/">
                                    <img src="/images/logo_blanco.png" style="width: 80%;">
                                </a>
                            </li>
                            <li><a href=""></a>Campus</li>
                            <li><a href=""></a>Cursos</li>
                            <li><a href=""></a>Matriculas</li>
                            <li><a href=""></a>Registros</li>
                        </ul>

                    </div>
                    <div class="col-3 text-white">
                        <h2 style="font-size: 1.2em;">¿Quiénes Somos?</h2>
                        <ul>
                            <li><a href=""></a>Campus</li>
                            <li><a href=""></a>Cursos</li>
                            <li><a href=""></a>Matriculas</li>
                            <li><a href=""></a>Registros</li>
                        </ul>
                    </div>
                    <div class="col-3 text-white">
                        
                    </div>
                    <div class="col-3 text-white">
                        <ul>
                            <li><a href=""></a><i class="fal fa-book-open"></i> Libro de Reclamaciones</li>
                            <li><a href=""></a>Métodos de Pago</li>
                            <li><a href=""></a>
                                <i class="fab fa-cc-visa mr-1" style="font-size: 2em;"></i>
                                <i class="fab fa-cc-paypal mr-1" style="font-size: 2em;"></i>
                                <i class="fab fa-cc-mastercard mr-1" style="font-size: 2em;"></i>
                                <i class="fab fa-cc-diners-club mr-1" style="font-size: 2em;"></i>
                                <i class="fab fa-cc-amex mr-1" style="font-size: 2em;"></i>
                            </li>
                            <li><a href=""></a>Compra 100% segura</li>
                            <li>
                                <i class="far fa-lock mr-1" style="font-size: 2em;"></i>
                                <i class="fas fa-shield" style="font-size: 2em;"></i>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row p-3">
                    <div class="col d-flex align-items-center">
                        <p class="text-white">Copyright © ASPEFAM 2020. All rights reserved.</p>
                    </div>
                    <div class="col socialButtons">
                        <ul class="d-flex justify-content-end align-items-center h-100">
                            <li>
                                <a href="" class="bg-facebook"><i class="fab fa-facebook-f"></i></a>
                            </li>
                            <li>
                                <a href="" class="bg-twitter"><i class="fab fa-twitter"></i></a>
                            </li>
                            <li>
                                <a href="" class="bg-fliker"><i class="fab fa-flickr"></i></a>
                            </li>
                            <li>
                                <a href="" class="bg-youtube"><i class="fab fa-youtube"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </footer>
        </div>
    </div>





    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->
  </body>
</html>