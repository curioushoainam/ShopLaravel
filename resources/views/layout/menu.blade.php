<div class="header-bottom" style="background-color: #0277b8;">
	<div class="container">
		<a class="visible-xs beta-menu-toggle pull-right" href="#"><span class='beta-menu-toggle-text'>Menu</span> <i class="fa fa-bars"></i></a>
		<div class="visible-xs clearfix"></div>
		<nav class="main-menu">
			<ul class="l-inline ov">
				<li><a href="{{route('home')}}">Trang chủ</a></li>
				<li><a>Loại sản phẩm</a>
					<ul class="sub-menu">
						@foreach($loai_sp as $lsp)
						<li><a href="{{route('productType',$lsp->id)}}">{{$lsp->name}}</a></li>
						@endforeach						
					</ul>
				</li>
				<li><a href="{{route('about')}}">Giới thiệu</a></li>
				<li><a href="{{ route('contact') }}">Liên hệ</a></li>
			</ul>
			<div class="clearfix"></div>
		</nav>
	</div> <!-- .container -->

</div> <!-- .header-bottom -->