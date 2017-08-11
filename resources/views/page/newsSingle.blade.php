@extends('master')
@section('content')
<!-- /banner_bottom_agile_info -->
@for($i=1;$i<count($banner);$i++)
@if($banner[$i]->position==4)
<div class="page-head_agile_info_w3l" style="background-image: url(images/banner/{{ $banner[$i]->hinh }});">
	<div class="container">
		<h3>Tin tức <span> </span></h3>
		<!--/w3_short-->
		<div class="services-breadcrumb">
			<div class="agile_inner_breadcrumb">
				<ul class="w3_short">
					<li><a href="{{ route('home') }}">Trang chủ</a><i>|</i></li>
					<li>Tin tức</li>
				</ul>
			</div>
		</div>
		<!--//w3_short-->
	</div>
</div>
@endif
@endfor
<div class="banner_bottom_agile_info">
			<div class="row" style="width: 80%; margin-left: 170px ">
				<div class="col-sm-4">
					<div class="left-sidebar">
						<h2>Danh sách tin</h2>
						<div class="panel-group category-products" id="scroll_box"><!--category-productsr-->
						@foreach($newsType as $new)
							<div class="panel panel-default">
								<div class="panel-heading">
								@if($new->id == $id)
									<h4  class="panel-title"><a style="color: red" href="{{ route('news_By_Id',$new->id) }}">{{ $new->title }}</a></h4>
								@else
									<h4 class="panel-title"><a href="{{ route('news_By_Id',$new->id) }}">{{ $new->title }}</a></h4>
								@endif
								</div>
							</div>
						@endforeach	
						</div><!--/category-products-->
					</div>
				</div>
				<div class="col-sm-8">
				
					<div class="blog-post-area">
						<h2 class="title text-center">Nội dung</h2>
						<div class="single-blog-post">
							<h2><b>{{ $news->title }}</b></h2>
							<div class="post-meta">
								<ul>
									<li><i class="fa fa-user"></i> {{ $news->full_name }}</li>
									<li><i class="fa fa-clock-o"></i> {{ date("H:i:s",strtotime($news->created_at))  }}</li>
									<li><i class="fa fa-calendar"></i>{{ date("d/m/Y",strtotime($news->created_at)) }}</li>
								</ul>
								<span>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star-half-o"></i>
								</span>
							</div>
							{!! $news->content !!}
							<div class="pager-area">
								<ul class="pager pull-right">
									@if($news->id == 1)	
										<li>Đầu</li>
									@else
										<li><a href="{{ route('news_By_Id',$news->id -1) }}">Pre</a></li>
									@endif
									@if($news->id == $newsType[count($newsType)-1]->id)
										<li>Cuối</li>
									@else
										<li><a href="{{ route('news_By_Id',$news->id +1) }}">Next</a></li>
									@endif
								</ul>
							</div>

						</div>
					</div><!--/blog-post-area-->
				

				
					<div class="rating-area">
						<ul class="ratings">
							<li class="rate-this">Rate this item:</li>
							<li>
								<i class="fa fa-star color"></i>
								<i class="fa fa-star color"></i>
								<i class="fa fa-star color"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
							</li>
							<li class="color">(6 votes)</li>
						</ul>
						<ul class="tag">
							<li>TAG:</li>
							<li><a class="color" href="">Pink <span>/</span></a></li>
							<li><a class="color" href="">T-Shirt <span>/</span></a></li>
							<li><a class="color" href="">Girls</a></li>
						</ul>
					</div><!--/rating-area-->

					<div class="socials-share">
						
					</div><!--/socials-share-->

					<div class="media commnets">
						<div style="width: 100%" class="fb-comments" data-href="http://localhost/webson/public/" data-numposts="5"></div>
					</div><!--Comments-->
				</div>	
			</div>
	</div>
@endsection