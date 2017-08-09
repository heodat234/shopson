<div class="new_arrivals_agile_w3ls_info">
	<div class="container">
		<h3 class="wthree_text_info">Sản phẩm <span>Xem Nhiều</span></h3>
		@foreach($product as $pro)
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
						<h4><a href="{{ route('singleProduct',$pro->id) }}">{{ $pro->name }}</a></h4>
						<br>
						<div class="snipcart-details hvr-outline-out button2">
							<a href="{{ route('singleProduct',$pro->id) }}">Xem Chi Tiết</a>
						</div>
						
						
					</div>
				</div>
			</div>
		@endforeach
		<div class="clearfix"></div>
		<div>{{ $product->links() }}</div>
	</div>
</div>