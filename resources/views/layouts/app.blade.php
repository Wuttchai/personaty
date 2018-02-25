<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>person</title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" href="{{ asset('css/testboot.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="fonts/thsarabunnew.css" />


<style media="screen">
.loader {
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid blue;
  border-right: 16px solid green;
  border-bottom: 16px solid red;
  border-left: 16px solid pink;
  margin : auto;
  width: 120px;
  height: 120px;
  -webkit-animation: spin 2s linear infinite;
  animation: spin 2s linear infinite;
}

@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
.btn-file {
    position: relative;
    overflow: hidden;
}
.btn-file input[type=file] {
    position: absolute;
    top: 0;
    right: 0;
    min-width: 100%;
    min-height: 100%;
    font-size: 100px;
    text-align: right;
    filter: alpha(opacity=0);
    opacity: 0;
    outline: none;
    background: white;
    cursor: inherit;
    display: block;
}

#img-upload{
    width: 100%;
}
</style>
</head>
<body>
    <div class="container" id="app">
      <nav class="navbar navbar-inverse navbar-fixed-top" >
        <div class="container">
          <div class="navbar-header" style="padding: 5px;">
              <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
              </button>

              <a class="icon-bar" href="http://disputebills.com"><img src="https://upload.wikimedia.org/wikipedia/th/f/f5/%E0%B8%95%E0%B8%A3%E0%B8%B2%E0%B8%81%E0%B8%A3%E0%B8%A1%E0%B8%A3%E0%B8%B2%E0%B8%8A%E0%B8%97%E0%B8%B1%E0%B8%93%E0%B8%91%E0%B9%8C.png" height="90" alt="Dispute Bills"> </a>

          </div>
          <!-- Collection of nav links, forms, and other content for toggling -->
          <div id="navbarCollapse" class="collapse navbar-collapse" style="margin-top: 20px;">
              <ul class="nav navbar-nav" style="margin-left: 80px;">
                  <li class="active"><a href="#"><h4>หน้าแรก</h4></a></li>
                <li><a class="nav-link" href="/officialapp"><h4>สำหรับเจ้าหน้าที่</h4></a></li>

              </ul>

              <ul class="nav navbar-nav navbar-right">
                @guest
                    <li><a class="nav-link" href="{{ route('login') }}"><h4>เข้าสู่ระบบ</h4></a></li>
                    <li><a class="nav-link" href="{{ route('register') }}"><h4>สมัครสมาชิก</h4></a></li>
                    @else
    <li class="dropdown">
        <a data-toggle="dropdown" class="dropdown-toggle" href="#"><h4>{{ Auth::user()->User_Name }} <b class="caret"></b> </h4></a>
        <ul class="dropdown-menu">
            <li><a href="#">ข้อมูลส่วนตัว</a></li>
            <li><a href="#" onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();">Logout</a></li>

                          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                              @csrf
                          </form>
        </ul>
    </li>


                      @endguest
              </ul>
          </div>
      </nav>

<div class="container">

            @yield('content')

    </div>
  </div>
<script src="/js/app.js" charset="utf-8"></script>
<script src="https://vuejs.org/js/vue.js"></script>
<script src="{{ asset('js/sweetalert2.min.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

      @stack('scripts')
</body>
</html>
