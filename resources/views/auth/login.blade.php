@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">
            <h1 class="text-center login-title">เข้าสู่ระบบผู้ใช้งาน</h1>
            <div class="account-wall">
                <img class="profile-img" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=120"
                    alt="">
										<form method="POST" action="{{ route('login') }}" class="form-signin">
												@csrf

												<div class="form-group row">


														<div class="col-md-12">
																<input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="อีเมลล์" required autofocus>

																@if ($errors->has('email'))
																		<span class="invalid-feedback">
																				<strong>{{ $errors->first('email') }}</strong>
																		</span>
																@endif
														</div>
												</div>

												<div class="form-group row">


														<div class="col-md-12">
																<input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="รหัสผ่าน" required>

																@if ($errors->has('password'))
																		<span class="invalid-feedback">
																				<strong>{{ $errors->first('password') }}</strong>
																		</span>
																@endif
														</div>
												</div>
                <button class="btn btn-lg btn-primary btn-block" type="submit">
                    เข้าสู่ระบบ</button>
                <label class="checkbox pull-left">
                    <input type="checkbox"  name="remember" id="remember" >
                    Remember me
                </label>
                <a href="#" class="pull-right need-help">ลืมรหัสผ่าน? </a><span class="clearfix"></span>
                </form>
            </div>

        </div>
    </div>
<br>
</div>

@endsection
