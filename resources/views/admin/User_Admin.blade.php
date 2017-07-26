@extends("admin.Admin")
@section('admin.Content')

<div class="main-grid">
    <div class="agile-grids">
        <div class="table-heading">
            <h2>User</h2>
        </div>
        <div>
            <button id="addRow" onclick="addRow()"  class="btn btn-primary glyphicon glyphicon-plus-sign" style="height: 60px; width: 60px; border-radius: 10px"></button>
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
                            <td id="group{{$users->id}}">{{$users->group}}</td>
                            <td>
                                <button class="btn btn-info btn-lg glyphicon glyphicon-hand-right" style="border-radius: 10px;" id="edit_button{{ $users->id  }}" onclick="editRow({{ $users->id }})"></button>
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
            {{-- add form --}}
            <div id="addRowPro" class="form">
                <p class="form_title">Add User</p>
                <a href="#" class="close"><img src="admin/images/close.png" class="img-close" title="Close Window" alt="Close" /></a>
                <form enctype="multipart/form-data" method="post" id="new_form" name="new_form" class="horizontal">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label class="name">Name</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="new_name" name="new_name" class="form-control" placeholder="Enter your name">
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
                                    <input type="text" id="new_email" name="new_email" class="form-control" placeholder="Enter your email">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label class="password">Password</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="password" id="new_password" name="new_password" class="form-control" placeholder="Enter your password">
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
                                    <input type="number" id="new_phone" name="new_phone" class="form-control" placeholder="Enter your phone">
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
                                    <input type="text" id="new_address" name="new_address" class="form-control" placeholder="Enter your address">
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
                                    <input type="text" id="new_group" name="new_group" class="form-control" placeholder="Enter your group">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-offset-5 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                            <button type="button" id="saveAdd" class="button submit-button btn btn-info btn-lg glyphicon glyphicon-floppy-save" style="border-radius: 10px;">  Save</button>
                        </div>
                    </div>
                    
                </form>
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


    function addRow(){
        var formBox = $('#addRowPro');
        $(formBox).fadeIn("slow");
        // thêm phần tử id="over" vào cuối thẻ body
        $('body').append('<div id="over"></div>');
        $('#over').fadeIn(300);
    }

    $(document).on('click', "a.close, #over", function() {
        $('#over, .form').fadeOut(300 , function() {
            $('#over').remove();
        });
        return false;
    });

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
        var name=$('#new_name'+id).val();
        var email=$('#new_email'+id).val();
        var phone=$('#new_phone'+id).val();
        var address=$('#new_address'+id).val();
        var group=$('#new_group'+id).val();
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
            var id=data;
            var table=document.getElementById("product_table");
            var table_len=(table.rows.length);
            var row = table.insertRow(table_len).outerHTML="<tr id='row"+id+"'><td id='id"+id+"'>"+id+"</td><td id='name"+id+"'>"+name+"</td><td id='email"+id+"'>"+email+"</td><td id='phone"+id+"'>"+phone+"</td><td id='address"+id+"'>"+address+"</td><td id='group"+id+"'>"+group+"</td><td><button class='btn btn-info btn-lg glyphicon glyphicon-hand-right' style='border-radius: 10px;' id='edit_button"+id+"' onclick='editRow("+id+")'></button> <button class='btn btn-warning btn-lg glyphicon glyphicon-trash' style='border-radius: 10px' id='delete_button"+id+"' onclick='delete_row("+id+");'></button></td></tr>";
            $('tbody').append("<div id='editRowPro"+id+"' class='form'>                                                                                                                   <p class='form_title'>Edit Type</p>                                                                                             <a href='#' class='close'><img src='close.png' class='img-close' title='Close Window' alt='Close' /></a>                        <form id='formEdit"+id+"' enctype='multipart/form-data' method='post'> <input type='hidden' name='_token' value='{{ csrf_token() }}'>                                                                                                                           <div class='row clearfix'><div class='col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label'><label class='id'>ID</label></div><div class='col-lg-10 col-md-10 col-sm-8 col-xs-7'><div class='form-group'><div class='form-line'><input type='text' value='"+id+"' name='id' class='form-control' readonly ></div></div></div></div>                                                           <div class='row clearfix'><div class='col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label'><label class='name'>Name</label></div><div class='col-lg-10 col-md-10 col-sm-8 col-xs-7'><div class='form-group'><div class='form-line'><input type='text' name='edit_name' id='edit_name"+id+"' value='"+name+"' required=''  class='form-control'></div></div></div></div>               <div class='row clearfix'><div class='col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label'><label class='email'>Email</label></div><div class='col-lg-10 col-md-10 col-sm-8 col-xs-7'><div class='form-group'><div class='form-line'><input type='email' value='"+email+"' name='edit_email' id='edit_email"+id+"' disabled='' class='form-control' ></div></div></div></div>                                                                                                                            <div class='row clearfix'><div class='col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label'><label class='phone'>Phone</label></div><div class='col-lg-10 col-md-10 col-sm-8 col-xs-7'><div class='form-group'><div class='form-line'><input type='number' value='"+phone+"' name='edit_phone' id='edit_phone"+id+"' required='' class='form-control'></div></div></div></div>                                                                                                                            <div class='row clearfix'><div class='col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label'><label class='address'>Address</label></div><div class='col-lg-10 col-md-10 col-sm-8 col-xs-7'><div class='form-group'><div class='form-line'><input type='text' value='"+address+"' name='edit_address' id='edit_address"+id+"' required='' class='form-control'></div></div></div></div>                                                                                                                           <div class='row clearfix'><div class='col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label'><label class='group'>Group</label></div><div class='col-lg-10 col-md-10 col-sm-8 col-xs-7'><div class='form-group'><div class='form-line'><input type='texy' value='"+group+"' name='edit_group' id='edit_group"+id+"' required='' class='form-control'></div></div></div></div>                                                                                                                            <div class='row clearfix'><div class='col-lg-offset-5 col-md-offset-2 col-sm-offset-4 col-xs-offset-5'><button  type='button' class='button submit-button btn btn-info btn-lg glyphicon glyphicon-floppy-save saveEdit' style='border-radius: 10px;' onclick='saveEdit("+id+");'>  Save</button></div></div> </form></div>");
            $("#new_name").val()="";
            $("#new_email").val()="";
            $("#new_password").val()="";
            $("#new_phone").val()="";
            $("#new_address").val()="";
            $("#new_group").val()="";
            alert('Thêm user thành công');
            },
            error:function() {
                alert('Thêm user thất bại');
            },
        });
        var formBox = $('#addRowPro');
            $(formBox).fadeOut('400', function() {
            $('#over').remove();
        });
    });
    </script>
    @endsection