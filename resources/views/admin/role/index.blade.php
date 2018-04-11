@extends('layouts.admin')
@section('content')
<div class="">
	<div class="page-title">
		<div class="title_left">
			<h3>Role</h3>
		</div>
	</div>
	<div class="clearfix"></div>
	<div class="row">
		<div class="clearfix"></div>
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<!-- X-title -->
				<div class="x_title">
					<h2>Management</h2>
					<div class="pull-right">
						<a href="{{ route('admin.role.create') }}" class="btn btn-primary">Create</a>
					</div>
					<div class="clearfix"></div>
				</div>
				<!-- X-title -->
				<!-- X-content -->
				<div class="x_content">
					<table id="table-user-not-active" class="table table-bordered table-hover">
						<thead>
							<tr>
								<th>ID</th>
								<th>Name</th>
								<th>Guard name</th>
								<th>Permissions</th>
								<th>Created_at</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							@foreach ($roles as $key => $role)
							<tr>
								<td>{{ $key+1 }}</td>
								<td>{{ $role->name }}</td>
								<td>{{ $role->guard_name }}</td>
								<td>{{ $role->permissions->implode('name', ', ') }}</td>
								<td>{{ $role->created_at->format('d/m/Y') }}</td>
								<td>
									<a class="btn btn-warning btn-xs" href="{{ route('admin.role.edit', $role) }}">Edit</a>
									<a class="btn btn-danger btn-xs" href="{{ route('admin.role.destroy', $role) }}" onclick="deleteItem(this); return false;">
										Remove
									</a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				<!-- X-content -->
			</div>

		</div>
	</div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
	var table = $('.table').DataTable();
	// function deleteItem(index) {
	// 	var url = $(index).attr('href');
	// 	$('#modal-delete').modal('show');
	// 	$('#form-delete').attr('action', url);
	// }

	// $('#link-delete').on('click', function(e) {
	// 	e.preventDefault();
	// 	$('#form-delete').submit();
	// 	$('#modal-delete').modal('hide');
	// });
</script>
@endsection
