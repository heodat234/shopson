<!-- //banner -->
<div class="banner_bottom_agile_info">
	<div class="container">
		<div class="banner_bottom_agile_info_inner_w3ls">
			@for($i=1;$i<count($banner);$i++)
			@if($banner[$i]->position==1)
			<div class="col-md-6 wthree_banner_bottom_grid_three_left1 grid">
				<figure class="effect-roxy">
					<img src="images/banner/{{ $banner[$i]->hinh }}" style="height: 250px" alt=" " class="img-responsive" />
					<figcaption>
					<h3><span>F</span>all Ahead</h3>
					<p>Mới về</p>
					</figcaption>
				</figure>
			</div>
			@endif
			@endfor
			<div class="clearfix"></div>
		</div>
	</div>
</div>

<!--/grids-->
<div class="agile_last_double_sectionw3ls">
	@for($i=1;$i<count($banner);$i++)
		@if($banner[$i]->position==2)
			<div class="col-md-6 multi-gd-img multi-gd-text ">
				<a href="womens.html"><img src="images/banner/{{ $banner[$i]->hinh }}" style="height: 400px" alt=" "><h4>Flat <span>50%</span> offer</h4></a>
				
			</div>
		@endif
	@endfor
	<div class="clearfix"></div>
</div>
<!--/grids-->