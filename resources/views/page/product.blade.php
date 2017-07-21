@extends('master')
@section('content')
@for($i=1;$i<count($banner);$i++)
	@if($banner[$i]->position==4)
		<div class="page-head_agile_info_w3l" style="background-image: url(images/banner/{{ $banner[$i]->hinh }});">
			<div class="container">
				@if($typepro==0)
				@foreach($typeParent as $typeCha)
				@if($typeCha->id==$id)
				<h3>{{ $typeCha->name }}</h3>
				<div class="services-breadcrumb">
					<div class="agile_inner_breadcrumb">
						<ul class="w3_short">
							<li><a href="{{ route('home') }}">Trang chủ</a><i>|</i></li>
							<li>{{ $typeCha->name }}</li>
						</ul>
					</div>
				</div>
				@endif
				@endforeach
				@else
				@foreach($typeChild as $typeCon)
				@if($typeCon->id==$id)
				<h3>{{ $typeCon->name }}</h3>
				<div class="services-breadcrumb">
					<div class="agile_inner_breadcrumb">
						<ul class="w3_short">
							<li><a href="{{ route('home') }}">Trang chủ</a><i>|</i></li>
							<li>{{ $typeCon->name }}</li>
						</ul>
					</div>
				</div>
				@endif
				@endforeach
				@endif
			</div>
		</div>
	@endif
