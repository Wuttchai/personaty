@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-6 col-md-6 col-md-offset-3">
            <h1 class="text-center login-title">สมัครบัญชีผู้ใช้</h1>
            <div class="account-wall">
                <img class="profile-img" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=120"
                    alt="">
										<form method="POST" action="{{ route('register') }}" class="regis">
												@csrf

												<div class="form-group row">
														<label for="name" class="col-md-3 col-form-label text-md-right">ชื่อ,นามสกุล:</label>

														<div class="col-md-9">
																<input id="User_Name" type="text" class="form-control{{ $errors->has('User_Name') ? ' is-invalid' : '' }}" name="User_Name" value="{{ old('User_Name') }}" required autofocus>

																@if ($errors->has('User_Name'))
																		<span class="text-errors">
																				<strong>{{ $errors->first('User_Name') }}</strong>
																		</span>
																@endif
														</div>
												</div>


												<div class="form-group row">

														<label for="User_Tel" class="col-md-3 col-form-label text-md-right">เบอร์โทรศัพท์:</label>

														<div class="col-md-9">
																<input id="User_Tel" type="text" class="form-control{{ $errors->has('User_Tel') ? ' is-invalid' : '' }}" name="User_Tel" value="{{ old('User_Tel') }}" required>

																@if ($errors->has('User_Tel'))
																		<span class="text-errors">
																				<strong>{{ $errors->first('User_Tel') }}</strong>
																		</span>
																@endif
														</div>
												</div>

												<div class="form-group row">
														<label for="User_Address" class="col-md-3 col-form-label text-md-right">ที่อยู่ :</label>

														<div class="col-md-9">

<textarea id="User_Address" class="form-control{{ $errors->has('User_Address') ? ' is-invalid' : '' }}" name="User_Address" value="{{ old('User_Address') }}" required ></textarea>
																@if ($errors->has('User_Address'))
																		<span class="text-errors">
																				<strong>{{ $errors->first('User_Address') }}</strong>
																		</span>
																@endif
														</div>
												</div>

												<div class="form-group row">
														<label for="email" class="col-md-3 col-form-label text-md-right">อีเมลล์ :</label>

														<div class="col-md-9">
																<input id="User_Email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

																@if ($errors->has('email'))
																		<span class="text-errors">
																				<strong>{{ $errors->first('email') }}</strong>
																		</span>
																@endif
														</div>
												</div>

												<div class="form-group row">
														<label for="password" class="col-md-3 col-form-label text-md-right">รหัสผ่าน:</label>

														<div class="col-md-9">
																<input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

																@if ($errors->has('password'))
																		<span class="text-errors">
																				<strong>{{ $errors->first('password') }}</strong>
																		</span>
																@endif
														</div>
												</div>

												<div class="form-group row">
														<label for="password-confirm" class="col-md-3 col-form-label text-md-right">ยืนยัน รหัสผ่าน:</label>

														<div class="col-md-9">
																<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
														</div>
												</div>

												<div class="form-group row mb-0">
														<div class="col-md-6 offset-md-4">
																<button type="submit" class="btn btn-primary">
																		Register
																</button>
														</div>
												</div>
										</form>
            </div>

        </div>
    </div>
<br>
</div>

@endsection
