@extends('admin.Admin')
@section("admin.Content")
<div class="main-grid" style="overflow: scroll;">
	@if(Session::has('thanhcong'))
          <div class="alert alert-success">{{Session::get('thanhcong')}}</div>
    @endif
	<div class="social grid">
		<br>
		<div class="table-heading">
            <h2>HÀNG LỖI</h2>
        </div>
        <div class="xoa alert alert-danger" style="display:none;"></div>
        <br>
        <div class="agile-tables">
            <table class="table table_bordered table_striped table-nonfluid" align="center" id="Mytable" >
                <thead>
                    <th>Mã </th>
                    <th style="width: 25%;">Tên sản phẩm</th>
                    <th style="width: 20%;">Quy cách</th>
                    <th>Số lượng lỗi</th>
                    <th>Sửa số lượng lỗi</th>
                </thead>
                <tbody>
                    @foreach($exports as $export )
                        <tr id="row{{$export->id}}">
                            <td>{{ $export->id }}</td>
                            <td>{{$export->name}}</td>
                            <td>{{$export->size}}</td>
                            <td>{{$export->error_quantity}}</td>
                            <td>
                                <a href="#" data-toggle="modal" data-target="#editProfile" data-original-title="Sửa thông tin" data-toggle="tooltip" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-edit"></i> Sửa số lượng hàng lỗi</a>
                            </td>
                        </tr>

						<!-- edit error quantity -->
					    <div class="modal fade" id="editProfile" tabindex="-1" role="dialog">
						    <div class="modal-dialog">
						        <div class="modal-content " style="width: 100%">
				                    <div class="modal-header">
				                        <h3 style="margin-left: 37%" class="modal-title" id="lineModalLabel">Sửa thông tin</h3>
				                    </div>
				                    <div class="modal-body">
				                        <div class="dangkythatbai alert alert-danger" style="display:none;"></div>
				                        <form enctype="multipart/form-data" method="post" action="{{ route('updateErrorQuantity') }}">
				                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
				                            <input type="hidden" name="id" value="{{ $export->id }}">
				                            <div class="form-group">
				                                <label>Tên sản phẩm</label>
				                                <input type="text" class="form-control" value="{{$export->name }}" disabled="">
				                            </div>
				                            <div class="form-group">
				                                <label>Quy cách</label>
				                                <input type="text" class="form-control" value="{{ $export->size}}" disabled="">
				                            </div>
				                            <div class="form-group">
				                                <label>Số lượng lỗi</label>
				                                <input type="text" name="error" pattern="[0-9]*" title="Số lượng chỉ được là số " class="form-control" value="{{$export->error_quantity}}" required="">
				                            </div>
				                            <div style="margin-left: 40%" >
				                            <button type="submit" class="button submit-button btn btn-info btn-lg glyphicon glyphicon-floppy-save" style="border-radius: 10px;">  Lưu</button>
				                            </div>
				                        </form>
				                    </div>
				                </div>
				            </div>
						</div>
					    <!-- end edit Profile -->

                    @endforeach
                </tbody>
            </table>
        </div>
	</div>
</div>
<script type="text/javascript">
      $(document).ready(function() {
        $('#Mytable').DataTable();
  
});
      
    </script>
@endsection