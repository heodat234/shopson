
 @if(Auth::check())
    @if(Auth::User()->group !=0)
<!DOCTYPE html>
<head>
<title>Colored  an Admin Panel Category Flat Bootstrap Responsive Website Template | Home :: w3layouts</title>
<base href="{{ asset('') }}">
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
<link href="admin/css/table-style.css" rel='stylesheet' type='text/css' />
<link rel="stylesheet" type="text/css" href="admin/css/dialog.css">
<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
<link rel="stylesheet" href="admin/css/font.css" type="text/css"/>
<link href="admin/css/font-awesome.css" rel="stylesheet"> 
 <link rel="stylesheet" href="admin/ssi-modal/styles/ssi-modal.css"/> 
<!-- //font-awesome icons -->
<script src="admin/js/jquery2.0.3.min.js"></script>
<script src="admin/js/modernizr.js"></script>
<script src="admin/js/jquery.cookie.js"></script>
<script src="admin/js/screenfull.js"></script>
{{-- ssi-modal --}}
<script src="admin/ssi-modal/js/ssi-modal.min.js"></script>
<script src="ckeditor/ckeditor.js"></script>
<script src="ckeditor/ckfinder/ckfinder.js"></script>
		<script>
		$(function () {
			$('#supported').text('Supported/allowed: ' + !!screenfull.enabled);

			if (!screenfull.enabled) {
				return false;
			}

			

			$('#toggle').click(function () {
				screenfull.toggle($('#container')[0]);
			});	
		});
		</script>
<!-- charts -->
<script src="admin/js/raphael-min.js"></script>
<script src="admin/js/morris.js"></script>
<link rel="stylesheet" href="admin/css/morris.css">
<!-- //charts -->
<!--skycons-icons-->
<script src="admin/js/skycons.js"></script>
<!--//skycons-icons-->
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
<script type="text/javascript" src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
</head>
<body class="dashboard-page">
	<script>
	        var theme = $.cookie('protonTheme') || 'default';
	        $('body').removeClass (function (index, css) {
	            return (css.match (/\btheme-\S+/g) || []).join(' ');
	        });
	        if (theme !== 'default') $('body').addClass(theme);
        </script>
	@include('admin.menu')
	<section class="wrapper scrollable">
		@include('admin.header')
		
		@yield('admin.Content')
		<!-- footer -->
		<div class="footer">
			<p>© 2017. Design by <a href="http://w3layouts.com/">Thanh Hưng</a></p>
		</div>
		<!-- //footer -->
	</section>
	<script src="admin/js/bootstrap.js"></script>
	<script src="admin/js/proton.js"></script>
	<script src="admin/js/validator.min.js"></script>
	<script type="text/javascript">
	// $('.alert').hide(10000);
	</script>
	<script type="text/javascript">
	$("input[type=password]").keyup(function(){
    var ucase = new RegExp("[A-Z]+");
	var lcase = new RegExp("[a-z]+");
	var num = new RegExp("[0-9]+");
	
	if($("#password1").val().length >= 8){
		$("#8char").removeClass("glyphicon-remove");
		$("#8char").addClass("glyphicon-ok");
		$("#8char").css("color","#00A41E");
	}else{
		$("#8char").removeClass("glyphicon-ok");
		$("#8char").addClass("glyphicon-remove");
		$("#8char").css("color","#FF0004");
	}
	
	if(ucase.test($("#password1").val())){
		$("#ucase").removeClass("glyphicon-remove");
		$("#ucase").addClass("glyphicon-ok");
		$("#ucase").css("color","#00A41E");
	}else{
		$("#ucase").removeClass("glyphicon-ok");
		$("#ucase").addClass("glyphicon-remove");
		$("#ucase").css("color","#FF0004");
	}
	
	if(lcase.test($("#password1").val())){
		$("#lcase").removeClass("glyphicon-remove");
		$("#lcase").addClass("glyphicon-ok");
		$("#lcase").css("color","#00A41E");
	}else{
		$("#lcase").removeClass("glyphicon-ok");
		$("#lcase").addClass("glyphicon-remove");
		$("#lcase").css("color","#FF0004");
	}
	
	if(num.test($("#password1").val())){
		$("#num").removeClass("glyphicon-remove");
		$("#num").addClass("glyphicon-ok");
		$("#num").css("color","#00A41E");
	}else{
		$("#num").removeClass("glyphicon-ok");
		$("#num").addClass("glyphicon-remove");
		$("#num").css("color","#FF0004");
	}
	
	if($("#password1").val() == $("#password2").val()){
		$("#pwmatch").removeClass("glyphicon-remove");
		$("#pwmatch").addClass("glyphicon-ok");
		$("#pwmatch").css("color","#00A41E");
	}else{
		$("#pwmatch").removeClass("glyphicon-ok");
		$("#pwmatch").addClass("glyphicon-remove");
		$("#pwmatch").css("color","#FF0004");
	}
});
</script>
</body>
</html>
	@else
         <script type="text/javascript">
        window.location.href = "{{route('Login_Admin')}}";
        </script>
    @endif

@else
         {{--  @if(Auth::User()->group=1) --}}
    <script type="text/javascript">
        window.location.href = "{{route('Login_Admin')}}";
    </script>
{{--     @endif --}}
@endif