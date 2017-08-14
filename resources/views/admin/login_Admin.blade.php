

<!DOCTYPE html>
<head>
<title>Đăng nhập trang quản trị</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Colored Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<link rel="stylesheet" href="admin/css/bootstrap.css">
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="admin/css/style.css" rel='stylesheet' type='text/css' />
<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
<link rel="stylesheet" href="admin/css/font.css" type="text/css"/>
<link href="admin/css/font-awesome.css" rel="stylesheet"> 
<!-- //font-awesome icons -->
</head>
<body class="signup-body">
		<div class="agile-signup">	
			@if(Session::has('thanhcong'))
		            <div class="alert alert-success" align="center">{{Session::get('thanhcong')}}</div>
		        @endif 
			<div class="content2">
				<div class="grids-heading gallery-heading signup-heading">
					<h2>Đăng Nhập Trang Quản Trị</h2>
				</div>
				@if(Session::has('thatbai'))
		            <div class="alert alert-danger">{{Session::get('thatbai')}}</div>
		        @endif  
				<form action="{{route('PostLogin_Admin')}}" method="post">
					<input type="hidden" name="_token" value="{{csrf_token()}}">
					<input type="email" name="email" placeholder="abc@gmail.com" required autofocus>
					<input type="password" name="password" placeholder="password" required autofocus>
					<input type="submit" class="register" value="Đăng nhập">
				</form>
				<div class="signin-text">
					<div class="text-left">
						<p><a href="{{ route('ForgetPassword') }}"> Quên mật khẩu? </a></p>
					</div>
					
					<div class="clearfix"> </div>
				</div>
				
				<a href="{{ route('home') }}">Về Trang chủ</a>
			</div>
			
			<!-- footer -->
			<div class="copyright">
				<p> Design by <a href="http://w3layouts.com/">Thanh Hưng</a></p>
			</div>
			<!-- //footer -->
			
		</div>
	<script src="admin/js/proton.js"></script>
</body>
</html>
