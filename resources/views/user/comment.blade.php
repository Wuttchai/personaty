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
      					<h2>หัวข้อกระทู้ที่เลือก</h2>
      				</div>
      				<hr>
      			</div>
      		</div>
          <!-- /.row -->


          <div class="col-md-12">
  <div class="panel panel-danger ">


  <div class="panel-heading" style="word-break:break-all; " >
  <strong>{{ $comment[0]->ques_name }}</strong> <span class="glyphicon glyphicon-calendar text-muted pull-right">{{ $comment[0]->ques_date }}</span>
  </div>

  <div class="panel-body " style="word-break:break-all;">

      <div class="col-md-12 ">
{{ $comment[0]->ques_detail }}
</div>

  </div><!-- /panel-body -->
<div class="panel-footer text-right" >
  <div class="row">
    <div class="col-md-6 text-left">

    ตั้งกระทู้โดย : {{ $comment[0]->User_Name }}
    </div>

  </div>


</div>
</a></div><!-- /panel panel-default -->
  </div>

  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <div class="text-center">
        <h4>ความคิดเห็นของกระทู้</h4>
      </div>
      <hr>
    </div>
  </div>

@foreach ($commentdetail as $commentdetails)
@if($commentdetails->quesde_detail != '-')

  <div class="col-md-12" >
<div class="panel panel-warning ">


<div class="panel-heading" style="word-break:break-all; " >
<strong>แสดงความคิดเห็นโดย : {{ $commentdetails->User_Name }}</strong> <span class="glyphicon glyphicon-calendar text-muted pull-right">{{ $commentdetails->quesde_date }}</span>
</div>

<div class="panel-body " style="word-break:break-all;">

<div class="col-md-12 ">
{{ $commentdetails->quesde_detail }}
</div>

</div><!-- /panel-body -->
<div class="panel-footer text-right" >

</div>
</a></div><!-- /panel panel-default -->
</div>
@endif
  @endforeach
  <div class="col-sm-12">
  {{ $commentdetail->links() }}
  </div>


  @if (Auth::user())

    <div class="col-md-12 col-md-offset-1 pull-right">
<div class="col-md-2 col-md-offset-0">
        <h4>แสดงความคิดเห็น :</h4>
        </div>
        <div class="col-md-6 col-md-offset-0">

              <form  action="{{ route('addcomment') }}" method="post" >
                  {{ csrf_field() }}
                  <input type="hidden" name="id" value="{{ $comment[0]->ques_id }}">
          <div class="input-group">
            <input type="text" name="message" placeholder="ความคิดเห็น ..." class="form-control{{ $errors->has('message') ? ' form-control is-invalid' : '' }}" value="{{ old('message') }}" >
                      <span class="input-group-btn">
                            <button type="submit" class="btn btn-warning btn-flat">ส่ง</button>
                          </span>

                    </div>
                    @if ($errors->has('message'))
                        <span class="text-errors">
                            <strong><h5>{{ $errors->first('message') }}</h5></strong>
                        </span>
                    @endif
                    </form>

</div>
    </div>

@endif






           <!-- /.col -->

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


$(document).ready(function(){

    $("#show").click(function(){
      document.getElementById("formdetail").style.display = "block";
    });
});


document.getElementById("loader").style.display = "none";

var information =  new Vue({
    el: '#information',
    data: {

        'status' : '<?php echo Auth::check(); ?>',
        'seach' : <?php if (Session::get('search') == 'ค้นหา' || Session::get('search') == null ) {echo 'true';}else {echo 'false';} ?>,
        'cancelsearch' :<?php if (Session::get('search')!='ค้นหา' && Session::get('search')!= null ) {echo 'true';}else {echo 'false';} ?>,
        'headqestion' :'',
        'textqestion' :[],
        'headqestionerror':'',
        'textqestionerror':'',
        'type':'',
        'typeerror':'',


    },

    computed: {

  },
    methods: {




           open: function () {
             this.headqestionerror = false;
             this.textqestionerror = false;
             this.typeerror = false;
if (information.status =='1') {
$("#formwebboard").modal('show');
}else {
  swal({
title: 'กรุณาเข้าสู่ระบบเพื่อตั้งกระทู้ !',
text: 'คุณต้องสมัครสมาชิกเพื่อเข้าสู่ระบบ',
type: 'warning',
confirmButtonColor: '#3085d6',
confirmButtonText: 'ยืนยัน',
closeOnConfirm: false
})
}



           },
           showcomment: function (event) {
$("#exampleModal2").modal('show');
             var question_ID =	event;

              var link = "/question/comment" + question_ID;
              axios.get(link, {
              }).then(function (response) {

console.log(response.data);



              })


           },
           addcomment: function (event) {

             var question_ID =	event;

              var link = "/question/comment" + question_ID;
              axios.post(link, {
              }).then(function (response) {

          console.log(response.data);

          $("#exampleModal2").modal('show');

              })


           },

           insert: function () {
             this.headqestionerror = false;
             this.textqestionerror = false;
             this.typeerror = false;
axios.post('/insert/question', {
    headqestion: this.headqestion,
    textqestion: this.textqestion,
    type: this.type,

  }).then(function (response) {
if (response.data.messages != null) {
if(response.data.messages.headqestion != null){
information.headqestionerror = true;
information.headqestionerror = response.data.messages.headqestion[0];
}
if(response.data.messages.textqestion != null){
information.textqestionerror = true;
information.textqestionerror = response.data.messages.textqestion[0];
}
if(response.data.messages.type != null){
information.typeerror = true;
information.typeerror = response.data.messages.type[0];
}
}else {
location.reload();
}

    });
            },

    }
  })
</script>
@endpush
