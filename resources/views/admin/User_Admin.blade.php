@extends("admin.Admin")
@section('admin.Content')

<div class="main-grid">
    <div class="agile-grids">
        <div class="table-heading">
            <h2>User</h2>
        </div>
        <div>
            <button id="addRow" data-toggle="modal" data-target="#addUser"  class="btn btn-primary glyphicon glyphicon-plus-sign" style="height: 60px; width: 60px; border-radius: 10px"></button>
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
                    <th>EDIT/DELETE</th>
                </thead>
                <tbody>
                    @foreach($user as $users )
                    <tr id="row{{$users->id}}">
                        <div id="row1{{ $users->id }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <td id="id{{$users->id}}">{{$users->id}}</td>
                            <td id="name{{$users->id}}">{{$users->full_name}}</td>
                            <td id="email{{$users->id}}">{{$users->email}}</td>
                            <td id="phone{{$users->id}}">{{$users->phone}}</td>
                            <td id="address{{$users->id}}">{{$users->address}}</td>
                            <td id="group{{$users->id}}">
                                @if($users->group == 0)
                                    Khách
                                @else Nhân viên
                                @endif
                            </td>
                            <td>
                                <button class="btn btn-info btn-lg glyphicon glyphicon-hand-right" style="border-radius: 10px;" id="edit_button{{ $users->id  }}" data-toggle="modal" data-target="#editUser"></button>
                                <button class="btn btn-warning btn-lg glyphicon glyphicon-trash" style="border-radius: 10px" id="delete_button{{ $users->id  }}" onclick="delete_row('{{ $users->id}}');"></button>
                            </td>
                        </div>
                    </tr>

                    {{-- edit form --}}
                    <div id="editRowPro{{ $users->id }}" class="form">
                        <p class="form_title">Edit User</p>
                        <a href="#" class="close"><img src="admin/images/close.png" class="img-close" title="Close Window" alt="Close" /></a>
                        <form id="formEdit{{ $users->id }}" enctype="multipart/form-data" method="post" class="horizontal">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="row clearfix">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                    <label class="id">ID</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" value="{{ $users->id }}" name="id" class="form-control" readonly >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                    <label class="name">Name</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" name="edit_name" id="edit_name{{ $users->id }}" value="{{ $users->full_name }}" pattern="[A-z]{1,15}" title="tên gồm 1 đến 15 kí tự hoa hoặc thường không dấu"  class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                    <label class="email">Email</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="email" value="{{$users->email}}" name="edit_des" id="edit_email{{ $users->id }}" disabled="" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                    <label class="phone">Phone</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="number" value="{{$users->phone}}" name="edit_phone" id="edit_phone{{ $users->id }}" required="" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                    <label class="address">Address</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" value="{{$users->address}}" name="edit_address" id="edit_address{{ $users->id }}" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                    <label class="group">Group</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" value="{{ $users->group }}" name="edit_group" id="edit_group{{ $users->id }}" required="" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-lg-offset-5 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                    <button  type="button" onclick="saveEdit({{ $users->id }});" class="button submit-button btn btn-info btn-lg glyphicon glyphicon-floppy-save saveEdit" style="border-radius: 10px;">  Save</button>
                                </div>
                            </div>
                            
                        </form>
                    </div>
                    {{-- end edit form --}}
                    
                    
                    @endforeach
                </tbody>
            </table>






                        {{-- edit modal --}}
            <div class="modal fade" id="editUser" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                        <h3 class="modal-title" id="lineModalLabel">Edit User</h3>
                    </div>
                    <div class="modal-body">
                        
                        content goes here
                        <form>
                          <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="text" class="form-control" id="editName" placeholder="Enter email">
                          </div>
                          <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                          </div>
                          <div class="form-group">
                            <label for="exampleInputFile">File input</label>
                            <input type="file" id="exampleInputFile">
                            <p class="help-block">Example block-level help text here.</p>
                          </div>
                          <div class="checkbox">
                            <label>
                              <input type="checkbox"> Check me out
                            </label>
                          </div>
                          <button type="submit" class="btn btn-default">Submit</button>
                        </form>

                    </div>
                </div>
              </div>
            </div>





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
    <script type="text/javascript">
    $(document).ready(function(){
        $('#Mytable').DataTable();
    });

    
    function editRow(id){
        var formBox = $('#editRowPro'+id);
        $(formBox).fadeIn("slow");
        // thêm phần tử id="over" vào cuối thẻ body
        $('body').append('<div id="over"></div>');
        $('#over').fadeIn(300);
    }


    function delete_row(id)
    {
        ssi_modal.confirm({
            content: 'Are you sure you want to exit?',
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
                ssi_modal.notify('error', {content: 'Result: ' + result});
            }
        );
    }
    
    function saveEdit(id) {
        var name=$('#edit_name'+id).val();
        var phone=$('#edit_phone'+id).val();
        var address=$('#edit_address'+id).val();
        var group=$('#edit_group'+id).val();
        var route=" {{ route('Edit_User') }} ";
        var form_data = new FormData($('form#formEdit'+id)[0]);
        $.ajax
        ({
            type:'post',
            url:route,
            data:form_data,
            processData: false,
            contentType: false,
            success:function() {
                $("#name"+id).html(name);
                $("#phone"+id).html(phone);
                $("#address"+id).html(address);
                $("#group"+id).html(group);
                alert('Cập nhập thành công');
            },
            error:function() {
                alert('lỗi khi cập nhập');
            },
        });
        var formBox = $('#editRowPro'+id);
            $(formBox).fadeOut('400', function() {
            $('#over').remove();
        });
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
                console.log(thongbao);
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