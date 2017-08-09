@extends("admin.Admin")
@section('admin.Content')

<div class="main-grid" style="overflow: scroll;">
        <div class="agile-grids">
            <div class="table-heading">
                    <h2>LỊCH SỬ NHẬP KHO</h2>
            </div>
            <div class="xoa alert alert-danger" style="display:none;"></div>
            <div>
                <button id="addRow" onclick="addRow()" title="Thêm sản phẩm mới"  class=" btn btn-info btn-lg glyphicon glyphicon-plus-sign" style=" border-radius: 10px;"></button>
            </div>
            <br>
            <div class="agile-tables">
                    <table class="table table_bordered table_striped table-nonfluid" align="center" id="product_table" >
                        <thead>
                            {{-- <th><input type="checkbox" id="checkall" /></th> --}}
                            <th style="width: 25%;">Tên sản phẩm</th>
                            <th style="width: 10%;">Quy cách</th>
                            <th>Số lượng nhập</th>
                            <th>Giá nhập</th>
                            <th >Ngày nhập</th>
                            <th>Sửa</th>
                        
                        </thead>
                        <tbody>
                            @foreach($import as $im )
                                <tr id="row{{$im->id}}">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <td>{{$im->name}}</td>
                                    <td>{{$im->size}}</td>
                                    <td>{{$im->import_quantity}}</td>
                                    <td >{{$im->import_price }}</td>
                                    <td>{{ $im->created_at }}</td>
                                    <td>
                                        <button class="btn btn-info btn-lg glyphicon glyphicon-hand-right" style="border-radius: 10px;" title="Sửa thông tin" onclick="editRow({{ $im->id }})"></button>
                                    </td>
                                </tr>
                            @endforeach
      
                        </tbody>
                    </table>
                
            </div>


            <br>
            <br><br>
            <div class="table-heading">
                    <h2>THỐNG KÊ KHO</h2>
            </div>
            <div class="xoa alert alert-danger" style="display:none;"></div>
            {{-- <div>
                <button id="addRow" onclick="addRow()" title="Thêm sản phẩm mới"  class=" btn btn-info btn-lg glyphicon glyphicon-plus-sign" style=" border-radius: 10px;"></button>
            </div> --}}
            <br>
            <div class="agile-tables">
                    <table class="table table_bordered table_striped table-nonfluid" align="center" id="product1_table" >
                        <thead>
                            {{-- <th><input type="checkbox" id="checkall" /></th> --}}
                            <th style="width: 25%;">Tên sản phẩm</th>
                            <th style="width: 10%;">Quy cách</th>
                            <th>Tổng số lượng nhập</th>
                            <th>tổng tiền nhập</th>
                            <th>Tổng số lượng xuất</th>
                            <th>Tổng tiền xuất</th>
                            <th>Lời/lỗ</th>
                        </thead>
                        <tbody>
                        {{-- {{ dd($sum_import) }} --}}
                            @foreach($sum_import as $im )
                            <div style="display: none;">{{ $flag=0 }}</div>
                            <tr id="row">
                                <td>{{ $im->name }}</td>
                                <td>{{ $im->size }}</td>
                                <td>{{number_format($im->qty)}}</td>
                                <td >{{number_format($im->price) }}</td>
                                @foreach($sum_export as $ex )
                                    @if($im->id_product == $ex->id_product && $im->size == $ex->size)
                                            <div style="display: none;">{{ $flag =1 }}</div>
                                            
                                    @endif
                                @endforeach
                                @if($flag==1)
                                    <td>{{ number_format($ex->soluong) }}</td>
                                    <td>{{ number_format($ex->totalPrice) }}</td>
                                    <td>{{ number_format($ex->totalPrice - $im->price) }}</td>
                                @else
                                    <td>N/A</td>
                                    <td>N/A</td>
                                    <td>{{ number_format($im->price) }}</td>
                                @endif
                                    
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                
            </div>
        </div>
    </div>

    <script type="text/javascript">
    $(document).ready(function(){
        $('#product_table').DataTable();
        $('#product1_table').DataTable();
    });
    
    function addRow(){
        var  route="{{ route('ViewPage_InsertKho') }}";
        window.location.replace(route);
    }

    function editRow(id) {
        var  route="{{ route('ViewPage_EditKho',['id']) }}";
        route = route.replace('id',id);
        window.location.replace(route);
    }
    </script>
    @endsection