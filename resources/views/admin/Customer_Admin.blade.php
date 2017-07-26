@extends('admin.Admin')
@section("admin.Content")

	<div class="main-grid">
		<div class="agile-grids">
			<div class="table-heading">
				<h2>Customer</h2>
			</div>
			
			<div class="agile-tables">
				<table id="Mytable"  class="table table_bordered table_striped table-nonfluid" align="center">
					<thead>
						{{-- <th><input type="checkbox" id="checkall" /></th> --}}
						<th style="width: 5%; ">ID</th>
						<th style="width: 25%; " >NAME</th>
						<th style="width: 25%; ">EMAIL</th>
						<th style="width: 15%; ">PHONE</th>
						<th style="width: 25%;">ADDRESS</th>
						
						<th>EDIT/DELETE</th>
					</thead>
					<tbody>
					@foreach($customer as $cus)
						<tr >
							<td>{{ $cus->id }}</td>
							<td>{{ $cus->full_name }} </td>
							<td>{{ $cus->email }}</td>
							<td>{{ $cus->phone }}</td>
							<td>{{ $cus->address }}</td>
							<td>
								<button class="btn btn-info btn-lg glyphicon glyphicon-hand-right" style="border-radius: 10px;" id="edit_button" ></button>
								
							</td>
						</tr>
					@endforeach
						
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