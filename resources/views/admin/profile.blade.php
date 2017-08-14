@extends('admin.Admin')
@section('admin.Content')

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
    </div>

    {{-- edit profile --}}

    <div class="modal fade" id="editProfile" tabindex="-1" role="dialog">
      <div class="modal-dialog">
    <!-- Modal content-->
         <div class="modal-content " style="width: 100%">
                    <div class="modal-header">
                        
                        <h3 style="margin-left: 37%" class="modal-title" id="lineModalLabel">Sửa thông tin</h3>
                    </div>
                    <div class="modal-body">
                        <div class="dangkythatbai alert alert-danger" style="display:none;"></div>
                        <!-- content goes here -->
                        <form enctype="multipart/form-data" method="post" action="{{ route('editProfile') }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="id" value="{{Auth::User()->id}}">
                            <div class="form-group">
                                <label>Tên</label>
                                <input type="text" name="name" class="form-control" value="{{Auth::User()->full_name}}" required ="">
                            </div>
                            <div class="form-group">
                                <label>Số điện thoại</label>
                                <input type="text" name="phone" pattern="[0-9]*" minlength="10" maxlength="11" title="số điện thoại chỉ được là số và 10 hoặc 11 số " class="form-control" value="{{Auth::User()->phone}}" required ="">
                            </div>
                            <div class="form-group">
                                <label>Địa chỉ</label>
                                <input type="text" name="address" class="form-control" value="{{Auth::User()->address}}" required="">
                            </div>
                            <div style="margin-left: 40%" >
                            <button type="submit" class="button submit-button btn btn-info btn-lg glyphicon glyphicon-floppy-save" style="border-radius: 10px;">  Lưu</button>
                            </div>
                        </form>

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
         <div class="modal-content " style="width: 100%">
                    <div class="modal-header">
                        <h3 style="margin-left: 37%" class="modal-title" id="lineModalLabel">Sửa thông tin</h3>
                    </div>
                    @if (count($errors) > 0)
                    <div class="alert alert-danger">
                      <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                      </ul>
                    </div>
                    @endif
                    <div class="modal-body">
                        <div class="dangkythatbai alert alert-danger" style="display:none;"></div>
                        <!-- content goes here -->
                        <form enctype="multipart/form-data" method="post" action="{{ route('changePassword') }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="email" value="{{Auth::User()->email}}">
                            <div class="form-group">
                                <label>Mật khẩu cũ</label>
                                <input type="password" name="passwordOld" class="form-control" required="" placeholder="Nhập mật khẩu cũ" autocomplete="off">
                            </div>

                            <div class="form-group">
                                <label>Mật khẩu mới</label>
                                <input type="password" name="password" id="password1" class="form-control"  required ="" placeholder="Nhập mật khẩu mới" autocomplete="off">
                                <div class="col-sm-6">
                                  <span id="8char" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span> 8 kí tự trở lên<br>
                                  <span id="ucase" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span> Phải có kí tự viết hoa
                                </div>
                                <div class="col-sm-6">
                                  <span id="lcase" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span>Phải có kí tự viết thường<br>
                                  <span id="num" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span> Ít nhất 1 số
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Nhập lại mật khẩu</label>
                                <input type="password" name="password2" id="password2" class="form-control" required ="" placeholder="Nhập lại mật khẩu mới" autocomplete="off">
                                 <div class="col-sm-12">
                                  <span id="pwmatch" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span> Mật khẩu phù hợp
                                 </div>
                            </div>
                            
                            <div style="margin-left: 40%" >
                            <button type="submit" class="button submit-button btn btn-info btn-lg " style="border-radius: 10px;">Lưu</button>
                            </div>
                        </form>

                    </div>
                </div>
          
    <!-- //Modal content-->
      </div>
    </div>
    <!-- end change password -->

    {{-- <script type="text/javascript">
      $(document).ready(function() {
        $('#Mytable').DataTable();
  
});
      
    </script> --}}
@endsection