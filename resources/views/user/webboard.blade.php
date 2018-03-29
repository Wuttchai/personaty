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
          <div class="topnav" style="background-color: #DCDCDC;">
      <div class="row">

      <div class="col-md-2">
      <div class="dropdown">
      <button onclick="myFunction1()" class="dropbtn" style="background-color: #ef0e0e;">เรียงตาม<i class="fa fa-angle-down"></i></button>
      <div id="myDropdown1" class="dropdown-content">
        <a href="/webboard?type=การเยี่ยมผู้ต้องขัง">การเยี่ยมผู้ต้องขัง</a>
        <a href="/webboard?type=การซื้อสินค้า">การซื้อสินค้า</a>
        <a href="/webboard?type=การเตรียมเอกสาร">การเตรียมเอกสาร</a>
        <a href="/webboard">ค่าเริ่มต้น</a>
        <li><a href="/webboard">ค่าเริ่มต้น</a></li>

      </div>
      </div>

      </div>
      <div class="col-md-4">
      <div class="search-container">
        <form class="navbar-form" role="search"  method="GET">
        <div class="input-group ">
            <input type="text" class="form-control" style="border-color:red" placeholder="<?php echo  Session::get('search'); ?>" name="q">
            <div class="input-group-btn ">
                  <button class="btn btn-danger btn-outline" type="submit" ><i v-if="seach" class="glyphicon glyphicon-search"></i> <i v-if="cancelsearch" class="glyphicon glyphicon-remove"></i></button>
            </div>
        </div>
        </form>
      </div>
      </div>
      <div class="col-md-2 pull-right">
        <form    method="GET">

          <a><button type="button" class="btn btn-danger btn-outline" v-on:click="open()">ตั้งกระทู้
        </button></a>

        </form>

      </div>



      </div>


          </div>

    @foreach ($question as $user)

          <div class="col-md-12">
  <div class="panel panel-danger "><a href="question/comment/<?php echo $user->ques_id ?>" class="text-dark panel-danger">







  <div class="panel-heading" style="word-break:break-all; " >
  <strong>{{ $user->ques_name }}</strong></a>
  @if(isset(Auth::user()->User_ID))
  @if($user->User_ID == Auth::user()->User_ID)
  <span class="glyphicon glyphicon-cog " v-on:click="openedit(<?php echo $user->ques_id ?>)" title="แก้ไขข้อมูลกระทู้"></span>
  @endif
  @endif

  @if(Session::get('idoffice') != null)
  @if($user->User_ID == '1')

  <span class="glyphicon glyphicon-cog " v-on:click="openedit(<?php echo $user->ques_id ?>)" title="แก้ไขข้อมูลกระทู้"></span>
  @endif
  @endif


   <span class="glyphicon glyphicon-calendar text-muted pull-right">{{ $user->ques_date }}</span>
  </div>

  <div class="panel-body " style="word-break:break-all; height: 100px;">
    <?php
$string = strip_tags($user->ques_detail);

if (strlen($string) >= 200) {

    // truncate string
    $stringCut = iconv_substr($string, 0, 200, "UTF-8");

}else {
  $stringCut = $user->ques_detail;

}

      ?>
      <div class="col-md-12 ">
{{ $stringCut }}
</div>

  </div><!-- /panel-body -->

<div class="panel-footer" >
  <div class="row">
    <div class="col-md-6">
    ตั้งกระทู้โดย : {{ $user->User_Name }}
    </div>
    <div class="col-md-6 text-right">
    <a href="question/comment/<?php echo $user->ques_id ?>"><span class="glyphicon glyphicon-comment" style="font-size:20px;"></span>  <span class="badge badge-notify2 ">{{ $user->user_count-1 }}</span></a>

    </div>
  </div>

</div>
</div><!-- /panel panel-default -->
  </div>

    @endforeach

      <div class="col-sm-12">
{{ $question->links() }}
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



          </div>
          <div v-bind:class="{'form-group':headqestionerror , 'has-error has-feedback':headqestionerror }">

                        <label for="recipient-name" class="col-form-label">หัวข้อกระทู้:</label>
                        <input type="text" class="form-control" v-model="headqestion"   >
                        <span class="glyphicon glyphicon-remove form-control-feedback" v-if="headqestionerror"></span>
                        <span class="text-errors" v-if="headqestionerror">
                            <strong><h5>@{{ headqestionerror }}</h5></strong>
                        </span>
                    </div>
<br>





          <div v-bind:class="{'form-group':textqestionerror , 'has-error has-feedback':textqestionerror }">

            <label for="message-text" class="col-form-label">รายละเอียดกระทู้:</label>
            <textarea class="form-control" v-model="textqestion" ></textarea>
                        <span class="glyphicon glyphicon-remove form-control-feedback" v-if="textqestionerror"></span>
                        <span class="text-errors" v-if="textqestionerror">
                            <strong><h5>@{{ textqestionerror }}</h5></strong>
                        </span>
                    </div>
