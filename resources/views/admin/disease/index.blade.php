@extends('layouts.admin')

@section('header')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<style type="text/css">
	td.details-control {
		background: url('/images/details_open.png') no-repeat center center;
		cursor: pointer;
	}
	tr.shown td.details-control {
		background: url('/images/details_close.png') no-repeat center center;
	}
</style>
@endsection

@section('content')
<div class="">
	<div class="page-title">
		<div class="title_left">
			<h3>Disease</h3>
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
						<a href="{{ route('admin.disease.create') }}" class="btn btn-primary">Create</a>
					</div>
					<div class="clearfix"></div>
				</div>
				<!-- X-title -->
				<!-- X-content -->
				<div class="x_content">
					<div class="row">
						<div class="col-md-6">
							<table id="table-disease" class="table table-bordered table-hover">
								<thead>
									<tr>
										<th>Name</th>
									</tr>
								</thead>
							</table>
						</div>
						<div id="detail" class="col-md-6"></div>
					</div>
				</div>
				<!-- X-content -->
			</div>
		</div>
	</div>
</div>
@endsection

@section('scripts')
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
	function deleteItem(index) {
		var url = $(index).attr('href');
		$('#modal-delete').modal('show');
		$('#form-delete').attr('action', url);
	}

	$('#modal-delete').on('shown', function() {
		$('#genes').val('');
    })

	$('#link-delete').on('click', function(e) {
		e.preventDefault();
		$('#form-delete').submit();
		$('#modal-delete').modal('hide');
	});

	function getDetail(url){
		$.ajax({
			url : url,
		}).done(function (response){
				$('#detail').empty();
				$('#detail').append(response);
			}
		)
	}

	function addDiseaseGene(disease_id){
		var gene_name = $('#genes').val();
		$.ajax({
			url : "{{ route('admin.disease.addDiseaseGene') }}",
			data: {gene_name:gene_name, disease_id:disease_id},
			type: 'GET'
		}).done(function (response){
			if (response==0) {
				toastr.error('Add gene error. Please try again');
			}else{
				getDetail(response);
			}
			$('#addDiseaseGeneModal').modal('hide');
			
		});
	}

	var table = $('#table-disease').DataTable({
				processing: true,
				serverSide: true,
				ajax: "{{route('admin.disease.getData')}}",
				"columns":[
					{
						data :'name_en',
						render : function(data, type, full, meta) {
							return '<a href="#" onclick=getDetail("'+full.detail_url+'"); return false;>'+data+'</a>';
						}
					},
				],
			
		});
</script>
@endsection
