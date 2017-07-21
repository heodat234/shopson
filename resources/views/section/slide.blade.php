<div id="myCarousel" class="carousel slide" >
	<!-- Indicators -->
	<ol class="carousel-indicators">
		<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
		@for($i=1;$i<count($banner);$i++)
			@if($banner[$i]->position==0)
				<li data-target="#myCarousel" data-slide-to="{{ $i }}" class=""></li>
			@endif
		@endfor
	</ol>
	<div class="carousel-inner" role="listbox">
		@for($i=1;$i<count($banner);$i++)
		@if($banner[$i]->position==0)
		
		<div class="item" style="background-image:url(images/banner/{{ $banner[$i]->hinh }}); ">
			<div class="container">
				<div class="carousel-caption">
					<h3>Giảm giá<span>Lớn</span></h3>
					<p>Đặc biệt hôm nay</p>
					<a class="hvr-outline-out button2" href="mens.html">Xem Ngay </a>
				</div>
			</div>
		</div>
		@endif
		@endfor
		
		<div class="item active" style="background-image:url(images/banner/{{ $banner[0]->hinh }}); ">
			<div class="container">
				<div class="carousel-caption">
					<h3>Giảm giá<span>Lớn</span></h3>
					<p>Đặc biệt hôm nay</p>
					<a class="hvr-outline-out button2" href="mens.html">Xem Ngay </a>
				</div>
			</div>
		</div>
	</div>
	<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
		<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
		<span class="sr-only">Previous</span>
	</a>
	<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
		<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
		<span class="sr-only">Next</span>
	</a>
	<!-- The Modal -->
</div>