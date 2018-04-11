<div class = "x_panel">
	<div class="x_title">
		<h4>{{ $disease->name_vi }}</h4>
	</div>
	<div class="x_content"> 
		<p> {{ $disease->description_vi }} </p>
	</div>
</div>

<div class = "x_panel">
	<div class="x_title">
		<h2>Genes</h2>
		<!-- Button to Open the Modal -->
		<div class="pull-right">
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addDiseaseGeneModal">Add Gene</button>
		</div>
		<div class="clearfix"></div>
	</div>
	<div class="x_content"> 
		<table class="table" id="table-genes">
			<thead>
				<th></th>
				<th>Name</th>
				<th>Name in full</th>
				<th>Action</th>
			</thead>
		</table>
	</div>
</div>


<!-- The Modal -->
<div class="modal fade" id="addDiseaseGeneModal">
	<div class="modal-dialog">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title">Add Gene</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body">
				<form>
					<select id = "genes" name="genes" class="form-control">
						@foreach ($genes as $gene)
						<option value="{{ $gene->id }}">{{$gene->name}}</option>
						@endforeach
					</select>
				</form>
			</div>

			<!-- Modal footer -->
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" onclick="addDiseaseGene({{$disease->id}})">Add</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			</div>

		</div>
	</div>
</div>

<script type="text/javascript">
	{!! 'var data_diseases = '.json_encode($disease->genes).';' !!}

	var table = $('#table-genes').DataTable({
		"data": data_diseases,
        "columns": [
            {
                "className":      'details-control',
                "orderable":      false,
                "data":           null,
                "defaultContent": ''
            },
            { "data": "name" },
            { "data": "name_full" },
            // { "data": "synonyms" },
            { "data": null }
        ],
	});

	 // Add event listener for opening and closing details
    $('#table-genes tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row( tr );
 
        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child( format(row.data()) ).show();
            tr.addClass('shown');
        }
    });

    function format ( d ) {
    // `d` is the original data object for the row
    return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
		        '<tr style="border-top: 1px solid black">'+
		            '<td><b>Description:</b></td>'+
		            '<td>'+d.description_vi+'</td>'+
		        '</tr>'+
		        '<tr style="border-top: 1px solid black">'+
		            '<td><b>Synonyms:</b></td>'+
		            '<td>'+d.synonyms+'</td>'+
		        '</tr>'+
		    '</table>';
	}

	// $('#genes').select2({
	// 	ajax: {
	// 		url: '{{route("admin.gene.searchGene")}}',
	// 		data: function (params) {
	// 			var query = {
	// 				search: params.term,
	// 				type: 'public'
	// 			}
	// 		    // Query parameters will be ?search=[term]&type=public
	// 		    return query;
	// 		}
	// 		dataType: 'json'
	// 	    // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
	// 	}
	// });
</script>