<nav class="main-menu">
		<ul>
			<li>
				<a href="{{ route('ViewContentAdmin') }}">
					<i class="fa fa-home nav_icon"></i>
					<span class="nav-text">
					Trang chủ 
					</span>
				</a>
			</li>
			<li class="has-subnav">
				<a href="{{ route('ViewProductAdmin') }}">
					<i class="fa fa-list-ul" aria-hidden="true"></i>
					<span class="nav-text">Sản phẩm</span>
					<i class="icon-angle-right"></i><i class="icon-angle-down"></i>
				</a>
				<ul>
					@foreach($typeChild as $child)
						<li>
							<a class="subnav-text" href="{{ route('ViewProductAdmin_ByType',[$child->id,$child->name]) }}">
								{{ $child->name }}
							</a>
						</li>
					@endforeach
				</ul>
			</li>
			<li class="has-subnav">
				<a href="{{ route('View_Category') }}">
					<i class="fa fa-check-square-o nav_icon"></i>
					<span class="nav-text">Danh mục</span>
					<i class="icon-angle-right"></i><i class="icon-angle-down"></i>
				</a>
				<ul>
					@foreach($typeParent as $typeCha)
						<li>
							<a class="subnav-text" href="{{ route('View_Category_By_Parent',[$typeCha->id]) }}">{{ $typeCha->name }}</a>
						
						</li>
					@endforeach
				</ul>
			</li>
			@if(Auth::User()->group >=2)
			<li class="has-subnav">
				<a href="{{ route('user_Admin') }}">
					<i class="fa fa-user"></i>
					<span class="nav-text">Thành viên</span>
				</a>
			</li>
			@endif
			<li>
				<a href="{{ route('ViewPageBill_Admin') }}">
					<i class="fa fa-file-text-o"></i>
					<span class="nav-text">
					Hóa đơn
					</span>
				</a>
			</li>
			<li>
				<a href="{{ route('View_Kho') }}">
					<i class="icon-table nav-icon"></i>
					<span class="nav-text">
					Kho
					</span>
				</a>
			</li>
			<li>
				<a href="{{ route('news_Admin') }}">
					<i class="fa fa-file-o" aria-hidden="true"></i>
					<span class="nav-text">
					Tin tức
					</span>
				</a>
			</li>
			<li>
				<a href="{{ route('View_Export') }}">
					<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
					<span class="nav-text">
					Hàng lỗi
					</span>
				</a>
			</li>
		</ul>
		<ul class="logout">
			<li>
			<a href="{{route('logout_Admin')}}">
			<i class="icon-off nav-icon"></i>
			<span class="nav-text">
			Đăng xuất
			</span>
			</a>
			</li>
		</ul>
	</nav>