<br>


                    <div v-bind:class="{'form-group':typeerror , 'has-error has-feedback':typeerror }">

                      <label for="sel1">หมวดหมู่กระทู้:</label>
                      <select class="form-control" v-model="type">
                        <option>การเยี่ยมผู้ต้องขัง</option>
                        <option>การซื้อสินค้า</option>
                        <option>การเตรียมเอกสาร</option>
                      </select>

                                  <span class="text-errors" v-if="typeerror">
                                      <strong><h5>@{{ typeerror }}</h5></strong>
                                  </span>
                              </div>

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
        <button type="button" class="btn btn-primary" v-if="btninsert" v-on:click="insert()" >บันทึกข้อมูล</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="formwebboardedit" tabindex="-1" role="dialog" aria-labelledby="formwebboardedit" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">แก้ไขข้อมูลกระทู้</h5>


        <button type="button" class="close btn-danger btn-outline" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">


          </div>
          <div v-bind:class="{'form-group':headqestionerror , 'has-error has-feedback':headqestionerror }">

                        <label for="recipient-name" class="col-form-label">หัวข้อกระทู้:</label>
                        <input type="text" class="form-control" v-model="ques_name"   >
                        <span class="glyphicon glyphicon-remove form-control-feedback" v-if="headqestionerror"></span>
                        <span class="text-errors" v-if="headqestionerror">
                            <strong><h5>@{{ headqestionerror }}</h5></strong>
                        </span>
                    </div>
<br>








          <div v-bind:class="{'form-group':textqestionerror , 'has-error has-feedback':textqestionerror }">

            <label for="message-text" class="col-form-label">รายละเอียดกระทู้:</label>
            <textarea class="form-control" v-model="ques_detail" ></textarea>
                        <span class="glyphicon glyphicon-remove form-control-feedback" v-if="textqestionerror"></span>
                        <span class="text-errors" v-if="textqestionerror">
                            <strong><h5>@{{ textqestionerror }}</h5></strong>
                        </span>
                    </div>
<br>


                    <div v-bind:class="{'form-group':typeerror , 'has-error has-feedback':typeerror }">

                      <label for="sel1">หมวดหมู่กระทู้:</label>
                      <select class="form-control" v-model="ques_type">
                        <option>การเยี่ยมผู้ต้องขัง</option>
                        <option>การซื้อสินค้า</option>
                        <option>การเตรียมเอกสาร</option>
                      </select>

                                  <span class="text-errors" v-if="typeerror">
                                      <strong><h5>@{{ typeerror }}</h5></strong>
                                  </span>
                              </div>

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
        <button type="button" class="btn btn-primary" v-if="btninsert" v-on:click="edit()" >แก้ไขข้อมูลข้อมูล</button>
      </div>
    </div>
  </div>
</div>
           <!-- /.col -->

        <!-- /.col-lg-12 -->
      </div>
      <!-- /.row -->
    </div>
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
        'status2' : '<?php echo Session::get('login'); ?>',
        'seach' : <?php if (Session::get('search') == 'ค้นหา' || Session::get('search') == null ) {echo 'true';}else {echo 'false';} ?>,
        'cancelsearch' :<?php if (Session::get('search')!='ค้นหา' && Session::get('search')!= null ) {echo 'true';}else {echo 'false';} ?>,
        'headqestion' :'',
        'textqestion' :[],
        'headqestionerror':'',
        'textqestionerror':'',
        'type':'',
        'ques_detail':'',
        'ques_name':'',
        'ques_type':'',
        'idedit':'',
        'typeerror':'',
        'btninsert':true,


    },

    computed: {

  },
    methods: {




           open: function () {
             this.headqestionerror = false;
             this.textqestionerror = false;
             this.typeerror = false;
if (information.status =='1' && information.status2 =='yes') {
  swal({
title: 'คุณกำลังเข้าสู่ระบบสองระบบ !',
text: 'หากคุณต้องการใช้สิทธ์เจ้าหน้าที่กรุณาออกจากระบบผู้ใช้',
type: 'warning',
confirmButtonColor: '#3085d6',
confirmButtonText: 'ยืนยัน',
closeOnConfirm: false
})
}else {
  if (information.status =='1' || information.status2 =='yes') {
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
}

           },

           openedit: function (event) {

             var question_ID =	event;

              var link = "/questiondetail/edit/" + question_ID;
              axios.get(link, {
              }).then(function (response) {

                information.idedit = response.data[0].ques_id;
                information.ques_detail = response.data[0].ques_detail;
                information.ques_name = response.data[0].ques_name;
                information.ques_type =response.data[0].ques_type;


$("#formwebboardedit").modal('show');
              })


           },


           insert: function () {
             information.btninsert = false;
             this.headqestionerror = '';
             this.textqestionerror = '';
             this.typeerror = '';
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
information.btninsert=true;
}else {
location.reload();
}

    });
            },

            edit: function () {
              information.btninsert = false;
              this.headqestionerror = '';
              this.textqestionerror = '';
              this.typeerror = '';

var question_ID =	information.idedit;



 axios.post('/edit/question/'+ question_ID, {
     headqestion: information.ques_name,
     textqestion: information.ques_detail,
     type: information.ques_type,

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
 information.btninsert=true;
 }else {
 location.reload();
 }

     });
             },

    }
  })
</script>
@endpush
