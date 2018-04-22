@extends('layouts.app')

@section('content')

<div class="container">
<div class="bg">
    <div class="row">

        <div class="col-sm-6 col-md-4 col-md-offset-4">


            <div class="account-wall">
              <p class="text-center login-title">เข้าสู่ระบบผู้ใช้งาน</p>
                <img class="profile-img" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=120"
                    alt="">
										<form method="POST" action="{{ route('login') }}" class="form-signin">
												@csrf

												<div class="form-group row{{ $errors->has('email') ? ' has-error has-feedback' : '' }}">


														<div class="col-md-12">
																<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="อีเมลล์" required autofocus>

																@if ($errors->has('email'))

																		<span class="text-danger">
																				<strong>{{ $errors->first('email') }}</strong>
																		</span>
																@endif
														</div>
												</div>

												<div class="form-group row{{ $errors->has('password') ? ' has-error has-feedback' : '' }}">


														<div class="col-md-12">
																<input id="password" type="password" class="form-control{{ $errors->has('password') ? ' form-group has-error has-feedback ' : '' }}" name="password" placeholder="รหัสผ่าน" required>

																@if ($errors->has('password'))
                                <span class="glyphicon glyphicon-remove form-control-feedback"></span>
																		<span class="text-danger">
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
                <a href="/register" class="pull-right need-help">สมัครสมาชิก </a><span class="clearfix"></span>
                </form>
            </div>

        </div>
    </div>
<br>
</div>
<br>
<br>
</div>

@endsection
