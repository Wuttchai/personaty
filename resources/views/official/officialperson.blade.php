@extends('layouts.offcialapp')

@section('content')
<div class="container"  id="example-4"  >
<div class="loader" id="loader"></div>
   <div class="row justify-content-center" >

       <div class="col-md-12" id="dsds">
           <div class="card card-default ">
               <div class="card-header card text-center bg-info"> จัดการข้อมูลผู้ต้องขัง </div>

 <div class="card-header card ">


 </div>



               <div class="card-body" >
                 <div class="row">
                   <div class="col-md-6 text-center">



                 <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#official" v-on:click="cleardata">
  เพิ่มข้อมูล
</button>
 </div>
&nbsp;
 <div class="col-md-5 text-right">
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
                   <th>ชื่อผู้ทำ</th>
                   <th>ชื่อประเภทข้อมูลผู้ต้องขัง</th>
                   <th>จำนวนผู้ต้องขัง</th>
                   <th>วันที่อัพเดทล่าสุด</th>
                   <th>จัดการ</th>
                 </tr>
               </thead>
               <tr v-for="item in paginatedUsers">
                 <td>@{{ item.official_Name }}</td>
                 <td>@{{ item.Person_Type }}</td>
                 <td>@{{ item.Person_Num }}</td>
                 <td>@{{ item.perupdated_at }} </td>

           <td >

              <button  type="button"  v-on:click="editItem(item)" class="btn btn-warning"><i class="material-icons">แก้ไข</i></button>&nbsp;&nbsp;&nbsp;
              <button  type="button" v-on:click="deleteItem(item)" class="btn btn-danger"><i class="material-icons">ลบ</i></button>

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
     <div class="modal-dialog modal-mg" role="document">
       <div class="modal-content">
         <div class="modal-header  text-center">
           <h5 class="modal-title text-center" id="exampleModalLabel">เพิ่มข้อมูลผู้ต้องขัง</h5>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>
         <div class="modal-body">
           <div class="row">
             <div class="col-md-12 ">
               <div class="card card-cascade card text-center">

           <!--Card image-->
           <div class="view gradient-card-header blue-gradient">
           <div class="card-header card text-center bg-info"> กรอกข้อมูล </div>

           </div>
           <!--/Card image-->

           <!--Card content-->
           <div class="card-body text-center" >


             <div v-bind:class="{'form-group':nameerror , 'form-control label text-danger is-invalid':nameerror }">
                           <label for="inputMessage">ชื่อประเภทข้อมูลผู้ต้องขัง</label>
                           <input type="text" class="form-control"  id="name" placeholder="ใส่ชื่อประเภทข้อมูลผู้ต้องขัง" v-model="name"/>
                           <span class="text-danger" v-if="nameerror">
                               <strong>@{{ nameerror }}</strong>
                           </span>
                       </div>

<div class="card-body" >



</div>
<div v-bind:class="{'form-group':counterror , 'form-control label text-danger is-invalid':counterror }">
              <label for="inputMessage">จำนวนผู้ต้องขัง</label>
              <input type="text" class="form-control"  id="count" placeholder="ใส่จำนวนผู้ต้องขัง" v-model="count"/>
              <span class="text-danger" v-if="counterror">
                  <strong>@{{ counterror }}</strong>
              </span>
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
     <div class="modal-dialog modal-mg" role="document">
       <div class="modal-content">
         <div class="modal-header  text-center">
           <h5 class="modal-title text-center" id="exampleModalLabel">แก้ไขข้อมูลผู้ต้องขัง</h5>
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
                                        <label for="inputMessage">ชื่อประเภทข้อมูลผู้ต้องขัง</label>
                                        <input type="text" class="form-control"  id="nameedit" placeholder="ใส่ชื่อประเภทข้อมูลผู้ต้องขัง" v-model="nameedit"/>
                                        <span class="text-danger" v-if="nameerror">
                                            <strong>@{{ nameerror }}</strong>
                                        </span>
                                    </div>

             <div class="card-body" >



             </div>
             <div v-bind:class="{'form-group':counterror , 'form-control label text-danger is-invalid':counterror }">
                           <label for="inputMessage">จำนวนผู้ต้องขัง</label>
                           <input type="text" class="form-control"  id="countedit" placeholder="ใส่จำนวนผู้ต้องขัง" v-model="countedit"/>
                           <span class="text-danger" v-if="counterror">
                               <strong>@{{ counterror }}</strong>
                           </span>
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
           <button type="button" class="btn btn-warning"  v-if="buttonedit"  v-on:click="updateItem()">บันทึก</button>
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

