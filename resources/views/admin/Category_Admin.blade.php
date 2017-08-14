@extends("admin.Admin")
@section('admin.Content')

<div class="main-grid" style="overflow: scroll;">
    <div class="social grid">
        <div class="agile-grids">
            <div class="table-heading">
                @if($type==0)
                    <h2>Tất cả Loại Sản phẩm</h2>
                @else
                    @foreach($typeParent as $type_cha)
                        @if($type_cha->id==$type)
                            <h2>{{ $type_cha->name }}</h2>
                        @endif
                    @endforeach
                @endif
            </div>
            <div class="xoa alert alert-danger" style="display:none;"></div>
            <div>
                <button id="addRow" onclick="addRow()" title="Thêm loại sản phẩm mới"  class=" btn btn-info btn-lg glyphicon glyphicon-plus-sign" style=" border-radius: 10px;"></button>
            </div>
            <br>
            <div class="agile-tables">
            {{-- {{ dd($category) }} --}}
                @if($type==0)
                    <table class="table table_bordered table_striped table-nonfluid" align="center" id="cateduct_table" >
                        <thead>
                            <th style="display: none;"></th>
                            <th style="width: 5%; ">Mã Loại</th>
                            <th style="width: 10%;">Ảnh  </th>
                            <th style="width: 25%;">Tên loại sản phẩm</th>
                            <th style="width: 15%;">Loại cha</th>
                            <th style="width: 30%;">Mô tả</th>
                            <th >Sửa/Xóa</th>
                        </thead>
                        <tbody>
                            @foreach($category as $cate )
                                <tr id="row{{$cate->id}}">
                                    <td style="display: none;"></td>
                                    <td>{{$cate->id}}</td>
                                    <td><img id="img{{ $cate->id }}" src="images/products/{{ $cate->image }}" style="width: 90px; height: 90px"></td>
                                    <td>{{$cate->name}}</td>
                                    <td>
                                        @foreach($typeParent as $type)
                                            @if($cate->type_cha ==$type->id)
                                                {{$type->name}}
                                            @endif

                                        @endforeach
                                    </td>
                                    <td>{!!$cate->description!!}</td>
    
                                    <td>
                                        <button class="btn btn-info btn-lg glyphicon glyphicon-hand-right" style="border-radius: 10px;" title="Sửa thông tin loại" onclick="editRow({{ $cate->id }})"></button>
                                        @if($cate->type_cha!=0)
                                        <button class="btn btn-warning btn-lg glyphicon glyphicon-trash" style="border-radius: 10px" title="Xóa loại" onclick="delete_row('{{ $cate->id}}');"></button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <table class="table table_bordered table_striped table-nonfluid" align="center" id="cateduct_table" >
                        <thead>
                            {{-- <th><input type="checkbox" id="checkall" /></th> --}}
                            <th style="width: 5%; ">Mã Loại</th>
                            <th style="width: 10%;">Ảnh  </th>
                            <th style="width: 25%;">Tên loại sản phẩm</th>
                            <th style="width: 30%;">Mô tả</th>
                            
                            <th >Sửa/Xóa</th>
                        </thead>
                        <tbody>
                            @foreach($category as $cate )
                                <tr id="row{{$cate->id}}">
                                    <td>{{$cate->id}}</td>
                                    <td><img id="img{{ $cate->id }}" src="images/products/{{ $cate->image }}" style="width: 90px; height: 90px"></td>
                                    <td>{{$cate->name}}</td>
                                    
                                    <td>{!!$cate->description!!}</td>
    
                                    <td>
                                        <button class="btn btn-info btn-lg glyphicon glyphicon-hand-right" style="border-radius: 10px;" title="Sửa thông tin" onclick="editRow({{ $cate->id }})"></button>
                                        <button class="btn btn-warning btn-lg glyphicon glyphicon-trash" style="border-radius: 10px" title="Xóa sản phẩm" onclick="delete_row('{{ $cate->id}}');"></button>
                                    </td>
                            
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#cateduct_table').DataTable();
    });

    function addRow(){
        var  route="{{ route('ViewPage_InsertCategory') }}";
        window.location.replace(route);
        
    }
    function editRow(id) {
        var  route="{{ route('ViewPage_EditCategory','id') }}";
        route = route.replace('id',id);
        window.location.replace(route);
    }


    function delete_row(id)
    {
        ssi_modal.confirm({
        content: 'Bạn có muốn xóa sản phẩm này không?',
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
        // var image = $('#img'+id).attr("src");
        var route="{{ route('Delete_Category') }}";
        $.ajax({
        url:route,
        type:'get',
        data:{
        id:id,
        // imageFile:image,
        },
        success:function() {
        $('#row'+id).hide();
        $('.xoa').show();
        $('.xoa').html("Xóa thành công");
        $('.xoa').hide(10000);
        }
        });
        
        }
        else
        ssi_modal.notify('error', {content: "Hủy xóa"});
        }
        );
    }
</script>
@endsection