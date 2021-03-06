<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> เจ้าหน้าที่ </title>

    <!-- Styles -->
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css' />
<link href="/css/app.css" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
<link href="/css/bootstrap-datepicker.css" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css">
<!-- dataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
<!-- dataTables -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="{{ asset('fonts/thsarabunnew.css') }}" />

@stack('css')
<style media="screen">
html {
  font-family: 'THSarabunNew', sans-serif;
  -webkit-text-size-adjust: 100%;
      -ms-text-size-adjust: 100%;
}
body {
  font-family: 'THSarabunNew',"Helvetica Neue", Helvetica, Arial, sans-serif;
  font-size: 14px;
  line-height: 1.42857143;
  color: #333;
  background-color: #fff;
}
.cheakcus {
    display: block;
    position: relative;
    padding-left: 35px;
    margin-bottom: 12px;
    cursor: pointer;
    font-size: 22px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}


.cheakcus input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
}

/* Create a custom checkbox */
.checkmark {
    position: absolute;
    top: 0;
    left: 0;
    height: 25px;
    width: 25px;
    background-color: #eee;
}

/* On mouse-over, add a grey background color */
.cheakcus:hover input ~ .checkmark {

    background-color: #ccc;
}

/* When the checkbox is checked, add a blue background */
.cheakcus input:checked ~ .checkmark {
    background-color: #2196F3;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
    content: "";
    position: absolute;
    display: none;
}

/* Show the checkmark when checked */
.cheakcus input:checked ~ .checkmark:after {
    display: block;
}
.cheakcus-center {
    position: absolute;
    left: 8%;
    transform: translateX(-50%);
}
/* Style the checkmark/indicator */
.cheakcus .checkmark:after {
    left: 9px;
    top: 5px;
    width: 5px;
    height: 10px;
    border: solid white;
    border-width: 0 3px 3px 0;
    -webkit-transform: rotate(45deg);
    -ms-transform: rotate(45deg);
    transform: rotate(45deg);
}

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
.onoff {
  margin-left: -27px;
  display: -moz-inline-stack;
  display: inline-block;
  vertical-align: middle;
  *vertical-align: auto;
  zoom: 1;
  *display: inline;
  position: relative;
  cursor: pointer;
  width: 150px;
  height: 30px;
  line-height: 30px;
  font-size: 14px;
  font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
}
.onoff label {
  position: absolute;
  top: 0px;
  left: 0px;
  width: 100%;
  height: 100%;
  cursor: pointer;
  background: #cd3c3c;
  border-radius: 5px;
  font-weight: bold;
  color: #FFF;
  -webkit-transition: background 0.3s, text-indent 0.3s;
  -moz-transition: background 0.3s, text-indent 0.3s;
  -o-transition: background 0.3s, text-indent 0.3s;
  transition: background 0.3s, text-indent 0.3s;
  text-indent: 27px;
  -webkit-box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.4) inset;
  -moz-box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.4) inset;
  box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.4) inset;
}
.onoff label:after {
  content: 'ไม่อนุญาติ';
  display: block;
  position: absolute;
  top: 0px;
  left: 0px;
  width: 100%;
  font-size: 12px;
  color: #591717;
  text-shadow: 0px 1px 0px rgba(255, 255, 255, 0.35);
  z-index: 1;
}
.onoff label:before {
  content: '';
  width: 15px;
  height: 24px;
  border-radius: 3px;
  background: #FFF;
  position: absolute;
  z-index: 2;
  top: 3px;
  left: 3px;
  display: block;
  -webkit-transition: left 0.3s;
  -moz-transition: left 0.3s;
  -o-transition: left 0.3s;
  transition: left 0.3s;
  -webkit-box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.4);
  -moz-box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.4);
  box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.4);
}
.onoff input:checked + label {
  background: #378b2c;
  text-indent: 8px;
}
.onoff input:checked + label:after {
  content: 'อนุญาติ';
  color: #091707;
}
.onoff input:checked + label:before {
  left: 132px;
}
.fc-time{
   display : none;
}








