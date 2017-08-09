@extends("admin.Admin")
@section('admin.Content')

<div class="main-grid" style="overflow: scroll;">
    <div class="agile-grids">
        <div class="table-heading">
            <h2>User</h2>
        </div>
        <div>
        @if(Auth::User()->group >= 2)
            <button id="addRow" data-toggle="modal" data-target="#addUser" title="Thêm tài khoản"  class="btn btn-primary glyphicon glyphicon-plus-sign" style="height: 60px; width: 60px; border-radius: 10px"></button>
        @endif
        </div>
        <br>
        <div class="agile-tables">
            <table class="table table_bordered table_striped table-nonfluid" align="center" id="Mytable" >
                <thead>
                    {{-- <th><input type="checkbox" id="checkall" /></th> --}}
                    <th style="width: 5%">ID</th>
                    <th style="width: 20%;">NAME</th>
                    <th style="width: 25%;">EMAIL</th>
                    <th style="width: 15%;"> PHONE   </th>
                    <th style="width: 30%;">ADDRESS</th>
                    <th style="width: 5%">GROUP</th>
                    @if(Auth::User()->group >= 2)
                    <th>DELETE</th>
                    <th>Lịch sử Mua hàng</th>
                    @endif
                </thead>
                <tbody>
                    @foreach($user as $users )
                    <tr id="row{{$users->id}}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <td id="id{{$users->id}}">{{$users->id}}</td>
                            <td id="name{{$users->id}}">{{$users->full_name}}</td>
                            <td id="email{{$users->id}}">{{$users->email}}</td>
                            <td id="phone{{$users->id}}">{{$users->phone}}</td>
                            <td id="address{{$users->id}}">{{$users->address}}</td>
                            <td id="group{{$users->id}}">
                                @if($users->group == 0)
                                    Khách
                                @elseif($users->group>=2) Admin
                                @else Nhân viên
                                @endif
                            </td>
                            
                            @if(Auth::User()->group >= 2)
                                <td>
                                    @if($users->group != 0 && Auth::User()->id != $users->id)
                                        <button class="btn btn-warning btn-lg glyphicon glyphicon-trash" style="border-radius: 10px" id="delete_button{{ $users->id  }}" onclick="delete_row('{{ $users->id}}');"></button>
                                    @endif
                                </td>
                            @endif
                            <td>
                                @if($users->id_bill !=null)
                                <button class="btn btn-success btn-lg glyphicon glyphicon-search" style="border-radius: 10px" id="delete_button{{ $users->id  }}" onclick="show_bill({{ $users->id}});"></button>
                                @endif
                            </td>
                            
                    </tr>

                    
                    
                    @endforeach
                </tbody>
            </table>






            {{-- add form --}}
            <div class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                        <h3 class="modal-title" id="lineModalLabel">Thêm tài khoản nhân viên</h3>
                    </div>
                    <div class="modal-body">
                        <div class="dangkythatbai alert alert-danger" style="display:none;"></div>
                        <!-- content goes here -->
                        <form enctype="multipart/form-data" method="post" id="new_form">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên</label>
                                <input type="text" id="new_name" name="new_name" class="form-control" placeholder="Enter your name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="text" id="new_email" name="new_email" class="form-control" placeholder="Enter your email">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" id="new_password" name="new_password" class="form-control" placeholder="Enter your password">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Số điện thoại</label>
                                <input type="number" id="new_phone" name="new_phone" class="form-control" placeholder="Enter your phone">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Địa chỉ</label>
                                <input type="text" id="new_address" name="new_address" class="form-control" placeholder="Enter your address">
                            </div>
                          
                            <button type="button" id="saveAdd" class="button submit-button btn btn-info btn-lg glyphicon glyphicon-floppy-save" style="border-radius: 10px;">  Save</button>
                        </form>

                    </div>
                </div>
              </div>
            </div>
            {{-- end add form --}}


            
                        
        </div>
    </div>
</div>
    <script>
    $(document).ready(function(){
        $('#Mytable').DataTable();
    });

    function show_bill(id){
        var  route="{{ route('Show_Bill_By_User','id_user') }}";
        route = route.replace('id_user',id);
        window.location.replace(route);
        
    }

    function delete_row(id)
    {
        ssi_modal.confirm({
            content: 'Bạn có muốn xóa không?',
            okBtn: {
                className:'btn btn-primary'
            },
            cancelBtn:{
                className:'btn btn-danger'
            }
        },function (result) {
            if(result)
            {
            // var image = $('#row'+id).find('td:nth-child(7)').text();
                var route="{{ route('Delete_User') }}";
                $.ajax({
                    url:route,
                    type:'get',
                    data:{
                        id:id,
                        // imageFile:image,
                    },
                    success:function() {
                        $('#row'+id).hide();
                        alert('Xóa thành công');
                    }
                });
            }else
                ssi_modal.notify('error', {content: 'Đã xóa'});
            }
        );
    }
    
   

    $('#saveAdd').click(function()
    {
        var route="{{ route('Insert_User') }}";
        var form_data = new FormData($('form#new_form')[0]);
        $.ajax
        ({
            type:'post',
            url:route,
            processData: false,
            contentType: false,
            data:form_data,
            success:function(data) {
                var thongbao = data.substring(1);
                // console.log(thongbao);
                if(data.substr(0,1)!=0){
                    $('.modal').modal('hide');
                    $('div.register').show();
                    $('div.register').html(thongbao);
                    setTimeout(function(){// wait for 2 secs(2)
                        location.reload(); // then reload the page.(3)
                    }, 2000); 
                }else{
                    $('div.dangkythatbai').fadeIn();
                    $('div.dangkythatbai').html(thongbao);
                    $('div.dangkythatbai').fadeOut(5000);
                }
            },
            error:function() {
                alert('Thêm user thất bại');
            },
        });
        
    });
    </script>
    @endsection