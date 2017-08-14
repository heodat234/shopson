@extends("admin.Admin")
@section('admin.Content')

<div class="main-grid">
    <div class="agile-grids">
        
            {{-- add form --}}
            <div class="container">
                <div class="modal-content " style="width: 100%">
                    <div class="modal-header">
                        
                        <h3 style="margin-left: 40%" class="modal-title" id="lineModalLabel">Sửa sản phẩm trong hóa đơn</h3>
                    </div>
                    <div class="modal-body">
                        <div class="dangkythatbai alert alert-danger" style="display:none;"></div>
                        <!-- content goes here -->
                        <form enctype="multipart/form-data" method="post" action="{{route('Update_Bill_Detail')}}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="quantityOld" value="{{ $Bill_Detail->quantity }}">
                            <input type="hidden" name="id" value="{{$Bill_Detail->id}}">
                            <input type="hidden" name="id_product" id="id_pro" value="{{$Bill_Detail->id_product}}">
                            <input type="hidden" name="id_bill" value="{{$Bill_Detail->id_bill}}">
                            <input type="hidden" name="size" id="id_size" value="{{$Bill_Detail->size}}">
                            <div class="form-group">
                                <label>Sản phẩm</label>
                                <input type="text" name="new_password" class="form-control" value="{{ $nameProduct }}" disabled="">
                            </div>
                            <div class="form-group">
                                <label>Quy cách</label>
                                <input type="text" name="new_size" class="form-control" value="{{ $Bill_Detail->size }}" disabled="">
                            </div>
                            <div class="form-group">
                                <label>Màu</label>
                                <input type="text" name="new_color" class="form-control" value="{{ $Bill_Detail->color }}" disabled="">
                            </div>
                            <div class="form-group">
                                <label>Số lượng</label>
                                <input type="text" id="id_qty" name="quantity" pattern="[0-9]*" title="Chỉ được nhập số" class="form-control" value="{{ $Bill_Detail->quantity }}">
                                <span style="color: red" id="loi"></span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Giá bán</label>
                                <input type="text" id="price" name="new_price" class="form-control" value="{{ $Bill_Detail->sales_price }}" disabled="">
                            </div>
                            <div style="margin-left: 45%">
                            <button type="submit" id="saveAdd" class="button submit-button btn btn-info btn-lg glyphicon glyphicon-floppy-save" style="border-radius: 10px;">  Lưu</button>
                            </div>
                        </form>

                    </div>
                </div>
              
            {{-- end add form --}}
        </div>

            
                        
    </div>
</div>
<script>
   $("#id_qty").blur(function (event) { 
    
           var quantity = $(this).val();
           var idPro =$('#id_pro').val();
            var size =$('#id_size').val();
           var route = "{{ route('CheckQuantity',['id','size','qty']) }}";
           route = route.replace('id',idPro);
           route = route.replace('size',size);
           route = route.replace('qty',quantity);
           $.ajax({
            url: route,
            type: 'get',
            data: null,
            success:function(data) {
                
                $("#loi").html(data);
            }
           });
            $("#loi").html('');
    });
</script>
@endsection