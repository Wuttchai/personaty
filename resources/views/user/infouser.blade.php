@extends('layouts.app')

@section('content')
<div class="bg">
<div class="container">
    <div class="row">
        <div class="col-sm-6 col-md-6 col-md-offset-3">

            <div class="account-wall">
              <p class="text-center login-title">แก้ไขข้อมูลผู้ใช้</p>
                <img class="profile-img" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=120"
                    alt="">
										<form method="POST" action="/edit/datailuser" class="regis">
												@csrf

												<div class="form-group row">
														<label for="name" class="col-md-3 col-form-label text-md-right">ชื่อ-นามสกุล *</label>

														<div class="col-md-9">
																<input id="User_Name" type="text" class="form-control{{ $errors->has('User_Name') ? ' is-invalid' : '' }}" name="User_Name" value="{{ old('User_Name', $user[0]->User_Name)}}" required autofocus>

																@if ($errors->has('User_Name'))
																		<span class="text-errors">
																				<strong>{{ $errors->first('User_Name') }}</strong>
																		</span>
																@endif
														</div>
												</div>


												<div class="form-group row">

														<label for="User_Tel" class="col-md-3 col-form-label text-md-right">เบอร์โทรศัพท์ *</label>

														<div class="col-md-9">
																<input id="User_Tel" type="text" class="form-control{{ $errors->has('User_Tel') ? ' is-invalid' : '' }}" name="User_Tel" value="{{ old('User_Tel', $userdetail[0]->address_tel)}} " required>

																@if ($errors->has('User_Tel'))
																		<span class="text-errors">
																				<strong>{{ $errors->first('User_Tel') }}</strong>
																		</span>
																@endif
														</div>
												</div>

                        <div class="form-group row">
                            <label for="User_Address" class="col-md-3 col-form-label text-md-right">บ้านเลขที่ *</label>

                            <div class="col-md-9">

    <input id="User_Address" class="form-control{{ $errors->has('User_Address') ? ' is-invalid' : '' }}" name="User_Address" value="{{ old('User_Address', $userdetail[0]->address_at)}}" required ></input>

                                @if ($errors->has('User_Address'))
                                    <span class="text-errors">
                                        <strong>{{ $errors->first('User_Address') }}</strong>
                                    </span>
                                @endif
                              </div>
                          </div>
                          <div class="form-group row">
                              <label for="tumbon" class="col-md-3 col-form-label text-md-right">ตำบล *</label>

                              <div class="col-md-9">

                      <input id="tumbon" class="form-control{{ $errors->has('tumbon') ? ' is-invalid' : '' }}" name="tumbon" value="{{ old('tumbon', $userdetail[0]->address_tumbon)}}" required ></input>

                                  @if ($errors->has('tumbon'))
                                      <span class="text-errors">
                                          <strong>{{ $errors->first('tumbon') }}</strong>
                                      </span>
                                  @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="aumpor" class="col-md-3 col-form-label text-md-right">อำเภอ *</label>

                                <div class="col-md-9">

                        <input id="aumpor" class="form-control{{ $errors->has('aumpor') ? ' is-invalid' : '' }}" name="aumpor" value="{{ old('aumpor', $userdetail[0]->address_aumpor)}}" required ></input>

                                    @if ($errors->has('aumpor'))
                                        <span class="text-errors">
                                            <strong>{{ $errors->first('aumpor') }}</strong>
                                        </span>
                                    @endif
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label for="province" class="col-md-3 col-form-label text-md-right">จังหวัด *</label>

                                  <div class="col-md-9">

                          <input id="province" class="form-control{{ $errors->has('province') ? ' is-invalid' : '' }}" name="province" value="{{ old('province', $userdetail[0]->address_province)}}" required ></input>

                                      @if ($errors->has('province'))
                                          <span class="text-errors">
                                              <strong>{{ $errors->first('province') }}</strong>
                                          </span>
                                      @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="zipcode" class="col-md-3 col-form-label text-md-right">รหัสไปรษณีย์ *</label>

                                    <div class="col-md-9">

                            <input id="zipcode" class="form-control{{ $errors->has('zipcode') ? ' is-invalid' : '' }}" name="zipcode" value="{{ old('zipcode', $userdetail[0]->address_zipcode)}}" required ></input>

                                        @if ($errors->has('zipcode'))
                                            <span class="text-errors">
                                                <strong>{{ $errors->first('zipcode') }}</strong>
                                            </span>
                                        @endif
                                      </div>
                                  </div>

												<div class="form-group row">
														<label for="email" class="col-md-3 col-form-label text-md-right">อีเมลล์ *</label>

														<div class="col-md-9">
																<input id="User_Email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email', $user[0]->email)}}" required>

																@if ($errors->has('email'))
																		<span class="text-errors">
																				<strong>{{ $errors->first('email') }}</strong>
																		</span>
																@endif
														</div>
												</div>





												<div class="form-group row mb-12">
														<div class="col-md-12 offset-md-7">
																<button type="submit" class="btn btn-lg btn-warning btn-block">
																		ยืนยันการแก้ไข
																</button>
														</div>
												</div>
										</form>
                    @if(session('alert'))
                    <?php
                      echo '<script type="text/javascript">';
                      echo 'setTimeout(function () { swal("แก้ไขข้อมูลเรียบร้อย!","","success");';
                      echo '}, 1000);</script>';
                    ?>
                    @endif
            </div>

        </div>
    </div>
    <br>

</div>
</div>
<br>
<br>
@endsection
