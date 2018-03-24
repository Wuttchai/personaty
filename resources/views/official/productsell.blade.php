@extends('layouts.offcialapp')

@section('content')
<div class="container"  id="example-4"  >
<div class="loader" id="loader"></div>
   <div class="row justify-content-center" >

       <div class="col-md-12" id="dsds">
           <div class="card card-default ">
               <div class="card-header card text-center bg-info"> จัดการข้อมูลการสั่งซื้อสินค้า </div>

 <div class="card-header card ">


 </div>


               <div class="card-body" >
                 <div class="row">
                   <div class="col-md-4 text-center">




 </div>

 <div class="col-md-6 text-right">
<div class="input-group input-group-sm" style="width: 300px;">
	                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search" v-model="searchKey">

	                   <div class="input-group-btn">
	                     <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
	                   </div>
	                 </div>
</div>
 </div>
 <br>
 <div class="row">
   <div class="col-md-12" style="overflow-x:auto;">

    


                                <table class="table table-borderless text-center" id="table">
               <thead>
                 <tr>
                   <th>ชื่อผู้สั่งสินค้า</th>
                   <th>จำนวนที่สั่ง</th>
                   <th>ราคารวม</th>
                   <th>การจัดส่ง</th>
                   <th>วันที่ชำระเงิน</th>
                   <th>การจัดการ</th>
                 </tr>
               </thead>
               <tr v-for="item in paginatedUsers">
                 <td>@{{ item.User_Name }}</td>
                 <td>@{{ item.Prosell_Quantity }}</td>
                 <td>@{{ item.Prosell_totalPirce }}</td>
                <td>@{{ item.Prosell_send }}</td>
                 <td>@{{ item.Prosell_orderdate }}</td>


           <td>

<a :href="'/sell/view/' + item.Prosell_ID" >
              <button  type="button"   class="btn btn-primary"><i class="material-icons">ดูรายละเอียดการสั่งซื้อสินค้า</i></button>
</a>

            </td>

               </tr>
             </table>



                 <ul class="pagination">
 <li  class="page-item" v-if="currentPage >= 1" @click.prevent="setPage(currentPage-1)"><a class="page-link" href="#">กลับ</a></li>

     <li  class="page-item"  v-for="n in totalPage" v-if="Math.abs(n) < 10 || n == 0 || n == totalPage"
                v-bind:class="{'active': (currentPage == (n-1))}"
                @click.prevent="setPage(n-1)"><a class="page-link" href="#">@{{n}}</a></li>

 <li  class="page-item" v-if="currentPage <= totalPage-2" @click.prevent="setPage(currentPage+1)"><a class="page-link" href="#">ต่อไป</a></li>


</ul>

                            </div>
                           </div>
               </div>

   <!-- Modal -->
   <div class="modal fade" id="official" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-lg" role="document">
       <div class="modal-content">
         <div class="modal-header  text-center">
           <h5 class="modal-title text-center" id="exampleModalLabel">เพิ่มข้อมูลเอกสารที่เผยแพร่</h5>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>
         <div class="modal-body">
           <div class="row">
             <div class="col-md-12 ">
               <div class="card card-cascade ">

           <!--Card image-->
           <div class="view gradient-card-header blue-gradient">
           <div class="card-header card text-center bg-info"> กรอกข้อมูล </div>

           </div>
           <!--/Card image-->

           <!--Card content-->
           <div class="card-body text-center" >


             <div v-bind:class="{'form-group':nameerror , 'form-control label text-danger is-invalid':nameerror }">
                           <label for="inputMessage">เนื้อหาข้างต้นของไฟล์</label>
                          <textarea class="form-control" rows="5" id="detail" placeholder="ใส่รายละเอียดข่าว" v-model="name"></textarea>
                           <span class="text-danger" v-if="nameerror">
                               <strong>@{{ nameerror }}</strong>
                           </span>
                       </div>
            <div v-bind:class="{'form-group':detailerror , 'form-control label text-danger is-invalid':detailerror }">
              <label for="inputMessage">รายละเอียดข่าว</label>


              <span class="text-danger" v-if="detailerror">
                <strong>@{{detailerror }}</strong>
              </span>
            </div>


