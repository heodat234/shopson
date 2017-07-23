

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
<!-- //font-awesome icons -->
<script src="admin/js/jquery2.0.3.min.js"></script>
<script src="admin/js/modernizr.js"></script>
<script src="admin/js/jquery.cookie.js"></script>
<script src="admin/js/screenfull.js"></script>
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

</body>
</html>
