<div class="header" id="home">
	<div class="container">
		<ul>
			<li> <a href="#" data-toggle="modal" data-target="#myModal"><i class="fa fa-unlock-alt" aria-hidden="true"></i> Đăng Nhập </a></li>
			<li> <a href="#" data-toggle="modal" data-target="#myModal2"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Đăng Ký </a></li>
			<li><i class="fa fa-phone" aria-hidden="true"></i> Call : 0903950907</li>
			<li><i class="fa fa-envelope-o" aria-hidden="true"></i> <a href="mailto:info@example.com">heodat234@gmail.com</a></li>
		</ul>
	</div>
</div>
<!-- //header -->
<!-- header-bot -->
<div class="header-bot">
	<div class="header-bot_inner_wthreeinfo_header_mid">
		<div class="col-md-4 header-middle">
			<form action="#" method="post">
				<input type="search" name="search" placeholder="Search here..." required="">
				<input type="submit" value=" ">
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
			<ul class="social-nav model-3d-0 footer-social w3_agile_social">
				<li class="share">Share On : </li>
				<li><a href="#" class="facebook">
					<div class="front"><i class="fa fa-facebook" aria-hidden="true"></i></div>
					<div class="back"><i class="fa fa-facebook" aria-hidden="true"></i></div></a></li>
					<li><a href="#" class="twitter">
						<div class="front"><i class="fa fa-twitter" aria-hidden="true"></i></div>
						<div class="back"><i class="fa fa-twitter" aria-hidden="true"></i></div></a></li>
						<li><a href="#" class="instagram">
							<div class="front"><i class="fa fa-instagram" aria-hidden="true"></i></div>
							<div class="back"><i class="fa fa-instagram" aria-hidden="true"></i></div></a></li>
							<li><a href="#" class="pinterest">
								<div class="front"><i class="fa fa-linkedin" aria-hidden="true"></i></div>
								<div class="back"><i class="fa fa-linkedin" aria-hidden="true"></i></div></a></li>
							</ul>
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
															<a href="{{ route('productByIdParent',$typeCha->id) }}"><h4>{{ $typeCha->name }}</h4></a>
															<ul class="multi-column-dropdown">
																@foreach($typeChild as $typeCon)
																@if($typeCon->type_cha==$typeCha->id)
																<li class="fa fa-long-arrow-right" aria-hidden="true"><a href="{{ route('productByIdChild',$typeCon->id) }}"> {{ $typeCon->name }}</a></li>
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
										</ul>
									</div>
								</div>
							</nav>
						</div>
						<div class="top_nav_right">
							<div class="wthreecartaits wthreecartaits2 cart cart box_1">
								<form action="#" method="post" class="last">
									<input type="hidden" name="cmd" value="_cart">
									<input type="hidden" name="display" value="1">
									<button class="w3view-cart" type="submit" name="submit" value=""><i class="fa fa-cart-arrow-down" aria-hidden="true"></i></button>
								</form>
								
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
				<!-- //banner-top -->