<div class="card-body" >



</div>

                 <div class="form-group">
                   <div v-bind:class="{'form-group':fileofficeerror , 'form-control label text-danger is-invalid':fileofficeerror }">

                                 <span class="btn btn-success btn-file" >
                                     Browse… <input type="file" id="imgInp" v-on:change="onFileChange">
                                 </span>
                                 <div class="form-group row">

                                 </div>
                                    <input type="text" class="form-control" readonly>
                                 <span class="text-danger" v-if="fileofficeerror">
                                     <strong>@{{ fileofficeerror }}</strong>
                                 </span>
                             </div>


                       </div>
                       <div class="form-group row">

                       </div>



                     </div>

                     </div>
            </div>




                                  </div>

         </div>
         <div class="modal-footer">
           <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
           <button type="button" class="btn btn-primary"  v-if="buttoninsert" v-on:click="insert()">บันทึกข้อมูล</button>
         </div>
       </div>
     </div>
   </div>

<!---model 2------------------------------------------>

   <div class="modal fade" id="editofficial" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-lg" role="document">
       <div class="modal-content">
         <div class="modal-header  text-center">
           <h5 class="modal-title text-center" id="exampleModalLabel">แก้ไขข้อมูลเอกสารที่เผยแพร่ ์</h5>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>
         <div class="modal-body">
           <div class="row">
             <div class="col-md-12 ">
               <div class="card card-cascade ">

           <!--Card image-->
           <div class="view gradient-card-header blue-gradient">
           <div class="card-header card text-center bg-info"> กรอกข้อมูล </div>

           </div>
           <!--/Card image-->

           <!--Card content-->
           <div class="card-body text-center" >


             <div v-bind:class="{'form-group':nameerror , 'form-control label text-danger is-invalid':nameerror }">
                           <label for="inputMessage">เนื้อหาข้างต้นของไฟล์</label>
                           <textarea class="form-control" rows="5" id="detail" placeholder="ใส่รายละเอียดข่าว" v-model="nameedit" :disabled ="inputedit == 'false'"></textarea>
                           <span class="text-danger" v-if="nameerror">
                               <strong>@{{ nameerror }}</strong>
                           </span>
                       </div>


  <div class="card-body" >



  </div>



                 <div class="form-group">
                   <div v-bind:class="{'form-group':fileofficeerror , 'form-control label text-danger is-invalid':fileofficeerror }">

                                 <span class="btn btn-success btn-file" v-if="buttonedit2" >
                                     Browse… <input type="file" id="imgInp2"  v-on:change="onFileChange">
                                 </span>
                                 <div class="form-group row">

                                 </div>
                                    <input type="text" class="form-control" v-model="showimg" readonly>
                                 <span class="text-danger" v-if="fileofficeerror">
                                     <strong>@{{ fileofficeerror }}</strong>
                                 </span>
                             </div>


                       </div>
                       <div class="form-group row">

                       </div>

                     </div>

                     </div>
            </div>




                                  </div>

         </div>
         <div class="modal-footer">
           <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
           <button type="button" class="btn btn-warning"  v-if="buttonedit" v-on:click="updateItem()">บันทึก</button>
         </div>
       </div>
     </div>
   </div>



               </div>
           </div>
       </div>
   </div>

</div>

@endsection

@push('scripts')
<script>


$(document).ready(function () {
    $('.datepicker').datepicker({
        format: 'dd/mm/yyyy',
        todayBtn: true,
        language: 'th',
        thaiyear: true
    }).datepicker("setDate", "0");
    $('.datepicker2').datepicker({
        format: 'dd/mm/yyyy',
        todayBtn: true,
        language: 'th',
        thaiyear: true
    }).datepicker();
});


document.getElementById("loader").style.display = "none";
document.getElementById("dsds").style.display = "block";

