@extends("admin.Admin")
@section('admin.Content')

<div class="main-grid">
    <div class="agile-grids">
        <div class="table-heading">
            <h2>Chi tiết hóa đơn</h2>
        </div>
    
        <div><b>Người mua: </b>{{ $bill_details[0]->name }}<span style="margin-left: 320px"><b>Email: </b> {{ $bill_details[0]->email }}</span></div><br> 
        <div><b>Số điện thoại: </b> {{ $bill_details[0]->phone }}<span style="margin-left: 300px"><b>Địa chỉ: </b> {{ $bill_details[0]->address }}</span></div><br>
        <div class="agile-tables">
            <table class="table table_bordered table_striped table-nonfluid" align="center" id="Mytable" >
                <thead>
                    <th data-breakpoints="xs">ID_bill</th>
                    <th>ID</th>
                    <th>Sản phẩm</th>
                    <th>Loại thùng</th>
                    <th>Màu</th>
                    <th data-breakpoints="xs">Số lượng</th>
                    <th>Giá Bán</th>
                    <th>Giá Tổng</th>
                    @if($bill_details[0]->method==0)
                    <th data-breakpoints="xs sm md" data-title="DOB">Edit</th>
                    @endif
                </thead>
                <tbody>
                <div style="display: none;">{{ $totalPrice =0 }}</div>
                    @foreach($bill_details as $bill_detail )
                    <tr id="row{{ $bill_detail->id }}">
                        <div>
                            <td>{{$bill_detail->id_bill}}</td>
                          <td>{{$bill_detail->id}}</td>
                          <td>{{$bill_detail->namePro}}</td>
                          <td>{{$bill_detail->size}}</td>
                          <td>#{{$bill_detail->color}}</td>
                          <td id="quantity{{ $bill_detail->id }}">{{number_format($bill_detail->quantity)}}</td>
                          <td>{{number_format($bill_detail->sales_price)}}</td>
                          <td>{{number_format($bill_detail->quantity*$bill_detail->sales_price)}}</td>
                          @if($bill_detail->method==0)
                            <td>
                                <button class="btn btn-info btn-lg glyphicon glyphicon-hand-right" style="border-radius: 10px;" onclick="editRow({{ $bill_detail->id }},'{{ $bill_detail->name }}')"></button>
                                <button class="btn btn-warning btn-lg glyphicon glyphicon-trash" style="border-radius: 10px"  onclick="delete_row({{ $bill_detail->id}},{{ $bill_detail->id_product }},{{ $bill_detail->quantity }},{{ $bill_detail->id_bill }});"></button>
                            </td>
                            @endif
                        </div>
                    </tr>
                    <div style="display: none;">{{ $totalPrice += $bill_detail->quantity*$bill_detail->sales_price }} </div>      
                    @endforeach
                    <div id="totalPrice"><b>Tổng tiền: </b>  {{ number_format($totalPrice) }} VNĐ <span style="margin-left: 300px"><b>Ngày mua: </b> {{ $bill_details[0]->created_at }}</span></div><br>
                </tbody>
            </table>


                        
        </div>
    </div>
</div>
    <script type="text/javascript">
    $(document).ready(function(){
        $('#Mytable').DataTable();
    });

    
    function editRow(id,namePro){
        var  route="{{route('ViewModify_BillDetail',['idbill_detail','name'])}}";
        route=route.replace('idbill_detail',id);
        route=route.replace('name',namePro);
        window.location.replace(route);
    }


    function delete_row(id,id_product,quantity,id_bill)
    {
        ssi_modal.confirm({
            content: 'Bạn có muốn xóa sản phẩm này chứ?',
            okBtn: {
                className:'btn btn-primary'
            },
            cancelBtn:{
                className:'btn btn-danger'
            }
        },function (result) {
            if(result)
            {

                
                var size = $('#row'+id).find('td:nth-child(4)').text();
                var route="{{ route('Delete_One_BillDetail',['id','id_pro','qty','size','id_bill']) }}";
                route = route.replace('id',id);
                route = route.replace('id_pro',id_product);
                route = route.replace('qty',quantity);
                route = route.replace('size',size);
                route = route.replace('id_bill',id_bill);
                window.location.replace(route);
            }else
                ssi_modal.notify('Cancel', {content: "Hủy xóa"});
            }
        );
    }
    
    </script>
    @endsection