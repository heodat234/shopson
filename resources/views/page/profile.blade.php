@extends('master')
@section('content')
@for($i=1;$i<count($banner);$i++)
  @if($banner[$i]->position==4)
    <div class="page-head_agile_info_w3l" style="background-image: url(images/banner/{{ $banner[$i]->hinh }});">
      <div class="container">
        <h3>Thông tin <span>khách hàng </span></h3>
        <!--/w3_short-->
        <div class="services-breadcrumb">
          <div class="agile_inner_breadcrumb">
            <ul class="w3_short">
              <li><a href="{{ route('home') }}">Trang chủ</a><i>|</i></li>
              <li>Thông tin khách hàng</li>
            </ul>
          </div>
        </div>
        <!--//w3_short-->
      </div>
    </div>
  @endif
@endfor

<div class="container">
      <div class="row">
      
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
        @if(Session::has('thatbai'))
          <div class="alert alert-danger">{{Session::get('thatbai')}}</div>
        @endif
        @if(Session::has('thanhcong'))
          <div class="alert alert-success">{{Session::get('thanhcong')}}</div>
        @endif
   
          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title">Thông tin</h3>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="http://babyinfoforyou.com/wp-content/uploads/2014/10/avatar-300x300.png" class="img-circle img-responsive"> </div>
                
                
                <div class=" col-md-9 col-lg-9 "> 
                  <table class=" table-user-information">
                    <tbody>
                      <tr>
                        <td>Tên:</td>
                        <td id="name">{{Auth::User()->full_name}}</td>
                      </tr>
                      <tr>
                        <td>Email:</td>
                        <td><a href="{{Auth::User()->email}}">{{Auth::User()->email}}</a></td>
                      </tr>
                      <tr>
                        <td>Chức vụ:</td>
                        @if(Auth::User()->group>=1)
                        <td>Admin</td>
                        @else
                          <td>Khách</td>
                        @endif
                      </tr>
                      <tr>
                        <td>Số điện thoại:</td>
                        <td id="phone">{{Auth::User()->phone}}</td>
                      </tr>
                      <tr>
                        <td>Địa chỉ:</td>
                        <td id="address">{{Auth::User()->address}}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
              <div class="panel-footer">
                <a href="#" data-toggle="modal" data-target="#editProfile" data-original-title="Sửa thông tin" data-toggle="tooltip" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-edit"></i> Sửa thông tin</a>
                <a href="#" data-toggle="modal" data-target="#changePassword" data-original-title="Đổi mật khẩu" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-lock"></i> Đổi mật khẩu</a>
              </div>
            
          </div>
        </div>
      </div>
      <h3>Các sản phẩm đã mua:</h3>
      <br>
      @if($id_bill==0)
      <table class="table table_bordered table_striped table-nonfluid" align="center" id="Mytable">
              <thead>
                <th>Mã hóa đơn</th>
                <th>Tình trạng</th>
                <th>Thanh toán</th>
                <th>Ngày mua</th>
                <th>Chi tiết</th>
              </thead>
              <tbody>
              @foreach($bills as $bill)
                <tr>
                  <td>{{ $bill->id }}</td>
                  <td>
                      @if($bill->method ==0)
                          Chưa xác nhận
                      @elseif($bill->method ==1) Đã xác nhận, chưa thanh toán
                      @else Đã thanh toán
                      @endif
                  </td>
                  <td>
                      @if($bill->payment ==0)
                          Thanh toán khi nhận hàng
                      @else Thanh toán trực tuyến
                      @endif
                  </td>
                  <td>{{ date("d/m/Y - H:i:sa",strtotime($bill->created_at)) }}</td>
                  <td><a href="{{route('ViewBill_Detail',$bill->id)}}"><button class="btn btn-success btn-lg glyphicon glyphicon-hand-right" style="border-radius: 10px;"></button></a></td>
                </tr>
              @endforeach
              </tbody>
            </table>
        @else
          <table class="table table_bordered table_striped table-nonfluid" align="center" id="Mytable">
              <thead>
                <th>Mã hóa đơn</th>
                <th>Tên sản phẩm</th>
                <th>Số lượng</th>
                <th>Loại</th>
                <th>Màu</th>
                <th>Giá mua</th>
                <th>Tổng</th>
              </thead>
              <tbody>
              <div style="display: none;">{{ $totalPrice=0 }}</div>
              @foreach($bill_details as $bill)
                <tr>
                  <td>{{ $bill->id_bill }}</td>
                  <td>{{ $bill->namePro }}</td>
                  <td>{{ $bill->quantity }}</td>
                  <td>{{ $bill->size }}</td>
                  <td>{{ $bill->color }}</td>
                  <td>{{ number_format($bill->sales_price) }}</td>
                  <td>{{ number_format($bill->sales_price*$bill->quantity) }}</td>
                  <div style="display: none;">{{$totalPrice += $bill->sales_price*$bill->quantity  }} </div>
                </tr>
              @endforeach
              <tr>
                <td colspan="7"> <b><h3>Tổng tiền: {{ number_format($totalPrice) }} VNĐ </h3></b></td>
              </tr>
              </tbody>
            </table>
        @endif
    </div>

    {{-- edit profile --}}

    <div class="modal fade" id="editProfile" tabindex="-1" role="dialog">
      <div class="modal-dialog">
    <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body modal-body-sub_agile">
        <div class="col-md-8 modal_body_left modal_body_left1">
          
          <h3 class="agileinfo_sign">Sửa <span>Thông tin</span></h3>
          @if (count($errors) > 0)
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
          @endif
          <form  method="post" id="editProfile" action="{{ route('editProfile') }}">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <input type="hidden" name="id" value="{{Auth::User()->id}}">
            <div class="styled-input agile-styled-input-top">
              <input type="text" name="name" id="editName" value="{{Auth::User()->full_name}}" required="">
              <label>Tên</label>
              <span></span>
            </div>
            <div class="styled-input">
              <input type="text" name="phone" pattern="[0-9]*" minlength="10" maxlength="11" title="số điện thoại chỉ được là số và 10 hoặc 11 số " id="editPhone" value="{{Auth::User()->phone}}">
              <label>Số điện thoại</label>
              <span></span>
            </div>
            <div class="styled-input">
              <input type="text" name="address" id="editAddress" value="{{Auth::User()->address}}">
              <label>Địa chỉ</label>
              <span></span>
            </div>
            <input type="submit" class="col-xs-12 btn btn-primary btn-load btn-lg" data-loading-text="Changing Password..." value="Lưu" >
          </form>
          
          <div class="clearfix"></div>
        </div>
        <div class="col-md-4 modal_body_right modal_body_right1">
          <img src="http://babyinfoforyou.com/wp-content/uploads/2014/10/avatar-300x300.png" alt=" "/>
        </div>
        <div class="clearfix"></div>
          </div>
        </div>
    <!-- //Modal content-->
      </div>
    </div>
    <!-- end edit Profile -->



    <!-- Change Password -->
    <div class="modal fade" id="changePassword" tabindex="-1" role="dialog">
      <div class="modal-dialog">
    <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body modal-body-sub_agile">
        <div class="col-md-8 modal_body_left modal_body_left1">
          
          <h3 class="agileinfo_sign">Đổi <span>Mật khẩu</span></h3>
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
          <div class="row">
            
              
              <form method="post" id="passwordForm" action="{{ route('changePassword') }}">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <input type="hidden" name="email" value="{{Auth::User()->email}}">
                <input type="password" class="input-lg form-control" name="passwordOld"  placeholder="Nhập mật khẩu cũ" autocomplete="off">
                <br>
                <input type="password" class="input-lg form-control" name="password" id="password1" placeholder="Nhập mật khẩu mới" autocomplete="off">
                
                <div class="styled-input">
                  <div class="col-sm-6">
                    <span id="8char" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span> 8 kí tự trở lên<br>
                    <span id="ucase" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span> Phải có kí tự viết hoa
                  </div>
                  <div class="col-sm-6">
                    <span id="lcase" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span>Phải có kí tự viết thường<br>
                    <span id="num" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span> Ít nhất 1 số
                  </div>
                </div>
                <br>
                <input type="password" class="input-lg form-control" name="password2" id="password2" placeholder="Nhập lại mật khẩu" autocomplete="off">
                <div class="styled-input">
                  <div class="col-sm-12">
                    <span id="pwmatch" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span> Mật khẩu phù hợp
                  </div>
                </div>
                <input type="submit" class="col-xs-12 btn btn-primary btn-load btn-lg" data-loading-text="Changing Password..." value="Đổi mật khẩu">
              </form>
              </div><!--/row-->
          
          <div class="clearfix"></div>
        </div>
        <div class="col-md-4 modal_body_right modal_body_right1">
          <img src="http://babyinfoforyou.com/wp-content/uploads/2014/10/avatar-300x300.png" alt=" "/>
        </div>
        <div class="clearfix"></div>
          </div>
        </div>
    <!-- //Modal content-->
      </div>
    </div>
    <!-- end change password -->

    <script type="text/javascript">
      $(document).ready(function() {
        $('#Mytable').DataTable();
  
});
      
    </script>
@endsection