$(document).ready( function() {

    	$(document).on('change', '.btn-file :file', function() {
		var input = $(this),
			label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
		input.trigger('fileselect', [label]);
		});

		$('.btn-file :file').on('fileselect', function(event, label) {

		    var input = $(this).parents('.form-group').find(':text'),
		        log = label;

		    if( input.length ) {
		        input.val(log);
		    } else {
		        if( log ) alert(log);
		    }

		});
		function readURL(input) {
		    if (input.files && input.files[0]) {
		        var reader = new FileReader();

		        reader.onload = function (e) {
		            $('#img-upload').attr('src', e.target.result);
		        }

		        reader.readAsDataURL(input.files[0]);

		    }
		}

		$("#imgInp").change(function(){
		    readURL(this);
		});

//test

    function readURL2(input) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();

          reader.onload = function (e) {
              $('#img-upload2').attr('src', e.target.result);
          }

          reader.readAsDataURL(input.files[0]);

      }
    }

    $("#imgInp2").change(function(){
      readURL2(this);
    });


	});

var information =  new Vue({
    el: '#example-4',
    data: {
        'id'  :'<?php echo Session::get('idoffice'); ?>',
        'name': '',
        'nameedit': '',
        'startDate':'',
        'detail':'',
        'detailerror':'',
        'imageedit': '',
        'fileoffice':'',
        'image' :'',
        'nameerror':'',
        'imageedit':'',
        'fileofficeerror':'',
        'nameimage':'',
        'showimg':'',
        'id_edit':'',
        'datefirst':[],
        'datelast':[],
        'buttonedit':true,
        'buttonedit2':true,
        'inputedit':'true',
        'datefirsterror':'',
        'datelasterror':'',
        'datefirstedit':'',
        'datelastedit':'',
        'detailedit':'',
        'buttoninsert' : false,
        'items': [],
        'pagination': [],
        'searchKey': '',
        'currentPage': 0,
        'itemsPerPage': 5,

    },
    mounted: function mounted() {

 	    this.getVueItems(this.current_page);
      $("#inputdatepicker").datepicker().on(
     "changeDate", () => {this.startDate = $('#datefirst').val()}
 );

 	  },
		computed: {
			isActived: function() {
					return this.current_page;
			},


			totalPage: function(){
		 if( this.searchKey.trim() == '' ) {
			 return Math.ceil(this.items.length / this.itemsPerPage)
		 }
		 else{
			 return Math.ceil(this.usersFilteredBySearchKey.length/ this.itemsPerPage);
		 }
	 },
   setPage: function(pageNumber){
   		this.currentPage = pageNumber;


   				    },

          usersFilteredBySearchKey: function () {

                return this.items.filter(item => {
                    	return item.Prosell_Quantity.toString().toLowerCase().indexOf(this.searchKey.toLowerCase()) > -1
                      || item.User_Name.toLowerCase().indexOf(this.searchKey.toLowerCase()) > -1
                      || item.Prosell_totalPirce.toString().toLowerCase().indexOf(this.searchKey.toLowerCase()) > -1


                 })
             },
             paginatedUsers: function(list){

             var index = this.currentPage * this.itemsPerPage;
             return this.usersFilteredBySearchKey.slice(index, index + this.itemsPerPage)
					 }
	},
    methods: {getVueItems: function getVueItems(page) {
 	      axios.get('/official/productselllist?page=' + page).then(function (response) {

 	        information.items = response.data;



 	      });
 	    },
			setPage: function(pageNumber){
		this.currentPage = pageNumber;


				    },


      onFileChange(e) {
               let files = e.target.files || e.dataTransfer.files;
               this.image = files[0];

           },
           createImage(file) {
               let reader = new FileReader();
               let vm = this;
               reader.onload = (e) => {
                   vm.image = e.target.result;
               };
               reader.readAsDataURL(file);
           },
           insert: function () {
             information.buttoninsert = false;
             information.nameerror = false;
             information.fileofficeerror = false;
const config = { headers: { 'Content-Type': 'multipart/form-data' } };
             const data = new FormData();

             data.append('id', this.id);
             data.append('name', this.name);
             data.append('secondParam', 0);
             data.append('fileoffice', this.image);


             axios.post('/official/document/add', data, config).then(function (response) {



if (response.data.messages != null) {
  if(response.data.messages.name != null){
information.nameerror = true;
information.nameerror = response.data.messages.name[0];
  }
  if(response.data.messages.fileoffice != null){
information.fileofficeerror = true;
information.fileofficeerror = response.data.messages.fileoffice[0];
  }
information.buttoninsert = true;
}else if (response.data[0] == 'true' && response.data[1] == 'ชื่อไฟล์มีขนาดยาวเกินไป') {
information.buttoninsert = true;
  information.fileofficeerror = true;
  information.fileofficeerror = response.data[1];
}

else {
location.reload();
}

                 });


           },
   cleardata: function () {
     information.nameerror = false;
     information.fileofficeerror = false;
           },
  editItem: function(item) {


             information.fileofficeerror = false;
             information.nameerror = false;
             information.buttonedit = true;
             information.buttonedit2 = true;
             information.inputedit = 'true';

       								var doc_id =	item.doc_id;
       								var link = "/documentlist/edit"  + doc_id;

       								axios.get(link, {
       								}).then(function (response) {


if (response.data[0].official_ID == information.id) {
  information.id_edit = response.data[0].doc_id;
  information.nameedit = response.data[0].doc_name;
  information.showimg = response.data[0].doc_file;
$("#editofficial").modal('show');
}else {
  information.id_edit = response.data[0].doc_id;
  information.nameedit = response.data[0].doc_name;
  information.showimg = response.data[0].doc_file;
  information.buttonedit = false ;
  information.buttonedit2 = false;
  information.inputedit = 'false';
  $("#editofficial").modal('show');


}

       								})

       							        },
        updateItem: function() {
          information.buttonedit = false;
          information.nameerror = false;
          information.fileofficeerror = false;
          const config = { headers: { 'Content-Type': 'multipart/form-data' } };
                       const data = new FormData();

                       data.append('id', this.id);
                       data.append('name', this.nameedit);
                       data.append('secondParam', 0);
                       data.append('fileoffice', this.image);
                         var doc_id =	this.id_edit;



                      axios.post("/document/update/"+doc_id ,data, config).then(function (response) {

                     if (response.data.messages != null) {
                       if(response.data.messages.name != null){
                     information.nameerror = true;
                     information.nameerror = response.data.messages.name[0];
                       }
                       if(response.data.messages.fileoffice != null){
                     information.fileofficeerror = true;
                     information.fileofficeerror = response.data.messages.fileoffice[0];
                       }else if (response.data[0] == 'true' && response.data[1] == 'ชื่อไฟล์มีขนาดยาวเกินไป') {
                         console.log(response.data[1])
                         information.fileofficeerror = true;
                         information.fileofficeerror = response.data[1];
                       }
information.buttonedit = true;
              }else {
              location.reload();
              }




            })

                  },
                  deleteItem: function(item) {

                      if (item.official_ID == information.id || information.id == '1') {
                        swal({
                  title: 'คุณแน่ใจ !',
                  text: 'คุณจะไม่สามารถกู้คืนไฟล์ที่ลบนี้ได้',
                  type: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'ยืนยัน',
                  cancelButtonText : 'ยกเลิก',
                  closeOnConfirm: false




                  }).then(function () {

                          var doc_id =	item.doc_id;

                          axios.post('/document/delete' + doc_id, {

                            id: information.id,
                          }).then(function (response) {
                            information.items = response.data;
                            $("#official").modal('hide');
                          });
                          swal(
                            'ถูกลบเเล้ว !',
                            'ไฟล์ของคุณถูกลบแล้ว.',
                            'success'
                          )

                        }, function (dismiss) {
                          // dismiss can be 'cancel', 'overlay',
                          // 'close', and 'timer'
                          if (dismiss === 'cancel') {
                            swal(
                              'ยกเลิกเเล้ว',
                              'ไฟล์ที่คุณเลือกปลอดภัย :)',
                              'error'
                            )
                          }
                        })
                    }else {
                      swal({
                title: 'คุณไม่มีสิทธิ์ไฟล์นี้ !',
                text: 'กรุณาตรวจสอบไฟล์ที่ต้องการลบอีกครั้ง',
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
