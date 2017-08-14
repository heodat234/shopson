@extends('master')
@section('content')
<!-- /banner_bottom_agile_info -->
@for($i=1;$i<count($banner);$i++)
@if($banner[$i]->position==4)
<div class="page-head_agile_info_w3l"  style="background-image: url(images/banner/{{ $banner[$i]->hinh }});">
	<div class="container">
		<h3>L<span>iên Hệ </span></h3>
		<div class="services-breadcrumb">
			<div class="agile_inner_breadcrumb">
				<ul class="w3_short">
					<li><a href="index.html">Trang chủ</a><i>|</i></li>
					<li>Liên hệ</li>
				</ul>
			</div>
		</div>
	</div>
</div>
@endif
@endfor

<div class="banner_bottom_agile_info">
	<div class="container">
		<div class="contact-grid-agile-w3s">
			<div class="col-md-4 contact-grid-agile-w3">
				<div class="contact-grid-agile-w31">
					<i class="fa fa-map-marker" aria-hidden="true"></i>
					<h4>Địa chỉ</h4>
					<p>84 Đường số 2, Trường Thọ<span>Thủ Đức, thành phố Hồ Chí Minh, Việt Nam.</span></p>
				</div>
			</div>
			<div class="col-md-4 contact-grid-agile-w3">
				<div class="contact-grid-agile-w32">
					<i class="fa fa-phone" aria-hidden="true"></i>
					<h4>Số điện thoại</h4>
					<p>+84 0903950907<span>+84 0981332104</span></p>
				</div>
			</div>
			<div class="col-md-4 contact-grid-agile-w3">
				<div class="contact-grid-agile-w33">
					<i class="fa fa-envelope-o" aria-hidden="true"></i>
					<h4>Email</h4>
					<p><a href="mailto:info@example.com">heodat234@gmail.com</a><span><a href="mailto:info@example.com">thanhhung23495@gmail.com</a></span></p>
				</div>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
</div>
<div class="contact-w3-agile1 map" data-aos="flip-right">
	
	<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3918.6707114583096!2d106.75071671421505!3d10.83649206104675!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317527b6b4e70b49%3A0x77d2e111705a8f65!2zxJDGsOG7nW5nIFPhu5EgMiwgVHLGsOG7nW5nIFRo4buNLCBUaOG7pyDEkOG7qWMsIEjhu5MgQ2jDrSBNaW5oLCBWaWV0bmFt!5e0!3m2!1sen!2s!4v1502290168170" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
</div>
<div class="banner_bottom_agile_info">
	<div class="container">
		<div class="agile_ab_w3ls_info">
			<div class="col-md-6 ab_pic_w3ls">
				<img src="images/logo.jpg" alt=" " class="img-responsive" />
			</div>
			<div class="col-md-6 ab_pic_w3ls_text_info">
				<h1>Giới thiệu về <span> Vila Paint</span> </h1>

				<p><h2><b>VILA PAINT BÁN SƠN CHÍNH HÃNG TRÊN TOÀN QUỐC</b></h2></p>
 
				<p>Công ty TNHH Vila Paint là đơn vị Thương Mại  trong ngành sơn.</p>
 
				<p><b>Chính sách bán sơn của Tổng Kho Sơn – Tongkhoson.com:</b></p>

					<p>+ Phục vụ <b>Khách hàng mua lẻ</b> các loại sơn:</p>

					<p>Số lượng không hạn định:    Cung cấp từ đơn vị nhỏ nhất</p>

                                              
     				<p>+ Phục vụ <b>Khách hàng là thợ sơn</b></p>

 					<p>Số lượng không hạn định:    Cung cấp theo đơn hàng cụ thể</p>

   					<p>+ Phục vụ <b>Khách hàng là thầu thi công sơn</b></p>

					<p>Số lượng không hạn định:    Cung cấp theo đơn hàng cụ thể</p>

					<p>+ Phục vụ <b>Khách hàng là đại lý sơn</b></p>

					<p>Số lượng không hạn định:    Cung cấp theo Quy định của Công ty</p>
			</div>
			<div class="clearfix"></div>
		</div>
		
	</div>
</div>
@endsection