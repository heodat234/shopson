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
					<div class="loginthatbai alert alert-danger" style="display:none;"></div>
					
					<form id="login" method="post">
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
						<input type="button" value="Đăng Nhập" onclick="login();">
					</form>
					<p><a href="{{ route('ForgetPassword') }}"> Quên mật khẩu? </a></p>

					<div class="footer-icons">
					<ul>
						<li><a href="{{route('provider_login','facebook')}}" class="twitter facebook"><i class="fa fa-facebook"></i></a></li>
						<li><a href="{{route('provider_login','google')}}" class="twitter chrome"><i class="fa fa-google-plus"></i></a></li>
					</ul>
					</div>
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
		<script type="text/javascript">
			function login(){
				var route=" {{ route('login') }} ";
                var form_data = new FormData($('form#login')[0]);
                $.ajax
                ({
                    type:'post',
                    url:route,
                    data:form_data,
                    processData: false,
                    contentType: false,
                    success:function(data) {
                    	var name = data.substring(1);
                    	if(data.substr(0,1)==0){
	                        $('.modal').modal('hide');
	                    	$('li#dangnhap').html("<a href='{{-- {{route('myPage')}} --}}'><i class='fa fa-user'></i>Chào bạn "+ name+"</a>");
	                    	$('li#dangky').html("<a href='{{route('logout')}}'><i class='fa fa-sign-out'></i>Đăng xuất</a>");
	                    		
                  		}else{
                  			$('div.loginthatbai').fadeIn(); 
	                            $('div.loginthatbai').html(name);
                  		}
                    },
                  		
                    
                });
                
                
			}
		</script>