@extends("admin.Admin")
@section('admin.Content')

<div class="main-grid">
        <div class="agile-grids">
            <div class="table-heading">
                <h2>Basic Tables</h2>
            </div>
            <div>
                <button id="addRow" onclick="addRow()"  class="btn btn-primary glyphicon glyphicon-plus-sign" style="height: 60px; width: 60px; border-radius: 10px"></button>
            </div>
            <br>
            <div class="agile-tables">
                <input type="hidden" id="typeRequest" value="{{ $typepro }}">
                        
                        @if($typepro==0)
                        <table class="table table_bordered table_striped table-nonfluid" align="center" id="product_table" >
                            <thead>
                                {{-- <th><input type="checkbox" id="checkall" /></th> --}}
                                <th style="width: 3%; ">ID</th>
                                <th style="width: 8%; " >IMAGE</th>
                                <th style="width: 25%;">NAME</th>
                                <th style="width: 8%;">TYPE PRODUCT</th>
                                <th style="width: 22%;">DESCRIPTION</th>
                                <th style="width: 8%;">  UNIT PRICE   </th>
                                
                                <th >EDIT/DELETE</th>
                            </thead>
                            <tbody>
                                @foreach($product as $pro )
                                <tr id="row{{$pro->id}}">
                                    <div id="row1{{ $pro->id }}">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <td id="id{{$pro->id}}">{{$pro->id}}</td>
                                        <td id="image{{$pro->id}}"><img id="img{{ $pro->id }}" src="images/products/{{ $pro->image }}" style="width: 90px; height: 90px"></td>
                                        <td id="name{{$pro->id}}">{{$pro->name}}</td>
                                        <td id="type_name{{$pro->id}}">{{$pro->type_name}}</td>
                                        <td id="description{{$pro->id}}">{{$pro->description}}</td>
                                        <td id="unit_price{{$pro->id}}">{{number_format($pro->unit_price)}} vnd</td>
                                        
                                        {{-- <td>{{$pro->created_at}}</td> --}}
                                        {{-- <td id="updated_at{{$pro->id}}">{{$pro->updated_at}}</td> --}}
                                        <td>
                                            <button class="btn btn-info btn-lg glyphicon glyphicon-hand-right" style="border-radius: 10px;" id="edit_button{{ $pro->id  }}" onclick="editRow({{ $pro->id }})"></button>
                                            <button class="btn btn-warning btn-lg glyphicon glyphicon-trash" style="border-radius: 10px" id="delete_button{{ $pro->id  }}" onclick="delete_row('{{ $pro->id}}');"></button>
                                        </td>
                                    </div>
                                </tr>
                                
                                
                                {{-- Edit Product --}}
                                <div id="editRowPro{{ $pro->id }}" class="form">
                                    <p class="form_title">Edit Product</p>
                                    <a href="#" class="close"><img src="admin/images/close.png" class="img-close" title="Close Window" alt="Close" /></a>
                                    <form id="formEdit{{ $pro->id }}" enctype="multipart/form-data" method="post">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <br>
                                        <div class="row clearfix">
                                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                <label class="id">ID</label>
                                            </div>
                                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" value="{{ $pro->id }}" name="id" class="form-control" readonly >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row clearfix">
                                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                <label class="name">Name Product</label>
                                            </div>
                                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" name="edit_name" id="edit_name{{ $pro->id }}" value="{{ $pro->name }}" required="" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row clearfix">
                                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                <label class="type">Type Product</label>
                                            </div>
                                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <select class="selectpicker form-control" name="edit_type" id="edit_type{{ $pro->id }}" >
                                                            @foreach($type_product as $type)
                                                            <option name="{{ $type->name }}" value="{{ $type->id }}" id="{{ $type->name }}" >{{ $type->name }}</option>
                                                            
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row clearfix">
                                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                <label class="description">Description</label>
                                            </div>
                                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" value="{{$pro->description}}" name="edit_des" id="edit_description{{ $pro->id }}" required="" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row clearfix">
                                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                <label class="unit-price">Unit Price</label>
                                            </div>
                                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="number" value="{{$pro->unit_price}}" name="edit_unit_price" id="edit_unit_price{{ $pro->id }}" required="" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row clearfix">
                                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                <label class="image">Image</label>
                                            </div>
                                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="file" value="{{$pro->image}}" name="edit_image" id="edit_image{{ $pro->id }}" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row clearfix">
                                            <div class="col-lg-offset-5 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                                <button  type="button" onclick="saveEdit({{ $pro->id }});" class="button submit-button btn btn-info btn-lg glyphicon glyphicon-floppy-save saveEdit" style="border-radius: 10px;">  Save</button>
                                            </div>
                                        </div>
                                        
                                    </form>
                                    {{-- <script type="text/javascript">
                                         $(document).ready(function(){
                                            $('#'+{{ $pro->type_name }}).attr('selected','selected');
                                         };
                                    </script> --}}
                                    
                                </div>
                                {{-- End Edit --}}
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <table border="1" class="table table-striped table-nonfluid" align="center" id="product_table" >
                            <thead>
                                {{-- <th><input type="checkbox" id="checkall" /></th> --}}
                                <th style="width: 5%;;">ID</th>
                                <th style="width: 8%;">IMAGE</th>
                                <th style="width: 30%;">NAME</th>
                                <th style="width: 30%;">DESCRIPTION</th>
                                <th style="width: 8%;">  UNIT PRICE   </th>
                                <th style="width: 9%;">EDIT/DELETE</th>
                            </thead>
                            <tbody>
                                @foreach($product as $pro )
                                <tr id="row{{$pro->id}}">
                                    <div id="row1{{ $pro->id }}">
                                        <td id="id{{$pro->id}}">{{$pro->id}}</td>
                                        <td id="image{{$pro->id}}"><img id="img{{ $pro->id }}" src="images/products/{{ $pro->image }}" style="width: 90px; height: 90px"></td>
                                        <td id="name{{$pro->id}}">{{$pro->name}}</td>
                                        <td id="description{{$pro->id}}">{{$pro->description}}</td>
                                        <td id="unit_price{{$pro->id}}">{{number_format($pro->unit_price)}} vnd</td>
                                        {{-- <td>{{$pro->created_at}}</td> --}}
                                        {{-- <td id="updated_at{{$pro->id}}">{{$pro->updated_at}}</td> --}}
                                        <td>
                                            <button class="btn btn-info btn-lg glyphicon glyphicon-hand-right" style="border-radius: 10px;" id="edit_button{{ $pro->id  }}" onclick="editRow({{ $pro->id }})"></button>
                                            <button class="btn btn-warning btn-lg glyphicon glyphicon-trash" style="border-radius: 10px" id="delete_button{{ $pro->id  }}" onclick="delete_row('{{ $pro->id}}');"></button>
                                        </td>
                                    </div>
                                </tr>
                                {{-- Edit Product --}}
                                <div id="editRowPro{{ $pro->id }}" class="form">
                                    <p class="form_title">Edit Product</p>
                                    <a href="#" class="close"><img src="admin/images/close.png" class="img-close" title="Close Window" alt="Close" /></a>
                                    <form id="formEdit{{ $pro->id }}" enctype="multipart/form-data" method="post">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <br>
                                        <div class="row clearfix">
                                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                <label class="id">ID</label>
                                            </div>
                                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" value="{{ $pro->id }}" name="id" class="form-control" readonly >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row clearfix" >
                                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                <label class="name">Name Product</label>
                                            </div>
                                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" name="edit_name" id="edit_name{{ $pro->id }}" value="{{ $pro->name }}" required="" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row clearfix" id="rowType{{ $pro->id }}">
                                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                <label class="type">Type Product</label>
                                            </div>
                                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="hidden" name="edit_type" value="{{ $pro->id_type }}" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row clearfix">
                                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                <label class="description">Description</label>
                                            </div>
                                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" value="{{$pro->description}}" name="edit_des" id="edit_description{{ $pro->id }}" required="" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row clearfix">
                                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                <label class="unit-price">Unit Price</label>
                                            </div>
                                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="number" value="{{$pro->unit_price}}" name="edit_unit_price" id="edit_unit_price{{ $pro->id }}" required="" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row clearfix">
                                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                <label class="image">Image</label>
                                            </div>
                                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="file" value="{{$pro->image}}" name="edit_image" id="edit_image{{ $pro->id }}" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row clearfix">
                                            <div class="col-lg-offset-5 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                                <button  type="button" onclick="saveEdit({{ $pro->id }});" class="button submit-button btn btn-info btn-lg glyphicon glyphicon-floppy-save saveEdit" style="border-radius: 10px;">  Save</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                {{-- End Edit --}}
                                @endforeach
                                
                            </tbody>
                        </table>
                        
                        @endif
                        
                        {{-- Add Product --}}
                        <div id="addRowPro" class="form">
                            <p class="form_title">Add Product</p>
                            <a href="#" class="close"><img src="admin/images/close.png" class="img-close" title="Close Window" alt="Close" /></a>
                            <form id="new_form" enctype="multipart/form-data" method="post">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <br>
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label class="name">Name Product</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="new_name" id="new_name" required="" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label class="type">Type Product</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <select class="selectpicker form-control" name="new_type" id="new_type" >
                                                    @foreach($type_product as $type)
                                                    <option name="{{ $type->name }}" class="{{ $type->id }}" value="{{ $type->id }}">{{ $type->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
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
                                <br>
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label class="unit-price">Unit Price</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="number" name="new_unit_price" id="new_unit_price" required="" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
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
                                <br>
                                <div class="row clearfix">
                                    <div class="col-lg-offset-5 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                        <button type="button" id="saveAdd" class="button submit-button btn btn-info btn-lg glyphicon glyphicon-floppy-save" style="border-radius: 10px;">  Insert</button>
                                    </div>
                                </div>
                                
                            </form>
                        </div>
                        {{-- End Add --}}
            </div>
        </div>
    </div>

    <script type="text/javascript">
    $(document).ready(function(){
    $('#product_table').DataTable();
    });
    $.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    
    function editRow(id){
        
        var typeRequest = $("#typeRequest").val();
        if (typeRequest!=0) {
        $('#rowType'+id).hide();
        // }else{
        //     for(i=0;i<$product.length;i++){
        //         alert($product[i]['id']);
        //     if($product[i]['id']==id){
        //         $('#'+$product[i]['type_name']).attr('selected','selected');
        //     }
        // }
         }
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
    var id = $row.find("td:nth-child(3)").text();
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
        },function (result)
        {
        if(result)
        {
        var image = $('#img'+id).attr("src");
        var route="{{ route('Delete_Product') }}";
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
        var typeRequest = $("#typeRequest").val();
        if (typeRequest==0) {
        var type= $("#edit_type"+id).find(":selected").attr('name');
        }
        var name = $("#edit_name"+id).val();
        var description = $("#edit_description"+id).value;
        var unit_price = $("#edit_unit_price"+id).val().toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        var image = $('#edit_image'+id)[0].files[0].name;
        var route=" {{ route('Edit_Product') }} ";
        var form_data = new FormData($('form#formEdit'+id)[0]);
        // var form = $('form#formEdit'+id).serializeArray();
        // console.log(form);
        $.ajax
        ({
        type:'post',
        url:route,
        data:form_data,
        processData: false,
        contentType: false,
        success:function() {
        // var updated_at = data;
        $("#name"+id).html(name);
        if (typeRequest==0) {
        $("#type_name"+id).html(type);
        }
        $("#description"+id).html(description);
        $("#unit_price"+id).html(unit_price+"vnd");
        $("#image"+id).html("<img src='images/products/"+image+"' style='width: 90px; height: 90px' />");
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
        var typeRequest = $("#typeRequest").val();
        if(typeRequest==0){
        var type=$("#new_type").find(":selected").attr('name');
        var typeValue=$("#new_type").find(":selected").attr('value');
        }
        var description=$("#new_description").val();
        var unit_price=$("#new_unit_price").val().toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        var image = $('#new_image')[0].files[0].name;
        var route="{{ route('Insert_Product') }}";
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
        var table=document.getElementById("product_table");
        var table_len=(table.rows.length);
        if(typeRequest!=0){
        var row = table.insertRow(table_len).outerHTML="<tr id='row"+id+"'><td id='id"+id+"'>"+id+"</td><td id='image"+id+"'><img id='img"+id+"' src='images/products/"+image+"' style='width: 90px; height: 90px'/></td><td id='name"+id+"'>"+name+"</td><td id='description"+id+"'>"+description+"</td><td id='unit_price"+id+"'>"+unit_price+"</td><td><button class='btn btn-info btn-lg glyphicon glyphicon-hand-right' style='border-radius: 10px;' id='edit_button"+id+"' onclick='editRow("+id+")'></button> <button class='btn btn-warning btn-lg glyphicon glyphicon-trash' style='border-radius: 10px' id='delete_button"+id+"' onclick='delete_row("+id+");'></button></td></tr>";
        $('tbody').append("<div id='editRowPro"+id+"' class='form'>                                                                                                                   <p class='form_title'>Edit Type</p>                                                                                                                              <a href='#' class='close'><img src='close.png' class='img-close' title='Close Window' alt='Close' /></a>                        <form id='formEdit"+id+"' enctype='multipart/form-data' method='post'> <input type='hidden' name='_token' value='{{ csrf_token() }}'><div class='row clearfix'><div class='col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label'><label class='id'>ID</label></div><div class='col-lg-10 col-md-10 col-sm-8 col-xs-7'><div class='form-group'><div class='form-line'><input type='text' value='"+id+"' name='id' class='form-control' readonly ></div></div></div></div>                                                                                                                            <div class='row clearfix'><div class='col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label'><label class='name'>Name</label></div><div class='col-lg-10 col-md-10 col-sm-8 col-xs-7'><div class='form-group'><div class='form-line'><input type='text' name='edit_name' id='edit_name"+id+"' value='"+name+"' required=''  class='form-control'></div></div></div></div>               <div class='row clearfix'><div class='col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label'><label class='description'>Description</label></div><div class='col-lg-10 col-md-10 col-sm-8 col-xs-7'><div class='form-group'><div class='form-line'><input type='text' value='"+description+"' name='edit_des' id='edit_description"+id+"' required='' class='form-control'></div></div></div></div>                                                                                                                             <div class='row clearfix'><div class='col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label'><label class='unit-price'>Unit Price</label></div><div class='col-lg-10 col-md-10 col-sm-8 col-xs-7'><div class='form-group'><div class='form-line'><input type='text' value='"+unit_price+"' name='edit_unit_price' id='edit_unit_price"+id+"' required='' class='form-control'></div></div></div></div>                                                                                                                                                                                                                                                              <div class='row clearfix'><div class='col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label'><label class='image'>Image</label></div><div class='col-lg-10 col-md-10 col-sm-8 col-xs-7'><div class='form-group'><div class='form-line'><input type='file' value='"+image+"' name='edit_image' id='edit_image"+id+"' class='form-control' ></div></div></div></div>                                                                                                                                                                                                                                                             <div class='row clearfix'><div class='col-lg-offset-5 col-md-offset-2 col-sm-offset-4 col-xs-offset-5'><button  type='button' class='button submit-button btn btn-info btn-lg glyphicon glyphicon-floppy-save saveEdit' style='border-radius: 10px;' onclick='saveEdit("+id+");'>  Save</button></div></div> </form></div>");
        }else{
        var row = table.insertRow(table_len).outerHTML="<tr id='row"+id+"'><td id='id"+id+"'>"+id+"</td><td id='image"+id+"'><img id='img"+id+"' src='images/products/"+image+"' style='width: 90px; height: 90px'/></td><td id='name"+id+"'>"+name+"</td><td id='type_name"+id+"'>"+type+"</td><td id='description"+id+"'>"+description+"</td><td id='unit_price"+id+"'>"+unit_price+" vnd</td><td><button class='btn btn-info btn-lg glyphicon glyphicon-hand-right' style='border-radius: 10px;' id='edit_button"+id+"' onclick='editRow("+id+")'></button> <button class='btn btn-warning btn-lg glyphicon glyphicon-trash' style='border-radius: 10px' id='delete_button"+id+"' onclick='delete_row("+id+");'></button></td></tr>";
        $('tbody').append("<div id='editRowPro"+id+"' class='form'>                                                                                                                   <p class='form_title'>Edit Type</p>                                                                                             <a href='#' class='close'><img src='close.png' class='img-close' title='Close Window' alt='Close' /></a>                        <form id='formEdit"+id+"' enctype='multipart/form-data' method='post'> <input type='hidden' name='_token' value='{{ csrf_token() }}'><div class='row clearfix'><div class='col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label'><label class='id'>ID</label></div><div class='col-lg-10 col-md-10 col-sm-8 col-xs-7'><div class='form-group'><div class='form-line'><input type='text' value='"+id+"' name='id' class='form-control' readonly ></div></div></div></div>                                                <div class='row clearfix'><div class='col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label'><label class='name'>Name</label></div><div class='col-lg-10 col-md-10 col-sm-8 col-xs-7'><div class='form-group'><div class='form-line'><input type='text' name='edit_name' id='edit_name"+id+"' value='"+name+"' required=''  class='form-control'></div></div></div></div>               <div class='row clearfix'><div class='col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label'><label class='type'>Type</label></div><div class='col-lg-10 col-md-10 col-sm-8 col-xs-7'><div class='form-group'><div class='form-line'><select class='selectpicker form-control' name='edit_type' id='edit_type"+id+"'><option name='"+type+"' value='"+typeValue+"'>"+type+"</option> @foreach($type_product as $type)<option name='{{ $type->name }}' value='{{ $type->id }}'>{{ $type->name }}</option> @endforeach</select></div></div></div></div>                                                                                                                                <div class='row clearfix'><div class='col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label'><label class='description'>Description</label></div><div class='col-lg-10 col-md-10 col-sm-8 col-xs-7'><div class='form-group'><div class='form-line'><input type='text' value='"+description+"' name='edit_des' id='edit_description"+id+"' required='' class='form-control'></div></div></div></div>                                                                                                                               <div class='row clearfix'><div class='col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label'><label class='unit-price'>Unit Price</label></div><div class='col-lg-10 col-md-10 col-sm-8 col-xs-7'><div class='form-group'><div class='form-line'><input type='text' value='"+unit_price+"' name='edit_unit_price' id='edit_unit_price"+id+"' required='' class='form-control'></div></div></div></div>                                                                                                                                                                                                                                                              <div class='row clearfix'><div class='col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label'><label class='image'>Image</label></div><div class='col-lg-10 col-md-10 col-sm-8 col-xs-7'><div class='form-group'><div class='form-line'><input type='file' value='"+image+"' name='edit_image' id='edit_image"+id+"' class='form-control' ></div></div></div></div>                                                                                                                                                                                                                                                                                                            <div class='row clearfix'><div class='col-lg-offset-5 col-md-offset-2 col-sm-offset-4 col-xs-offset-5'><button  type='button' class='button submit-button btn btn-info btn-lg glyphicon glyphicon-floppy-save saveEdit' style='border-radius: 10px;' onclick='saveEdit("+id+");'>  Save</button></div></div> </form></div>");
        }
        
        $("#new_name").val()="";
        $("#new_type").val()="";
        $("#new_description").val()="";
        $("#new_unit_price").val()="";
        $("#new_image").val()="";
        alert('Thêm sản phẩm thành công');
        },
        error:function() {
        alert('thất bại');
        },
        });
        var formBox = $('#addRowPro');
        $(formBox).fadeOut('400', function() {
        $('#over').remove();
        });
    });
    </script>
    @endsection