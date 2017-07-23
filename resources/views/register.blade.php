<div class="modal fade" id="myModal2" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body modal-body-sub_agile">
				<div class="col-md-8 modal_body_left modal_body_left1">
					
					<h3 class="agileinfo_sign">Đăng Ký <span>Ngay</span></h3>
					@if (count($errors) > 0)
					<div class="alert alert-danger">
						<ul>
							@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
					@endif
					<div class="dangkythatbai alert alert-danger" style="display:none;"></div>
					<form  method="post" id="register">
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
							<input type="text" name="phone">
							<label>Phone</label>
							<span></span>
						</div>
						<div class="styled-input">
							<input type="text" name="address">
							<label>Address</label>
							<span></span>
						</div>
						<input type="button" value="Đăng Ký" onclick="register()">
					</form>
					
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
<script type="text/javascript">
	function register(){
		var route=" {{ route('register') }} ";
		var form_data = new FormData($('form#register')[0]);
		// var form =$('form#register').serializeArray();
		// console.log(form);
		$.ajax
		({
			type:'post',
			url:route,
			data:form_data,
			processData: false,
			contentType: false,
			success:function(data) {
				// console.log("1111");
				var name = data.substring(1);
				// console.log(name);
				if(data.substr(0,1)==0){
					$('.modal').modal('hide');
					$('div.register').show(2000);
					$('div.register').html(name);
				}else{
					$('div.dangkythatbai').fadeIn();
					$('div.dangkythatbai').html(name);
				}
			},
			error: function(data)
            {
                var errors = '';
                for(datos in data.responseJSON){
                    errors += data.responseJSON[datos] + '<br>';
                }
                $('div.dangkythatbai').show().html(errors); //this is my div with messages
            }


		});


	}
</script>