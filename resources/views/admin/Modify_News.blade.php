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
                        
                        <h3 class="modal-title" style="margin-left: 45%" id="lineModalLabel">Sửa Tin</h3>
                    </div>
                    <div class="modal-body">
                        <div class="dangkythatbai alert alert-danger" style="display:none;"></div>
                        <!-- content goes here -->
                        <form enctype="multipart/form-data" method="post" action="{{route('Edit_News')}}" class="forms">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="id" value="{{$id}}">
                            <div class="form-group">
                                <label>Tiêu đề</label>
                                <input type="text" name="title" class="form-control" value="{{ $new->title }}" required="">
                            </div>
                            <div class="form-group">
                                <label>Mô tả</label>
                                <textarea id="ckeditor"  name="content">{!! $new->content !!}</textarea>
                            </div>
                            <div style="margin-left: 45%">
                                <button type="submit" id="saveEdit" class="button submit-button btn btn-info btn-lg glyphicon glyphicon-floppy-save" style="border-radius: 10px;">  Lưu</button>
                            </div>
                        </form>

                    </div>
                </div>
            @else
                <div class="modal-content " style="width: 100%">
                    <div class="modal-header">
                        
                        <h3 class="modal-title" style="margin-left: 43%" id="lineModalLabel">Thêm Tin Mới</h3>
                    </div>
                    <div class="modal-body">
                        <div class="dangkythatbai alert alert-danger" style="display:none;"></div>
                        <!-- content goes here -->
                        <form enctype="multipart/form-data" method="post" action="{{route('Insert_News')}}" class="forms">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <label>Tiêu đề</label>
                                <input type="text" name="title" class="form-control"  required="">
                            </div>
                            <div class="form-group">
                                <label>Mô tả</label>
                                <textarea id="ckeditor" name="content" required=""></textarea>
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
<script>
    CKEDITOR.replace( 'ckeditor',{
        filebrowserBrowseUrl : '../public/ckeditor/ckfinder/ckfinder.html',
        filebrowserImageBrowseUrl : '../public/ckeditor/ckfinder/ckfinder.html?type=Images',
        filebrowserFlashBrowseUrl : '../public/ckeditor/ckfinder/ckfinder.html?type=Flash',
        filebrowserUploadUrl : '../public/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
        filebrowserImageUploadUrl : '../public/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
        filebrowserFlashUploadUrl : '../public/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
    });
    
   

    </script>
@endsection