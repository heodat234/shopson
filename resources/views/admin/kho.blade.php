@extends("admin.Admin")
@section('admin.Content')

<div class="main-grid" style="overflow: scroll;">
    <div class="social grid">
        <div class="grid-info">
            <div class="col-md-3 top-comment-grid">
                <div class="comments likes">
                    <div class="comments-icon">
                        <i class="fa fa-users" style="height: 70%"></i>
                    </div>
                    <div class="comments-info likes-info">
                        <h3>{{ number_format($count_user) }}</h3>
                        <a href="#">user</a>
                    </div>
                    <div class="clearfix"> </div>
                </div>
            </div>
            <div class="col-md-3 top-comment-grid">
                <div class="comments">
                    <div class="comments-icon">
                        <i class="fa fa-file-text-o"></i>
                    </div>
                    <div class="comments-info">
                        <h3>{{ number_format($count_bill) }}</h3>
                        <a href="#">bills</a>
                    </div>
                    <div class="clearfix"> </div>
                </div>
            </div>
            <div class="col-md-3 top-comment-grid">
                <div class="comments tweets">
                    <div class="comments-icon">
                        <i class="fa fa-list-ul" aria-hidden="true"></i>
                    </div>
                    <div class="comments-info tweets-info">
                        <h3>{{ number_format($count_pro) }}</h3>
                        <a href="#">Products</a>
                    </div>
                    <div class="clearfix"> </div>
                </div>
            </div>
            <div class="col-md-3 top-comment-grid">
                <div class="comments views">
                    <div class="comments-icon">
                        <i class="fa fa-eye"></i>
                    </div>
                    <div class="comments-info views-info">
                        <h3>557K</h3>
                        <a href="#">Views</a>
                    </div>
                    <div class="clearfix"> </div>
                </div>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
        <div class="agile-grids">
            <div class="table-heading">
                    <h2>LỊCH SỬ NHẬP KHO</h2>
            </div>
            <div class="xoa alert alert-danger" style="display:none;"></div>
            {{-- <div>
                <button id="addRow" onclick="addRow()" title="Thêm sản phẩm mới"  class=" btn btn-info btn-lg glyphicon glyphicon-plus-sign" style=" border-radius: 10px;"></button>
            </div> --}}
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
                            {{-- <th>Sửa</th> --}}
                        
                        </thead>
                        <tbody>
                            @foreach($import as $im )
                                <tr id="row{{$im->id}}">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <td>{{$im->name}}</td>
                                    <td>{{$im->size}}</td>
                                    <td>{{$im->import_quantity}}</td>
                                    <td >{{$im->import_price }}</td>
                                    <td>{{ date("d/m/Y - H:i:s",strtotime($im->created_at)) }}</td>
                                    {{-- <td>
                                        <button class="btn btn-info btn-lg glyphicon glyphicon-hand-right" style="border-radius: 10px;" title="Sửa thông tin" onclick="editRow({{ $im->id }})"></button>
                                    </td> --}}
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
                            <th>Tổng số lượng bán</th>
                            <th>Tổng tiền bán</th>
                            <th>Lời/lỗ</th>
                        </thead>
                        <tbody>

                        <div style="display: none;">{{ $totalImport=0 }}</div>
                        <div style="display: none;">{{ $totalExport=0 }}</div>
                            @foreach($sum_import as $im )
                            <div style="display: none;">{{ $flag=0 }}{{ $dem=0 }}</div>
                            <tr id="row">
                                <td>{{ $im->name }}</td>
                                <td>{{ $im->size }}</td>
                                <td>{{number_format($im->qty)}}</td>
                                <td >{{number_format($im->price *$im->qty) }}</td>
                                @for($i=0;$i<count($sum_export);$i++ )
                                    @if($im->id_product == $sum_export[$i]->id_product && $im->size == $sum_export[$i]->size)
                                            <div style="display: none;">{{ $flag =1 }}{{ $dem=$i }}</div>
                                            
                                    @endif
                                    
                                @endfor
                                @if($flag==1)
                                    <td>{{ number_format($sum_export[$dem]->soluong) }}</td>
                                    <td>{{ number_format($sum_export[$dem]->totalPrice) }}</td>
                                    <td>{{ number_format($sum_export[$dem]->totalPrice - ($im->price * $im->qty)) }}</td>
                                    <div style="display: none;">{{ $totalExport += $sum_export[$dem]->totalPrice }}</div>  
                                @else
                                    <td>0</td>
                                    <td>0</td>
                                    <td> -{{ number_format($im->price* $im->qty) }}</td>
                                @endif
                                <div style="display: none;">{{ $totalImport += $im->price *$im->qty }}</div> 
                                {{-- <div style="display: none;">{{ $totalExport += $ex->totalPrice }}</div>   --}}
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <br>
                <div><b><h3><span style="margin-left: 200px">TỔNG TIỀN NHẬP VÀO:  {{ number_format($totalImport) }} VNĐ </span><span style="margin-left: 300px">TỔNG TIỀN BÁN RA:  {{ number_format($totalExport) }} VNĐ</span></h3></b></div>
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