@extends('layout.index')

@section('title') {{$sanpham->name}} @endsection
@section('contents') 

<div class="inner-header">
	<div class="container">
		<div class="pull-left">
			<h6 class="inner-title">{{$sanpham->name}}</h6>
		</div>
		<div class="pull-right">
			<div class="beta-breadcrumb font-large">
				<a href="{{route('home')}}">Home</a> / <span>Chi tiết</span>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>

<div class="container">
	<div id="content">
		<div class="row">
			<div class="col-sm-9">

				<div class="row">
					<div class="col-sm-4">
						<img src="public/image/product/{{$sanpham->image}}" alt="" width="270px" height="270px">
					</div>
					<div class="col-sm-8">
						<div class="single-item-body">
							<p class="single-item-title"><b>{{$sanpham->name}}</b></p>
							<p class="single-item-price">
								@if($sanpham->promotion_price != 0)
									<span class="flash-del">{{number_format($sanpham->unit_price)}}</span>
									<span class="flash-sale">{{number_format($sanpham->promotion_price) }}</span>
									@else
									<span class="flash-sale">{{number_format($sanpham->unit_price) }}</span>
									@endif
									<small>VND</small>
							</p>
						</div>

						<div class="clearfix"></div>
						<div class="space20">&nbsp;</div>

						<div class="single-item-desc">
							<p></p>
						</div>
						<div class="space20">&nbsp;</div>

						<p>Số lượng</p>
						<div class="single-item-options">							
							<select class="wc-select" name="color">							
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
							</select>
							<a class="add-to-cart" href="#"><i class="fa fa-shopping-cart"></i></a>
							<div class="clearfix"></div>
						</div>
					</div>
				</div>

				<div class="space40">&nbsp;</div>
				<div class="woocommerce-tabs">
					<ul class="tabs">
						<li><a href="#tab-description">Mô tả</a></li>
						<li><a href="#tab-reviews">Nhận xét (0)</a></li>
					</ul>

					<div class="panel" id="tab-description">
						<p>{{$sanpham->description}}</p>
					</div>
					<div class="panel" id="tab-reviews">
						<p>No Reviews</p>
					</div>
				</div>
				<div class="space50">&nbsp;</div>
				<div class="beta-products-list">
					<h4>Sản phẩm liên quan</h4>
					<br>
					<div class="row">
						@foreach($sp_lien_quan as $prod)
							<div class="col-sm-4" style="margin-bottom: 30px">
								<div class="single-item">
									@if($prod->promotion_price != 0)
									<div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
									@endif

									<div class="single-item-header">
										<a href="{{route('detail',$prod->id)}}"><img src="public/image/product/{{$prod->image}}" alt="" width="270px" height="200px"></a>
									</div>
									<div class="single-item-body">
										<p class="single-item-title">{{$prod->name}}</p>
										<p class="single-item-price">
											@if($prod->promotion_price != 0)
											<span class="flash-del">{{number_format($prod->unit_price)}}</span>
											<span class="flash-sale">{{number_format($prod->promotion_price) }}</span>
											@else
											<span class="flash-sale">{{number_format($prod->unit_price) }}</span>
											@endif
											<small>VND</small>
										</p>
									</div>
									<div class="single-item-caption">
										<a class="add-to-cart pull-left" href="shopping_cart.html"><i class="fa fa-shopping-cart"></i></a>
										<a class="beta-btn primary" href="{{route('detail',$prod->id)}}">Details <i class="fa fa-chevron-right"></i></a>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
							@endforeach							
					</div>
					<div class="row text-center"> {{$sp_lien_quan->links() }} </div>
				</div> <!-- .beta-products-list -->
			</div>
			<div class="col-sm-3 aside">
				<div class="widget">
					<h3 class="widget-title">Sản phẩm bán chạy</h3>
					<div class="widget-body">
						<div class="beta-sales beta-lists">
							@foreach($sp_bs as $prod)
							<div class="media beta-sales-item">
								<a class="pull-left" href="{{route('detail',$prod->id)}}"><img src="public/image/product/{{$prod->image}}" alt=""></a>
								<div class="media-body">
									{{$prod->name}}
									<span class="beta-sales-price">{{$prod->unit_price}}</span>
								</div>
							</div>
							@endforeach
						</div>
					</div>
				</div> <!-- best sellers widget -->
				<div class="widget">
					<h3 class="widget-title">New Products</h3>
					<div class="widget-body">
						<div class="beta-sales beta-lists">
							@foreach($sp_moi as $prod)
							<div class="media beta-sales-item">
								<a class="pull-left" href="{{route('detail',$prod->id)}}"><img src="public/image/product/{{$prod->image}}" alt=""></a>
								<div class="media-body">
									{{$prod->name}}
									<span class="beta-sales-price">{{$prod->unit_price}}</span>
								</div>
							</div>
							@endforeach
						</div>
					</div>
				</div> <!-- best sellers widget -->
			</div>
		</div>
	</div> <!-- #content -->
</div> <!-- .container -->

@endsection