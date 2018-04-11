@extends('layouts.admin')

@section('content')
<form class="form-horizontal form-label-left" action="{{ route('admin.role.update', $role) }}" method="POST" enctype="multipart/form-data">
	{{ method_field('PATCH') }}
	{{ csrf_field() }}
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
						<h2>Edit <small>Role</small></h2>
						<div class="clearfix"></div>
					</div>
					<!-- X-title -->

					<!-- X-content -->
					<div class="x_content">
						<div class="row">
							<div class="col-md-8">
								<div class="form-group">
									<label class="control-label" for="name">Name<span class="required">*</span>
									</label>
									<input type="text" name="name" id="name" required="required" class="form-control" value="{{ $role->name }}">
								</div>
								<div class="form-group">
									<label class="control-label">Permission<span class="required">*</span>
									</label>
									<select name="permissions[]" class="select2 form-control" id="permissions" multiple>
									@foreach ($permissions as $permission)
									<option @if($role->hasPermissionTo($permission->name)) selected @endif value="{{ $permission->id }}">{{ $permission->name }}</option>
									@endforeach
									</select>
								</div>
								<div class="form-group">
									<div class="text-center">
										<a href="{{ route('admin.user.index') }}" class="btn btn-default">Back</a>
										<button class="btn btn-primary">Update</button>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								
							</div>
						</div>
					</div>
					<!-- X-content -->
					<!-- <div class="x_footer">
					</div> -->
					<!-- X-footer -->
				</div>
			</div>
		</div>
	</div>
</form>
@endsection
@section('scripts')
<script type="text/javascript">
	@if ($errors->any())
	toastr.error("{{ $errors->first() }}");
	@endif
	$('.select2').select2({
		placeholder : "-- Select role --",
	});
	$("#avatar").change(function() {
		readURL(this, 'preview-avatar');
	});
</script>
@endsection
