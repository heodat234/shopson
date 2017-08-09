@extends("admin.Admin")
@section('admin.Content')

<div class="main-grid">
    <div class="agile-grids">
        
        
        <div class="container">
        @if(Session::has('thatbai'))
            <div class="alert alert-error">{{Session::get('thatbai')}}</div>
        @endif
            @if($id!=0)
                <div class="modal-content " style="width: 100%">
                    <div class="modal-header">
                        
                        <h3 class="modal-title" style="margin-left: 40%" id="lineModalLabel">Sửa Loại Sản Phẩm</h3>
                    </div>
                    <div class="modal-body">
                        <div class="dangkythatbai alert alert-danger" style="display:none;"></div>
                        <!-- content goes here -->
                        <form enctype="multipart/form-data" method="post" action="{{route('Edit_Category')}}" class="forms">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="id" value="{{$id}}">
                            <input type="hidden" name="imageOld" value="{{ $category->image }}">
                            <div class="form-group">
                                <label>Tên Loại</label>
                                <input type="text" name="name" class="form-control" value="{{ $category->name }}" required="">
                            </div>
                            <div class="form-group">
                                <label>Tên Loại Cha</label>
                                <select class="form-control" id="type_cha" name ="type_cha">
                                    @if($category->type_cha==0)
                                        <option  id="0" value="0">Không có loại cha</option>
                                    @else
                                        @foreach( $typeParent as $typeCha )
                                            <option  id="{{$typeCha->id}}" value="{{$typeCha->id}}">{{$typeCha->name}}</option>
                                        @endforeach
                                        <script type="text/javascript">
                                            var id={{$category->type_cha}};
                                            $('#'+id).attr('selected','selected');
                                        </script>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Ảnh</label>
                                <input class="form-control" id="f" type="file" name="image" onchange="file_change(this)" />
                                <img style="width: 100px;height: 100px" id="img" src="images/products/{{ $category->image }}">
                            </div>
                            <div class="form-group">
                                <label>Mô tả</label>
                                <textarea id="ckeditor" name="desc">{!! $category->description !!}</textarea>
                            </div>
                            <div style="margin-left: 45%">
                                <button type="submit" id="saveEdit" class="button submit-button btn btn-info btn-lg glyphicon glyphicon-floppy-save" style="border-radius: 10px;">  Save</button>
                            </div>
                        </form>

                    </div>
                </div>
            @else
                <div class="modal-content " style="width: 100%">
                    <div class="modal-header">
                        
                        <h3 class="modal-title" style="margin-left: 40%" id="lineModalLabel">Thêm Loại Sản Phẩm</h3>
                    </div>
                    <div class="modal-body">
                        <div class="dangkythatbai alert alert-danger" style="display:none;"></div>
                        <!-- content goes here -->
                        <form enctype="multipart/form-data" method="post" action="{{route('Insert_Category')}}" class="forms">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <label>Tên Loại</label>
                                <input type="text" name="name" class="form-control"  required="">
                            </div>
                            <div class="form-group">
                                <label>Tên Loại Cha</label>
                                <select class="form-control" id="type_cha" name ="type_cha">
                                        <option  id="0" value="0">Không có loại cha</option>
                                        @foreach( $typeParent as $typeCha )
                                            <option  id="{{$typeCha->id}}" value="{{$typeCha->id}}">{{$typeCha->name}}</option>
                                        @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Ảnh</label>
                                <input class="form-control" id="f" type="file" name="image" onchange="file_change(this)" required="" title="Bạn chưa chọn hình" />{{-- <input type="button" value="Chọn ảnh" onclick="document.getElementById('f').click()" /> --}}
                                <img style="width: 100px;height: 100px" id="img"  style="display: none;">
                            </div>
                            <div class="form-group">
                                <label>Mô tả</label>
                                <textarea id="ckeditor" name="desc"></textarea>
                            </div>
                            <div style="margin-left: 45%">
                                <button type="submit" id="saveAdd" class="button submit-button btn btn-info btn-lg glyphicon glyphicon-floppy-save" style="border-radius: 10px;">  Save</button>
                            </div>
                        </form>

                    </div>
                </div>
            @endif  
        </div>
                        
    </div>
</div>
<script>
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
        //console.log(e.target.result);
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
                    // console.log(f.files[0]);
                    break;
                default:
                    alert(' Bạn chỉ được chọn file ảnh.');
                    $('#f').val(null);
            }
    
    }


    </script>
@endsection