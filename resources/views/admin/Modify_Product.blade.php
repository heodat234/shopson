@extends("admin.Admin")
@section('admin.Content')

<div class="main-grid">
    <div class="agile-grids">
        <div class="container" style="margin: auto; float: center;">
        @if(Session::has('thatbai'))
            <div class="alert alert-error">{{Session::get('thatbai')}}</div>
        @endif
            @if($id==0)
                <div class="modal-content " style="width: 100%">
                    <div class="modal-header">
                        <h3 class="modal-title" style="margin-left: 40%" id="lineModalLabel">Thêm sản phẩm mới</h3>
                    </div>
                    <div class="modal-body">
                        <div class="dangkythatbai alert alert-danger" style="display:none;"></div>
                        <!-- content goes here -->
                        <form enctype="multipart/form-data" method="post" action="{{route('Insert_Product')}}" class="forms">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <label>Tên sản phẩm</label>
                                <input type="text" name="name" class="form-control" required="">
                            </div>
                            <div class="form-group">
                                <label>Loại sản phẩm</label>
                                <select class="form-control" id="category_id" name ="category">
                                    @foreach( $typeChild as $typecon )
                                        <option  id="{{$typecon->id}}" value="{{$typecon->id}}">{{$typecon->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Ảnh</label>
                                <input class="form-control" id="f" type="file" name="image" onchange="file_change(this)" required="" title="Bạn chưa chọn hình" />
                                <img style="width: 100px;height: 100px" id="img"  style="display: none;">
                            </div>
                            <div class="form-group">
                                <label>Loại chức năng</label>
                                <select class="form-control" id="type_id" name ="type">
                                    <option  id="0" value="0">Nội thất</option>
                                    <option  id="1" value="1">Ngoại thất</option>
                                    <option  id="2" value="2">Khác</option>
                                </select>
                            </div>
                             <div class="form-group">
                                <label>Quy cách:(thùng,bao,...)</label>
                                <input type="text" name="size" class="form-control" required="" placeholder="ví dụ: 18 Lít, 5 Lít">
                                <span>(có thể nhập nhiều cách nhau bởi dấu phẩy)</span>
                            </div>
                             <div class="form-group">
                                <label>Giá nhập</label>
                                <input type="text" name="import_price" pattern="[0-9]{,}*" title="Chỉ được nhập số" class="form-control" required="" placeholder="ví dụ: 10000">
                                <span>(có thể nhập nhiều cách nhau bởi dấu phẩy, nhập đúng với từng quy cách nhập ở trên)</span>
                            </div>
                            <div class="form-group">
                                <label>Số lượng nhập</label>
                                <input type="text" name="import_quantity" pattern="[0-9]{,}*" title="Chỉ được nhập số" class="form-control" required="" placeholder="ví dụ: 100">
                                <span>(có thể nhập nhiều cách nhau bởi dấu phẩy, nhập đúng với từng quy cách nhập ở trên)</span>
                            </div>
                            <div class="form-group">
                                <label>Giá bán</label>
                                <input type="text" name="export_price" pattern="[0-9]{,}*" title="Chỉ được nhập số" class="form-control" required="" placeholder="ví dụ: 100000">
                                <span>(có thể nhập nhiều cách nhau bởi dấu phẩy, nhập đúng với từng quy cách nhập ở trên)</span>
                            </div>
                            <div class="form-group">
                                <label>Mô tả sản phẩm</label>
                                <textarea id="ckeditor" name="description"></textarea>

                            </div>
                            <div style="margin-left: 45%">
                            <button type="submit" id="saveAdd" class="button submit-button btn btn-info btn-lg glyphicon glyphicon-floppy-save" style="border-radius: 10px;">  Lưu</button>
                            </div>
                        </form>
                    </div>
                </div>
            {{-- end add form --}}
            @elseif($id>0)

                <div class="modal-content " style="width: 100%">
                    <div class="modal-header">
                        <h3 class="modal-title" style="margin-left: 40%" id="lineModalLabel">Sửa sản phẩm</h3>
                    </div>
                    <div class="modal-body">
                        <div class="dangkythatbai alert alert-danger" style="display:none;"></div>
                        <!-- content goes here -->
                        <form enctype="multipart/form-data" method="post" action="{{route('Edit_Product')}}" class="forms">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="id" value="{{ $product->id }}">
                            <input type="hidden" name="idsize" value="{{ $product->idsize }}">
                            <input type="hidden" name="imageOld" value="{{ $product->image }}">
                            <div class="form-group">
                                <label>Tên sản phẩm</label>
                                <input type="text" name="name" value="{{ $product->name }}" class="form-control" required="">
                            </div>
                            <div class="form-group">
                                <label>Loại sản phẩm</label>
                                <select class="form-control" id="category_id" name ="category">
                                    @foreach( $typeChild as $typecon )
                                        <option  id="{{$typecon->id}}" value="{{$typecon->id}}">{{$typecon->name}}</option>
                                    @endforeach
                                    <script type="text/javascript">
                                        var id={{$product->id_type}};
                                        $('#'+id).attr('selected','selected');
                                    </script>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Ảnh</label>
                                <input class="form-control" id="f" type="file" name="image" accept="image/*" onchange="file_change(this)" />
                                <img id="img" src="images/products/{{ $product->image }}" style="width: 90px;height: 90px">
                            </div>
                            <div class="form-group">
                                <label>Loại chức năng</label>
                                <select class="form-control" id="type_id" name ="type">
                                    <option  id="0" value="0">Nội thất</option>
                                    <option  id="1" value="1">Ngoại thất</option>
                                    <option  id="2" value="2">Khác</option>
                                    <script type="text/javascript">
                                        var id={{$product->type}};
                                        $('#'+id).attr('selected','selected');
                                    </script>
                                </select>
                            </div>
                             <div class="form-group">
                                <label>Loại thùng</label>
                                <input type="text" name="size" value="{{ $product->size }}" class="form-control" disabled="">
                            </div>
                            <div class="form-group">
                                <label>Giá bán</label>
                                <input type="text" name="export_price" value="{{ $product->export_price }}" pattern="[0-9]*" title="Chỉ được nhập số" class="form-control" required="">
                            </div>
                            <div class="form-group">
                                <label>Mô tả sản phẩm</label>
                                <textarea id="ckeditor" name="description" >{{ $product->description }}</textarea>
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
                        <h3 class="modal-title" style="margin-left: 45%" id="lineModalLabel">Nhập kho</h3>
                    </div>
                    <div class="modal-body">
                        <div class="dangkythatbai alert alert-danger" style="display:none;"></div>
                        <!-- content goes here -->
                        <form enctype="multipart/form-data" method="post" action="{{route('Insert_Import_Product')}}" class="forms">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="id" value="{{ $product->id }}">
                            <input type="hidden" name="size" value="{{ $product->size }}">
                            <div class="form-group">
                                <label>Tên sản phẩm</label>
                                <input type="text" name="name" value="{{ $product->name }}" class="form-control" disabled="" required="">
                            </div>
                             <div class="form-group">
                                <label>Quy cách</label>
                                <input type="text" name="size" value="{{ $product->size }}" class="form-control" disabled="">
                            </div>
                            <div class="form-group">
                                <label>Số lượng nhập: (thùng,bao)</label>
                                <input type="text" name="quantity" pattern="[0-9]*" title="Chỉ được nhập số"  class="form-control" placeholder="ví dụ: 100">
                            </div>
                            <div class="form-group">
                                <label>Giá nhập: (VNĐ)</label>
                                <input type="text" name="import_price" pattern="[0-9]*" title="Chỉ được nhập số" class="form-control" required="" placeholder="ví dụ: 100000">
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
<script type="text/javascript">
    CKEDITOR.replace( 'ckeditor',{
        filebrowserBrowseUrl : '../public/ckeditor/ckfinder/ckfinder.html',
        filebrowserImageBrowseUrl : '../public/ckeditor/ckfinder/ckfinder.html?type=Images',
        filebrowserFlashBrowseUrl : '../public/ckeditor/ckfinder/ckfinder.html?type=Flash',
        filebrowserUploadUrl : '../public/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
        filebrowserImageUploadUrl : '../public/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
        filebrowserFlashUploadUrl : '../public/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
    });


    function file_change(f){

    var reader = new FileReader();
    reader.onload = function (e) {
        var img = document.getElementById("img");
        img.src = e.target.result;
        img.style.display = "inline";
    };
    var ftype =f.files[0].type;
    switch(ftype)
            {
                case 'image/png':
                case 'image/gif':
                case 'image/jpeg':
                case 'image/pjpeg':
                    reader.readAsDataURL(f.files[0]);
                    break;
                default:
                    alert(' Bạn chỉ được chọn file ảnh.');
                   $('#f').val(null);
            }
    
    }
    
</script>
@endsection