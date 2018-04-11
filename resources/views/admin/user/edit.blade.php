@extends('layouts.admin')

@section('content')
<form class="form-horizontal form-label-left" method="POST" enctype="multipart/form-data">
	{{ csrf_field() }}
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
						<h2>Create <small>Account</small></h2>
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
									<input type="text" name="name" id="name" required="required" class="form-control" value="{{ $user->name }}">
								</div>
								<div class="form-group">
									<label class="control-label" for="email">Email<span class="required">*</span>
									</label>
									<input type="email" name="email" id="email" required="required" class="form-control col-md-7 col-xs-12" value="{{ $user->email }}" readonly>
								</div>
								<div class="form-group">
									<label class="control-label" for="password">Password</label>
									<input type="password" name="password" id="password" class="form-control">
								</div>
								<div class="form-group">
									<label class="control-label" for="password-confirmation">Password Confirmation</label>
									<input type="password" name="password_confirmation" id="password-confirmation" class="form-control">
								</div>
								<div class="form-group">
									<label class="control-label" for="phone">Phone</span>
									</label>
									<input type="text" name="phone" id="phone" class="form-control" value="{{ $user->phone }}">
								</div>
								<div class="form-group">
									<label class="control-label" for="address">Address</label>
									<input type="text" name="address" id="address" class="form-control" value="{{ $user->address }}">
								</div>

							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label">Role<span class="required">*</span>
									</label>
									<select name="roles[]" class="select2 form-control" id="role" multiple>
									@foreach ($roles as $role)
									<option value="{{ $role->id }}" @if($user->hasRole($role->name)) selected @endif>{{ $role->name }}</option>
									@endforeach
									</select>
								</div>
								<div class="form-group">
									<label class="control-label">Birthday</label>
									<input class="form-control datepicker" name="birthday" value="{{ isset($user->birthday)?Carbon\Carbon::parse($user->birthday)->format('d/m/Y') : '' }}"></input>
								</div>
								<div class="form-group">
									<label class="control-label" for="avatar">Avatar</label>
									<input type="file" name="avatar" id="avatar" class="form-control col-md-7 col-xs-12">
									<div class="form-group">
										<img src="@if ($user->avatar) {{ asset($user->avatar) }} @endif" class="img img-thumbnail" id="preview-avatar" width="500px" height="auto">
									</div>
								</div>
								<div class="form-group">
									<div class="text-center">
										<a href="{{ route('admin.user.index') }}" class="btn btn-default">Back</a>
										<button class="btn btn-primary">Update</button>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- X-content -->
					<div class="x_footer">
						
					</div>
					<!-- X-footer -->
				</div>
			</div>
		</div>
		<div class="row">
			<div class="clearfix"></div>
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<!-- X-footer -->
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
