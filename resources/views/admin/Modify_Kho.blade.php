@extends("admin.Admin")
@section('admin.Content')

<div class="main-grid">
    <div class="agile-grids">
        <div class="container" style="margin: auto; float: center;">
            @if($id==0)
                <div class="modal-content " style="width: 100%">
                    <div class="modal-header">
                        <h3 class="modal-title" style="margin-left: 45%" id="lineModalLabel">Nhập kho</h3>
                    </div>
                    <div class="modal-body">
                        <div class="dangkythatbai alert alert-danger" style="display:none;"></div>
                        <!-- content goes here -->
                        <form enctype="multipart/form-data" method="post" action="{{route('Insert_Kho')}}" class="forms">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            {{-- <input type="hidden" name="id" value="{{ $product->id }}">
                            <input type="hidden" name="size" value="{{ $product->size }}"> --}}
                            <div class="form-group">
                                <label>Tên sản phẩm</label>
                                <select class="form-control" id="category_id" name ="category">
                                    @foreach( $products as $pro )
                                        <option  id="{{$pro->id}}" value="{{$pro->id}}">{{$pro->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                             <div class="form-group">
                                <label>Quy cách: (thùng,bao,...)</label>
                                <input type="text" name="size" class="form-control" required="" placeholder="ví dụ: 18 Lít, 5 Lít">
                                <span>(có thể nhập nhiều cách nhau bởi dấu phẩy)</span>
                            </div>
                            <div class="form-group">
                                <label>Số lượng nhập:</label>
                                <input type="text" name="quantity" pattern="[0-9]{,}*" title="Chỉ được nhập số"  class="form-control" placeholder="ví dụ: 100,10">
                                <span>(có thể nhập nhiều cách nhau bởi dấu phẩy, nhập đúng với từng quy cách nhập ở trên)</span>
                            </div>
                            <div class="form-group">
                                <label>Giá Nhập: (VNĐ)</label>
                                <input type="text" name="import_price" pattern="[0-9]{,}*" title="Chỉ được nhập số" class="form-control" required="" placeholder="ví dụ: 100000,4500">
                                <span>(có thể nhập nhiều cách nhau bởi dấu phẩy, nhập đúng với từng quy cách nhập ở trên)</span>
                            </div>
                            <div class="form-group">
                                <label>Giá Bán: (VNĐ)</label>
                                <input type="text" name="export_price" pattern="[0-9]{,}*" title="Chỉ được nhập số" class="form-control" required="" placeholder="ví dụ: 100000,4500">
                                <span>(có thể nhập nhiều cách nhau bởi dấu phẩy, nhập đúng với từng quy cách nhập ở trên)</span>
                            </div>
                            <div style="margin-left: 45%">
                                <button type="submit" id="saveAdd" class="button submit-button btn btn-info btn-lg glyphicon glyphicon-floppy-save" style="border-radius: 10px;">  Lưu</button>
                            </div>
                        </form>
                    </div>
                </div>
            @else
                 <div class="modal-content " style="width: 100%">
                    <div class="modal-header">
                        <h3 class="modal-title" style="margin-left: 45%" id="lineModalLabel">Sửa kho</h3>
                    </div>
                    <div class="modal-body">
                        <div class="dangkythatbai alert alert-danger" style="display:none;"></div>
                        <!-- content goes here -->
                        <form enctype="multipart/form-data" method="post" action="{{route('Edit_Kho')}}" class="forms">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="id" value="{{ $id }}">
                            <div class="form-group">
                                <label>Tên sản phẩm</label>
                                <input type="text" name="name" value="{{ $product->name }}" class="form-control" disabled=""  >
                            </div>
                             <div class="form-group">
                                <label>Quy cách: (thùng,bao,...)</label>
                                <input type="text" name="size" value="{{ $product->size }}" class="form-control" disabled=""  >
                            </div>
                            <div class="form-group">
                                <label>Số lượng nhập:</label>
                                <input type="text" name="quantity" pattern="[0-9]{,}*" title="Chỉ được nhập số"  class="form-control" value="{{ $product->import_quantity }}">
                            </div>
                            <div class="form-group">
                                <label>Giá Nhập: (VNĐ)</label>
                                <input type="text" name="price" pattern="[0-9]{,}*" title="Chỉ được nhập số" class="form-control" required="" value="{{ $product->import_price }}">
                            </div>
                            <div style="margin-left: 45%">
                                <button type="submit" id="saveAdd" class="button submit-button btn btn-info btn-lg glyphicon glyphicon-floppy-save" style="border-radius: 10px;">  Lưu</button>
                            </div>
                        </form>
                    </div>
                </div>
            @endif
        </div>                
    </div>
</div>

@endsection