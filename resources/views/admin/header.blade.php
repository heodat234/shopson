<nav class="user-menu">
	<a href="javascript:;" class="main-menu-access">
		<i class="icon-proton-logo"></i>
		<i class="icon-reorder"></i>
	</a>
</nav>
<section class="title-bar">
	<div class="logo" style="width: 500px">
		<h1><a href="{{ route('ViewContentAdmin') }}"><img src="images/logo.jpg" style="width: 90px" alt="" />Vila Paint</a></h1>
	</div>
	<div class="full-screen">
		<section class="full-top">
			<button id="toggle"><i class="fa fa-arrows-alt" aria-hidden="true"></i></button>
		</section>
	</div>
	{{-- <div class="w3l_search">
		<form action="#" method="post">
			<input type="text" name="search" value="Search" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search';}" required="">
			<button class="btn btn-default" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
		</form>
	</div> --}}
	<div class="header-right">
		<div class="profile_details_left">
			<div class="header-right-left">
				<!--notifications of menu start -->
				<ul class="nofitications-dropdown">
					
					<li class="dropdown head-dpdn">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-bell"></i><span class="badge blue numberBill">{{ $count_bill }}</span></a>
						<ul class="dropdown-menu anti-dropdown-menu agile-notification">
							<li>
								<div class="notification_header">
									<h3>Bạn có {{ $count_bill }} hóa đơn mới</h3>
								</div>
							</li>
							<script type="text/javascript">
			                    $(document).ready(function(){
			                        var route="{{route('Count_Bill')}}";
			                        setInterval(function(){
			                            $.ajax({
			                            url:route,
			                            type:'get',
			                            data:{
			                            },
			                            success:function(data) {  
			                                if(data!=0){
			                                    $('.numberBill').html(data);
			                                    $('.notification_header').html('<h3>Bạn có '+data+' hóa đơn mới. <a href={{ route('ViewPageBill_Admin') }}"><button>Xem</button>')
			                                }
			                                else{
			                                    $('.numberBill').hide();
			                                    $('.notification_header').html('Bạn không có hóa đơn mới');
			                                }
			                               
			                            }
			                        });
			                        },10000);
			                    });
                			</script>
						</ul>
					</li>
					
					<div class="clearfix"> </div>
				</ul>
			</div>
			<div class="profile_details">
				<ul>
					@if(Auth::check())
					<li class="dropdown profile_details_drop">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
							Chào {{Auth::User()->full_name}}
						</a>
						<ul class="dropdown-menu drp-mnu">
							<li> <a href="{{ route('profileAdmin') }}"><i class="fa fa-user"></i> Trang cá nhân</a> </li>
							<li> <a href="{{route('logout_Admin')}}"><i class="fa fa-sign-out"></i> Đăng xuất</a> </li>
						</ul>
					</li>
					@endif
				</ul>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
	<div class="clearfix"> </div>
	<div class="alert alert-success register" style="display: none;"></div>
</section>