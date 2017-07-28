@extends('master')
@section('content')
@for($i=1;$i<count($banner);$i++)
	@if($banner[$i]->position==4)
		<div class="page-head_agile_info_w3l" style="background-image: url(images/banner/{{ $banner[$i]->hinh }});">
			<div class="container">
				<h3>Chi tiết <span>Sản phẩm </span></h3>
				<!--/w3_short-->
				<div class="services-breadcrumb">
					<div class="agile_inner_breadcrumb">
						<ul class="w3_short">
							<li><a href="{{ route('home') }}">Trang chủ</a><i>|</i></li>
							<li>Chi tiết sản phẩm</li>
						</ul>
					</div>
				</div>
				<!--//w3_short-->
			</div>
		</div>
	@endif
@endfor
<div class="banner-bootom-w3-agileits">
	<div class="container">
		<div class="col-md-4 single-right-left ">
			<div class="grid images_3_of_2">
				<div class="flexslider">
					
					<ul class="slides">
						<li data-thumb="images/products/{{ $product[0]->image }}">
							<div class="thumb-image"> <img src="images/products/{{ $product[0]->image }}" data-imagezoom="true" class="img-responsive"> </div>
						</li>
						<li data-thumb="images/products/{{ $product[0]->image }}">
							<div class="thumb-image"> <img src="images/products/{{ $product[0]->image }}" data-imagezoom="true" class="img-responsive"> </div>
						</li>
						<li data-thumb="images/products/{{ $product[0]->image }}">
							<div class="thumb-image"> <img src="images/products/{{ $product[0]->image }}" data-imagezoom="true" class="img-responsive"> </div>
						</li>
					</ul>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
		{{-- {{ dd($product) }} --}}
		<div class="col-md-8 single-right-left simpleCart_shelfItem">
			<h3>{{ $product[0]->name }} </h3>
			@foreach($product as $pro)
			<p>{{ $pro->size }}: <span class="item_price">{{ number_format($pro->export_price) }} VNĐ</span></p>
			@endforeach
			<div class="rating1">
				<span class="starRating">
					<input id="rating5" type="radio" name="rating" value="5">
					<label for="rating5">5</label>
					<input id="rating4" type="radio" name="rating" value="4">
					<label for="rating4">4</label>
					<input id="rating3" type="radio" name="rating" value="3" checked="">
					<label for="rating3">3</label>
					<input id="rating2" type="radio" name="rating" value="2">
					<label for="rating2">2</label>
					<input id="rating1" type="radio" name="rating" value="1">
					<label for="rating1">1</label>
				</span>
				Lượt xem: {{ $product[0]->view }}
			</div>
			<div class="description">
				{{ $product[0]->description }}
			</div>

			<form action="#" method="post">
			<div class="color-quality">
				<div class="color-quality-right">
					<h5>Số lượng:</h5>
					<button  type="button" id="minus" style="margin-left: 3%;"><i class="fa fa-minus" aria-hidden="true"></i></button>
					<input type="text" name="quantity" id="quantity"  value="1" pattern="[0-9]{1,4}" required title=" nhâp 1 to 4 chữ số">
					<button   type="button" id="plus"><i class="fa fa-plus" aria-hidden="true"></i></button>
					 
				</div>
				<br>
				<div class="col-sm-4">
			  		<h4>Màu sơn: </h4> <input value="222" name="color" id="colorPro" class="pick-a-color form-control" type="text">
			  </div>
			  <div class="clearfix"> </div>
			</div>
			
			<div class="occasional">
				<h5>Loại :</h5>
				@foreach($product as $pro)
				<div class="colr ert">
					<label class="radio"><input type="radio" name="amount" id="idsize" value="{{ $pro->idsize }}"><i></i>{{ $pro->size }}</label>
				</div>
				@endforeach	
				
				<div class="clearfix"> </div>
			</div>
			
			</form>
			
				<button class="snipcart-details" style="background-color: #2fdab8; width: 250px;height: 50px"  onclick="addcart('{{ $product[0]->id}}');">Thêm vào giỏ hàng</button>
			


							
						</div>
						<div class="clearfix"> </div>
						<!-- /new_arrivals -->
						<div class="responsive_tabs_agileits">
							<div id="horizontalTab">
								<ul class="resp-tabs-list">
									<li>Mô tả</li>
									<li>Đánh giá</li>
									
								</ul>
								<div class="resp-tabs-container">
									<!--/tab_one-->
									<div class="tab1">
										<div class="single_page_agile_its_w3ls">
											<h6>Sơn Jotun Majestic Đẹp Hoàn Hảo ( Bóng )</h6>
											<p>Sơn Jotun nội thất Majetic đẹp hoàn hảo là sản phẩm sơn nội thất cao cấp đem lại màu sắc rực rỡ, sắc nét, tạo nét sang trọng cho ngôi nhà bạn. Tường nhà được sơn bởi Majestic sẽ có bề mặt mờ cổ điển, bền màu và dễ lau chùi. Với công thức công nghệ màu đích thực và chất tạo màng đặc biệt của Jotun sẽ đảm bảo màu sơn Majestic luôn chính xác và bền màu theo thời gian. Jotun luôn cam kết đáp ứng những tiêu chuẩn cao nhất nhằm mang lại sản phẩm thân thiện với môi trường và sức khỏe người tiêu dùng.  </p>
											
										</div>
									</div>
									<!--//tab_one-->
									<div class="tab2">
										
										<div class="fb-comments" data-href="http://localhost/webson/public/" data-numposts="5"></div>
									</div>
									
								</div>
							</div>
						</div>
						<!-- //new_arrivals -->
						<!--/slider_owl-->
						
						<div class="w3_agile_latest_arrivals">
							<h3 class="wthree_text_info">Featured <span>Arrivals</span></h3>
							<div class="col-md-3 product-men single">
								<div class="men-pro-item simpleCart_shelfItem">
									<div class="men-thumb-item">
										<img src="images/w2.jpg" alt="" class="pro-image-front">
										<img src="images/w2.jpg" alt="" class="pro-image-back">
										<div class="men-cart-pro">
											<div class="inner-men-cart-pro">
												<a href="single.html" class="link-product-add-cart">Quick View</a>
											</div>
										</div>
										<span class="product-new-top">New</span>
										
									</div>
									<div class="item-info-product ">
										<h4><a href="single.html">Sleeveless Solid Blue Top</a></h4>
										<div class="info-product-price">
											<span class="item_price">$140.99</span>
											<del>$189.71</del>
										</div>
										<div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out button2">
											<form action="#" method="post">
												<fieldset>
													<input type="hidden" name="cmd" value="_cart">
													<input type="hidden" name="add" value="1">
													<input type="hidden" name="business" value=" ">
													<input type="hidden" name="item_name" value="Sleeveless Solid Blue Top">
													<input type="hidden" name="amount" value="30.99">
													<input type="hidden" name="discount_amount" value="1.00">
													<input type="hidden" name="currency_code" value="USD">
													<input type="hidden" name="return" value=" ">
													<input type="hidden" name="cancel_return" value=" ">
													<input type="submit" name="submit" value="Add to cart" class="button">
												</fieldset>
											</form>
										</div>
										
									</div>
								</div>
							</div>
							<div class="col-md-3 product-men single">
								<div class="men-pro-item simpleCart_shelfItem">
									<div class="men-thumb-item">
										<img src="images/w4.jpg" alt="" class="pro-image-front">
										<img src="images/w4.jpg" alt="" class="pro-image-back">
										<div class="men-cart-pro">
											<div class="inner-men-cart-pro">
												<a href="single.html" class="link-product-add-cart">Quick View</a>
											</div>
										</div>
										<span class="product-new-top">New</span>
										
									</div>
									<div class="item-info-product ">
										<h4><a href="single.html">Black Basic Shorts</a></h4>
										<div class="info-product-price">
											<span class="item_price">$120.99</span>
											<del>$189.71</del>
										</div>
										<div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out button2">
											<form action="#" method="post">
												<fieldset>
													<input type="hidden" name="cmd" value="_cart">
													<input type="hidden" name="add" value="1">
													<input type="hidden" name="business" value=" ">
													<input type="hidden" name="item_name" value="Black Basic Shorts">
													<input type="hidden" name="amount" value="30.99">
													<input type="hidden" name="discount_amount" value="1.00">
													<input type="hidden" name="currency_code" value="USD">
													<input type="hidden" name="return" value=" ">
													<input type="hidden" name="cancel_return" value=" ">
													<input type="submit" name="submit" value="Add to cart" class="button">
												</fieldset>
											</form>
										</div>
										
									</div>
								</div>
							</div>
							<div class="col-md-3 product-men single">
								<div class="men-pro-item simpleCart_shelfItem">
									<div class="men-thumb-item">
										<img src="images/s6.jpg" alt="" class="pro-image-front">
										<img src="images/s6.jpg" alt="" class="pro-image-back">
										<div class="men-cart-pro">
											<div class="inner-men-cart-pro">
												<a href="single.html" class="link-product-add-cart">Quick View</a>
											</div>
										</div>
										<span class="product-new-top">New</span>
										
									</div>
									<div class="item-info-product ">
										<h4><a href="single.html">Aero Canvas Loafers  </a></h4>
										<div class="info-product-price">
											<span class="item_price">$120.99</span>
											<del>$199.71</del>
										</div>
										<div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out button2">
											<form action="#" method="post">
												<fieldset>
													<input type="hidden" name="cmd" value="_cart">
													<input type="hidden" name="add" value="1">
													<input type="hidden" name="business" value=" ">
													<input type="hidden" name="item_name" value="Aero Canvas Loafers">
													<input type="hidden" name="amount" value="30.99">
													<input type="hidden" name="discount_amount" value="1.00">
													<input type="hidden" name="currency_code" value="USD">
													<input type="hidden" name="return" value=" ">
													<input type="hidden" name="cancel_return" value=" ">
													<input type="submit" name="submit" value="Add to cart" class="button">
												</fieldset>
											</form>
										</div>
										
									</div>
								</div>
							</div>
							<div class="col-md-3 product-men single">
								<div class="men-pro-item simpleCart_shelfItem">
									<div class="men-thumb-item">
										<img src="images/w7.jpg" alt="" class="pro-image-front">
										<img src="images/w7.jpg" alt="" class="pro-image-back">
										<div class="men-cart-pro">
											<div class="inner-men-cart-pro">
												<a href="single.html" class="link-product-add-cart">Quick View</a>
											</div>
										</div>
										<span class="product-new-top">New</span>
										
									</div>
									<div class="item-info-product ">
										<h4><a href="single.html">Ankle Length Socks</a></h4>
										<div class="info-product-price">
											<span class="item_price">$100.99</span>
											<del>$159.71</del>
										</div>
										<div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out button2">
											<form action="#" method="post">
												<fieldset>
													<input type="hidden" name="cmd" value="_cart">
													<input type="hidden" name="add" value="1">
													<input type="hidden" name="business" value=" ">
													<input type="hidden" name="item_name" value="Ankle Length Socks">
													<input type="hidden" name="amount" value="30.99">
													<input type="hidden" name="discount_amount" value="1.00">
													<input type="hidden" name="currency_code" value="USD">
													<input type="hidden" name="return" value=" ">
													<input type="hidden" name="cancel_return" value=" ">
													<input type="submit" name="submit" value="Add to cart" class="button">
												</fieldset>
											</form>
										</div>
										
									</div>
								</div>
							</div>
							<div class="clearfix"> </div>
							<!--//slider_owl-->
						</div>
					</div>
				</div>
				<!--//single_page-->
				<script type="text/javascript">
					$('#minus').click(function()
					{
						var quantity=parseInt($("#quantity").val())-1;
						if(quantity<=1)
							$("#quantity").val(1);
						else
							$("#quantity").val(quantity);

					});
					$('#plus').click(function()
					{
						var quantity=parseInt($("#quantity").val())+1;

							$("#quantity").val(quantity);

					});
		
					function addcart(id){
				        var quantity = $('#quantity').val();
				        var color = $('#colorPro').val();
				        var idsize = $('#idsize').val();
				        alert(idsize);
				        var route = "{{route('add-to-cart',['idsize','quantity','color'])}}"; 
				        route=route.replace("idsize",idsize); 
				        route=route.replace("quantity",quantity); 
				        route=route.replace("color",color); 
				        $.ajax({
				            url: route,
				            type: "get",
				            data: null,

				            processData: false,
            				contentType: false,
				        }).done(function(data){ 
				        	var getData = $.parseJSON(data);
				           // console.log(getData.totalQty);
				            $("#items_in_shopping_cart").html(getData.totalQty); // get Json data
				            if($(".shopping_cart_holder").css("display") == "block"){ // Check if shopping cart is open 
				                $(".shopping_cart_info").trigger( "click" );  // update cart on event
				            }
				        })
				        
				    }
				</script>
				@endsection