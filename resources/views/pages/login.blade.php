@extends('layout.index')

@section('title') Login @endsection

@section('contents')

<div class="inner-header">
	<div class="container">
		<div class="pull-left">
			<h6 class="inner-title">Đăng nhập</h6>
		</div>
		<div class="pull-right">
			<div class="beta-breadcrumb">
				<a href="{{ route('home') }}">Home</a> / <span>Đăng nhập</span>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>

<div class="container">
	<div id="content">
		{!! errors($errors->all()) !!}
		{!! error(session('error')) !!}

		<form action="{{ route('login') }}" method="post" class="beta-form-checkout">
			<input type="hidden" name="_token" value="{{csrf_token() }}">
			<div class="row">
				<div class="col-sm-3"></div>
				<div class="col-sm-6">
					<h4>Đăng nhập</h4>
					<div class="space20">&nbsp;</div>

					
					<div class="form-block">
						<label for="email">Email address*</label>
						<input type="email" id="email" name="email" placeholder="địa chỉ email" required>
					</div>
					<div class="form-block">
						<label for="password">Password*</label>
						<input type="password" id="password" name="password" placeholder="mật khẩu" required>
					</div>
					<div class="form-block">
						<button type="submit" class="btn btn-primary">Đăng nhập</button>
					</div>
				</div>
				<div class="col-sm-3"></div>
			</div>
		</form>
	</div> <!-- #content -->
</div> <!-- .container -->

@endsection