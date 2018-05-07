@extends('layouts.offcialapp')

@section('content')
<div class="container"  id="example-4"  >
<div class="loader" id="loader"></div>
   <div class="row justify-content-center" >

       <div class="col-md-12" id="dsds">
           <div class="card card-default ">
               <div class="card-header card text-center bg-info"> จัดการข้อมูลสินค้าวิชาชีพ </div>

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
                   <th>ชื่อสินค้า</th>
                   <th>ราคาสินค้า</th>
                   <th>จำนวนสินค้า</th>
                   <th>ตัวอย่างรูปภาพ</th>
                   <th>วันที่อัพเดทล่าสุด</th>
                   <th>การจัดการ</th>
                 </tr>
               </thead>




               <tr v-for="item in paginatedUsers" v-if="id == item.official_ID || id == '1'">
                 <td>@{{ item.official_Name }}</td>
                 <td>@{{ item.Pro_Name }}</td>
                 <td>@{{  formatPrice(item.Pro_Price) }}</td>
                 <td>@{{ item.Pro_Count }}</td>
                 <td><img :src="'{{asset('product')}}/' + item.Pro_img" height="42" width="42"/></td>
                 <td>@{{ item.proupdated_at }}</td>
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
     <div class="modal-dialog modal-lg" role="document">
       <div class="modal-content">
         <div class="modal-header  text-center">
           <h5 class="modal-title text-center" id="exampleModalLabel">เพิ่มข้อมูลสินค้าวิชาชีพ</h5>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>
         <div class="modal-body">
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


             <div v-bind:class="{'form-group':nameerror , 'form-control label text-danger is-invalid':nameerror }">
                           <label for="inputMessage">ชื่อสินค้า</label>
                           <input type="text" class="form-control"  id="name" placeholder="ใสชื่อสินค้า" v-model="name"/>
                           <span class="text-danger" v-if="nameerror">
                               <strong>@{{ nameerror }}</strong>
                           </span>
                       </div>
            <div v-bind:class="{'form-group':detailerror , 'form-control label text-danger is-invalid':detailerror }">
              <label for="inputMessage">รายละเอียดสินค้า</label>
            <textarea class="form-control" rows="5" id="detail" placeholder="ใส่รายละเอียดสินค้าวิชาชีพ" v-model="detail"></textarea>

              <span class="text-danger" v-if="detailerror">
                <strong>@{{detailerror }}</strong>
              </span>
            </div>

<div v-bind:class="{'form-group':typeerror , 'form-control label text-danger is-invalid':typeerror }">
                                    <label for="inputMessage">ประเภทสินค้า</label>
<br>
                            <select id="demo" class="form-control" v-model="type">
                                            <option value="เบเกอรี่">เบเกอรี่</option>
                                            <option value="เฟอนิเจอร์">เฟอนิเจอร์</option>
                                            <option value="ของฝาก">ของฝาก</option>
                                            <option value="ศาลพระภูมิ">ศาลพระภูมิ</option>
                                        </select>

                                        <span class="text-danger" v-if="typeerror">
                                          <div class="form-group row">

                                          </div>
                                            <strong>@{{ typeerror }}</strong>
                                        </span>
                                      </div>
                                      <div class="form-group row">

                                      </div>
        <div v-bind:class="{'form-group':moneyerror , 'form-control label text-danger is-invalid':moneyerror }">
                      <label for="inputMessage">ราคาสินค้า</label>
                      <input type="text" class="form-control"  id="money" placeholder="ใส่ราคาสินค้า" v-model="money"/>
                      <span class="text-danger" v-if="moneyerror">
                          <strong>@{{ moneyerror }}</strong>
                      </span>
                  </div>
                  <div v-bind:class="{'form-group':counterror , 'form-control label text-danger is-invalid':counterror }">
                                <label for="inputMessage">จำนวนสินค้า</label>
                                <input type="text" class="form-control"  id="money" placeholder="ใส่จำนวนสินค้า" v-model="count"/>
                                <span class="text-danger" v-if="counterror">
                                    <strong>@{{ counterror }}</strong>
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
         <div class="modal-footer">
           <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
           <button type="button" class="btn btn-primary" v-if="buttonload"><i class="fa fa-spinner fa-spin"></i> บันทึกข้อมูล</button>
           <button type="button" class="btn btn-primary" v-if="buttoninsert"  v-on:click="insert()">บันทึกข้อมูล</button>
         </div>
       </div>
     </div>
   </div>

