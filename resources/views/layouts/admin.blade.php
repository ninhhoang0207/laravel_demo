<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<!-- Meta, title, CSS, favicons, etc. -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>@yield('title')| Laravel</title>
	<!-- Bootstrap library-->
	<link href="{{asset('backend/css/bootstrap.min.css')}}" rel="stylesheet">
	<!-- Font-awsome -->
	<link href="{{asset('backend/css/font-awesome.min.css')}}" rel="stylesheet">
	<!-- Bootstrap library-->
	<link href="{{asset('backend/css/nprogress.css')}}" rel="stylesheet">
	<!-- Toastr -->
	<link href="{{asset('backend/css/toastr.min.css')}}" rel="stylesheet">
	<!-- Select 2 -->
	<link rel="stylesheet" type="text/css" href="{{ asset('backend/css/select2.css') }}">
	<!-- Swtich button -->
	<link rel="stylesheet" type="text/css" href="{{ asset('backend/css/switchery.css') }}">
	<!-- Check button -->
	<link rel="stylesheet" type="text/css" href="{{ asset('backend/iCheck/skins/flat/green.css') }}">
	<!-- Custom Theme Style -->
	<link href="{{ asset('backend/build/css/custom.css') }}" rel="stylesheet">
	<!-- Date Picker -->
	<link rel="stylesheet" href="{{asset('backend/css/bootstrap-datepicker3.css')}}"/>
	<!-- Data table -->
	<link rel="stylesheet" type="text/css" href="{{ asset('backend/css/dataTables.min.css') }}"/>
	<!-- Tags	 -->
	<link rel="stylesheet" type="text/css" href="{{ asset('backend/tags/src/tagsinput.css') }}">

	@yield('header')
</head>

<body class="nav-md">
	<div class="container body">
		<div class="main_container">
			@include('includes/admin/sidebar_menu')
			@include('includes/admin/top_menu')
			<!-- page content -->
			<div class="right_col" role="main">
				@yield('content')
			</div>
		</div>
	</div>
	<!-- Modal delete-->
	<div id="modal-delete" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Remove</h4>
				</div>
				<div class="modal-body">
				<p>Comfirm delete?</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
					<a href="" id="link-delete"  class="btn btn-danger" >Delete</a>
				</div>
			</div>
		</div>
	</div>
</body>

<!-- jQuery -->
<script src="{{asset('backend/js/jquery.min.js')}}"></script>
<!-- Bootstrap -->
<script src="{{asset('backend/js/bootstrap.min.js')}}"></script>
<!-- Moment -->
<script src="{{asset('backend/js/moment.min.js')}}"></script>
<!-- NProgress -->
<script src="{{asset('backend/js/nprogress.js')}}"></script>
<!-- Select 2 -->
<script type="text/javascript" src="{{ asset('backend/js/select2.js') }}"></script>
<!-- Switch button -->
<script type="text/javascript" src="{{ asset('backend/js/switchery.js') }}"></script>
<!-- Toastr -->
<script type="text/javascript" src="{{ asset('backend/js/toastr.min.js') }}"></script>
<!-- Checkbox -->
<script type="text/javascript" src="{{ asset('backend/iCheck/icheck.js') }}"></script>
<!-- Custom Theme Scripts -->
<script src="{{asset('backend/build/js/custom.min.js')}}"></script>
<!-- Date Picker -->
<script type="text/javascript" src="{{asset('backend/js/bootstrap-datepicker.min.js')}}"></script>
<!-- TinyMCE editor -->
<script src="{{ asset('backend/vendor/laravel-filemanager/js/lfm.js') }}"></script>
<script src="{{ asset('backend/js/tinymce/tinymce.min.js') }}"></script>
<!-- Tags -->
<script src="{{ asset('backend/tags/src/tagsinput.js') }}"></script>
<!-- Data Table -->
<script src="{{ asset('backend/js/dataTables.min.js') }}"></script>

<!-- Admin JS -->
<script type="text/javascript" src="{{ asset('backend/js/admin.js') }}"></script>
<script type="text/javascript">
	@if (Session::has('success')) 
	toastr.success('{{ Session::get("success") }}');
	@endif
	@if (Session::has('warning')) 
	toastr.warning('{{ Session::get("warning") }}');
	@endif
	@if (Session::has('error')) 
	toastr.error('{{ Session::get("error") }}');
	@endif

	$(document).ready(function() {
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
		});
	});

	$('.datepicker').datepicker({
		format : 'dd/mm/yyyy'
	});

	function removeItem(index) {
		var url = $(index).attr('href');
		$('#modal-delete').modal('show');
		$('#link-delete').attr('href', url);
	}
</script>
@yield('scripts')
</html>
