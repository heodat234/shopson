
            @extends("admin.Admin")
            @section('admin.Content')
            
        <section class="content">
            <div class="container-fluid">
                <div class="row">            
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2 id="header">
                                    CATEGORY
                                    {{-- <small>You can edit any columns except header/footer</small> --}}
                            </h2>
                        </div>
                        <div class="body">     

                        <div>
                            <button id="addRow" onclick="addRow()"  class="btn btn-primary glyphicon glyphicon-plus-sign" style="height: 60px; width: 60px; border-radius: 10px"></button>
                        </div> 
                        <div style="float: right;">
                            <input type="text" id="search" placeholder="Search" style="width: 200px; height: 50px"></input>
                            <br><br>
                        </div>
                        <br>
                             <table border="1" class="table table-admin table-striped table-nonfluid" align="center" id="product_table" >
                                <thead>
                           {{-- <th><input type="checkbox" id="checkall" /></th> --}}
                                        <th style="width: 5%">ID</th>
                                        <th style="width: 10%;">Image</th> 
                                        <th style="width: 30%;">NAME</th>
                                        <th style="width: 35%;">Description</th>
                                        <th style="width: 8%;">Type</th>             
                                        <th>EDIT/DELETE</th>
                                </thead>
                                <tbody>
                                    @foreach($typeproduct as $tp)
                                        <tr id="row{{$tp->id }}">
                                            <div id="row1{{$tp->id }}">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <td id="id{{$tp->id }}">{{$tp->id }}</td>
                                                <td id="image{{$tp->id}}"><img id="img{{$tp->id}}" src="images/category/{{$tp->image}}" style="width: 100px; height: 100px"></td>
                                                <td id="name{{ $tp->id }}">{{ $tp->name }}</td>
                                                <td id="description{{ $tp->id }}">{{ $tp->description }}</td>
                                                @if($tp->type==1)
                                                    <td id="type{{$tp->id}}">Sản phẩm</td>
                                                @else
                                                    <td id="type{{$tp->id}}">Tin tức</td>
                                                @endif
                                                <td>
                                                    <button class="btn btn-info btn-lg glyphicon glyphicon-hand-right" style="border-radius: 10px;" id="edit_button{{ $tp->id  }}" onclick="editRow({{ $tp->id }})"></button>
                                                    <button class="btn btn-warning btn-lg glyphicon glyphicon-trash" style="border-radius: 10px" id="delete_button{{ $tp->id  }}" onclick="delete_row('{{ $tp->id  }}');"></button>
                                                </td>
                                            </div>
                                        </tr>

                                        <div id="editRowPro{{ $tp->id  }}" class="form">
                                            <p class="form_title">Edit Type</p>
                                            <a href="#" class="close"><img src="close.png" class="img-close" title="Close Window" alt="Close" /></a>
                                            <form id="formEdit{{ $tp->id  }}" enctype="multipart/form-data" method="post" class="horizontal">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <div class="row clearfix">
                                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                        <label class="id">ID</label>
                                                    </div>
                                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <input type="text" value="{{ $tp->id  }}" name="id" class="form-control" readonly >
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
                                                                <input type="text" name="edit_name" id="edit_name{{ $tp->id  }}" value="{{ $tp->name }}" required=""  class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row clearfix">
                                                   <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                        <label class="image">Image</label>
                                                    </div>
                                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <input type="file" value="{{$tp->image}}" name="edit_image" id="edit_image{{$tp->id}}" class="form-control" >
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row clearfix">
                                                     <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                        <label class="description">Description</label>
                                                    </div>
                                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <input type="text" value="{{$tp->description}}" name="edit_des" id="edit_description{{ $tp->id }}" required="" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row clearfix">
                                                     <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                        <label class="type">Type</label>
                                                    </div>
                                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <select class="selectpicker form-control" name="edit_type" id="edit_type{{ $tp->id }}">
                                                                    @if($tp->type==1)
                                                                        <option selected="selected" name="Sản phẩm" value="1">Sản phẩm</option>
                                                                        <option name="Tin tức" value="2">Tin tức</option>
                                                                    @else
                                                                        <option selected="selected"  name="Tin tức" value="2" >Tin tức</option>
                                                                        <option name="Sản phẩm" value="1">Sản phẩm</option>
                                                                    @endif
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row clearfix">
                                                    <div class="col-lg-offset-5 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                                    <button  type="button" onclick="saveEdit({{ $tp->id }});" class="button submit-button btn btn-info btn-lg glyphicon glyphicon-floppy-save saveEdit" style="border-radius: 10px;">  Save</button>
                                                    </div>
                                                </div>  
                                            </form>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>    
                                {{-- <button type="button" class="btn btn-success" style="height:40px;width: 150px;  float:right; border-radius: 5px; margin-top: 25px;" id="viewpdf_allproduct">Xuất file pdf</button>  --}}  

                            <div id="addRowPro" class="form">
                                <p class="form_title">Add Type</p>
                                <a href="#" class="close"><img src="close.png" class="img-close" title="Close Window" alt="Close" /></a>
                                <form id="new_form" enctype="multipart/form-data" method="post">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label class="name">Name</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" id="new_name" name="new_name" class="form-control" placeholder="Enter name">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                <label class="description">Description</label>
                                            </div>
                                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" name="new_des" id="new_description" required="" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <div class="row clearfix">
                                                 <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                    <label class="type">Type</label>
                                                </div>
                                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <select class="selectpicker form-control" name="new_type" id="new_type">
                                                                    <option selected="selected" name="Sản phẩm" value="1">Sản phẩm</option>
                                                                    <option name="Tin tức" value="2">Tin tức</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                   
                                    <div class="row clearfix">
                                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                        <label class="image">Image</label>
                                                    </div>
                                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <input type="file" name="new_image" id="new_image" class="form-control">
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
                            <div>{{  $typeproduct->links() }}</div>
                        
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <script type="text/javascript">
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
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

            $("#search").on("keyup", function() {
                var value = $(this).val();

                $("table tr").each(function(index) {
                    if (index !== 0) {

                        $row = $(this);

                        var id = $row.find("td:nth-child(2)").text();

                        if (id.indexOf(value) !== 0) {
                            $row.hide();
                            
                        }
                        else {
                            $row.show();
                            $('#new_row').hide();
                        }
                    }
                });
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
                        var image = $('#img'+id).attr("src");
                        image=image.substr(7);
                        var route="{{ route('Delete_Category') }}";
                        $.ajax({
                            url:route,
                            type:'get',
                            data:{
                                id:id,
                                imageFile:image,
                            },
                            success:function() {  
                                 $('#row'+id).hide();
                                alert('Xóa thành công');
                            }
                        });
                    }
                    else
                        ssi_modal.notify('error', {content: 'Result: ' + result});
                }
            );
            }
            function saveEdit(id)
            {
                var name=$("#edit_name"+id).val();
                var description=$("#edit_description"+id).val();
                var type= $("#edit_type"+id).find(":selected").attr('name');
                var image = $('#edit_image'+id)[0].files[0].name;
                var route=" {{ route('Edit_Category') }} ";
                var form_data = new FormData($('form#formEdit'+id)[0]);
                $.ajax
                ({
                    type:'post',
                    url:route,
                    data:form_data,
                    processData: false,
                    contentType: false,
                    success:function() {
                        $("#description"+id).html(description);
                        $("#name"+id).html(name);
                        $("#type"+id).html(type);
                        $("#image"+id).html("<img src='images/"+image+"' style='width: 100px; height: 100px' />");
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
                var name=$("#new_name").val();
                var description=$("#new_description").val();               
                var image = $('#new_image')[0].files[0].name;
                var type= $("#new_type").find(":selected").attr('name');
                var typeValue= $("#new_type").val();
                var typeValue1="";
                if(type=="Sản phẩm"){
                    var type1="Tin tức";
                    typeValue1=2;
                }
                else{
                    var type1="Sản phẩm";
                    typeValue1=1;
                }
                var route="{{ route('Insert_Category') }}";
                var form_data = new FormData($('form#new_form')[0]);
                $.ajax
                ({
                    type:'post',
                    url:route,
                    processData: false,
                    contentType: false,
                    data:form_data,
                    success:function(data) {
                        // console.log(data);
                        var id=data;
                        var table=$("#product_table");
                        var table_len=(table.rows.length);
                            var row = table.insertRow(table_len).outerHTML="<tr id='row"+id+"'><td id='id"+id+"'>"+id+"</td></td><td id='image"+id+"'><img id='img"+id+"' src='images/"+image+"' style='width: 90px; height: 90px'/></td><td id='name"+id+"'>"+name+"</td><td id='description"+id+"'>"+description+"</td><td id='type"+id+"'>"+type+"</td><td><button class='btn btn-info btn-lg glyphicon glyphicon-hand-right' style='border-radius: 10px;' id='edit_button"+id+"' onclick='editRow("+id+")'></button> <button class='btn btn-warning btn-lg glyphicon glyphicon-trash' style='border-radius: 10px' id='delete_button"+id+"' onclick='delete_row("+id+");'></button></td></tr>";                        
                            $('tbody').append("<div id='editRowPro"+id+"' class='form'>                                                                                                                   <p class='form_title'>Edit Type</p>                                                                                             <a href='#' class='close'><img src='close.png' class='img-close' title='Close Window' alt='Close' /></a>                        <form id='formEdit"+id+"' enctype='multipart/form-data' method='post'> <input type='hidden' name='_token' value='{{ csrf_token() }}'>                                                                                                                           <div class='row clearfix'><div class='col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label'><label class='id'>ID</label></div><div class='col-lg-10 col-md-10 col-sm-8 col-xs-7'><div class='form-group'><div class='form-line'><input type='text' value='"+id+"' name='id' class='form-control' readonly ></div></div></div></div>                                                   <div class='row clearfix'><div class='col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label'><label class='name'>Name</label></div><div class='col-lg-10 col-md-10 col-sm-8 col-xs-7'><div class='form-group'><div class='form-line'><input type='text' name='edit_name' id='edit_name"+id+"' value='"+name+"' required=''  class='form-control'></div></div></div></div>               <div class='row clearfix'><div class='col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label'><label class='image'>Image</label></div><div class='col-lg-10 col-md-10 col-sm-8 col-xs-7'><div class='form-group'><div class='form-line'><input type='file' value='"+image+"' name='edit_image' id='edit_image"+id+"' class='form-control' ></div></div></div></div>  <div class='row clearfix'><div class='col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label'><label class='description'>Description</label></div><div class='col-lg-10 col-md-10 col-sm-8 col-xs-7'><div class='form-group'><div class='form-line'><input type='text' value='"+description+"' name='edit_des' id='edit_description"+id+"' required='' class='form-control'></div></div></div></div>                                                                                                                            <div class='row clearfix'><div class='col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label'><label class='type'>Type</label></div><div class='col-lg-10 col-md-10 col-sm-8 col-xs-7'><div class='form-group'><div class='form-line'><select class='selectpicker form-control' name='edit_type' id='edit_type"+id+"'><option selected='selected' name='"+type+"' value='"+typeValue+"'>"+type+"</option><option name='"+type1+"' value='"+typeValue1+"'>"+type1+"</option></select></div></div></div></div>                                                                                                                            <div class='row clearfix'><div class='col-lg-offset-5 col-md-offset-2 col-sm-offset-4 col-xs-offset-5'><button  type='button' class='button submit-button btn btn-info btn-lg glyphicon glyphicon-floppy-save saveEdit' style='border-radius: 10px;' onclick='saveEdit("+id+");'>  Save</button></div></div> </form></div>");
                        $("#new_name").val()="";
                        $("#new_description").val()="";
                        $("#new_image").val()="";
                        $("#new_type").val()="";
                        alert('Thêm category thành công');
                    },
                    error:function() {
                        alert('Thêm category thất bại');
                    },
                });
                var formBox = $('#addRowPro');
                        $(formBox).fadeOut('400', function() {
                            $('#over').remove(); 
                        });
            });

    </script>
    @endsection



                            


                            