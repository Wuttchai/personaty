
                  @extends('layouts.offcialapp')

                  @section('content')
                  <div class="container"  id="information"  >
                  <div class="loader" id="loader"></div>
                     <div class="row justify-content-center" >

                         <div class="col-md-12" id="dsds">
                             <div class="card card-default ">
                                 <div class="card-header card text-center bg-info">จัดการข้อมูลเจ้าหน้าที่</div>

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
                                     <th>ชื่อ-นามสกุล</th>
                                     <th>จ.ภาพแบรน์เนอร์</th>
                                     <th>จ.สินค้าวิชาชีพ</th>
                                     <th>จ.ข่าวประชาสัมพันธ์</th>
                                     <th>จ.ข้อมูลเจ้าหน้าที่</th>
                                     <th>จ.ข้อมูลเกี่ยวกับเรือนจำ</th>
                                     <th>จ.ข้อมูลเอกสาร</th>
                                     <th>จ.ข้อมูลวันหยุดทำการ</th>
                                     <th>การจัดการ</th>
                                   </tr>
                                 </thead>
                                 <tr v-for="item in paginatedUsers">
                                   <td>@{{ item.official_Name }}</td>
                                   <td>@{{ item.info }}</td>
                                   <td>@{{ item.product }}</td>
                                   <td>@{{ item.hotnews }}</td>
                                   <td>@{{ item.activity }}</td>
                                   <td>@{{ item.prison }}</td>
                                   <td>@{{ item.document }}</td>
                                   <td>@{{ item.calender }}</td>


                             <td >

                                <button  type="button"  v-on:click="editItem(item)" class="btn btn-warning"><i class="material-icons">แก้ไข</i></button>

                                <button  type="button" v-on:click="deleteItem(item)" class="btn btn-danger" style="width: 62px;"><i class="material-icons"> ลบ</i></button>

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
                             <h5 class="modal-title text-center" id="exampleModalLabel">เพิ่มข้อมูลเจ้าหน้าที่</h5>
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
                                             <label for="inputMessage">ชื่อ-นามสกุล :</label>
                                             <input type="text" class="form-control"   placeholder="ใส่ชื่อ-นามสกุล" v-model="name"/>
                                             <span class="text-danger" v-if="nameerror">
                                                 <strong>@{{ nameerror }}</strong>
                                             </span>
                                         </div>

                               <div v-bind:class="{'form-group':emailerror , 'form-control label text-danger is-invalid':emailerror }">
                               <label for="inputMessage">อีเมลล์ :</label>
                               <input type="text" class="form-control"   placeholder="ใส่อีเมลล์" v-model="email"/>
                               <span class="text-danger" v-if="emailerror">
                                  <strong>@{{ emailerror }}</strong>
                               </span>
                                      </div>
                                      <div v-bind:class="{'form-group':passworderror , 'form-control label text-danger is-invalid':passworderror }">
                                        <label for="inputMessage">รหัสผ่าน :</label>
                                        <input type="password" class="form-control"   placeholder="ใส่รหัสผ่าน" v-model="password"/>
                                     <span class="text-danger" v-if="passworderror">
                                            <strong>@{{ passworderror }}</strong>
                                        </span>
                                                </div>

                                     <div v-bind:class="{'form-group':password_confirmationerror , 'form-control label text-danger is-invalid':password_confirmationerror }">
                                                  <label for="inputMessage">ยืนยัน รหัสผ่าน :</label>
                                                  <input type="password" class="form-control"   placeholder="ยืนยัน รหัสผ่าน" v-model="password_confirmation"/>
                                               <span class="text-danger" v-if="password_confirmationerror">
                                                      <strong>โปรดกรอกข้อมูล.</strong>
                                                  </span>
                                                          </div>


                     <div class="card-body" >

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
                                   <div class="card-header card text-center bg-warning"> กำหนดสิทธ์ผู้ใช้ </div>

                                 </div>
                                 <!--/Card image-->

                                 <!--Card content-->
                                 <div class="card-body text-center" >
                                   <div class="form-group row">
                               <label for="User_Tel" class="col-md-7 col-form-label text-md-left">จัดการภาพแบรน์เนอร์ :</label>
                               <div class="col-md-4 ">
                               <p class="form-control onoff"><input type="checkbox" v-model="info" value="จัดการ" id="checkboxID"><label for="checkboxID"></label></p>
                               </div>
                                 </div>
                                 <div class="form-group row">
                                 <label for="User_Tel" class="col-md-7 col-form-label text-md-left">จัดการสินค้าวิชาชีพ :</label>
                                 <div class="col-md-4 ">
                                 <p class="form-control onoff"><input type="checkbox" value="จัดการ" v-model="product" id="checkboxID2"><label for="checkboxID2"></label></p>
                                 </div>
                                 </div>
                                 <div class="form-group row">
                                            <label for="User_Tel" class="col-md-7 col-form-label text-md-left">จัดการข่าวประชาสัมพันธ์ :</label>
                                            <div class="col-md-4 ">
                                        <p class="form-control onoff"><input type="checkbox" v-model="hotnews" value="จัดการ" id="checkboxID3"><label for="checkboxID3"></label></p>
                                            </div>
                                        </div>
                                 <div class="form-group row">
                                          <label for="User_Tel" class="col-md-7 col-form-label text-md-left">จัดการข้อมูลเจ้าหน้าที่ :</label>
                                          <div class="col-md-4 ">
                                 <p class="form-control onoff"><input type="checkbox" v-model="activity" value="จัดการ" id="checkboxID4"><label for="checkboxID4"></label></p>
                                          </div>
                                      </div>
                                 <div class="form-group row">
                                      <label for="User_Tel" class="col-md-7 col-form-label text-md-left">จัดการข้อมูลผู้ต้องขัง :</label>
                                      <div class="col-md-4 ">
                                  <p class="form-control onoff"><input type="checkbox" v-model="prison" value="จัดการ" id="checkboxID5"><label for="checkboxID5"></label></p>
                                      </div>
                                  </div>
                                  <div class="form-group row">
                                       <label for="User_Tel" class="col-md-7 col-form-label text-md-left">จัดการข้อมูลเอกสารเผยแพร่ :</label>
                                       <div class="col-md-4 ">
                                   <p class="form-control onoff"><input type="checkbox" v-model="documentper" value="จัดการ" id="checkboxID6"><label for="checkboxID6"></label></p>
                                       </div>
                                   </div>
                                   <div class="form-group row">
                                        <label for="User_Tel" class="col-md-7 col-form-label text-md-left">จัดการข้อมูลข้อมูลวันหยุดทำการ :</label>
                                        <div class="col-md-4 ">
                                    <p class="form-control onoff"><input type="checkbox" v-model="calender" value="จัดการ" id="checkboxID7"><label for="checkboxID7"></label></p>
                                        </div>
                                    </div>
                                  <div class="alert alert-danger text-center" role="alert" v-if="nocheck">
                     <strong>คุณไม่ได้กำหนดสิทธ์เจ้าหน้าที่ !</strong>  <br> กรุณากำหนดสิทธ์เจ้าหน้าที่อย่างน้อย1สิทธ์
                     </div>
                                  <br>

                                 </div>

                                 </div>

                             </div>


                                                    </div>

                           </div>
                           <div class="modal-footer">
                             <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                               <button type="button" class="btn btn-primary" v-if="buttonload"><i class="fa fa-spinner fa-spin"></i> บันทึกข้อมูล</button>
                             <button type="button" class="btn btn-primary"  v-if="buttoninsert"  v-on:click="insert()">บันทึกข้อมูล</button>
                           </div>
                         </div>
                       </div>
                     </div>

                  <!---model 2------------------------------------------>

                  <div class="modal fade" id="editofficial" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                        <div class="modal-header  text-center">
                          <h5 class="modal-title text-center" id="exampleModalLabel">แก้ไขข้อมูลเจ้าหน้าที่</h5>
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
                                          <label for="inputMessage">ชื่อ-นามสกุล :</label>
                                          <input type="text" class="form-control"   placeholder="ใส่ชื่อ-นามสกุล" v-model="nameedit"/>
                                          <span class="text-danger" v-if="nameerror">
                                              <strong>@{{ nameerror }}</strong>
                                          </span>
                                      </div>

                            <div v-bind:class="{'form-group':emailerror , 'form-control label text-danger is-invalid':emailerror }">
                            <label for="inputMessage">อีเมลล์ :</label>
                            <input type="text" class="form-control"   placeholder="ใส่อีเมลล์" v-model="emailedit"/>
                            <span class="text-danger" v-if="emailerror">
                               <strong>@{{ emailerror }}</strong>
                            </span>
                                   </div>
                                   <div v-bind:class="{'form-group':passworderror , 'form-control label text-danger is-invalid':passworderror }">
                                     <label for="inputMessage">รหัสผ่าน :</label>
                                     <input type="password" class="form-control"   placeholder="ใส่รหัสผ่าน" v-model="passwordedit"/>
                                  <span class="text-danger" v-if="passworderror">
                                         <strong>@{{ passworderror }}</strong>
                                     </span>
                                             </div>

                                  <div v-bind:class="{'form-group':password_confirmationerror , 'form-control label text-danger is-invalid':password_confirmationerror }">
                                               <label for="inputMessage">ยืนยัน รหัสผ่าน :</label>
                                               <input type="password" class="form-control"   placeholder="ยืนยัน รหัสผ่าน" v-model="password_confirmationedit"/>
                                            <span class="text-danger" v-if="password_confirmationerror">
                                                   <strong>โปรดกรอกข้อมูล.</strong>
                                               </span>
                                                       </div>


                  <div class="card-body" >

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
                                <div class="card-header card text-center bg-warning"> แก้ไขสิทธ์ผู้ใช้ </div>

                              </div>
                              <!--/Card image-->

                              <!--Card content-->
                              <div class="card-body text-center" >
                                <div class="form-group row">
                            <label for="User_Tel" class="col-md-7 col-form-label text-md-left">จัดการภาพแบรน์เนอร์ :</label>
                            <div class="col-md-4 ">
                            <p class="form-control onoff"><input type="checkbox" v-model="infoedit" value="จัดการ" id="checkboxID6"><label for="checkboxID6"></label></p>
                            </div>
                              </div>
                              <div class="form-group row">
                              <label for="User_Tel" class="col-md-7 col-form-label text-md-left">จัดการสินค้าวิชาชีพ :</label>
                              <div class="col-md-4 ">
                              <p class="form-control onoff"><input type="checkbox" value="จัดการ" v-model="productedit" id="checkboxID7"><label for="checkboxID7"></label></p>
                              </div>
                              </div>
                              <div class="form-group row">
                                         <label for="User_Tel" class="col-md-7 col-form-label text-md-left">จัดการข่าวประชาสัมพันธ์ :</label>
                                         <div class="col-md-4 ">
                                     <p class="form-control onoff"><input type="checkbox" v-model="hotnewsedit" value="จัดการ" id="checkboxID8"><label for="checkboxID8"></label></p>
                                         </div>
                                     </div>
                              <div class="form-group row">
                                       <label for="User_Tel" class="col-md-7 col-form-label text-md-left">จัดการข้อมูลเจ้าหน้าที :</label>
                                       <div class="col-md-4 ">
                              <p class="form-control onoff"><input type="checkbox" v-model="activityedit" value="จัดการ" id="checkboxID9"><label for="checkboxID9"></label></p>
                                       </div>
                                   </div>
                              <div class="form-group row">
                                   <label for="User_Tel" class="col-md-7 col-form-label text-md-left">จัดการข้อมูลผู้ต้องขัง :</label>
                                   <div class="col-md-4 ">
                               <p class="form-control onoff"><input type="checkbox" v-model="prisonedit" value="จัดการ" id="checkboxID10"><label for="checkboxID10"></label></p>
                                   </div>
                               </div>
                               <div class="form-group row">
                                    <label for="User_Tel" class="col-md-7 col-form-label text-md-left">จัดการข้อมูลเอกสารเผยแพร่ :</label>
                                    <div class="col-md-4 ">
                                <p class="form-control onoff"><input type="checkbox" v-model="documentperedit" value="จัดการ" id="checkboxID11"><label for="checkboxID11"></label></p>
                                    </div>
                                </div>
                                <div class="form-group row">
                                     <label for="User_Tel" class="col-md-7 col-form-label text-md-left">จัดการข้อมูลข้อมูลวันหยุดทำการ :</label>
                                     <div class="col-md-4 ">
                                 <p class="form-control onoff"><input type="checkbox" v-model="calenderedit" value="จัดการ" id="checkboxID12"><label for="checkboxID12"></label></p>
                                     </div>
                                 </div>
                               <div class="alert alert-danger text-center" role="alert" v-if="nocheck">
                  <strong>คุณไม่ได้กำหนดสิทธ์เจ้าหน้าที่ !</strong>  <br> กรุณากำหนดสิทธ์เจ้าหน้าที่อย่างน้อย1สิทธ์
                  </div>
                               <br>

                              </div>

                              </div>

                          </div>


                                                 </div>

                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                            <button type="button" class="btn btn-warning" v-if="buttonload"><i class="fa fa-spinner fa-spin"></i>แก้ไขข้อมูล</button>
                          <button type="button" class="btn btn-warning"  v-if="buttonedit" v-on:click="updateItem()">แก้ไขข้อมูล</button>
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
                      el: '#information',
                      data: {
                          'id'  :'<?php echo Session::get('idoffice'); ?>',
                          'name': '',
                          'nameerror':'',
                          'nameedit': '',
                          'email':'',
                          'emailedit':'',
                          'emailerror':'',
                          'password':'',
                          'passwordedit':'',
                          'passworderror':'',
                          'password_confirmation':'',
                          'nocheck':'',
                          'info':[],
                          'product':[],
                          'hotnews':[],
                          'activity':[],
                          'prison':[],
                          'infoedit':[],
                          'productedit':[],
                          'hotnewsedit':[],
                          'activityedit':[],
                          'prisonedit':[],
                          'documentperedit':[],
                          'documentper':[],
                          'calender':[],
                          'calenderedit':[],
                          'id_edit':'',
                          'password_confirmationedit':'',
                          'password_confirmationerror':'',
                          'buttonedit':true,
                          'buttonedit2':true,
                          'inputedit':'true',
                          'buttoninsert' : true,
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

                                      	return item.official_Name.toLowerCase().indexOf(this.searchKey.toLowerCase()) > -1
                                        || item.hotnews.indexOf(this.searchKey.toLowerCase()) > -1
                                        || item.info.toLowerCase().indexOf(this.searchKey.toLowerCase()) > -1
                                        || item.product.toLowerCase().indexOf(this.searchKey.toLowerCase()) > -1
                                        || item.prison.toLowerCase().indexOf(this.searchKey.toLowerCase()) > -1
                                        || item.document.toLowerCase().indexOf(this.searchKey.toLowerCase()) > -1
                                        || item.calender.toLowerCase().indexOf(this.searchKey.toLowerCase()) > -1


                                   })
                               },
                               paginatedUsers: function(list){

                               var index = this.currentPage * this.itemsPerPage;
                               return this.usersFilteredBySearchKey.slice(index, index + this.itemsPerPage)
                  					 }
                  	},
                      methods: {getVueItems: function getVueItems(page) {
                   	      axios.get('/official/officiallist?page=' + page).then(function (response) {

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
                               information.buttonload =true;
information.buttoninsert =false;
information.nameerror = false;
information.nocheck = false;
information.emailerror = false;
information.passworderror = false;


                               axios.post('/official/add', {
                                   id: this.id,
                                   name: this.name,
                                   email:this.email,
                                   password:this.password,
                                   password_confirmation:this.password_confirmation,
                                   info: this.info,
                                   product: this.product,
                                   hotnews: this.hotnews,
                                   activity: this.activity,
                                   prison: this.prison,
                                   documentper: this.documentper,
                                   calender: this.calender,

                                 }).then(function (response) {

                                   if (response.data.nocheck == 'yes') {
                                     information.buttoninsert =true;
                                     information.nocheck = true;
}
                  if (response.data.messages != null) {
                    if(response.data.messages.name != null){

                  information.nameerror = true;
                  information.nameerror = response.data.messages.name[0];

                    }
                    if(response.data.messages.email != null){
                  information.emailerror = true;
                  information.emailerror = response.data.messages.email[0];
                    }
                    if(response.data.messages.password != null){
                  information.passworderror = true;
                  information.passworderror = response.data.messages.password[0];
                    }if(response.data.messages.password_confirmation != null){
                  information.password_confirmationerror = true;
                  information.password_confirmationerror = response.data.messages.password_confirmation[0];
                }
                information.buttonload =false;
                information.buttoninsert =true;
}
if (response.data.messages == null && response.data.nocheck != 'yes') {
  location.reload();
}




                                   });


                             },
                     cleardata: function () {
                    information.activity = '';
                     information.hotnews = '';
                     information.info = '';
                     information.product = '';
                     information.prison = '';

                               information.nameerror = false;
                               information.emailerror = false;
                               information.passworderror = false;
                               information.password_confirmationerror = false;
                             },

                    editItem: function(item) {
                      information.activityedit = '';
                     information.hotnewsedit = '';
                     information.infoedit = '';
                     information.productedit = '';
                     information.prisonedit = '';
                     information.calenderedit = '';
                     information.documentperedit = '';
                      information.nameerror = false;
                      information.nocheck = false;
                      information.emailerror = false;
                      information.passworderror = false;

                         								var official_id =	item.official_ID;

                         								var link = "/official/officiallist" + official_id;
                         								axios.get(link, {
                         								}).then(function (response) {

                    information.id_edit = response.data[0].official_ID;
                    information.nameedit = response.data[0].official_Name;
                    information.emailedit = response.data[0].official_Email;
                    information.passwordedit = response.data[0].official_Password;
                    information.password_confirmationedit = response.data[0].official_Password;

if (response.data[0].activity == 'จัดการ') {
  information.activityedit = 'จัดการ';
}
if (response.data[0].hotnews == 'จัดการ') {
information.hotnewsedit = 'จัดการ';

}
if (response.data[0].info == 'จัดการ') {
information.infoedit = 'จัดการ';

}
if (response.data[0].product == 'จัดการ') {
  information.productedit = 'จัดการ';
}
if (response.data[0].prison == 'จัดการ') {
  information.prisonedit = 'จัดการ';
}
if (response.data[0].calender == 'จัดการ') {
  information.calenderedit = 'จัดการ';
}
if (response.data[0].document == 'จัดการ') {
  information.documentperedit = 'จัดการ';
}


                  $("#editofficial").modal('show');
                         								})
     },
                          updateItem: function() {
                            information.buttonload = true;
information.buttonedit =false;
                                     var official_id =	this.id_edit;

                                     var link = "/official/updateofficial/" + official_id;
                                     axios.post(link, {
                                       id: this.id,
                                       name: this.nameedit,
                                       email:this.emailedit,
                                       password:this.passwordedit,
                                       password_confirmation:this.password_confirmationedit,
                                       info: this.infoedit,
                                       product: this.productedit,
                                       hotnews: this.hotnewsedit,
                                       activity: this.activityedit,
                                       prison: this.prisonedit,
                                       documentper: this.documentperedit,
                                       calender: this.calenderedit,
                                     }).then(function (response) {

                                                                          if (response.data.nocheck == 'yes') {

                                                                            information.nocheck = true;
                                                                             }
                                                         if (response.data.messages != null) {
                                                           if(response.data.messages.name != null){

                                                         information.nameerror = true;
                                                         information.nameerror = response.data.messages.name[0];

                                                           }
                                                           if(response.data.messages.email != null){
                                                         information.emailerror = true;
                                                         information.emailerror = response.data.messages.email[0];
                                                           }
                                                           if(response.data.messages.password != null){
                                                         information.passworderror = true;
                                                         information.passworderror = response.data.messages.password[0];
                                                           }if(response.data.messages.password_confirmation != null){
                                                         information.password_confirmationerror = true;
                                                         information.password_confirmationerror = response.data.messages.password_confirmation[0];
                                                       }
                                                       information.buttonload = false;
information.buttonedit =true;
                                                     }

                                                    if (response.data.messages == null && response.data.nocheck != 'yes') {
                                                      location.reload();
                                                    }






                              })

                                    },
                                    deleteItem: function(item) {


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
                                            var official_id =	item.official_ID;

                                            axios.post('/officiallist/delete/' + official_id, {
                                              official_id: item.official_ID,
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

                      },
                      }
                    })



                  </script>
                  @endpush
