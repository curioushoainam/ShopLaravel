@extends('layout.index')

@section('title') Products @endsection
@section('contents') 

<div class="inner-header">
	<div class="container">
		<div class="pull-left">
			<h6 class="inner-title">Sản phẩm {{$loai_sp->name}}</h6>
		</div>
		<div class="pull-right">
			<div class="beta-breadcrumb font-large">
				<a href="{{route('home')}}">Home</a> / <span>Loại sản phẩm</span>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>
<div class="container">
	<div id="content" class="space-top-none">
		<div class="main-content">
			<div class="space60">&nbsp;</div>
			<div class="row">
				<div class="col-sm-3">
					<ul class="aside-menu">
						@foreach($loai as $l)
						<li><a href="{{route('productType',$l->id)}}">{{$l->name}}</a></li>
						@endforeach
					</ul>
				</div>
				<div class="col-sm-9">
					<div class="beta-products-list">
						<h4>{{$loai_sp->name}}</h4>
						<div class="beta-products-details">
							<p class="pull-left">Có {{count($sp_theo_loai)}} sản phẩm được tìm thấy</p>
							<div class="clearfix"></div>
						</div>

						<div class="row">
							@foreach($sp_theo_loai as $prod)
							<div class="col-sm-4" style="margin-bottom: 30px">
								<div class="single-item">
									@if($prod->promotion_price != 0)
									<div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
									@endif

									<div class="single-item-header">
										<a href="{{route('detail',$prod->id)}}"><img src="public/image/product/{{$prod->image}}" alt="" width="270px" height="270px"></a>
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
										<a class="add-to-cart pull-left" href="{{route('addtocart',$prod->id)}}"><i class="fa fa-shopping-cart"></i></a>
										<a class="beta-btn primary" href="{{route('detail',$prod->id)}}">Details <i class="fa fa-chevron-right"></i></a>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
							@endforeach
							
						</div>
					</div> <!-- .beta-products-list -->

					<div class="space50">&nbsp;</div>

					<div class="beta-products-list">
						<h4>Sản phẩm khác</h4>
						<div class="beta-products-details">
							<p class="pull-left">Hài lòng ngay từ mùi vị đầu tiên</p>
							<div class="clearfix"></div>
						</div>
						<div class="row">
							@foreach($sp_khac as $prod)
							<div class="col-sm-4">
								<div class="single-item">
									@if($prod->promotion_price != 0)
									<div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
									@endif

									<div class="single-item-header">
										<a href="{{route('detail',$prod->id)}}"><img src="public/image/product/{{$prod->image}}" alt="" width="270px" height="270px"></a>
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
										<a class="add-to-cart pull-left" href="{{route('addtocart',$prod->id)}}"><i class="fa fa-shopping-cart"></i></a>
										<a class="beta-btn primary" href="{{route('detail',$prod->id)}}">Details <i class="fa fa-chevron-right"></i></a>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
							@endforeach
							
						</div>
						<div class="row text-center"> {{ $sp_khac->links() }} </div>
						<div class="space40">&nbsp;</div>
						
					</div> <!-- .beta-products-list -->
				</div>
			</div> <!-- end section with sidebar and main content -->


		</div> <!-- .main-content -->
	</div> <!-- #content -->
</div> <!-- .container -->

@endsection