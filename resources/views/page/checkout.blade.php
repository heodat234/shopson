@extends('master')
@section('content')
@for($i=1;$i<count($banner);$i++)
@if($banner[$i]->position==4)
<div class="page-head_agile_info_w3l"  style="background-image: url(images/banner/{{ $banner[$i]->hinh }});">
	<div class="container">
		<h3>Trang<span> thanh toán </span></h3>
		<div class="services-breadcrumb">
			<div class="agile_inner_breadcrumb">
				<ul class="w3_short">
					<li><a href="index.html">Trang chủ</a><i>|</i></li>
					<li>Thanh toán</li>
				</ul>
			</div>
		</div>
	</div>
</div>
@endif
@endfor
<!-- checkout -->
    <div class='row' style='padding-top:25px; padding-bottom:25px;'>
        <div class='col-md-12'>
            <div id='mainContentWrapper'>
                <div class="col-md-8 col-md-offset-2">
                    <h2 style="text-align: center;">
                        Xem lại đặt hàng & Thanh toán
                    </h2>
                    <hr/>
                    <a href="{{ route('home') }}" class="btn btn-info" style="width: 100%;">Mua thêm sản phẩm</a>
                    <hr/>
                    <div class="shopping_cart">
                        <form class="form-horizontal" role="form" action="{{ route('postCheckOut') }}" method="post" id="payment-form">
                        	 <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="panel-group" id="accordion">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Đặt hàng của bạn</a>
                                        </h4>
                                    </div>
                                    <div id="collapseOne" class="panel-collapse collapse in">
                                        <div class="panel-body">
                                            <div class="items" id='shopping_cart_output'>
                                                <div class="col-md-9">
                                                    <table class="table table-striped">
                                                    @foreach($items as $item)
                                                        <tr>
                                                            <td colspan="3">
                                                                <b>{{$item['item']->name}}</b>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <ul>
                                                                    <li>Mã màu: #{{ $item['color'] }}</li>
                                                                    <li>Size: Thùng {{ $item['size'] }} </li>
                                                                    <li>Số lượng: {{$item['qty']}}</li>
                                                                </ul>
                                                            </td>
                                                            <td>
                                                            	<img class='img-responsive item_disp_image' style='width:50px; height: 60px; float:left;' src="images/products/{{$item['item']->image}}">
                                                            </td>
                                                            <td>
                                                                <b>{{number_format($item['price'])}} VNĐ</b>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </table>
                                                </div>
                                                <div class="col-md-3">
                                                    <div style="text-align: center;">
                                                        <h3>Tổng tiền</h3>
                                                        <h3><span style="color:green;">{{number_format($totalPrice)}} VNĐ</span></h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <div style="text-align: center; width:100%;"><a style="width:100%;"
                                                                                        data-toggle="collapse"
                                                                                        data-parent="#accordion"
                                                                                        href="#collapseTwo"
                                                                                        class=" btn btn-success"
                                                                                        onclick="$(this).fadeOut(); $('#payInfo').fadeIn();">Tiếp tục đến thông tin thanh toán»</a></div>
                                    </h4>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">Liên hệ và thông tin thanh toán</a>
                                    </h4>
                                </div>
                                <div id="collapseTwo" class="panel-collapse collapse">
                                    <div class="panel-body">
                                    	@if(!Auth::check())
	                                        <b><a href="#" data-toggle="modal" data-target="#myModal">Đăng nhập</a> tài khoản (nếu có) Hoặc điền thông tin liên hệ vào form bên dưới</b>
	                                        <br/><br/>
                                        @endif
                                        <table class="table table-striped" style="font-weight: bold;">
                                        	                                        @if(Auth::check())
	                                            <tr>
	                                                <td style="width: 175px;">
	                                                    <label for="id_email">Email:</label></td>
	                                                <td>
	                                                
	                                                    <input class="form-control" id="id_email" name="email"
	                                                           required="required" type="email" value="{{Auth::User()->email}}" />
	                                                           <span id="loi"></span>
	                                                </td>
	                                            </tr>
	                                            <tr>
	                                                <td style="width: 175px;">
	                                                    <label for="id_first_name">Tên:</label></td>
	                                                <td>
	                                                    <input class="form-control" id="id_name" name="name"
	                                                           required="required" type="text" value="{{Auth::User()->full_name}}" />
	                                                </td>
	                                            </tr>
	                                            
	                                            <tr>
	                                                <td style="width: 175px;">
	                                                    <label for="id_address_line_1">Địa chỉ giao hàng:</label></td>
	                                                <td>
	                                                    <input class="form-control" id="id_address"
	                                                           name="address" required="required" type="text" value="{{Auth::User()->address}}" />
	                                                </td>
	                                            </tr>
	                                            
	                                            <tr>
	                                                <td style="width: 175px;">
	                                                    <label for="id_phone">Số điện thoại:</label></td>
	                                                <td>
	                                                    <input class="form-control" id="id_phone" name="phone" type="number" value="{{Auth::User()->phone}}" />
	                                                </td>
	                                            </tr>
	                                            @else
													<tr>
	                                                	<td style="width: 175px;">
	                                                    <label for="id_email">Email:</label></td>
		                                                <td>
		                                                
		                                                    <input class="form-control" id="id_email" name="email"
		                                                           required="required" type="email"  />
		                                                           <span id="loi"></span>
		                                                </td>
	                                            	</tr>
		                                            <tr>
		                                                <td style="width: 175px;">
		                                                    <label for="id_first_name">Tên:</label></td>
		                                                <td>
		                                                    <input class="form-control" id="id_name" name="name"
		                                                           required="required" type="text"  />
		                                                </td>
		                                            </tr>
		                                            
		                                            <tr>
		                                                <td style="width: 175px;">
		                                                    <label for="id_address_line_1">Địa chỉ giao hàng:</label></td>
		                                                <td>
		                                                    <input class="form-control" id="id_address"
		                                                           name="address" required="required" type="text"  />
		                                                </td>
		                                            </tr>
		                                            
		                                            <tr>
		                                                <td style="width: 175px;">
		                                                    <label for="id_phone">Số điện thoại:</label></td>
		                                                <td>
		                                                    <input class="form-control" id="id_phone"  name="phone" type="number"  />
		                                                </td>
		                                            </tr>
	                                            @endif
	                                         
                                            <tr>
                                                <td style="width: 175px;">
                                                    <label for="id_phone">Phương thức thanh toán:</label></td>
                                                <td>
                                                    <select id="id_payment" name="payment" onchange="myFunction()">
                                                    	<option value="1">Thanh toán trực tuyến
														<option value="0">Thanh toán khi nhận hàng
														
													</select>
                                                </td>
                                            </tr>

                                        </table>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <div style="text-align: center;"><a data-toggle="collapse"
                                                                            data-parent="#accordion"
                                                                            href="#collapseThree"
                                                                            class=" btn   btn-success" id="payInfo"
                                                                            style="width:100%;display: none;"                  onclick="$(this).fadeOut();  
                   					document.getElementById('collapseThree').scrollIntoView()">Thanh toán đơn hàng»</a>
                                        </div>
                                    </h4>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                            <b>Cổng thanh toán</b>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseThree" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <span class='payment-errors'></span>
                                        <div id="content">
                                        <fieldset>
                                            <legend>Phương thức bạn muốn thanh toán hôm nay là?</legend>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label" for="card-holder-name">Name on
                                                    Card</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" stripe-data="name"
                                                           id="name-on-card" placeholder="Card Holder's Name">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label" for="card-number">Card
                                                    Number</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" stripe-data="number"
                                                           id="card-number" placeholder="Debit/Credit Card Number">
                                                    <br/>
                                                    <div><img class="pull-right"
                                                              src="https://s3.amazonaws.com/hiresnetwork/imgs/cc.png"
                                                              style="max-width: 250px; padding-bottom: 20px;">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label" for="expiry-month">Expiration
                                                        Date</label>
                                                    <div class="col-sm-9">
                                                        <div class="row">
                                                            <div class="col-xs-3">
                                                                <select class="form-control col-sm-2"
                                                                        data-stripe="exp-month" id="card-exp-month"
                                                                        style="margin-left:5px;">
                                                                    <option>Month</option>
                                                                    <option value="01">Jan (01)</option>
                                                                    <option value="02">Feb (02)</option>
                                                                    <option value="03">Mar (03)</option>
                                                                    <option value="04">Apr (04)</option>
                                                                    <option value="05">May (05)</option>
                                                                    <option value="06">June (06)</option>
                                                                    <option value="07">July (07)</option>
                                                                    <option value="08">Aug (08)</option>
                                                                    <option value="09">Sep (09)</option>
                                                                    <option value="10">Oct (10)</option>
                                                                    <option value="11">Nov (11)</option>
                                                                    <option value="12">Dec (12)</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-xs-3">
                                                                <select class="form-control" data-stripe="exp-year"
                                                                        id="card-exp-year">
                                                                    <option value="2016">2016</option>
                                                                    <option value="2017">2017</option>
                                                                    <option value="2018">2018</option>
                                                                    <option value="2019">2019</option>
                                                                    <option value="2020">2020</option>
                                                                    <option value="2021">2021</option>
                                                                    <option value="2022">2022</option>
                                                                    <option value="2023">2023</option>
                                                                    <option value="2024">2024</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label" for="cvv">Card CVC</label>
                                                    <div class="col-sm-3">
                                                        <input type="text" class="form-control" stripe-data="cvc"
                                                               id="card-cvc" placeholder="Security Code">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-offset-3 col-sm-9">
                                                    </div>
                                                </div>
                                        </fieldset>
                                        </div>
                                        <button type="submit" class="btn btn-success btn-lg" style="width:100%;">Đặt hàng
                                        </button>
                                        <br/>
                                        <div style="text-align: left;"><br/>
                                        	Bằng cách gửi lệnh này, bạn đồng ý với <a href="/legal/billing/"> quy định
                                            hợp đồng thanh toán </a> và <a href="/legal/terms/"> điều khoản dịch vụ </a>.
                                            Nếu bạn có thắc mắc về sản phẩm hoặc dịch vụ của chúng tôi, vui lòng liên hệ với chúng tôi trước khi đặt đơn hàng này.
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    

<script type="text/javascript">
	// $("#loi").hide();
	$("#id_email").keyup(function (event) { 
	
		   var Email = $(this).val();
		   var route = "{{ route('checkEmail') }}";
		   $.ajax({
		   	url: route,
		   	type: 'get',
		   	data: {email: Email},
		   	success:function(data) {
		   		
		   		$("#loi").html(data);
		   	}
		   });
	  		$("#loi").html('');
});
	function myFunction() {
		var x = $('#id_payment').val();
		if(x==0){
			$('#content').html("Cảm ơn quý khách đã đặt hàng. Chúng tôi sẽ liên hệ với bạn để xác nhận đơn hàng và giao hàng trong thời gian sớm nhất. <br>");
		}
	}
	
</script>
<!-- //checkout -->
@endsection