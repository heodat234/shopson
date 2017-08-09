@extends('admin.Admin')
@section("admin.Content")
            
<div class="main-grid" style="overflow: scroll;">
    <div class="agile-grids">
        <div class="table-heading">
            <h2>Tin tức</h2>
        </div>

            <div>
                <button id="addRow" onclick="addRow()"  class="btn btn-primary glyphicon glyphicon-plus-sign" style="height: 60px; width: 60px; border-radius: 10px"></button>
            </div> 
            <br>
             <table border="1" class="table table-admin table-striped table-nonfluid" align="center" id="news_table" >
                <thead>
                        <th style="width: 3%">Mã tin</th>
                        <th style="width: 10%">Tên người viết</th>
                        <th style="width: 18%;">Tiêu đề</th>
                        <th style="width: 50%;">Nội dung</th> 
                        <th>Ngày tạo</th>
                        <th>Sửa/xóa</th>
                </thead>
                <tbody>
                    @foreach($news as $new)
                        <tr id="row{{$new->id }}">
                            <div id="row1{{$new->id }}">
                                <td id="id{{$new->id }}">{{$new->id }}</td>
                                <td>{{$new->full_name }}</td>
                                <td>{{ $new->title }}</td>
                                <td id="content{{ $new->id }}">{!!str_limit($new->content,$limit =500, $end='...')!!}
                                {{-- <button class="btn btn-success" style="border-radius: 10px" onclick="readMore({{ $new->id }});">Xem thêm</button> --}}
                                </td>
                                <td>{{ date('d-m-Y - H:i:s',strtotime($new->created_at)) }}</td>
                                <td>
                                    <button class="btn btn-info btn-lg glyphicon glyphicon-hand-right" style="border-radius: 10px;" id="edit_button{{ $new->id  }}" onclick="editRow({{ $new->id }})"></button>
                                    <button class="btn btn-warning btn-lg glyphicon glyphicon-trash" style="border-radius: 10px" id="delete_button{{ $new->id  }}" onclick="delete_row('{{ $new->id  }}');"></button>
                                </td>
                            </div>
                        </tr>
                        <div id="noidung{{ $new->id }}" style="display: none;">{!! $new->content !!}</div>     
                    @endforeach
                </tbody>
            </table>    
                        
        </div>
    </div>
</div>
    <script type="text/javascript">
            // function readMore($id) {
    
            //     var content = $('#noidung'+$id).val();
                
            //     $('#content'+$id).html(content+"<button>Thu gọn</button>");
        
            // }
            $(document).ready(function(){
                $('#news_table').DataTable();
            });
            
            function editRow($id){
                var  route="{{route('ViewPage_EditNews','idnews')}}";
                route=route.replace('idnews',$id)
              window.location.replace(route);
            }
            function addRow(){
                var  route="{{route('ViewPage_InsertNews')}}";
              window.location.replace(route);
        
            }
             
            function delete_row(id)
            {
                ssi_modal.confirm({
                content: 'bạn có muốn xóa tin này không?',
                okBtn: {
                className:'btn btn-primary'
                },
                cancelBtn:{
                className:'btn btn-danger'
                }
                },function (result) {
                    if(result)
                    {
                        var route="{{ route('Delete_News') }}";
                        $.ajax({
                            url:route,
                            type:'get',
                            data:{
                                id:id,
                            },
                            success:function() {  
                                 $('#row'+id).hide();
                                ssi_modal.notify('success', {content: 'Xóa Thành Công'});
                            }
                        });
                    }
                    else
                        ssi_modal.notify('error', {content: 'Hủy Xóa'});
                }
            );
            }

    </script>
@endsection