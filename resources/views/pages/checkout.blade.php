@extends('layout.index')

@section('title') Checkout @endsection

@section('contents')

<div class="inner-header">
		<div class="container">
			<div class="pull-left">
				<h6 class="inner-title">Đặt hàng</h6>
			</div>
			<div class="pull-right">
				<div class="beta-breadcrumb">
					<a href="{{ route('home') }}">Trang chủ</a> / <span>Đặt hàng</span>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
</div>

<div class="container">
	<div id="content">
		{!! errors($errors->all()) !!}
		{!! message(session('msg')) !!}
		{!! error(session('error')) !!}
		<form action="{{ route('setcheckout') }}" method="post" class="beta-form-checkout">
			<input type="hidden" name="_token" value="{{csrf_token()}}">
			<div class="row"></div>
			<div class="row">
				<div class="col-sm-6">
					<h4>Đặt hàng</h4>
					<div class="space20">&nbsp;</div>

					<div class="form-block">
						<label for="name">Họ tên*</label>
						<input type="text" name="name" placeholder="Họ tên" required>
					</div>
					<div class="form-block">
						<label>Giới tính </label>
						<input type="radio" class="input-radio" name="gender" value="nam" checked="checked" style="width: 10%"><span style="margin-right: 10%">Nam</span>
						<input type="radio" class="input-radio" name="gender" value="nữ" style="width: 10%"><span>Nữ</span>
									
					</div>

					<div class="form-block">
						<label for="email">Email*</label>
						<input type="email" id="email" name="email" required placeholder="expample@gmail.com">
					</div>

					<div class="form-block">
						<label for="adress">Địa chỉ*</label>
						<input type="text" id="address" name="address" placeholder="Street Address" required>
					</div>
					

					<div class="form-block">
						<label for="phone">Điện thoại*</label>
						<input type="text" id="phone" name="phone" required>
					</div>
					
					<div class="form-block">
						<label for="notes">Ghi chú</label>
						<textarea id="note" name="note"></textarea>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="your-order">
						<div class="your-order-head"><h5>Đơn hàng của bạn</h5></div>
						<div class="your-order-body" style="padding: 0px 10px">
							@if(isset($cart))
							<div class="your-order-item">
								<div>
								
								
								<!--  one item	 -->
									@foreach($cart['items'] as $order)
									
									<div class="media">
										<img width="25%" src="public/image/product/{{$order['item']->image}}" alt="" class="pull-left">
										<div class="media-body">
											<p class="font-large">{{$order['item']->name}}</p>
											<span class="color-gray your-order-info">Giá: 
											{{ $order['item']->promotion_price ? number_format($order['item']->promotion_price) : number_format($order['item']->unit_price)  }}
											<small>VND</small></span>											
											<span class="color-gray your-order-info">Số lượng: {{$order['qty']}}</span>
											<span class="color-gray your-order-info">Thành tiền: {{ number_format($order['subamount'])}} <small>VND</small></span>
										</div>
									</div>
									@endforeach
								<!-- end one item -->
								
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="your-order-item">
								<div class="pull-left"><p class="your-order-f18">Tổng tiền: {{number_format($cart['amount'])}} <small>VND</small></p></div>
								<div class="pull-right"><h5 class="color-black"></h5></div>
								<div class="clearfix"></div>
							</div>
							@endif
						</div>
						<div class="your-order-head"><h5>Hình thức thanh toán</h5></div>
						
						<div class="your-order-body">
							<ul class="payment_methods methods">
								<li class="payment_method_bacs">
									<input id="payment_method_bacs" type="radio" class="input-radio" name="payment_method" value="COD" checked="checked" data-order_button_text="">
									<label for="payment_method_bacs">Thanh toán khi nhận hàng </label>
									<div class="payment_box payment_method_bacs" style="display: block;">
										Cửa hàng sẽ gửi hàng đến địa chỉ của bạn, bạn xem hàng rồi thanh toán tiền cho nhân viên giao hàng
									</div>						
								</li>

								<li class="payment_method_cheque">
									<input id="payment_method_cheque" type="radio" class="input-radio" name="payment_method" value="ATM" data-order_button_text="">
									<label for="payment_method_cheque">Chuyển khoản </label>
									<div class="payment_box payment_method_cheque" style="display: none;">
										Chuyển tiền đến tài khoản sau:
										<br>- Số tài khoản: 123 456 789
										<br>- Chủ TK: Nguyễn A
										<br>- Ngân hàng ACB, Chi nhánh TPHCM
									</div>						
								</li>
								
							</ul>
						</div>
						
					</div> <!-- .your-order -->
				</div>

			</div>
			<div class="space20">&nbsp;</div>
			<div class="text-center"><button type="submit" class="btn btn-primary">Đặt hàng <i class="fa fa-chevron-right"></i></button></div>
		</form>
	</div> <!-- #content -->
</div> <!-- .container -->

@endsection