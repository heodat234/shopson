@extends("admin.Admin")
@section('admin.Content')

<div class="main-grid" style="overflow: scroll;">
        <div class="agile-grids">
            <div class="table-heading">
                @if($typepro==0)
                    <h2>Tất cả Sản phẩm</h2>
                @else
                    <h2>{{ $typeName }}</h2>
                @endif
            </div>
            <div class="xoa alert alert-danger" style="display:none;"></div>
            <div>
                <button id="addRow" onclick="addRow()" title="Thêm sản phẩm mới"  class=" btn btn-info btn-lg glyphicon glyphicon-plus-sign" style=" border-radius: 10px;"></button>
            </div>
            <br>
            <div class="agile-tables">
                <input type="hidden" id="typeRequest" value="{{ $typepro }}">
                @if($typepro==0)
                    <table class="table table_bordered table_striped table-nonfluid" align="center" id="product_table" >
                        <thead>
                            {{-- <th><input type="checkbox" id="checkall" /></th> --}}
                            <th style="width: 3%; ">Mã SP</th>
                            <th style="width: 8%; " >Ảnh</th>
                            <th style="width: 25%;">Tên sản phẩm</th>
                            <th style="width: 8%;">Loại sản phẩm</th>
                            <th style="width: 22%;">Tính năng</th>
                            <th style="width: 8%;">Nội thất/Ngoại thất  </th>
                            <th>Loại thùng</th>
                            <th>Giá bán (vnđ)</th>
                            <th >Sửa/Xóa</th>
                            <th>Nhập Kho</th>
                        </thead>
                        <tbody>
                            @foreach($product as $pro )
                                <tr id="row{{$pro->id}}">
                                    <td>{{$pro->id}}</td>
                                    <td><img id="img{{ $pro->id }}" src="images/products/{{ $pro->image }}" style="width: 90px; height: 90px"></td>
                                    <td>{{$pro->name}}</td>
                                    <td>{{$pro->type_name}}</td>
                                    <td>{!!$pro->description!!}</td>
                                    <td>
                                        @if($pro->type==0) Nội thất
                                        @elseif($pro->type==1) Ngoại thất
                                        @else Khác
                                        @endif
                                    </td>
                                    <td >{{$pro->size }}</td>
                                    <td>{{ $pro->export_price }}</td>
                                    <td>
                                        <button class="btn btn-info btn-lg glyphicon glyphicon-hand-right" style="border-radius: 10px;" title="Sửa thông tin" onclick="editRow({{ $pro->id }},{{ $pro->idsize }})"></button>
                                        <button class="btn btn-warning btn-lg glyphicon glyphicon-trash" style="border-radius: 10px" title="Xóa sản phẩm" onclick="delete_row({{ $pro->id }},{{ $pro->idsize}});"></button>
                                    </td>
                                    <td>
                                        <button class="btn btn-success btn-lg glyphicon glyphicon-download" style="border-radius: 10px;" title="Nhập kho" onclick="importProduct({{ $pro->id }},{{ $pro->idsize }})"></button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <table border="1" class="table table-striped table-nonfluid" align="center" id="product_table" >
                        <thead>
                            <th style="width: 5%;;">Mã sp</th>
                            <th style="width: 8%;">ảnh</th>
                            <th style="width: 20%;">tên sản phẩm</th>
                            <th style="width: 30%;">tính năng</th>
                            <th style="width: 8%;"> Nội thất/ngoại thất   </th>
                            <th>Loại thùng</th>
                            <th style="width: 8%;"> Giá bán (vnđ)  </th>
                            <th style="width: 9%;">Sửa/Xóa</th>
                            <th>Nhập Kho</th>
                        </thead>
                        <tbody>
                            @foreach($product as $pro )
                                <tr id="row{{$pro->id}}">
                                    <td >{{$pro->id}}</td>
                                    <td ><img id="img{{ $pro->id }}" src="images/products/{{ $pro->image }}" style="width: 90px; height: 90px"></td>
                                    <td >{{$pro->name}}</td>
                                    <td >{!!$pro->description!!}</td>
                                    <td>
                                        @if($pro->type==0) Nội thất
                                        @elseif($pro->type==1) Ngoại thất
                                        @else Khác
                                        @endif
                                    </td>
                                    <td >{{$pro->size }}</td>
                                    <td>{{ $pro->export_price }}</td>
                                    
                                    <td>
                                        <button class="btn btn-info btn-lg glyphicon glyphicon-hand-right" style="border-radius: 10px;" title="Sửa thông tin" onclick="editRow({{ $pro->id }},{{ $pro->idsize }})"></button>
                                        <button class="btn btn-warning btn-lg glyphicon glyphicon-trash" style="border-radius: 10px" title="Xóa sản phẩm" onclick="delete_row({{ $pro->id }},{{ $pro->idsize}});"></button>
                                    </td>
                                    <td>
                                        <button class="btn btn-success btn-lg glyphicon glyphicon-download" style="border-radius: 10px;" title="Nhập kho" onclick="importProduct({{ $pro->id }},{{ $pro->idsize }})"></button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>

    <script type="text/javascript">
    $(document).ready(function(){
        $('#product_table').DataTable();
    });
    
    function addRow(){
        var  route="{{ route('ViewPage_InsertProduct') }}";
        window.location.replace(route);
        
    }
    function editRow(id, idsize) {
        var  route="{{ route('ViewPage_EditProduct',['id','idsize']) }}";
        route = route.replace('id',id);
        route = route.replace('idsize',idsize);
        window.location.replace(route);
    }
    function importProduct(id, idsize) {
        var  route="{{ route('ViewPage_ImportProduct',['id','idsize']) }}";
        route = route.replace('id',id);
        route = route.replace('idsize',idsize);
        // route = route.replace('size',size);
        window.location.replace(route);
    }

    function delete_row(id,idsize)
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
        var route="{{ route('Delete_Product',['id','idsize']) }}";
        route = route.replace('id',id);
        route = route.replace('idsize',idsize);
        $.ajax({
        url:route,
        type:'get',
        data:null,
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