document.getElementById("loader").style.display = "none";
document.getElementById("dsds").style.display = "block";


var information =  new Vue({
    el: '#example-4',
    data: {
        'id'  :'<?php echo Session::get('idoffice'); ?>',
        'name': '',
        'nameedit': '',
        'count': '',
        'countedit':'',
        'counterror':'',
        'nameerror':'',
        'id_edit':'',
        'total' : [],
        'buttoninsert':false,
        'buttonedit':true,
        'buttoninsert':true,

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

                    	return  item.Person_Type.indexOf(this.searchKey.toLowerCase()) > -1
                      || item.official_Name.toLowerCase().indexOf(this.searchKey.toLowerCase()) > -1
                      || item.Person_Num.toLowerCase().indexOf(this.searchKey.toLowerCase()) > -1
                      || item.perupdated_at.toLowerCase().indexOf(this.searchKey.toLowerCase()) > -1

                 })
             },
             paginatedUsers: function(list){

             var index = this.currentPage * this.itemsPerPage;
             return this.usersFilteredBySearchKey.slice(index, index + this.itemsPerPage)
					 }
	},
    methods: {getVueItems: function getVueItems(page) {
 	      axios.get('/official/personlist?page=' + page).then(function (response) {

 	        information.items = response.data;
          information.total =+ response.data[0];

 	      });
 	    },
			setPage: function(pageNumber){
		this.currentPage = pageNumber;


				    },


           insert: function () {

            information.buttonedit=false;
             information.buttoninsert=false;
             axios.defaults.headers.post['formData'] = 'multipart/form-data';
             axios.post('/official/person/add', {
                 id: this.id,
                 name: this.name,
                 count: this.count,

               }).then(function (response) {
if (response.data.messages != null) {
  if(response.data.messages.name != null){
information.nameerror = true;
information.nameerror = response.data.messages.name[0];
  }
  if(response.data.messages.count != null){
information.counterror = true;
information.counterror = response.data.messages.count[0];
  }
  information.buttoninsert=true;
}else {
  location.reload();
}

                 });


           },
   cleardata: function () {
             information.counterror = false;
             information.nameerror = false;
           },
  editItem: function(item) {
             information.counterror = false;
             information.nameerror = false;

       								var Person_ID =	item.Person_ID;

       								var link = "/person/edit" + Person_ID;
       								axios.get(link, {
       								}).then(function (response) {

  information.id_edit = response.data[0].Person_ID;
  information.nameedit = response.data[0].Person_Type;
  information.countedit = response.data[0].Person_Num;
$("#editofficial").modal('show');








       								})

       							        },
        updateItem: function() {
information.buttonedit=false;
                   var Person_ID =	this.id_edit;

                   var link = "/person/updateinfo/" + Person_ID;
                   axios.post(link, {
                     id: this.id,
                     name: this.nameedit,
                     count: this.countedit,
                   }).then(function (response) {
                     if (response.data.messages != null) {
                       if(response.data.messages.name != null){
                     information.nameerror = true;
                     information.nameerror = response.data.messages.name[0];
                       }
                       if(response.data.messages.count != null){
                     information.counterror = true;
                     information.counterror = response.data.messages.count[0];
                       }
                       information.buttonedit=true;
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

                          var Person_ID =	item.Person_ID;

                          axios.post('/person/delete/' + Person_ID, {

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
