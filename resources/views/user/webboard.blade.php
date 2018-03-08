@extends('layouts.app')

@section('content')
<div class="container"  id="information"  >
<div class="loader" id="loader"></div>
   <div class="row justify-content-center" >

     <div class="container">




        <!-- /.col-lg-3 -->

        <div class="col-lg-12 ">



          <div class="row">
      			<div class="col-md-6 col-md-offset-3">
      				<div class="text-center">
      					<h2>กระทู้สอบถาม</h2>
      				</div>
      				<hr>
      			</div>
      		</div>
          <!-- /.row -->
          <nav class="navbar navbar-default fixed-top-2" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        </button>

        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">


        <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">หมวดหมู่กระทู้ <b class="caret"></b></a>

        <ul class="dropdown-menu" >
          <li><a href="/ProductAyutaya?type=การเยี่ยม">การเยี่ยมผู้ต้องขัง</a></li>
          <li><a href="/ProductAyutaya?type=ของฝาก">การเตรียมเอกสาร</a></li>
          <li class="divider"></li>
          <li><a href="/ProductAyutaya">ค่าเริ่มต้น</a></li>

        </ul>

        </li>
        </ul>
        <div class="col-sm-6 col-md-6 text-right">
        <form class="navbar-form" role="search"  method="GET">
        <div class="input-group ">
            <input type="text" class="form-control" placeholder="<?php echo  Session::get('search'); ?>" name="q">
            <div class="input-group-btn ">
                  <button class="btn btn-danger btn-outline" type="submit" ><i v-if="seach" class="glyphicon glyphicon-search"></i> <i v-if="cancelsearch" class="glyphicon glyphicon-remove"></i></button>
            </div>
        </div>
        </form>
        </div>
        <ul class="nav navbar-nav navbar-right">



<div class="col-sm-6 col-md-6 text-right">
<form class="navbar-form" role="search"  method="GET">
<div class="input-group ">
  <a><button type="button" class="btn btn-danger btn-outline" v-on:click="open()">ตั้งกระทู้
</button></a>
</div>
</form>
</div>
        </ul>





      </div><!-- /.navbar-collapse -->
        </nav>
          <div class="col-sm-4">
  <div class="panel panel-default">
  <div class="panel-heading">
  <strong>myusername</strong> <span class="text-muted">commented 5 days ago</span>
  </div>
  <div class="panel-body">
  Panel content
  </div><!-- /panel-body -->
  </div><!-- /panel panel-default -->
  </div>
  <div class="col-sm-4">
<div class="panel panel-default">
<div class="panel-heading">
<strong>myusername</strong> <span class="text-muted">commented 5 days ago</span>
</div>
<div class="panel-body">
Panel content
</div><!-- /panel-body -->
</div><!-- /panel panel-default -->
</div>
  <div class="col-sm-4 ">
<div class="panel panel-default">
<div class="panel-heading">
<strong>myusername</strong> <span class="text-muted">commented 5 days ago</span>
</div>
<div class="panel-body">
Panel content
</div><!-- /panel-body -->
</div><!-- /panel panel-default -->
</div>

<div class="modal fade" id="formwebboard" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ตั้งกระทู้สอบถาม (วันที่:{{ Session::get('date') }})</h5>


        <button type="button" class="close btn-danger btn-outline" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">หัวข้อกระทู้:</label>
            <input type="text" class="form-control" id="recipient-name">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">รายละเอียดกระทู้:</label>
            <textarea class="form-control" id="message-text"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
        <button type="button" class="btn btn-primary">บันทึกข้อมูล</button>
      </div>
    </div>
  </div>
</div>
        </div>
        <!-- /.col-lg-12 -->

      </div>
      <!-- /.row -->

    </div>


       </div>

<br>
<br>
@endsection

@push('scripts')
<script>



document.getElementById("loader").style.display = "none";

var information =  new Vue({
    el: '#information',
    data: {

        'status' : '<?php echo Auth::check(); ?>',
        'seach' : <?php if (Session::get('search') == 'ค้นหา' || Session::get('search') == null ) {echo 'true';}else {echo 'false';} ?>,
        'cancelsearch' :<?php if (Session::get('search')!='ค้นหา' && Session::get('search')!= null ) {echo 'true';}else {echo 'false';} ?>,



    },

    computed: {

  },
    methods: {




           open: function () {


if (information.status =='1') {
$("#formwebboard").modal('show');
}else {
  swal({
title: 'คุณไม่มีสิทธิ์ในการตั้งกระทู้ !',
text: 'กรุณาเข้าสู่ระบบเพื่อตั้งกระทู้',
type: 'warning',
confirmButtonColor: '#3085d6',
confirmButtonText: 'ยืนยัน',
closeOnConfirm: false
})
}



           },

    }
  })
</script>
@endpush
