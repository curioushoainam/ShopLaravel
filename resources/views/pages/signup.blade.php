@extends('layout.index')

@section('title') Signup @endsection

@section('contents')

<div class="inner-header">
	<div class="container">
		<div class="pull-left">
			<h6 class="inner-title">Đăng kí</h6>
		</div>
		<div class="pull-right">
			<div class="beta-breadcrumb">
				<a href="{{ route('home') }}">Home</a> / <span>Đăng kí</span>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>

<div class="container">
	<div id="content">
		{!! errors($errors->all()) !!}
		{!! message(session('msg')) !!}
		
		<form action="{{ route('signup') }}" method="post" class="beta-form-checkout">
			<input type="hidden" name="_token" value="{{csrf_token()}}">
			<div class="row">
				<div class="col-sm-3"></div>
				<div class="col-sm-6">
					<h4>Đăng kí</h4>
					<div class="space20">&nbsp;</div>

					
					<div class="form-block">
						<label for="email">Email address*</label>
						<input type="email" id="email" name="email" placeholder="địa chỉ email" required>
					</div>

					<div class="form-block">
						<label for="your_last_name">Fullname*</label>
						<input type="text" id="your_last_name" name="full_name" placeholder="họ tên" required>
					</div>

					<div class="form-block">
						<label for="adress">Address*</label>
						<input type="text" id="adress" name="address" placeholder="Street Address">
					</div>


					<div class="form-block">
						<label for="phone">Phone*</label>
						<input type="text" id="phone" name="phone" placeholder="số điện thoại" required>
					</div>
					<div class="form-block">
						<label for="password">Password*</label>
						<input type="password" id="password" name="password" placeholder="mật khẩu" required>
					</div>
					<div class="form-block">
						<label for="repassword">Re password*</label>
						<input type="password" id="repassword" name="repassword" placeholder="nhập lại mật khẩu" required>
					</div>
					<div class="form-block">
						<button type="submit" class="btn btn-primary">Đăng ký</button>
					</div>
				</div>
				<div class="col-sm-3"></div>
			</div>
		</form>
	</div> <!-- #content -->
</div> <!-- .container -->

@endsection