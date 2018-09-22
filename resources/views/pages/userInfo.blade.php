@extends('layout.index')

@section('title') User information @endsection

@section('contents')

<div class="inner-header">
	<div class="container">
		<div class="pull-left">
			<h6 class="inner-title">Thông tin người dùng</h6>
		</div>
		<div class="pull-right">
			<div class="beta-breadcrumb">
				<a href="{{ route('home') }}">Home</a> / <span>User Info.</span>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>

<div class="container">
	<div id="content">
		{!! errors($errors->all()) !!}
		{!! message(session('msg')) !!}
		
		<form action="{{ route('userinfo') }}" method="post" class="beta-form-checkout">
			<input type="hidden" name="_token" value="{{csrf_token()}}">
			<div class="row">
				<div class="col-sm-3"></div>
				<div class="col-sm-6">
					<h4>{{Auth::user()->full_name}}</h4>
					<div class="space20">&nbsp;</div>

					
					<div class="form-block">
						<label for="email">Email address*</label>
						<input type="email" id="email" name="email" placeholder="địa chỉ email" required value="{{Auth::user()->email}}">
					</div>

					<div class="form-block">
						<label for="your_last_name">Fullname*</label>
						<input type="text" id="your_last_name" name="full_name" placeholder="họ tên" required value="{{Auth::user()->full_name}}">
					</div>

					<div class="form-block">
						<label for="adress">Address*</label>
						<input type="text" id="adress" name="address" placeholder="Street Address" value="{{Auth::user()->address}}">
					</div>


					<div class="form-block">
						<label for="phone">Phone*</label>
						<input type="text" id="phone" name="phone" placeholder="số điện thoại" required value="{{Auth::user()->phone}}">
					</div>

					<input type="checkbox" name="changePassword" id="changePassword">&nbsp&nbspThay đổi mật khẩu

					<div class="form-block">												
						<label for="password">New password</label>
						<input class="password" type="password" id="password" name="password" placeholder="mật khẩu" required disabled="">
					</div>
					<div class="form-block">
						<label for="repassword">Re new password*</label>
						<input class="password" type="password" id="repassword" name="repassword" placeholder="nhập lại mật khẩu" required disabled="">
					</div>
					<div class="form-block">
						<button type="submit" class="btn btn-primary">Cập nhật</button>
					</div>
				</div>
				<div class="col-sm-3"></div>
			</div>
		</form>
	</div> <!-- #content -->
</div> <!-- .container -->

@endsection

@section('script')
	<script>
		$(document).ready(function($){
			$('#changePassword').change(function(){
				if($(this).is(':checked'))
					$('.password').removeAttr('disabled');
				else
					$('.password').attr('disabled','');
			});
		});
	</script>
@endsection