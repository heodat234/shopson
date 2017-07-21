<div class="modal fade" id="myModal2" tabindex="-1" role="dialog">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
						<div class="modal-body modal-body-sub_agile">
						<div class="col-md-8 modal_body_left modal_body_left1">
						@if(Session::has('thongbao'))
						<div class="alert alert-success">{{Session::get('thongbao')}}</div>
						@endif
						@if(Session::has('thanhcong'))
						<div class="alert alert-success">{{Session::get('thanhcong')}}</div>
						@endif
						<h3 class="agileinfo_sign">Đăng Ký <span>Ngay</span></h3>
						 <form action="{{route('register')}}" method="post">
						 	<input type="hidden" name="_token" value="{{csrf_token()}}">
							<div class="styled-input agile-styled-input-top">
								<input type="text" name="full_name" required="">
								<label>Name</label>
								<span></span>
							</div>
							<div class="styled-input">
								<input type="email" name="email" required=""> 
								<label>Email</label>
								<span></span>
							</div> 
							<div class="styled-input">
								<input type="password" name="password" required=""> 
								<label>Password</label>
								<span></span>
							</div> 
							<div class="styled-input">
								<input type="password" name="re_password" required=""> 
								<label>Confirm Password</label>
								<span></span>
							</div>
							<div class="styled-input">
								<input type="text" name="phone" required=""> 
								<label>Phone</label>
								<span></span>
							</div>
							<div class="styled-input">
								<input type="text" name="address" required=""> 
								<label>Address</label>
								<span></span>
							</div> 
							<input type="submit" value="Đăng Ký">
						</form>
						  <ul class="social-nav model-3d-0 footer-social w3_agile_social top_agile_third">
															<li><a href="#" class="facebook">
																  <div class="front"><i class="fa fa-facebook" aria-hidden="true"></i></div>
																  <div class="back"><i class="fa fa-facebook" aria-hidden="true"></i></div></a></li>
															<li><a href="#" class="google"> 
																  <div class="front"><i class="fa fa-google" aria-hidden="true"></i></div>
																  <div class="back"><i class="fa fa-google" aria-hidden="true"></i></div></a></li>
														</ul>
														<div class="clearfix"></div>
														<p><a href="#">Bằng cách nhấp vào đăng ký, tôi đồng ý với các điều khoản của bạn</a></p>

						</div>
						<div class="col-md-4 modal_body_right modal_body_right1">
							<img src="images/products/jotun_2.jpg" alt=" "/>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
				<!-- //Modal content-->
			</div>
		</div>