<!---model 2------------------------------------------>

   <div class="modal fade" id="editofficial" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-lg" role="document">
       <div class="modal-content">
         <div class="modal-header  text-center">
           <h5 class="modal-title text-center" id="exampleModalLabel">แก้ไขข้อมูลสินค้าวิชาชีพ</h5>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>
         <div class="modal-body">
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


             <div v-bind:class="{'form-group':nameerror , 'form-control label text-danger is-invalid':nameerror }">
                           <label for="inputMessage">ชื่อสินค้า</label>
                           <input type="text" class="form-control"  id="name" placeholder="ใส่ชื่อ" v-model="nameedit" :disabled ="inputedit == 'false'"/>
                           <span class="text-danger" v-if="nameerror">
                               <strong>@{{ nameerror }}</strong>
                           </span>
                       </div>
                       <div v-bind:class="{'form-group':detailerror , 'form-control label text-danger is-invalid':detailerror }">
                         <label for="inputMessage">รายละเอียดสินค้า</label>
                       <textarea class="form-control" rows="5" id="detail" placeholder="ใส่รายละเอียดข่าว" v-model="detailedit" :disabled ="inputedit == 'false'"></textarea>

                         <span class="text-danger" v-if="detailerror">
                           <strong>@{{detailerror }}</strong>
                         </span>
                       </div>
                       <div v-bind:class="{'form-group':typeerror , 'form-control label text-danger is-invalid':typeerror }">
                                                           <label for="inputMessage">ประเภทสินค้า</label>
                       <br>
                                                   <select id="demo" class="form-control" v-model="typeedit">
                                                                   <option value="เบเกอรี่">เบเกอรี่</option>
                                                                   <option value="เฟอนิเจอร์">เฟอนิเจอร์</option>
                                                                   <option value="ของฝาก">ของฝาก</option>
                                                                   <option value="ศาลพระภูมิ">ศาลพระภูมิ</option>
                                                               </select>

                                                               <span class="text-danger" v-if="typeerror">
                                                                 <div class="form-group row">

                                                                 </div>
                                                                   <strong>@{{ typeerror }}</strong>
                                                               </span>
                                                             </div>
                                                             <div class="form-group row">

                                                             </div>
                               <div v-bind:class="{'form-group':moneyerror , 'form-control label text-danger is-invalid':moneyerror }">
                                             <label for="inputMessage">ราคาสินค้า</label>
                                             <input type="text" class="form-control"  id="money" placeholder="ใส่ราคาสินค้า" v-model="moneyedit"/>
                                             <span class="text-danger" v-if="moneyerror">
                                                 <strong>@{{ moneyerror }}</strong>
                                             </span>
                                         </div>
                                         <div v-bind:class="{'form-group':counterror , 'form-control label text-danger is-invalid':counterror }">
                                                       <label for="inputMessage">จำนวนสินค้า</label>
                                                       <input type="text" class="form-control"  id="money" placeholder="ใส่จำนวนสินค้า" v-model="countedit"/>
                                                       <span class="text-danger" v-if="counterror">
                                                           <strong>@{{ counterror }}</strong>
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

                                 <div class="form-group row">

                                 </div>

                     </div>

                     </div>
            </div>

                                <div class="col-md-6">
                                <div class="card card-cascade">

               <!--Card image-->
               <div class="view gradient-card-header blue-gradient">
                 <div class="card-header card text-center bg-info"> ตัวอย่างรูปภาพ </div>

               </div>
               <!--/Card image-->

               <!--Card content-->
               <div class="card-body text-center" >

          <img :src="'{{asset('product')}}/' + imageedit" height="400" width="320" id='img-upload2'/>
               </div>

               </div>

           </div>


                                  </div>

         </div>
         <div class="modal-footer">
           <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
           <button type="button" class="btn btn-warning" v-if="buttonload"><i class="fa fa-spinner fa-spin"></i> แก้ไขข้อมูล</button>
           <button type="button" class="btn btn-warning"  v-if="buttonedit" v-on:click="updateItem()">แก้ไขข้อมูล</button>
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
        'moneyerror':'',
        'detail':'',
        'detailerror':'',

        'fileoffice':'',
        'image' :'',
        'nameerror':'',
        'imageedit':'',
        'fileofficeerror':'',
        'nameimage':'',
        'showimg':'',
        'id_edit':'',
        'money':'',
        'typeedit':'',
        'buttonedit':true,
        'buttonedit2':true,
        'inputedit':'true',
        'typeerror':'',
        'type':'',
        'moneyedit':'',
        'count':'',
        'counterror':'',
        'countedit':'',
        'buttoninsert':true,
        'datelasterror':'',
        'buttonload' :false,
        'datelastedit':'',
        'detailedit':'',


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

                    	return item.Pro_Name.indexOf(this.searchKey.toLowerCase()) > -1
                      || item.proupdated_at.indexOf(this.searchKey.toLowerCase()) > -1
                      || item.Pro_Price.indexOf(this.searchKey.toLowerCase()) > -1
                      || item.Pro_Count.indexOf(this.searchKey.toLowerCase()) > -1
                      || item.official_Name.toLowerCase().indexOf(this.searchKey.toLowerCase()) > -1

                 })
             },
             paginatedUsers: function(list){

             var index = this.currentPage * this.itemsPerPage;
             return this.usersFilteredBySearchKey.slice(index, index + this.itemsPerPage)
					 }
	},
    methods: {getVueItems: function getVueItems(page) {
 	      axios.get('/official/productlist?page=' + page).then(function (response) {
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
           formatPrice(value) {
       let val = (value/1).toFixed(0).replace('.', ',')
       return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
      },
           insert: function () {
             information.buttonload = true;
             information.buttoninsert = false;
             information.nameerror = false;
             information.fileofficeerror = false;
             information.detailerror = false;
             information.typeerror = false;
             information.counterror = false;
             information.moneyerror = false;
             axios.defaults.headers.post['formData'] = 'multipart/form-data';
             axios.post('/official/product/add', {
                 id: this.id,
                 name: this.name,
                 fileoffice: this.image,
                 detail : this.detail,
                 type: this.type,
                 money: this.money,
                 count: this.count

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
  if(response.data.messages.type != null){
    information.typeerror = true;
    information.typeerror = response.data.messages.type[0];
  }
  if(response.data.messages.count != null){
    information.counterror = true;
    information.counterror = response.data.messages.count[0];
  }
  if(response.data.messages.money != null){
    information.moneyerror = true;
    information.moneyerror = response.data.messages.money[0];
  }
  if(response.data.messages.detail != null){
  information.detailerror = true;
  information.detailerror = response.data.messages.detail[0];
  }
  information.buttonload = false;
  information.buttoninsert = true;
}else {
  location.reload();
}

                 });


           },
   cleardata: function () {
             information.fileofficeerror = false;
             information.detailerror = false;
             information.nameerror = false;
            information.typeerror = false;
            information.counterror = false;
            information.moneyerror = false;
           },
  editItem: function(item) {

    information.fileofficeerror = false;
    information.detailerror = false;
    information.nameerror = false;
   information.typeerror = false;
   information.counterror = false;
   information.moneyerror = false
   information.buttonedit = true;
   information.buttonedit2 = true;
   information.inputedit = 'true';

       								var Pro_ID =	item.Pro_ID;

       								var link = "/product/edit" + Pro_ID;
       								axios.get(link, {
       								}).then(function (response) {



if (response.data[0].official_ID == information.id) {
  information.id_edit = response.data[0].Pro_ID;
  information.nameedit = response.data[0].Pro_Name;
  information.detailedit = response.data[0].Pro_Detail;
  information.imageedit = response.data[0].Pro_img;
  information.showimg = response.data[0].Pro_img;
information.typeedit = response.data[0].Pro_Type;
information.moneyedit = response.data[0].Pro_Price;
information.countedit = response.data[0].Pro_Count;

$("#editofficial").modal('show');
}else {
  information.id_edit = response.data[0].Pro_ID;
  information.nameedit = response.data[0].Pro_Name;
  information.detailedit = response.data[0].Pro_Detail;
  information.imageedit = response.data[0].Pro_img;
  information.showimg = response.data[0].Pro_img;
information.typeedit = response.data[0].Pro_Type;
information.moneyedit = response.data[0].Pro_Price;
information.countedit = response.data[0].Pro_Count;
  information.buttonedit = false ;
  information.buttonedit2 = false;
  information.inputedit = 'false';
  $("#editofficial").modal('show');

}







       								})

       							        },
        updateItem: function() {
          information.buttonload = true;
          information.buttonedit = false;
          information.nameerror = false;
          information.fileofficeerror = false;
          information.detailerror = false;
          information.typeerror = false;
          information.counterror = false;
          information.moneyerror = false;
                   var Pro_ID =	this.id_edit;

                   var link = "/product/update/" + Pro_ID;
                   axios.post(link, {
                     id: this.id,
                     name: this.nameedit,
                     fileoffice: this.image,
                     detail : this.detailedit,
                     type: this.typeedit,
                     money: this.moneyedit,
                     count: this.countedit
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
                       if(response.data.messages.detail != null){
                       information.detailerror = true;
                       information.detailerror = response.data.messages.detail[0];
                       }
                       if(response.data.messages.type != null){
                         information.typeerror = true;
                         information.typeerror = response.data.messages.type[0];
                       }
                       if(response.data.messages.count != null){
                         information.counterror = true;
                         information.counterror = response.data.messages.count[0];
                       }
                       if(response.data.messages.money != null){
                         information.moneyerror = true;
                         information.moneyerror = response.data.messages.money[0];
                       }
                       information.buttonload = false;
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

                          var Pro_ID =	item.Pro_ID;

                          axios.post('/product/delete' + Pro_ID, {

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