@endfor
<input type="hidden" id="idLoai" value="{{ $id }}">  <!-- banner-bootom-w3-agileits -->
<div class="banner-bootom-w3-agileits">
	<div class="container">
		<!-- mens -->
		<div class="col-md-4 products-left">
			<div class="filter-price">
				<h3>Filter By <span>Price</span></h3>
				<ul class="dropdown-menu6">
					<li>
						<div id="slider-range"></div>
						<input type="text" id="amount" style="border: 0; color: #ffffff; font-weight: normal;" />
					</li>
				</ul>
			</div>
			{{-- {{ dd($Product) }} --}}
			<div class="css-treeview">
				<h4>Sản Phẩm</h4>
				<ul class="tree-list-pad">
					@foreach($typeParent as $typeCha)
					@if($typeCha->id==$id)
					<li><input type="checkbox" checked="checked" id="item-0" /><label for="item-0" style="color: red;"><i class="fa fa-long-arrow-right" aria-hidden="true"></i>{{ $typeCha->name }}</label>
					@else
					<li><input type="checkbox" checked="checked" id="item-0" /><label for="item-0" ><i class="fa fa-long-arrow-right" aria-hidden="true"></i>{{ $typeCha->name }}</label>
					@endif
					<ul>
						@foreach($typeChild as $typeCon)
						@if($typeCon->type_cha==$typeCha->id)
						@if($typeCon->id==$id)
						<li ><a style="color: red" href="{{ route('productByIdChild',[$typeCon->id,'type=rong']) }}">{{ $typeCon->name }}</a></li>
						@else
						<li><a href="{{ route('productByIdChild',[$typeCon->id,'type=rong']) }}">{{ $typeCon->name }}</a></li>
						@endif
						@endif
						@endforeach
					</ul>
				</li>
				@endforeach
			</ul>
		</div>
		<div class="clearfix"></div>
	</div>
	<div class="col-md-8 products-right">
		<h5>Product <span>Compare(0)</span></h5>
		<div class="sort-grid">
			<div class="sorting">
				<h6>Sort By</h6>
				<select id="country1" onchange="change_country(this.value)" class="frm-field required sect">
					<option value="null">Default</option>
					<option value="null">Name(A - Z)</option>
					<option value="null">Name(Z - A)</option>
					<option value="null">Price(High - Low)</option>
					<option value="null">Price(Low - High)</option>
					<option value="null">Model(A - Z)</option>
					<option value="null">Model(Z - A)</option>
				</select>
				<div class="clearfix"></div>
			</div>
			<div class="sorting">
				<h6>Showing</h6>
				<select id="country2" class="frm-field required sect">
					
					<option id="0" value="0">Nội Thất</option>
					<option id="1" value="1">Ngoại thất</option>
					<option id="2" value="2">Tất Cả</option>
				</select>
				
				<div class="clearfix"></div>
			</div>
			<div class="clearfix"></div>
		</div>
		@if($typepro==0)
		@foreach($typeParent as $typeCha)
		@if($typeCha->id==$id)
		<div class="men-wear-bottom">
			<div class="col-sm-4 men-wear-left">
				<img class="img-responsive" src="images/products/{{ $typeCha->image }}" alt=" " />
			</div>
			<div class="col-sm-8 men-wear-right">
				<h4>{{ $typeCha->name }}</h4>
				<p>{{ $typeCha->description }}</p>
			</div>
			<div class="clearfix"></div>
		</div>
		@endif
		@endforeach
		@else
		@foreach($typeChild as $typeCon)
		@if($typeCon->id==$id)
		<div class="men-wear-bottom">
			<div class="col-sm-4 men-wear-left">
				<img class="img-responsive" src="images/products/{{ $typeCon->image }}" alt=" " />
			</div>
			<div class="col-sm-8 men-wear-right">
				<h4>{{ $typeCon->name }}</h4>
				<p>{{ $typeCon->description }}</p>
			</div>
			<div class="clearfix"></div>
		</div>
		@endif
		@endforeach
		@endif
		<div class="single-pro">
			@if($typepro==0)
			@foreach($Product as $proCha)
			@foreach($proCha as $pro)
			<div class="col-md-4 product-men">
				<div class="men-pro-item simpleCart_shelfItem" style="height: 360px">
					<div class="men-thumb-item">
						<img src=" images/products/{{$pro->image  }}" style="height: 200px" alt="" class="pro-image-front">
						<img src="images/products/{{$pro->image  }}" style="height: 200px" alt="" class="pro-image-back">
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
							{{-- <del>$69.71</del> --}}
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
									<input type="hidden" name="currency_code" value="VN" /> --}}
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
			@endforeach
			@else
			@foreach($Product as $pro)
			<div class="col-md-4 product-men">
				<div class="men-pro-item simpleCart_shelfItem" style="height: 360px">
					<div class="men-thumb-item">
						<img src="images/products/{{$pro->image  }}" style="height: 200px" alt="" class="pro-image-front">
						<img src="images/products/{{$pro->image  }}" style="height: 200px" alt="" class="pro-image-back">
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
							{{-- <del>$69.71</del> --}}
						</div>
						<div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out button2">
							<form action="#" method="post">
								<fieldset>
									<input type="hidden" name="cmd" value="_cart" />
									<input type="hidden" name="add" value="1" />
									<input type="hidden" name="business" value=" " />
									<input type="hidden" name="item_name" value="{{ $pro->name }}" />
									<input type="hidden" name="amount" value="{{ $pro->unit_price }}" />
									{{-- <input type="hidden" name="discount_amount" value="1.00" /> --}}
									{{-- <input type="hidden" name="currency_code" value="VND" /> --}}
									<input type="hidden" name="return" value=" " />
									<input type="hidden" name="cancel_return" value=" " />
									<input type="submit" name="submit" value="Add to cart" class="button" />
								</fieldset>
							</form>
						</div>
						
					</div>
				</div>
			</div>
			@endforeach
			@endif
		</div>
		<div class="clearfix"></div>
	</div>
	<div class="clearfix"></div>
	
	
	
	<div class="clearfix"></div>
</div>
</div>
</div>
<script type="text/javascript">
	$('#country2').change(function(){
		var type=$(this).val();
		// alert(type);
		var id =$('#idLoai').val();
		var route = "{{ route('Show_product',['id','type'=>'loai']) }}";
		route=route.replace('id',id);
		route=route.replace('loai',type);
		window.location.replace(route);
	});
		var type = {{$_GET['type']}};	
	$('#'+type).attr('selected','selected');
	
	
</script>
@endsection