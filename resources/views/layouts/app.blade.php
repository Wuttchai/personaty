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

    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
    <link href="https://adminlte.io/themes/AdminLTE/dist/css/AdminLTE.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="{{ asset('css/testboot.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fonts/thsarabunnew.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}">


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
                  <li><a class="nav-link" href="/officialapp"><h5>กิจกรรมเเละประกาศ</h5></a></li>
                  <li><a class="nav-link" href="/officialapp"><h5>เอกสารที่เผยแพร่</h5></a></li>
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
                          document.getElementById('logout-form').submit();">Logout</a></li>

                          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                              @csrf
                          </form>
                          <form id="product-form" action="/ProductCarOrders" method="get" style="display: none;">
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
                      <li><p><a href="http://www.dop.go.th/th/aboutus/1"class="text-dark">ประวัติความเป็นมา</a></p></li>
                      <li><p><a href="http://www.dop.go.th/th/aboutus/2"class="text-dark">วิสัยทัศน์และพันธกิจ</a></p></li>
                      <li><p><a href="http://www.dop.go.th/th/aboutus/3"class="text-dark">โครงสร้างหน่วยงาน</a></p></li>
                      <li><p><a href="http://www.dop.go.th/th/aboutus/4"class="text-dark">ทำเนียบผู้บริหาร</a></p></li>
                      <li><p><a href="http://www.dop.go.th/th/aboutus/5"class="text-dark">ยุทธศาสตร์</a></p></li>
                      <li><p><a href="http://www.dop.go.th/th/aboutus/6"class="text-dark">ภารกิจหน้าที่</a></p></li>
                      <li><p><a href="/officialapp"class="text-dark">สำหรับเจ้าหน้าที่</a></p></li>


              <li><p><a href="http://www.dop.go.th/th/organization"class="text-dark">หน่วยงานภายใน</a></p></li>
            </ul>

          </div>
          <div class="col-md-3">
            <h4>เอกสารเผยแพร่</h4>
            <ul class="contact">
                      <li><p><a href="http://www.dop.go.th/th/organization/1" class="text-dark">สำนักงานเลขานุการกรม</a></p></li>
                      <li><p><a href="http://www.dop.go.th/th/organization/7" class="text-dark">กองยุทธศาสตร์และแผนงาน</a></p></li>
                      <li><p><a href="http://www.dop.go.th/th/organization/2" class="text-dark">กองส่งเสริมสวัสดิการและคุ้มครองสิทธิผู้สูงอายุ</a></p></li>
                      <li><p><a href="http://www.dop.go.th/th/organization/3" class="text-dark">กองส่งเสริมศักยภาพผูัสูงอายุ</a></p></li>
                      <li><p><a href="http://www.dop.go.th/th/organization/4" class="text-dark">กองบริหารกองทุนผู้สูงอายุ</a></p></li>
                      <li><p><a href="http://www.dop.go.th/th/organization/5" class="text-dark">กลุ่มพัฒนาระบบบริหาร</a></p></li>
                      <li><p><a href="http://www.dop.go.th/th/organization/6" class="text-dark">กลุ่มตรวจสอบภายใน</a></p></li>
                    </ul>
          </div>

          <div class="col-md-3">
            <h4>คลังความรู้</h4>
            <ul class="contact">
                  <li><p>
            <a href="http://www.dop.go.th/th/know/1" class="text-dark">สถิติผู้สูงอายุ</a>
          </p></li>
                  <li><p>
            <a href="http://www.dop.go.th/th/know/2" class="text-dark">สถานการณ์ผู้สูงอายุ</a>
          </p></li>
                  <li><p>
            <a href="http://www.dop.go.th/th/know/3" class="text-dark">บทความ</a>
          </p></li>
                  <li><p>
            <a href="http://www.dop.go.th/th/know/4" class="text-dark">ผลงานวิชาการ</a>
          </p></li>
                  <li><p>
            <a href="http://www.dop.go.th/th/know/5" class="text-dark">เอกสารเผยแพร่/สื่อสิ่งพิมพ์</a>
          </p></li>
                  <li><p>
            <a href="http://www.dop.go.th/th/know/7" class="text-dark">เทคโนโลยีสารสนเทศ</a>
          </p></li>
                  <li><p>
            <a href="http://www.dop.go.th/th/know/6" class="text-dark">สื่อมัลติมีเดีย</a>
          </p></li>
                    </ul>



          </div>
          <div class="col-md-3">
              <h4>บริการ</h4>
                          <ul class="contact">
                            <li>
                              <p><a href="http://www.dop.go.th/th/formdownload" class="text-dark">ดาวน์โหลดเอกสาร/แบบฟอร์ม</a></p>
                            </li>

                            <li><p>
                              <a href="http://www.dop.go.th/th/topic" class="text-dark">ถามตอบ (Q&amp;A)</a>
                            </p></li>
                            <li><p>
                              <a href="http://www.dop.go.th/th/faq" class="text-dark">คำถามที่พบบ่อย (FAQ)</a></p>
                            </li>
                            <li>
                              <p><a href="http://www.dop.go.th/th/formcomplaint" class="text-dark">ร้องเรียน</a></p>
                            </li>

                            <li>
                              <p><a href="http://www.dop.go.th/th/weblink" class="text-dark">เว็บลิงค์</a></p>
                            </li>
                            <li>
                              <p><a href="http://www.dop.go.th/th/rss" class="text-dark">ระบบกระจายข่าว (RSS)</a></p>
                            </li>
                            <li>
                              <p><a href="http://www.dop.go.th/th/search" class="text-dark">ค้นหา</a></p>
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
<script src="https://vuejs.org/js/vue.js"></script>
<script src="{{ asset('js/sweetalert2.min.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="{{ asset('js/sweetalert2.min.js') }}"></script>
      @stack('scripts')
</body>
</html>
