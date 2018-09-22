@extends('layout.index')

@section('title') Search @endsection

@section('contents')

<div class="container">
	<div id="content" class="space-top-none">
		<div class="main-content">
			<div class="space60">&nbsp;</div>
			<div class="row">
				<div class="col-sm-12">
					<div class="beta-products-list">
						<h4>Kết quả tìm kiếm</h4>
						<div class="beta-products-details">
							<p class="pull-left">Tìm thấy {{$count}} sản phẩm</p>
							<div class="clearfix"></div>
						</div>

						<div class="row">
							
							@foreach($products as $prod)	
							<div class="col-sm-3" style="margin-bottom: 30px">
									<div class="single-item">
										@if($prod->promotion_price != 0)
										<div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
										@endif
										<div class="single-item-header">
											<a href="{{route('detail',$prod->id)}}"><img src="public/image/product/{{$prod->image}}" alt="" width="260px" height="212px"></a>
										</div>
										<div class="single-item-body">
											<p class="single-item-title">{!! highlight($prod->name, $keyword) !!}</p>
											<p class="single-item-price">
												@if($prod->promotion_price != 0)
												<span class="flash-del">{{number_format($prod->unit_price)}}</span>
												<span class="flash-sale">{{number_format($prod->promotion_price) }}</span>
												@else
												<span class="flash-sale">{{number_format($prod->unit_price) }}</span>
												@endif
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
						<div class="row text-center" >
							{{ $products->links() }}
						</div>
					</div> <!-- .beta-products-list -->
				</div>
			</div> <!-- end section with sidebar and main content -->


		</div> <!-- .main-content -->
	</div> <!-- #content -->
</div> <!-- .container -->

@endsection