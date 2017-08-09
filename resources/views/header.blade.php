<div class="header" id="home">
	<div class="container">
		<ul>
			@if(Auth::check())
                <li><a href="{{route('profile')}}"><i class="fa fa-user"> Chào bạn {{Auth::User()->full_name}}</i></a></li>
                <li><a href="{{route('logout')}}"><i class="fa fa-sign-out"></i>Đăng xuất</a></li>
            @else
                <li id="dangnhap"> <a href="#" data-toggle="modal" data-target="#myModal"><i class="fa fa-unlock-alt" aria-hidden="true"></i> Đăng Nhập </a></li>
				<li id="dangky"> <a href="#" data-toggle="modal" data-target="#myModal2"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Đăng Ký </a></li>
            @endif
			
			<li><i class="fa fa-phone" aria-hidden="true"></i> Call : 0903950907</li>
			<li><i class="fa fa-envelope-o" aria-hidden="true"></i> <a href="mailto:heodat234@gmail.com">heodat234@gmail.com</a></li>
		</ul>
	</div>
</div>
<!-- //header -->
<!-- header-bot --> 
@if(Session::has('thatbai'))
	<div class="alert alert-danger">{{Session::get('thatbai')}}</div>
@endif
@if(Session::has('thanhcong'))
	<div class="alert alert-success">{{Session::get('thanhcong')}}</div>
@endif
<div class="alert alert-success register" style="display: none;"></div>
<div class="header-bot">
	<div class="header-bot_inner_wthreeinfo_header_mid">
		<div class="col-md-4 header-middle" id="searchfield">
			<form action="{{ route('searchSingle') }}" method="post">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<input type="hidden" name="id" id="idSearch" value="">
				<input type="search" name="search" class="biginput" id="searchPro" placeholder="Search here..." required="">
				<input type="submit"  value=" ">
				<div class="clearfix"></div>
			</form>
		</div>
		<!-- header-bot -->
		<div class="col-md-4 logo_agile">
			<a href="{{ route('home') }}"><img src="{{ asset('images/logo.jpg') }}" style="height: 120px"></a>
			{{-- <h1><a href="index.html"><span>E</span>lite Shoppy <i class="fa fa-shopping-bag top_logo_agile_bag" aria-hidden="true"></i></a></h1> --}}
			
		</div>
		<!-- header-bot -->
		<div class="col-md-4 agileits-social top_content">
			<div class="footer-icons">
					<ul>
						<li>Chia sẻ: </li>
						<li><a href="#" class="twitter"><i class="fa fa-twitter"></i></a></li>
						<li><a href="#" class="twitter facebook"><i class="fa fa-facebook"></i></a></li>
						<li><a href="#" class="twitter chrome"><i class="fa fa-google-plus"></i></a></li>
						<li><a href="#" class="twitter dribbble"><i class="fa fa-dribbble" aria-hidden="true"></i></a></li>
					</ul>
				</div>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
				<!-- //header-bot -->
				<!-- banner -->
				<div class="ban-top">
					<div class="container">
						<div class="top_nav_left">
							<nav class="navbar navbar-default">
								<div class="container-fluid">
									<!-- Brand and toggle get grouped for better mobile display -->
									<div class="navbar-header">
										<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
										<span class="sr-only">Toggle navigation</span>
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
										</button>
									</div>
									<!-- Collect the nav links, forms, and other content for toggling -->
									<div class="collapse navbar-collapse menu--shylock" id="bs-example-navbar-collapse-1">
										<ul class="nav navbar-nav menu__list">
											<li class="active menu__item menu__item--current"><a class="menu__link" href="{{ route('home') }}">Trang chủ <span class="sr-only">(current)</span></a></li>
											<li class=" menu__item"><a class="menu__link" href="{{ route('about') }}">Giới thiệu</a></li>
											<li class="dropdown menu__item">
												<a href="#" class="dropdown-toggle menu__link" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Sản phẩm <span class="caret"></span></a>
												<ul class="dropdown-menu multi-column columns-3">
													<div class="agile_inner_drop_nav_info">
														{{-- <div class="col-sm-6 multi-gd-img1 multi-gd-text ">
															<a href="mens.html"><img src="images/top2.jpg" alt=" "/></a>
														</div> --}}
														@foreach($typeParent as $typeCha)
														<div class="col-sm-3">
															<a href="{{ route('productByIdParent',[$typeCha->id,'type=rong']) }}"><h4>{{ $typeCha->name }}</h4></a>
															<ul class="multi-column-dropdown">
																@foreach($typeChild as $typeCon)
																@if($typeCon->type_cha==$typeCha->id)
																<li class="fa fa-long-arrow-right" aria-hidden="true"><a href="{{ route('productByIdChild',[$typeCon->id,'type=rong']) }}"> {{ $typeCon->name }}</a></li>
																@endif
																@endforeach
															</ul>
														</div>
														
														@endforeach
														<div class="clearfix"></div>
													</div>
												</ul>
											</li>
											
											<li class=" menu__item"><a class="menu__link" href="{{ route('contact') }}">Liên hệ</a></li>
											<li class=" menu__item"><a class="menu__link" href="{{ route('news') }}">Tin tức</a></li>
										</ul>
									</div>
								</div>
							</nav>
						</div>
						<div class="top_nav_right">
							<div class="wthreecartaits wthreecartaits2 cart cart box_1">
								{{-- <form action="#" method="post" class="last">
									<input type="hidden" name="cmd" value="_cart">
									<input type="hidden" name="display" value="1">
									<button class="w3view-cart" type="submit" name="submit" value=""><i class="fa fa-cart-arrow-down" aria-hidden="true"></i></button>
								</form> --}}
								<button class="w3view-cart shopping_cart_info" type="submit" name="submit" value="" onclick="showCart()"><i class="fa fa-cart-arrow-down" aria-hidden="true"></i></button>
								<span id='items_in_shopping_cart' style='color:#333; font-size:15px;'>
					                	@if(Session::has('cart'))
					                	{{Session('cart')->totalQty}}
					                	@else 
					                	{{0}}
					                	@endif
					            </span>
					            <span style='color:#333; font-size:15px;'> Sản phẩm</span> 
							</div>
						</div>
						
						<div class="clearfix"></div>
						<!-- Holds shopping cart info with selected items -->
					    <div class="shopping_cart_holder">
					        <a href="#" class="close_shopping_cart_holder" title="Đóng giỏ hàng">Close Cart</a>
					        <h2>Shopping Cart</h2>
					        <div id="shopping_cart_output">
					        </div>
					    </div>
					</div>

				</div>
				<!-- //banner-top -->
				<script type="text/javascript">
					$(".shopping_cart_holder").fadeOut();

					function showCart() {
						$(".shopping_cart_holder").fadeIn(); // how to cart displays - you can change to any event you wish.
					    $("#shopping_cart_output" ).load( "{{route('show-cart')}}");
					}
					$( ".close_shopping_cart_holder").click(function(e){
					    e.preventDefault(); 
					    $(".shopping_cart_holder").fadeOut(500); // close cart of fadeOut ... or any event you wish 
					});
				</script>