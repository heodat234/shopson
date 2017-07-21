<div class="modal fade" id="myModal" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body modal-body-sub_agile">
				<div class="col-md-8 modal_body_left modal_body_left1">
					<h3 class="agileinfo_sign">Đăng Nhập <span>Ngay</span></h3>
					@if(Session::has('thatbai'))
					<div class="alert alert-danger">{{Session::get('thatbai')}}</div>
					@endif
					<form action="{{route('login')}}" method="post">
						<input type="hidden" name="_token" value="{{csrf_token()}}">
						<div class="styled-input agile-styled-input-top">
							<input type="email" name="email" required="">
							<label>Email</label>
							<span></span>
						</div>
						<div class="styled-input">
							<input type="password" name="password" required="">
							<label>Password</label>
							<span></span>
						</div>
						<input type="submit" value="Đăng Nhập">
					</form>
					<ul class="social-nav model-3d-0 footer-social w3_agile_social top_agile_third">
						<li><a href="{{route('provider_login','facebook')}}" class="facebook">
							<div class="front"><i class="fa fa-facebook" aria-hidden="true"></i></div>
							<div class="back"><i class="fa fa-facebook" aria-hidden="true"></i></div></a></li>
							<li><a href="{{route('provider_login','google')}}" class="google">
								<div class="front"><i class="fa fa-google" aria-hidden="true"></i></div>
								<div class="back"><i class="fa fa-google" aria-hidden="true"></i></div></a></li>
									</ul>
									<div class="clearfix"></div>
									<p><a href="#" data-toggle="modal" data-target="#myModal2" > Bạn chưa có tài khoản?</a></p>
								</div>
								<div class="col-md-4 modal_body_right modal_body_right1">
									<img src="images/products/jotun_1.jpg" alt=" "/>
								</div>
								<div class="clearfix"></div>
							</div>
						</div>
						<!-- //Modal content-->
					</div>
				</div>