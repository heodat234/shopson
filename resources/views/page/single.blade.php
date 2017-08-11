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
					{{-- {{ dd($product) }} --}}
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
		{{-- {{ dd($type_cha->type_cha) }} --}}
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
				<b>Tính năng:</b> <br>
				{{-- {!!$product[0]->description !!} --}}
			</div>

			<form action="#" method="post">
			<div class="color-quality">
				<div class="color-quality-right">
					<h5>Số lượng:</h5>
					<button  type="button" id="minus" style="margin-left: 3%;"><i class="fa fa-minus" aria-hidden="true"></i></button>
					<input type="text" name="quantity" id="quantity"  value="1" pattern="[0-9]" required title=" nhâp 1 to 4 chữ số">
					<button   type="button" id="plus"><i class="fa fa-plus" aria-hidden="true"></i></button>
					 
				</div>
				<br>
				@if($type_cha->type_cha!=4)
				<div class="col-sm-4">
			  		<h4>Màu sơn: </h4> <input value="222" name="color" id="colorPro" class="pick-a-color form-control" type="text">
			  	</div>
			  	@endif
			  	<div class="clearfix"> </div>
			</div>
			
			<div class="occasional">
				<h5>Loại :</h5>
				@foreach($product as $pro)
				@if($pro->status == 0) <!-- neu bang 1 là da xoa -->
				<div class="colr ert">
					<label class="radio"><input type="radio" name="amount" checked="" class="idsize" value="{{ $pro->idsize }}"><i></i>{{ $pro->size }}</label>
				</div>
				@endif
				@endforeach	
				
				<div class="clearfix"> </div>
			</div>
			
			</form>
			
				<button class="btn btn-sussess fa fa-cart-plus" style="background-color: #2fdab8; width: 250px;height: 50px" 	 onclick="addcart('{{ $product[0]->id}}');">  Thêm vào giỏ hàng</button>
				<br><br>
				<div class="alert alert-success thanhcong" style="display: none;"></div>
				<div class="alert alert-danger thatbai" style="display: none;"></div>
							
						</div>
						<div class="clearfix"> </div>
						<!-- /new_arrivals -->
						<div class="responsive_tabs_agileits">
							<div id="horizontalTab">
								<ul class="resp-tabs-list">
									<li>Mô tả</li>
									<li>Đánh giá</li>
									<li>Bảo hành</li>
									<li>Vận chuyển</li>
								</ul>
								<div class="resp-tabs-container">
									<!--/tab_one-->
									<div class="tab1">
										<div class="single_page_agile_its_w3ls">
											<h6>{{ $product[0]->name }}</h6>
											<p>{!!$product[0]->description  !!} </p>
											
										</div>
									</div>
									<!--//tab_one-->
									<div class="tab2">
										<div class="single_page_agile_its_w3ls">
										<div style="width: 100%" class="fb-comments" data-href="http://localhost/webson/public/" data-numposts="5"></div>
										</div>
									</div>
									<div class="tab3">
									<div class="single_page_agile_its_w3ls">
										<h2><b>Quy định bảo hành và đổi trả hàng</b> </h2><br>
										Quy định đổi trả hàng:<br>

										- Tất cả các sản phẩm sơn được đưa lên trên Website: vilapaint.com cam kết đều là những sản phẩm chính hãng của các nhà sản xuất sơn, các sản phẩm sơn đã được nhà sản xuất đăng ký về Hợp Chuẩn Hợp Quy và tiêu chuẩn chất lượng theo quy định của nhà nước và luật xây dựng Việt nam.<br>

										- Sản phẩm được Vila Paint cung cấp ra thị trường đều có cơ chế hậu mãi và bảo hành, đảm bảo không có hàng giả hàng nhái và hàng kém chất lượng.<br>

										- Mọi chính sách bảo hành sơn, đổi trả sơn chúng tôi đều thực hiện theo quy định của từng nhà sản xuất với những thương hiệu sơn đang cung cấp ra thị trường.<br>

										- Nếu hàng giao cho Quý khách không đúng theo đơn đặt hàng, hoặc không đúng theo tiêu chuẩn của nhà sản xuất thì Quý khách hàng được yêu cầu đổi trả hàng như sau:<br>

										<b>1. Thời gian đổi trả :</b><br>

										Thời gian đổi trả trong vòng 48h từ khi nhận hàng.<br>

										<b>2. Điều kiện để đổi trả hàng:</b><br>

										+ Sản phẩm bị lỗi do nhà sản xuất<br>

										+ Hàng không đúng chuẩn, mẫu mã như Quý khách đặt hàng<br>

										+ Đổi sản phẩm đúng như Quý khách đã đặt, không cho phép đổi sản phẩm không cùng loại.<br>

										+ Hàng đổi hoặc trả phải còn mới, nguyên đai, nguyên kiện, không có dấu hiệu cạy mở, thay đổi.<br>

										<b>3. Cách thức đổi trả hàng:</b><br>

										- Khách hàng chuyển hàng đổi trả, Công ty sẽ chuyển hàng mới đạt yêu cầu cho Quý khách.<br> 

										- Để đổi trả hàng Quý khách vui lòng làm theo trình tự sau:<br>

										+ Khi phát hiện sự cố đề nghị khách hàng dừng mọi hoạt động liên quan đến sự cố và thực hiện bước sau.<br>

										+ Gọi điện thoại thông báo ngay cho nhân viên đã bán hàng hoặc số điện thoại của bộ phận giải quyết khiếu nại hoặc đến trực tiếp văn phòng Công ty TNHH Vila Paint  để thông báo, nói rõ cụ thể tình trạng mà mình đang gặp phải.<br>

										+ Thỏa thuận với người giải quyết về hình thức, cách thức, thời gian đổi hàng cụ thể.<br>

										+ Trong trường hợp khách hàng biết có sự cố nhưng vẫn cố tình sử dụng và sau khi sử dụng xong hoặc đang sử dụng  mới thực hiện các bước thông báo sự cố thì Vila Paint và nhà sản xuất không giải quyết và không có trách nhiệm trong vấn đề này.<br>

										- Chi phí khi đổi, trả hàng:<br>

										Tất cả các chi phí trực tiếp phát sinh do lỗi trên sẽ được Công ty TNHH Vila Paint hỗ trợ hoàn toàn miễn phí.<br>

										<b>4. Chính sách hoàn tiền:</b><br>

										Sau quá trình đổi trả nếu hàng vẫn không đúng theo yêu cầu đặt hàng thì Quý khách hàng được quyền yêu cầu dừng đơn hàng và được hoàn trả tiền bằng tiền mặt hoặc chuyển khoản.<br>

										<b>5. Chính sách bảo hành sơn:</b><br>

										Chính sách bảo hành sơn nhà, sơn nước, sơn dầu, sơn công nghiệp sơn chống thấm...sẽ giải quyết tất cả các câu hỏi của khách hàng:<br>

										Sơn bảo hành bao lâu?<br>

										Cơ chế bảo hành sơn như thế nào?<br>

										+ Chính sách bảo hành sơn nhà, sơn dầu, sơn công nghiệp theo quy định của từng nhà sản xuất sơn sản phẩm sơn.<br>

										+ Khi cần giải quyết có thể liên hệ trực tiếp nhà sản xuất hoặc có thể gọi điện đến đơn vị thương mại  Công ty TNHH Vila Paint để được thực hiện quyền bảo hành sản phẩm sơn mình đã mua và sử dụng.<br>

										 Mua sơn có bảo hành, Bán sơn có bảo hành, xử lý sự cố về sơn nhanh chóng dứt điểm.<br>

										<h2 style="color: red; float: center">Hãy để Vila Paint mang lại giá trị niềm tin đến với khách hàng</h2><br>

										Quý khách hàng có thể gọi trực tiếp đến số máy tiếp nhận và giải quyết khứu nại sơn: 0964215696<br>

										Trân trọng cảm ơn sự quan tâm của Quý khách hàng!<br>
									</div>
									</div>
									<div class="tab4">
										<div class="single_page_agile_its_w3ls">
											<b><h3>Chính sách vận chuyển và giao nhận</h3></b><br>
 
											<b>1.Chính sách vận chuyển gần</b><br>
											Công ty sẽ giao hàng miễn phí tận nơi trong bán kính 10km với đơn hàng đạt số lượng lớn hơn hoặc bằng 5 đơn vị (thùng-kiện-bao).<br>
											Đối với những trường hợp số lượng hàng ít không đạt mức từ 5 đơn vị trở lên khách hàng sẽ hỗ trợ thêm phí vận chuyển ngoại trừ trường hợp có sự hỗ trợ vận chuyển từ nhà sản xuất.<br>
											Phí vận chuyển công ty sẽ báo trước cho khách hàng<br>
											<b>2.Chính sách vận chuyển xa</b><br>
											Công Ty sẽ giao hàng ra ngoài bến xe gửi theo nhà xe khách hàng chỉ định hoặc Công ty sẽ liên hệ với nhà xe, sau đó nhà xe sẽ chở hàng đến cho khách hàng, phí xe sẽ do khách hàng chi trả.<br>
											Trường hợp khách hàng mua số lượng lớn đủ một chuyến xe tải hoặc theo quy định thì Công ty sẽ hỗ trợ chở hàng tận nơi cho quý khách trong bán kính 150km.
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- //new_arrivals -->
						<!--/slider_owl-->
						
						<div class="w3_agile_latest_arrivals">
							<h3 class="wthree_text_info">Sản phẩm <span>Cùng loại</span></h3>
							{{-- {{ dd($productsType) }} --}}
							@foreach($productsType as $proType)
							@if($proType->id != $product[0]->id)
							<div class="col-md-3 product-men single">
								<div class="men-pro-item simpleCart_shelfItem" style="height: 360px">
									<div class="men-thumb-item">
										<img src="images/products/{{$proType->image  }}" style="height: 200px" alt="" class="pro-image-front">
										<img src="images/products/{{$proType->image  }}" style="height: 200px" alt="" class="pro-image-back">
										<div class="men-cart-pro">
											<div class="inner-men-cart-pro">
												<a href="{{ route('singleProduct',$proType->id) }}" class="link-product-add-cart">Xem Nhanh</a>
											</div>
										</div>
										<span class="product-new-top">New</span>
									</div>
									<div class="item-info-product ">
										<h4><a href="{{ route('singleProduct',$proType->id) }}">{{ $proType->name }}</a></h4>
										<br>
										<div class="snipcart-details  hvr-outline-out button2">
										<a href="{{ route('singleProduct',$proType->id) }}">Xem Chi Tiết</a>
										</div>
									</div>
								</div>
							</div>
							@endif
							@endforeach
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
				        
				        var id_cha = {{ $type_cha->type_cha }};
				        if(id_cha !=4)
				        	var color = $('#colorPro').val();
				    	else 
				    		var color = "0";
				        var idsize = "";
				        var checkbox = $('.idsize');
		                for (var i = 0; i < checkbox.length; i++){
		                    if (checkbox[i].checked === true){
		                        
		                        idsize = checkbox[i].value;
		                    }
		                }
		                if (quantity!=0) {
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
				        	var cart = data.substring(1);
                				// console.log(thongbao);
                			if(data.substr(0,1)==0){
				        		var getData = $.parseJSON(cart);
				            	$("#items_in_shopping_cart").html(getData.totalQty); // get Json data
				            	if($(".shopping_cart_holder").css("display") == "block"){ // Check if shopping cart is open 
				                	$(".shopping_cart_info").trigger( "click" );  // update cart on event
				            	}
				            	$('div.thanhcong').fadeIn();
			                    $('div.thanhcong').html("Đã thêm vào giỏ hàng");
			                    $('div.thanhcong').fadeOut(10000);
				            }else{
				            	$('div.thatbai').fadeIn();
			                    $('div.thatbai').html(cart);
			                    $('div.thatbai').fadeOut(10000);
			                    
				            }
				        })
				        }else{
				        	$('div.thatbai').fadeIn();
			                    $('div.thatbai').html("Số lượng phải tối thiểu bằng 1");
			                    $('div.thatbai').fadeOut(10000);
				        }

				    }
				</script>
				@endsection