@extends('layouts.offcialapp')

@section('content')
<div class="container"  id="example-3"  >
<div class="loader" id="loader"></div>
   <div class="row justify-content-center" >

       <div class="col-md-10" id="dsds">
           <div class="card card-default ">
               <div class="card-header bg-warning card text-center "> จัดการข้อมูลเว็ปไซต์(สำหรับเจ้าหน้าที่) </div>

               <div class="card-body">
                   <form method="POST" action="/official/login">
                       @csrf

                       <div class="form-group row">
                           <label for="email" class="col-sm-4 col-form-label text-md-right">E-Mail Address</label>

                           <div class="col-md-6">
                               <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                               @if ($errors->has('email'))
                                   <span class="invalid-feedback">
                                       <strong>{{ $errors->first('email') }}</strong>
                                   </span>
                               @endif
                           </div>
                       </div>

                       <div class="form-group row">
                           <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                           <div class="col-md-6">
                               <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                               @if ($errors->has('password'))
                                   <span class="invalid-feedback">
                                       <strong>{{ $errors->first('password') }}</strong>
                                   </span>
                               @endif
                           </div>
                       </div>

                       @if ($erx == 'has')
                       <div class="alert alert-danger text-center" role="alert">
          <strong>ไม่สารถเข้าสู่ระบบได้ !</strong>   กรุณาตรวจสอบข้อมูลที่กรอกอีกครั้ง
          </div>
                      @endif

                       <div class="form-group row">
                           <div class="col-md-6 offset-md-4">
                               <div class="checkbox">
                                   <label>
                                       <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                   </label>
                               </div>
                           </div>
                       </div>

                       <div class="form-group row mb-0">
                           <div class="col-md-8 offset-md-4">
                               <button type="submit" class="btn btn-primary">
                                   Login
                               </button>

                               <a class="btn btn-link" href="{{ route('password.request') }}">
                                   Forgot Your Password?
                               </a>
                           </div>
                       </div>
                   </form>
               </div>


               <div class="card-body" >



</div>

   <!-- Modal -->
   <div class="modal fade" id="official" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
       <div class="modal-content">
         <div class="modal-header  text-center">
           <h5 class="modal-title " id="exampleModalLabel">เข้าสู่ระบบ</h5>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>
         <div class="modal-body">
           xxxxx

         </div>
         <div class="modal-footer">
           <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
           <button type="button" class="btn btn-primary" v-on:click="edit()">Save changes</button>
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

</script>
@endpush
