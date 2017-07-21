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
						<div class="info-product-price">
							<span class="item_price">{{ number_format($pro->unit_price) }} VNĐ</span>
							<del>$69.71</del>
						</div>
						<div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out button2">
							<form action="#" method="post">
								<fieldset>
									<input type="hidden" name="cmd" value="_cart" />
									<input type="hidden" name="add" value="1" />
									<input type="hidden" name="business" value=" " />
									<input type="hidden" name="item_name" value="{{ $pro->name }}" />
									<input type="hidden" name="amount" value="{{ $pro->unit_price }}" />
									{{-- <input type="hidden" name="discount_amount" value="1.00" />
									<input type="hidden" name="currency_code" value="USD" /> --}}
									<input type="hidden" name="return" value=" " />
									<input type="hidden" name="cancel_return" value=" " />
									<input type="submit" name="submit" value="Thêm vào giỏ hàng" class="button" />
								</fieldset>
							</form>
						</div>
						
					</div>
				</div>
			</div>
		@endforeach
		<div class="clearfix"></div>
		<div>{{ $product->links() }}</div>
	</div>
</div>