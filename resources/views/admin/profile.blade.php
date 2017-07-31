@extends('admin.Admin')
@section('admin.Content')

<div class="container">
      <div class="row">
      
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
   
   
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
                        <td>Nhân viên</td>
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
      <table class="table table_bordered table_striped table-nonfluid" align="center" id="Mytable">
              <thead>
                <th>Sản phẩm</th>
                <th>Số lượng</th>
                <th>Giá</th>
                <th>Ngày mua</th>
              </thead>
              <tbody>
                <tr>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
              </tbody>
            </table>
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
          
          <form  method="post" id="editProfile" action="{{ route('editProfile') }}">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <input type="hidden" name="id" value="{{Auth::User()->id}}">
            <div class="styled-input agile-styled-input-top">
              <input type="text" name="name" id="editName" value="{{Auth::User()->full_name}}" required="">
              <label>Name</label>
              <span></span>
            </div>
            <div class="styled-input">
              <input type="text" name="phone" pattern="[0-9]*" title="số điện thoại chỉ được là số và 10 hoặc 11 số " id="editPhone" value="{{Auth::User()->phone}}">
              <label>Phone</label>
              <span></span>
            </div>
            <div class="styled-input">
              <input type="text" name="address" id="editAddress" value="{{Auth::User()->address}}">
              <label>Address</label>
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
                <input type="password" class="input-lg form-control" name="password" id="password1" placeholder="New Password" autocomplete="off">
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
                <input type="password" class="input-lg form-control" name="password2" id="password2" placeholder="Repeat Password" autocomplete="off">
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


    var panels = $('.user-infos');
    var panelsButton = $('.dropdown-user');
    panels.hide();

    //Click dropdown
    panelsButton.click(function() {
        //get data-for attribute
        var dataFor = $(this).attr('data-for');
        var idFor = $(dataFor);

        //current button
        var currentButton = $(this);
        idFor.slideToggle(400, function() {
            //Completed slidetoggle
            if(idFor.is(':visible'))
            {
                currentButton.html('<i class="glyphicon glyphicon-chevron-up text-muted"></i>');
            }
            else
            {
                currentButton.html('<i class="glyphicon glyphicon-chevron-down text-muted"></i>');
            }
        })
    });


    $('[data-toggle="tooltip"]').tooltip();

    $('button').click(function(e) {
        e.preventDefault();
        alert("This is a demo.\n :-)");
    });

  
});
      
    </script>
@endsection