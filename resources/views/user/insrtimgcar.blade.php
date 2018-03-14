@extends('layouts.app')

@section('content')
<div class="container"  id="example-4"  >
<div class="loader" id="loader"></div>
   <div class="row justify-content-center" >

       <div class="col-md-12" id="dsds">
           <div class="card card-default ">
               <div class="card-header card text-center bg-info"> จัดการภาพแบรน์เนอร์ </div>

 <div class="card-header card ">
   <div class="row">
     <div class="col-md-6 ">
       <div class="card card-cascade ">

   <!--Card image-->
   <div class="view gradient-card-header blue-gradient">
   <div class="card-header card text-center bg-info"> กรอกข้อมูล </div>

   </div>
   <!--/Card image-->

   <!--Card content-->
   <div class="card-body text-center" >



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

                        <div class="col-md-6" id="text">
                        <div class="card card-cascade">

       <!--Card image-->
       <div class="view gradient-card-header blue-gradient">
         <div class="card-header card text-center bg-info"> ตัวอย่างรูปภาพ </div>

       </div>
       <!--/Card image-->

       <!--Card content-->
       <div class="card-body text-center" >

    <img id='img-upload' />
       </div>

       </div>

   </div>


                          </div>

 </div>


               <div class="card-body" >



               </div>

   <!-- Modal -->


<!---model 2------------------------------------------>





               </div>
           </div>
       </div>
   </div>

</div>

@endsection

@push('scripts')
<script>

document.getElementById("loader").style.display = "none";
document.getElementById("dsds").style.display = "block";
document.getElementById("text").style.display = "none";
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
            document.getElementById("text").style.display = "block";
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
        'imageedit': '',
        'fileoffice':'',
        'image' :'',
        'nameerror':'',
        'imageedit':'',
        'fileofficeerror':'',
        'nameimage':'',
        'showimg':'',
        'id_edit':'',

        'buttonedit':true,
        'buttonedit2':true,
        'inputedit':'true',

        'items': [],
        'pagination': [],
        'searchKey': '',
        'currentPage': 0,
        'itemsPerPage': 5,

    },
    mounted: function mounted() {

 	    this.getVueItems(this.current_page);
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

                    	return item.Info_Name.indexOf(this.searchKey.toLowerCase()) > -1
                      || item.Infoupdated_at.indexOf(this.searchKey.toLowerCase()) > -1
                      || item.official_Name.toLowerCase().indexOf(this.searchKey.toLowerCase()) > -1

                 })
             },
             paginatedUsers: function(list){

             var index = this.currentPage * this.itemsPerPage;
             return this.usersFilteredBySearchKey.slice(index, index + this.itemsPerPage)
					 }
	},
    methods: {getVueItems: function getVueItems(page) {
 	      axios.get('/official/testza?page=' + page).then(function (response) {

 	        information.items = response.data;



 	      });
 	    },
			setPage: function(pageNumber){
		this.currentPage = pageNumber;


				    },


      onFileChange(e) {
               let files = e.target.files || e.dataTransfer.files;
               if (!files.length)
                   return;
               this.createImage(files[0]);
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


             axios.defaults.headers.post['formData'] = 'multipart/form-data';
             axios.post('/official/testza', {
                 id: this.id,
                 name: this.name,
                 fileoffice: this.image,

               }).then(function (response) {
if (response.data.messages != null) {
  if(response.data.messages.name != null){
information.nameerror = true;
information.nameerror = response.data.messages.name[0];
  }
  if(response.data.messages.fileoffice != null){
information.fileofficeerror = true;
information.fileofficeerror = response.data.messages.fileoffice[0];
  }
}else {
  location.reload();
}

                 });


           },
   cleardata: function () {
             information.fileofficeerror = false;
             information.nameerror = false;
           },
  editItem: function(item) {
             information.fileofficeerror = false;
             information.nameerror = false;
             information.buttonedit = true;
             information.buttonedit2 = true;
             information.inputedit = 'true';
       								var info_id =	item.Info_ID;

       								var link = "/official/editinfo/" + info_id;
       								axios.get(link, {
       								}).then(function (response) {
if (response.data[0].official_ID == information.id) {
  information.id_edit = response.data[0].Info_ID;
  information.nameedit = response.data[0].Info_Name;
  information.imageedit = response.data[0].Info_Img;
  information.showimg = response.data[0].Info_Img;
$("#editofficial").modal('show');
}else {
  information.id_edit = response.data[0].Info_ID;
  information.nameedit = response.data[0].Info_Name;
  information.imageedit = response.data[0].Info_Img;
  information.showimg = response.data[0].Info_Img;
  information.buttonedit = false ;
  information.buttonedit2 = false;
  information.inputedit = 'false';
  $("#editofficial").modal('show');

}







       								})

       							        },
        updateItem: function() {

                   var info_id =	this.id_edit;

                   var link = "/official/updateinfo/" + info_id;
                   axios.post(link, {
                     id: this.id,
                     name: this.nameedit,
                     fileoffice: this.image,
                   }).then(function (response) {
                     if (response.data.messages != null) {
                       if(response.data.messages.name != null){
                     information.nameerror = true;
                     information.nameerror = response.data.messages.name[0];
               }
               if(response.data.messages.fileoffice != null){
              information.fileofficeerror = true;
              information.fileofficeerror = response.data.messages.fileoffice[0];
                                           }
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

                          var info_id =	item.Info_ID;

                          axios.post('/official/delete/' + info_id, {
                            info_id: item.Info_ID,
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
