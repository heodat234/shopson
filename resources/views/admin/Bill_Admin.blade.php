@extends("admin.Admin")
@section('admin.Content')

<div class="main-grid" style="overflow: scroll;">
    <div class="social grid">
        <div class="agile-grids">
        @if($id_user ==0)
            <div class="table-heading">
                <h2> Tất cả Hóa đơn</h2>
            </div>
            <div class="agile-tables">
                <table class="table table_bordered table_striped table-nonfluid" align="center" id="Mytable" >
                    <thead>
                        {{-- <th><input type="checkbox" id="checkall" /></th> --}}
                        <th style="width: 5%">Mã hóa đơn</th>
                        <th style="width: 10%;">Người mua</th>
                        <th style="width: 13%">Email</th>
                        <th style="width: 8%;"> Số điện thoại   </th>
                        <th style="width: 20%;">Địa chỉ</th>
                        <th style="width: 10%">Tình Trạng</th>
                        <th style="width: 10%">Payment</th>
                        <th>Xem Chi tiết</th>
                        <th>Sửa trạng thái</th>
                    </thead>
                    <tbody>
                        @foreach($bills as $bill )
                        <tr id="row{{ $bill->id }}">
                            <div>
                                <td >{{$bill->id}}</td>
                                <td>{{$bill->name}}</td>
                                <td>{{$bill->email}}</td>
                                <td>{{$bill->phone}}</td>
                                <td>{{$bill->address}}</td>
                                <td>
                                    @if($bill->method ==0)
                                        Chưa xác nhận
                                    @elseif($bill->method ==1) Đã xác nhận, chưa thanh toán
                                    @else Đã thanh toán
                                    @endif
                                </td>
                                <td>
                                    @if($bill->payment ==0)
                                        Thanh toán khi nhận hàng
                                    @else Thanh toán trực tuyến
                                    @endif
                                </td>
                                <td><a href="{{route('ViewPageBill_Detail_Admin',$bill->id)}}"><button class="btn btn-success btn-lg glyphicon glyphicon-hand-right" style="border-radius: 10px;"></button></a></td>
                                <td>
                                @if($bill->method<2)
                                    <button class="btn btn-info btn-lg glyphicon glyphicon-hand-right" style="border-radius: 10px;" onclick="editRow({{ $bill->id }})"></button>
                                
                                @elseif(Auth::User()->group>=2)
                                    <button class="btn btn-info btn-lg glyphicon glyphicon-hand-right" style="border-radius: 10px;" onclick="editRow({{ $bill->id }})"></button>
                                @endif
                                </td>
                            </div>
                        </tr>

                       
                        
                        @endforeach
                    </tbody>
                </table>              
            </div>
        @else
            <div class="table-heading">
                <h2>Hóa đơn</h2>
            </div>
            <div><b>Người mua: </b>{{ $bills[0]->name }}<span style="margin-left: 320px"><b>Email: </b> {{ $bills[0]->email }}</span></div><br> 
            <div><b>Số điện thoại: </b> {{ $bills[0]->phone }}<span style="margin-left: 300px"><b>Địa chỉ: </b> {{ $bills[0]->address }}</span></div><br>
            <div class="agile-tables">
                <table class="table table_bordered table_striped table-nonfluid" align="center" id="Mytable" >
                    <thead>
                        {{-- <th><input type="checkbox" id="checkall" /></th> --}}
                        <th style="width: 15%">Mã hóa đơn</th>
                        <th style="width: 25%">Tình Trạng</th>
                        <th style="width: 20%">Payment</th>
                        <th>Ngày mua</th>
                        <th>Xem Chi tiết</th>
                        <th>Sửa trạng thái</th>
                    </thead>
                    <tbody>
                        @foreach($bills as $bill )
                        <tr id="row{{ $bill->id }}">
                            <div>
                                <td >{{$bill->id}}</td>
                                <td>
                                    @if($bill->method ==0)
                                        Chưa xác nhận
                                    @elseif($bill->method ==1) Đã xác nhận, chưa thanh toán
                                    @else Đã thanh toán
                                    @endif
                                </td>
                                <td>
                                    @if($bill->payment ==0)
                                        Thanh toán khi nhận hàng
                                    @else Thanh toán trực tuyến
                                    @endif
                                </td>
                                <td>{{ $bill->created_at }}</td>
                                <td><a href="{{route('ViewPageBill_Detail_Admin',$bill->id)}}"><button class="btn btn-success btn-lg glyphicon glyphicon-hand-right" style="border-radius: 10px;"></button></a></td>
                                <td>
                                @if($bill->method<2)
                                    <button class="btn btn-info btn-lg glyphicon glyphicon-hand-right" style="border-radius: 10px;" onclick="editRow({{ $bill->id }})"></button>
                                
                                @elseif(Auth::User()->group>=2)
                                    <button class="btn btn-info btn-lg glyphicon glyphicon-hand-right" style="border-radius: 10px;" onclick="editRow({{ $bill->id }})"></button>
                                @endif
                                </td>
                            </div>
                        </tr>

                       
                        
                        @endforeach
                    </tbody>
                </table>              
            </div>
        @endif
        </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
    $('#Mytable').DataTable();
});


function editRow(id){
    var  route="{{route('ViewPageBill_Admin_Insert','idbill')}}";
    route=route.replace('idbill',id);
    window.location.replace(route);
}

</script>
@endsection