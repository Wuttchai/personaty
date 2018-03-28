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
    <!-- Font Awesome -->

    <link rel="stylesheet" href="{{ asset('css/fullcalendar.min.css') }}">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/AdminLTE.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="{{ asset('css/testboot.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fonts/thsarabunnew.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


<style media="screen">
/* Dropdown Button */
.dropbtn {
    background-color: #f93e3e;
    color: white;
    padding: 20px;
    font-size: 14px;
    border: none;
    cursor: pointer;
}

/* Dropdown button on hover & focus */
.dropbtn:hover, .dropbtn:focus {
    background-color: #e80b0b;
}

/* The container <div> - needed to position the dropdown content */
.dropdown {
    position: relative;
    display: inline-block;
}

/* Dropdown Content (Hidden by Default) */
.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f1f1f1;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}

/* Links inside the dropdown */
.dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

/* Change color of dropdown links on hover */
.dropdown-content a:hover {background-color: #ddd}

/* Show the dropdown menu (use JS to add this class to the .dropdown-content container when the user clicks on the dropdown button) */
.show {display:block;}
.topnav {

  background-color: #ef7c7c;
}

.topnav a {
  float: left;
  display: block;
  color: black;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.topnav a:hover {
  background-color: #ddd;
  color: black;
}

.topnav a.active {
  background-color: #2196F3;
  color: white;
}

.topnav .search-container {
  float: right;
}

.topnav input[type=text] {
  padding: 6px;
  margin-top: 8px;
  font-size: 17px;
  border: none;
}

.topnav .search-container button {
  float: right;
  padding: 6px 10px;
  margin-top: 8px;
  margin-right: 16px;
  background: #ddd;
  font-size: 17px;
  border: none;
  cursor: pointer;
}

.topnav .search-container button:hover {
  background: #ccc;
}

@media screen and (max-width: 600px) {
  .topnav .search-container {
    float: none;
  }
  .topnav a, .topnav input[type=text], .topnav .search-container button {
    float: none;
    display: block;
    text-align: left;
    width: 100%;
    margin: 0;
    padding: 14px;
  }
  .topnav input[type=text] {
    border: 1px solid #ccc;
  }
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

.glyphicon-lg{font-size:3em}
.blockquote-box{border-right:5px solid #E6E6E6;margin-bottom:25px}
.blockquote-box .square{width:100px; margin-right:100px;text-align:center!important;}
.blockquote-box.blockquote-primary{border-color:#357EBD}
.blockquote-box.blockquote-primary .square{background-color:#428BCA;color:#FFF}
.blockquote-box.blockquote-success{border-color:#4CAE4C}
.blockquote-box.blockquote-success .square{background-color:#5CB85C;color:#FFF}
.blockquote-box.blockquote-info{border-color:#46B8DA}
.blockquote-box.blockquote-info .square{background-color:#5BC0DE;color:#FFF}
.blockquote-box.blockquote-warning{border-color:#EEA236}
.blockquote-box.blockquote-warning .square{background-color:#F0AD4E;color:#FFF}
.blockquote-box.blockquote-danger{border-color:#D43F3A}
.blockquote-box.blockquote-danger .square{background-color:#D9534F;color:#FFF}
@import url(http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700);
/* written by riliwan balogun http://www.facebook.com/riliwan.rabo*/
a.list-group-item {
    height:auto;
    min-height:220px;
}
.card {
    font-size: 1em;
    overflow: hidden;
    padding: 0;
    border: none;
    border-radius: .28571429rem;
    box-shadow: 0 1px 3px 0 #d4d4d5, 0 0 0 1px #d4d4d5;
}

.card-block {
    font-size: 1em;
    position: relative;
    margin: 0;
    padding: 1em;
    border: none;
    border-top: 1px solid rgba(34, 36, 38, .1);
    box-shadow: none;
}

.card-img-top {
    display: block;
    width: 100%;
    height: auto;
}

.card-title {
    font-size: 1.28571429em;
    font-weight: 700;
    line-height: 1.2857em;
}

.card-text {
    clear: both;
    margin-top: .5em;
    color: rgba(0, 0, 0, .68);
}

.card-footer {
    font-size: 1em;
    position: static;
    top: 0;
    left: 0;
    max-width: 100%;
    padding: .75em 1em;
    color: rgba(0, 0, 0, .4);
    border-top: 1px solid rgba(0, 0, 0, .05) !important;
    background: #fff;
}

.card-inverse .btn {
    border: 1px solid rgba(0, 0, 0, .05);
}

.profile {
    position: absolute;
    top: -12px;
    display: inline-block;
    overflow: hidden;
    box-sizing: border-box;
    width: 25px;
    height: 25px;
    margin: 0;
    border: 1px solid #fff;
    border-radius: 50%;
}

.profile-avatar {
    display: block;
    width: 100%;
    height: auto;
    border-radius: 50%;
}

.profile-inline {
    position: relative;
    top: 0;
    display: inline-block;
}

.profile-inline ~ .card-title {
    display: inline-block;
    margin-left: 4px;
    vertical-align: top;
}

.text-bold {
    font-weight: 700;
}

.meta {
    font-size: 1em;
    color: rgba(0, 0, 0, .4);
}

.meta a {
    text-decoration: none;
    color: rgba(0, 0, 0, .4);
}

.meta a:hover {
    color: rgba(0, 0, 0, .87);
}
.bg {
    /* The image used */
    background-image: url('http://farm3.staticflickr.com/2832/12303719364_c25cecdc28_b.jpg');

    /* Full height */
    height: 100%;

    /* Center and scale the image nicely */
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
}


@import url(http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,300,600,700);
.bg{
    background: -webkit-linear-gradient(90deg, #FF512F 10%, #DD2476 90%);
    background: -moz-linear-gradient(90deg, #FF512F 10%, #DD2476 90%);
    background: -ms-linear-gradient(90deg, #FF512F 10%, #DD2476 90%);
    background: -o-linear-gradient(90deg, #FF512F 10%, #DD2476 90%);
    background: linear-gradient(90deg, #FF512F 10%, #DD2476 90%);
    font-family: 'Open Sans', sans-serif!important;

}.fc-time{
   display : none;
}


#custom-search-input {
        margin:0;
        margin-top: 10px;
        padding: 0;
    }

    #custom-search-input .search-query {
        padding-right: 3px;
        padding-right: 4px \9;
        padding-left: 3px;
        padding-left: 4px \9;
        /* IE7-8 doesn't have border-radius, so don't indent the padding */

        margin-bottom: 0;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;
    }

    #custom-search-input button {
        border: 0;
        background: none;
        /** belows styles are working good */
        padding: 2px 5px;
        margin-top: 2px;
        position: relative;
        left: -28px;
        /* IE7-8 doesn't have border-radius, so don't indent the padding */
        margin-bottom: 0;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;
        color:#D9230F;
    }

    .search-query:focus + button {
        z-index: 3;
    }

</style>
</head>

<body>
    <div class="container">
      <nav class="navbar navbar-inverse navbar-fixed-top"  id="app">
        <div class="container">
          <div class="navbar-header" style="padding: 1px;">
              <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
              </button>

              <a class="icon-bar" href="/home"><img src="https://upload.wikimedia.org/wikipedia/th/f/f5/%E0%B8%95%E0%B8%A3%E0%B8%B2%E0%B8%81%E0%B8%A3%E0%B8%A1%E0%B8%A3%E0%B8%B2%E0%B8%8A%E0%B8%97%E0%B8%B1%E0%B8%93%E0%B8%91%E0%B9%8C.png" height="90" alt="Dispute Bills"> </a>

          </div>
          <!-- Collection of nav links, forms, and other content for toggling -->
          <div id="navbarCollapse" class="collapse navbar-collapse" style="margin-top: 18px;">
              <ul class="nav navbar-nav" style="margin-left: 80px;">
                  <li class="<?php echo  Session::get('tabmanu'); ?>"><a href="/home"><h5>หน้าแรก</h5></a></li>
                  <li><a class="nav-link" href="/officialapp"><h5>เกี่ยวกับเรือนจำ</h5></a></li>
                  <li class="dropdown <?php echo  Session::get('tabmanu3'); ?>" >
                    <a data-toggle="dropdown" class="dropdown-toggle " href="#"><h5>ข่าวเกี่ยวกับเรือนจำ<b class="caret"></b> </h5></a>
                      <ul class="dropdown-menu">
                          <li ><a href="/advertise">ข่าวประชาสัมพันธ์</a></li>
                          <li><a href="/activities">ข่าวกิจกรรม</a></li>
                      </ul>
                  </li>
                  <li class="dropdown <?php echo  Session::get('tabmanu4'); ?>"><a class="nav-link" href="/documentsh"><h5>เอกสารที่เผยแพร่</h5></a></li>
                  <li class="<?php echo  Session::get('tabmanu1'); ?>"><a class="nav-link" href="/ProductAyutaya"><h5>สินค้าวิชาชีพ</h5></a></li>
                  <li class="<?php echo  Session::get('tabmanu2'); ?>"><a class="nav-link" href="/webboard"><h5>กระทู้สอบถาม</h5></a></li>

              </ul>

              <ul class="nav navbar-nav navbar-right">
                @guest
                    <li><a class="nav-link" href="{{ route('login') }}"><h5>เข้าสู่ระบบ</h5></a></li>
                    <li><a class="nav-link" href="{{ route('register') }}"><h5>สมัครสมาชิก</h5></a></li>
                    @else
    <li class="dropdown">
      <a data-toggle="dropdown" class="dropdown-toggle " href="#"><h5>{{ Auth::user()->User_Name }} <b class="caret"></b> </h5></a>
        <ul class="dropdown-menu">
            <li class="<?php echo  Session::get('tabmanu3'); ?>"><a href="#" onclick="event.preventDefault();
                          document.getElementById('product-form').submit();">ข้อมูลการสั่งซื้อสินค้า</a></li>
            <li><a href="#" onclick="event.preventDefault();
                          document.getElementById('datailuser-form').submit();">แก้ไขข้อมูลส่วนตัว</a></li>
            <li><a href="#" onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();">Logout</a></li>

                          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                              @csrf
                          </form>
                          <form id="product-form" action="/ProductCarOrders" method="get" style="display: none;">
                              @csrf
                          </form>
                          <form id="datailuser-form" action="/datailuser" method="get" style="display: none;">
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

  <footer class="panel-footer">
      <div class="container">

        <div class="row">
          <div class="col-md-3">
            <h4>เกี่ยวกับ เรือนจำ</h4>
            <ul class="contact">
                      <li><p><a href="/abouts?type=ประวัติความเป็นมา"class="text-dark">ประวัติความเป็นมา</a></p></li>
                      <li><p><a href="/abouts?type=วิสัยทัศน์และพันธกิจ"class="text-dark">วิสัยทัศน์และพันธกิจ</a></p></li>
                      <li><p><a href="/abouts?type=โครงสร้างหน่วยงาน"class="text-dark">โครงสร้างหน่วยงาน</a></p></li>
                      <li><p><a href="/abouts?type=ทำเนียบผู้บริหาร"class="text-dark">ทำเนียบผู้บริหาร</a></p></li>
                      <li><p><a href="/abouts?type=ยุทธศาสตร์"class="text-dark">ยุทธศาสตร์</a></p></li>
                      <li><p><a href="/abouts?type=ข้อมูลบุคลากร"class="text-dark">ข้อมูลบุคลากร</a></p></li>
                      <li><p><a href="/officialapp"class="text-dark">สำหรับเจ้าหน้าที่</a></p></li>
                      <li><p><a href="/abouts?type=ข้อมูลสถิติผู้ต้องขัง"class="text-dark">ข้อมูลสถิติผู้ต้องขัง</a></p></li>
            </ul>

          </div>
          <div class="col-md-3">
            <h4>เอกสารเผยแพร่</h4>
            <ul class="contact">
                      <li><p><a href="" class="text-dark">สำนักงานเลขานุการกรม</a></p></li>
                      <li><p><a href="" class="text-dark">กองยุทธศาสตร์และแผนงาน</a></p></li>
                      <li><p><a href="" class="text-dark">กองส่งเสริมสวัสดิการและคุ้มครองสิทธิผู้สูงอายุ</a></p></li>
                      <li><p><a href="" class="text-dark">กองส่งเสริมศักยภาพผูัสูงอายุ</a></p></li>
                      <li><p><a href="" class="text-dark">กองบริหารกองทุนผู้สูงอายุ</a></p></li>
                      <li><p><a href="" class="text-dark">กลุ่มพัฒนาระบบบริหาร</a></p></li>
                      <li><p><a href="" class="text-dark">กลุ่มตรวจสอบภายใน</a></p></li>
                    </ul>
          </div>

          <div class="col-md-3">
            <h4>คลังความรู้</h4>
            <ul class="contact">
                  <li><p>
            <a href="" class="text-dark">สถิติผู้สูงอายุ</a>
          </p></li>
                  <li><p>
            <a href="" class="text-dark">สถานการณ์ผู้สูงอายุ</a>
          </p></li>
                  <li><p>
            <a href="" class="text-dark">บทความ</a>
          </p></li>
                  <li><p>
            <a href="" class="text-dark">ผลงานวิชาการ</a>
          </p></li>
                  <li><p>
            <a href="" class="text-dark">เอกสารเผยแพร่/สื่อสิ่งพิมพ์</a>
          </p></li>
                  <li><p>
            <a href="" class="text-dark">เทคโนโลยีสารสนเทศ</a>
          </p></li>
                  <li><p>
            <a href="" class="text-dark">สื่อมัลติมีเดีย</a>
          </p></li>
                    </ul>



          </div>
          <div class="col-md-3">
              <h4>บริการ</h4>
                          <ul class="contact">
                            <li>
                              <p><a href="" class="text-dark">ดาวน์โหลดเอกสาร/แบบฟอร์ม</a></p>
                            </li>

                            <li><p>
                              <a href="" class="text-dark">ถามตอบ (Q&amp;A)</a>
                            </p></li>
                            <li><p>
                              <a href="" class="text-dark">คำถามที่พบบ่อย (FAQ)</a></p>
                            </li>
                            <li>
                              <p><a href="" class="text-dark">ร้องเรียน</a></p>
                            </li>

                            <li>
                              <p><a href="" class="text-dark">เว็บลิงค์</a></p>
                            </li>
                            <li>
                              <p><a href="" class="text-dark">ระบบกระจายข่าว (RSS)</a></p>
                            </li>
                            <li>
                              <p><a href="" class="text-dark">ค้นหา</a></p>
                            </li>
                          </ul>
</footer>
<footer class="panel-footer ">
      <div class="container">
        <p class="m-0 text-center text-danger">Copyright &copy; PersonAyutaya Website 2018</p>
      </div>
      <!-- /.container -->
    </footer>

          </div>
        </div>

<script src="/js/app.js" charset="utf-8"></script>

<script src="{{ asset('js/sweetalert2.min.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="{{ asset('js/sweetalert2.min.js') }}"></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js'></script>

      @stack('scripts')
</body>
</html>
