@extends('layouts.admin')
@section('content')
<div class="">
	<div class="page-title">
		<div class="title_left">
			<h3>User</h3>
		</div>
	</div>
	<div class="clearfix"></div>
	<div class="row">
		<div class="clearfix"></div>
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<!-- X-title -->
				<div class="x_title">
					<h2>Manager</h2>
					<a href="{{ route('admin.user.create') }}" class="btn btn-primary pull-right">Create</a>
					<div class="clearfix"></div>
				</div>
				<!-- X-title -->
				<!-- X-content -->
				<div class="x_content">
					<table id="table-user-not-active" class="table table-bordered table-hover">
						<thead>
							<tr>
								<th>ID</th>
								<th>Username</th>
								<th>Email</th>
								<th>Role</th>
								<th>Created_at</th>
								<th>Chức năng</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($users as $key => $user)
							<tr>
								<td>{{ $key+1 }}</td>
								<td>{{ $user->name }}</td>
								<td>{{ $user->email }}</td>
								<td>{{ count($user->getRoleNames()) ? $user->getRoleNames() : 'N/A' }}</td>
								<td>{{ $user->created_at->format('d/m/Y') }}</td>
								<td>
									<a class="btn btn-warning btn-xs" href="{{ route('admin.user.edit', ['id'=>$user->id]) }}">Edit</a>
									<a class="btn btn-danger btn-xs" href="{{ route('admin.user.destroy', ['id'=>$user->id]) }}" onclick="removeItem(this); return false;">Remove</a>
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
