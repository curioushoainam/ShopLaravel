<div id="header">
	<div class="header-top">
		<div class="container">
			<div class="pull-left auto-width-left">
				<ul class="top-menu menu-beta l-inline">
					<li><a href=""><i class="fa fa-home"></i> HCM city - Vietnam - the Earth - the Sun system</a></li>
					<li><a href=""><i class="fa fa-phone"></i> 123 123 1234</a></li>
				</ul>
			</div>
			<div class="pull-right auto-width-right">
				<ul class="top-details menu-beta l-inline">
					
					@if(!Auth::user())
						<li><a href="{{ route('signup') }}">Đăng kí</a></li>
						<li><a href="{{ route('login') }}">Đăng nhập</a></li>
					@else
						<li><a href="{{ route('userinfo') }}"><i class="fa fa-user"></i>{{Auth::user()->full_name}}</a></li>
						<li><a href="{{ route('logout') }}">Đăng xuất</a></li>
					@endif

				</ul>
			</div>
			<div class="clearfix"></div>
		</div> <!-- .container -->
	</div> <!-- .header-top -->
	<div class="header-body">
		<div class="container beta-relative">
			<div class="pull-left">
				<a href="{{route('home')}}" id="logo"><img src="public/assets/dest/images/logo-cake.png" width="200px" alt=""></a>
			</div>
			<div class="pull-right beta-components space-left ov">
				<div class="space10">&nbsp;</div>
				<div class="beta-comp">
					<form role="search" method="get" id="searchform" action="{{ route('search') }}">
						{{-- <input type="hidden" name="_token" value="{{csrf_token()}}"> --}}
				        <input type="text" value="" name="keyword" id="s" placeholder="Nhập từ khóa..." />
				        <button class="fa fa-search" type="submit" id="searchsubmit"></button>
					</form>
				</div>

				<div class="beta-comp">
					
					<div class="cart">
						<div class="beta-select"><i class="fa fa-shopping-cart"></i> Giỏ hàng (	
							{{ Session::has('cart') ? session('cart')->count : 0 }} )<i class="fa fa-chevron-down"></i></div>
						@if(Session::has('cart'))
						<div class="beta-dropdown cart-body">
							{{-- {{ viewArr($prod_cart) }} --}}
							@foreach($prod_cart as $prod)
														
							<div class="cart-item">
								<a class="cart-item-delete" href="{{route('removeItem',$prod['item']->id)}}" ><i class="fa fa-times"></i></a>
								<div class="media">
									<a class="pull-left" href="{{route('detail',$prod['item']->id)}}"><img src="public/image/product/{{$prod['item']->image}}" alt=""></a>
									<div class="media-body">
										<span class="cart-item-title">{{$prod['item']->name}}</span>

										<span class="cart-item-amount">{{$prod['qty']}} * <span>
										@if($prod['item']->promotion_price)
											{{number_format($prod['item']->promotion_price)}}
										@else
											{{number_format($prod['item']->unit_price)}}
										@endif

										</span><small>VND</small></span>
									</div>
								</div>
							</div>
							@endforeach		
							<div class="cart-caption">
								<div class="cart-total text-right">Tổng tiền: <span class="cart-total-value">{{number_format(session('cart')->amount) }} </span><small>VND</small></div>
								<div class="clearfix"></div>

								<div class="center">
									<div class="space10">&nbsp;</div>
									<a href="{{route('checkout')}}" class="beta-btn primary text-center">Đặt hàng <i class="fa fa-chevron-right"></i></a>
								</div>
							</div>
						</div>
						@endif
					</div> <!-- .cart -->
					
				</div>
			</div>
			<div class="clearfix"></div>
		</div> <!-- .container -->
	</div> <!-- .header-body -->
	
	@include('layout.menu')

</div> <!-- #header -->