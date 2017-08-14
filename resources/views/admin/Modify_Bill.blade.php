@extends("admin.Admin")
@section('admin.Content')

<div class="main-grid">
    <div class="agile-grids">
        

            {{-- add form --}}
            <div class="container">
                <div class="modal-content " style="width: 100%">
                    <div class="modal-header">
                        
                        <h3 style="margin-left: 40%" class="modal-title" id="lineModalLabel">Sửa tình trạng hóa đơn</h3>
                    </div>
                    <div class="modal-body">
                        <div class="dangkythatbai alert alert-danger" style="display:none;"></div>
                        <!-- content goes here -->
                        <form enctype="multipart/form-data" method="post" action="{{route('Update_Bill')}}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="methodOld" value="{{ $bill->method }}">
                            <input type="hidden" name="id" value="{{$id}}">
                            <div class="form-group">
                                <label>Mã hóa đơn</label>
                                <input type="text" name="new_password" class="form-control" value="{{ $id }}" disabled="">
                            </div>
                            <div class="form-group">
                                <label>Tên người mua</label>
                                <input type="text" name="new_size" class="form-control" value="{{ $bill->name }}" disabled="">
                            </div>
                            <div class="form-group">
                                <label>Tình trạng</label>
                                <select class="form-control" name="method">
                                    <option value="0" id="0">Chưa xác nhận</option>
                                    <option value="1" id="1">Đã xác nhận, chưa thanh toán</option>
                                    <option value="2" id="2">Đã thanh toán</option>
                                    <script type="text/javascript">
                                         var id={{$bill->method}};
                                        $('#'+id).attr('selected','selected');
                                        </script>
                                </select>
                            </div>
                            <div style="margin-left: 45%" >
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

    
</script>
@endsection