</style>
</head>
<body>

    <div>
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel ">

            <div class="container" id="app">
                <a class="navbar-brand" href="{{ url('/home') }}">
                  <i class="fa fa-mail-reply-all" style="font-size:48px"></i>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                      <li><a class="nav-link" href="{{ url('/home') }}"><strong>หน้าแรก</strong></a></li>
                        @if (session('idoffice'))
                      <li class="nav-item dropdown">
                          <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                             จัดการข้อมูลเว็ปไซต์ <span class="caret"></span>
                          </a>
                          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            @if (session('info') == 'จัดการ')
                            <a class="nav-link" href="/official/officialform">จัดการภาพแบรน์เนอร์</a>

                            @endif

                            @if (session('hotnews') == 'จัดการ')
                            <a class="nav-link" href="/official/hotnews">จัดการข่าวประชาสัมพันธ์</a>
                            @endif

                            @if (session('prison') == 'จัดการ')
                            <a class="nav-link" href="/official/person">จัดการข้อมูลเกี่ยวกับเรือนจำ</a>
                            @endif
                            @if (session('document') == 'จัดการ')
                            <a class="nav-link" href="/official/document">  จัดการข้อมูลเอกสารเผยแพร่</a>
                            @endif
                              @if (session('calender') == 'จัดการ')
                            <a class="nav-link" href="/official/calender">จัดการวันที่เข้าเยี่ยม </a>
                            @endif
                          </div>
                      </li>
                      @endif
                        @if (session('product') == 'จัดการ')
                      <li class="nav-item dropdown">
                          <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                             จัดการข้อมูลสินค้าวิชาชีพ <span class="caret"></span>
                          </a>
                          <div class="dropdown-menu" aria-labelledby="navbarDropdown">


                            <a class="nav-link" href="/official/product">จัดการสินค้าวิชาชีพ</a>


                            <a class="nav-link" href="/official/productsell">  จัดการข้อมูลสั่งซื้อสินค้า</a>

                          </div>
                      </li>
                        @endif
                        @if (session('idoffice'))
                      <li class="nav-item dropdown">
                          <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                             รายงานการจัดการ <span class="caret"></span>
                          </a>
                          <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                            <a class="dropdown-item" href="#"
                               onclick="event.preventDefault();
                                             document.getElementById('edit-form').submit();">
                                รายงานข้อมูลเจ้าหน้าที่
                            </a>

                              @if (session('product') == 'จัดการ')
                            <a class="dropdown-item" href="/official/logfile/product">
                                รายงานข้อมูลการขายสินค้า
                            </a>
                              @endif
                              <a class="dropdown-item" href="/official/logfile/graph">
                                  รายงานกราฟคนเข้าดู
                              </a>
                              @if (session('product') == 'จัดการ')
                            <a class="dropdown-item" href="/official/logfile/graph">

                            </a>
                              @endif
                          </div>
                      </li>
                      @endif
                    </ul>


                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @if (session('activity') == 'จัดการ')

                        <li><a class="nav-link" href="/webboard">จัดการข้อมูลกระทู้</a></li>
                        <li><a class="nav-link" href="/official/add">จัดการข้อมูลเจ้าหน้าที่</a></li>
                        @endif


                        @if (session('nameoffice'))

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              {{ session('nameoffice') }}<span class="caret"></span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">


                                <a class="dropdown-item" href="#"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    ออกจากระบบ
                                </a>

                                <form id="logout-form" action="/official/logout" method="POST" style="display: none;">
                                    @csrf
                                </form>
                                <form id="edit-form" action="/official/logfile" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>






                        </li>
                        @endif

                    </ul>

                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <script src="/js/app.js" charset="utf-8"></script>
<script src="{{ asset('js/sweetalert2.min.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

<!-- dataTables -->
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>

<script src="{{ asset('js/vfs_fonts.js') }}"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
<!-- dataTables -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<!-- datepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
<script src="/js/bootstrap-datepicker-custom.js"></script>
<script src="/js/bootstrap-datepicker.th.min.js" charset="UTF-8"></script>


<script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js'></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
      @stack('scripts')
</body>
</html>
