<!--
=========================================================
* Paper Dashboard 2 - v2.0.1 - Julio Izquierdo Mejía
=========================================================

* Product Page: https://www.creative-tim.com/product/paper-dashboard-2
* Copyright 2020 Creative Tim (https://www.creative-tim.com)

Coded by www.creative-tim.com

 =========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    {{isset($title) ? $title . ' | ' : ''}} SigeCampus
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">


  
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4-4.1.1/jszip-2.5.0/dt-1.10.22/b-1.6.5/b-html5-1.6.5/datatables.min.css"/>

  <link rel="stylesheet" type="text/css" href="{{ asset('/css/app.css') }}">
  
  <!-- CSS Files -->
  
  <!-- CSS Just for demo purpose, don't include it in your project -->
  @yield('css')

</head>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="white" data-active-color="danger">
      <div class="logo">
        <a href="" class="simple-text logo-mini">
          <div class="logo-image-small">
            <img src="{{ asset('/../assets/img/{{$usuario->avatar}}') }}">
          </div>
          <!-- <p>CT</p> -->
        </a>
        <a href="" class="simple-text logo-normal">
          SIGECAMPUS
        </a>
      </div>
      <div class="sidebar-wrapper">
        @include('layouts.sidebar')
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      @include('layouts.headernav')
      <!-- End Navbar -->
      <div class="content">
        @yield('content')
      </div>
      <footer class="footer footer-black  footer-white ">
        <div class="container-fluid">
          <div class="row">
            <nav class="footer-nav">
              <ul>
                <li><a href="https://www.aspefam.org.pe/" target="_blank">#ASPEFAM</a></li>
                <li><a href="https://www.campus.aspefam.org.pe/" target="_blank">#CAMPUS</a></li>
              </ul>
            </nav>
            <div class="credits ml-auto">
              <span class="copyright">
                © <script>
                  document.write(new Date().getFullYear())
                </script>, Power by <i class="fa fa-heart heart"></i> Soporte ASPEFAM
              </span>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </div>

  <!-- 
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>



  <script src="{{asset('js/jquery-1.x-git.js')}}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.1/gsap.min.js"></script>
  <script src="{{asset('js/datatables.js')}}"></script>
  
  <script src="{{asset('js/core/popper.min.js')}}"></script>
  <script src="assets/js/core/bootstrap.min.js"></script>
  <script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>

  <script src="{{asset('js/script.js')}}"></script>




    Core JS Files 
  <script src="assets/js/core/jquery.min.js"></script>
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap.min.js"></script>
  <script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  
  Chart JS 
  <script src="assets/js/plugins/chartjs.min.js"></script>
  Notifications Plugin 
  <script src="assets/js/plugins/bootstrap-notify.js"></script>
  Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc 
  <script src="assets/js/paper-dashboard.min.js?v=2.0.1" type="text/javascript"></script>Paper Dashboard DEMO methods, don't include it in your project! 
  <script src="assets/demo/demo.js"></script>
  <script src="{{asset('js/datatables.js')}}"></script>
  -->

  
  
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  

  @yield('javascript')
</body>

</html>
