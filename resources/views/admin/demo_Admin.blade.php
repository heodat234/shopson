@extends('admin.Admin')
@section("admin.Content")

	<div class="main-grid">
		<div class="agile-grids">
			<div class="table-heading">
				<h2>Basic Tables</h2>
			</div>
			<div>
                            <button id="addRow" onclick="addRow()"  class="btn btn-primary glyphicon glyphicon-plus-sign" style="height: 60px; width: 60px; border-radius: 10px"></button>
                        </div>
            <br>
			<div class="agile-tables">
				<table id="Mytable"  class="table table_bordered table_striped table-nonfluid" align="center">
					<thead>
						{{-- <th><input type="checkbox" id="checkall" /></th> --}}
						<th style="width: 3%; ">ID</th>
						<th style="width: 8%; " >IMAGE</th>
						<th style="width: 25%; ">NAME</th>
						<th style="width: 8%; ">TYPE PRODUCT</th>
						<th style="width: 22%;">DESCRIPTION</th>
						<th style="width: 8%; ">  UNIT PRICE   </th>
						<th style="width: 10%;">PROMOTION PRICE</th>
						
						<th>EDIT/DELETE</th>
					</thead>
					<tbody>
						<tr >
							<td>1</td>
							<td>sadas jhgadasgdasjdba asdhgasudhask </td>
							<td>quángdàdsafdssssssssssssssssssssssssssssfskfjskdfbjksdnfksdjnfksjhhbjkhkjkjkjjkkjjk kjdshfshdf adjkas</td>
							<td>1</td>
							<td>sádgfdgfdg</td>
							<td>423432</td>
							<td>3423423</td>
							<td>
								<button class="btn btn-info btn-lg glyphicon glyphicon-hand-right" style="border-radius: 10px;" id="edit_button" ></button>
								<button class="btn btn-warning btn-lg glyphicon glyphicon-trash" style="border-radius: 10px" id="delete_button" ></button>
							</td>
						</tr>
						<tr >
							<td>2</td>
							<td>sadas</td>
							<td>hung</td>
							<td>1</td>
							<td>sádgfdgfdg</td>
							<td>423432</td>
							<td>3423423</td>
							<td>
								<button class="btn btn-info btn-lg glyphicon glyphicon-hand-right" style="border-radius: 10px;" id="edit_button" ></button>
								<button class="btn btn-warning btn-lg glyphicon glyphicon-trash" style="border-radius: 10px" id="delete_button" ></button>
							</td>
						</tr>
						<tr >
							<td>3</td>
							<td>sadas</td>
							<td>kjfjvd kha</td>
							<td>1</td>
							<td>sádgfdgfdg</td>
							<td>423432</td>
							<td>3423423</td>
							<td>
								<button class="btn btn-info btn-lg glyphicon glyphicon-hand-right" style="border-radius: 10px;" id="edit_button" ></button>
								<button class="btn btn-warning btn-lg glyphicon glyphicon-trash" style="border-radius: 10px" id="delete_button" ></button>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function(){
	$('#Mytable').DataTable();
	});
	</script>
	@endsection