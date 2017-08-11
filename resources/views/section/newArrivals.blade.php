
<div class="new_arrivals_agile_w3ls_info">
	<div class="container">
		<h3 class="wthree_text_info">Hàng <span>Mới Về</span></h3>
		<div id="horizontalTab">
			<ul class="resp-tabs-list">
			@foreach($typeParent as $type)
				<li>{{ $type->name }}</li>
			@endforeach
			</ul>
			{{-- {{ dd($typeParent,$product) }} --}}
			<div class="resp-tabs-container">
				@for($i=1;$i<=count($typeParent);$i++)
					
					<div class="tab{{ $i }}">
						@foreach($product as $pro)
							@if($pro->type_cha==$i)
								<div class="col-md-3 product-men">
									<div class="men-pro-item simpleCart_shelfItem" style="height: 360px">
										<div class="men-thumb-item">
											<img src="images/products/{{ $pro->image }}" style="height: 200px" alt="" class="pro-image-front">
											<img src="images/products/{{ $pro->image }}" style="height: 200px" alt="" class="pro-image-back">
											<div class="men-cart-pro">
												<div class="inner-men-cart-pro">
													<a href="{{ route('singleProduct',$pro->id) }}" class="link-product-add-cart">Xem Nhanh</a>
												</div>
											</div>
											<span class="product-new-top">New</span>
											
										</div>
										<div class="item-info-product ">
											<div style="height: 50px">
												<h4><a href="{{ route('singleProduct',$pro->id) }}">{{ $pro->name }}</a></h4>
											</div>
											<div class="snipcart-details  hvr-outline-out button2">
												<a href="{{ route('singleProduct',$pro->id) }}">Xem Chi Tiết</a>
											</div>
											
										</div>
									</div>
								</div>
							@endif
						@endforeach
						<div class="clearfix"></div>
					</div>
						
				@endfor
			</div>
		</div>
	</div>
</div>
<!-- //new_arrivals -->
<!-- /we-offer -->
@for($i=1;$i<count($banner);$i++)
	@if($banner[$i]->position==3)
		<div class="sale-w3ls" style="background-image: url('images/banner/{{ $banner[$i]->hinh }}');">
			<div class="container">
				<h6>We Offer Flat <span>40%</span> Discount</h6>
				
				<a class="hvr-outline-out button2" href="single.html">Shop Now </a>
			</div>
		</div>
	@endif
@endfor
<!-- //we-offer -->
<!--/grids