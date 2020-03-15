@extends('layouts.master')

@section('title','Disaster | Aplikasi K-Means')

@section('content')
<div class="main">
    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="container-fluid">
            {{-- <h3 class="page-title">Manage Data</h3> --}}
            <div class="row">
                <div class="col-md-12">
                    <!-- BORDERED TABLE -->
					<div class="panel">
						<div class="panel-heading">
							<h3 class="panel-title">Data Geographics</h3>
						</div>
						<div class="panel-body">
                            <p class="button">
								<button  type="button" class="btn btn-primary" id="add-geo" name="add-geo"><i class="fa fa-plus-square"></i> Add Data </button>
								<!-- Button trigger modal -->								
								{{-- <a href="{{ route('disasters.export') }}" class="col-6 btn btn-default"><i class="fa fa-file-export"></i> Export Data </a> --}}
                                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#importGeographic"><i class="fa fa-file-import"></i> Import Data </button>
							</p>
							
							@include('admin.geoadd')							
												
							<table id="datatable" class="table table-bordered">
								<thead>
									<tr>
										<th>#</th>
										<th>Nama Wilayah</th>
										<th>kemiringan Lereng</th>
										<th>Jenis Tanah</th>
										<th>Curah Hujan</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
                                    @foreach ($geographics as $geo)
									<tr>
                                        <td scope="row">{{$loop->iteration}}</td>
										<td>{{$geo->namawilayah}}</td>
										<td>{{$geo->kemiringanlereng}}</td>
										<td>{{$geo->jenistanah}}</td>
										<td>{{$geo->curahhujan}}</td>
										<td>   
											{{-- UPDATE BUTTON --}}
											<a class="label label-success edit-geo" value="{{$geo->id}}" data-id="{{$geo->id}}"
												data-namawilayah="{{$geo->namawilayah}}" data-kemiringanlereng="{{$geo->kemiringanlereng}}" data-jenistanah="{{$geo->jenistanah}}" data-curahhujan="{{$geo->curahhujan}}">Edit</a>											
											{{-- DELETE BUTTON --}}											
											<a class="label label-danger delete-geo" data-id="{{$geo->id}}" data-namawilayah="{{$geo->namawilayah}}">Delete</a>
                                        </td>
									</tr>		                                        
                                    @endforeach					
								</tbody>
							</table>	
							{{$geographics->links()}}	
							
							<!-- Modal Import Excel-->
							<div class="modal fade" id="importGeographic" tabindex="-1" role="dialog"aria-hidden="true">
								<div class="modal-dialog" role="document">
								<form method="post" action="{{ route('geographics.import') }}" id="frmImportGeo" enctype="multipart/form-data">								
								<div class="modal-content">
									<div class="modal-header">
									<h3 class="modal-title">Import Data Excel Geographics</h3>									
									</div>
									<div class="modal-body">
									@csrf									
										<div class="form-group">
											<input type="file" name="file" required="required">
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>									
										<input type="submit" class="btn btn-primary" value="import">										
									</div>
								</div>
								</form>
								</div>
							</div>

							@include('admin.geoedit')																											
						</div>
					</div>
					<!-- END BORDERED TABLE -->
                </div>                
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT -->
</div>
@section('script')
<script src="{{asset('admin/assets/js/geo.js')}}"></script>
<script>
$(document).ready(function(){
	//header token CSRF ***************************
	$.ajaxSetup({
		  headers: {
			  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		  }
	});
	//get base URL *********************
	var url = $('#url').val();

	//trigger reset form and show modal ***************************
	$('#add-geo').click(function(){
		$('#frmAddGeo').trigger("reset");
		$('#addGeoModal').modal('show');
	});

	 //display modal form for EDIT and pass to route ***************************
	 $('body').on('click','.edit-geo',function(e){
		var id = $(this).data('id');    
		// Populate Data in Edit Modal Form
		$.get("{{ route('geographics.index') }}" +'/' + id +'/edit',function (data) {
				console.log(data);
				$('#id').val(data.id);
				$('.modal-body #namawilayah').val(data.namawilayah);
				$('.modal-body #kemiringanlereng').val(data.kemiringanlereng);                
				$('.modal-body #jenistanah').val(data.jenistanah); 
				$('.modal-body #curahhujan').val(data.curahhujan);                
				$('#editGeoModal').modal('show');								
		});
	});

	//call class delete-confirm in body ***************************
	$('body').on('click', '.delete-geo', function () {
		//header token CSRF ***************************
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
			}
		})
		event.preventDefault();
		var id = $(this).attr("data-id");
		var namawilayah = $(this).attr('data-namawilayah');		
		//sweet alert ***************************
		Swal.fire({
			title: 'Are you sure?',			
			text: "Delete data with nama wilayah "+ namawilayah +"",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, delete it!'
			}).then((result) => {
				if (result.value) {					
					Swal.fire(
						'Deleted!',
						'Your file has been deleted.',
						'success'
					).then(function(){ 						
						window.location= "geographics/"+id+"/destroy";
					})
				}
			})
		});
	});

	//call submit button form modal id frmAddDisaster ***************************
	$('#frmAddGeo').on('submit',function(event){
			//header token CSRF ***************************
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
				}
			})
			event.preventDefault();
			//header token CSRF ***************************
			$.ajax({
				data: $('#frmAddGeo').serialize(),
				url: "/geographics",
				type: "POST",
				success: function(response){
					$('#addGeoModal').modal('hide')
					Swal.fire(
					'Success!',
					'Data Berhasil ditambahkan',
					'success'
					).then(function(){ 
						location.reload();
					})										
				},
				error: function(xhr){	
					// catch http request
					console.log(errors);
					// var res = xhr.responseJSON;
					// if ($.isEmptyObject(res.errors) == false) {
					// 	$.each(res.errors,function(key,value){
					// 		$('#'+key)
					// 			.closest('.form-group')
					// 			.addClass('has-error')
					// 			.append('<span class="help-block"><strong>'+ value +'</strong></span>')
					// 	})
					// }
				}
			});
		})


	$('#frmImportGeo').on('submit',function(){
		//header token CSRF ***************************
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
			}
		})
		event.preventDefault();
		var formData = new FormData();
		$.ajax({
			url: '{{ route('geographics.import') }}',
			type: 'POST',              
			data: formData,
			success: function(response){
				$('#importGeographic').modal('hide')
				Swal.fire(
				'Success!',
				'Data Berhasil ditambahkan',
				'success'
				).then(function(){ 
					location.reload();
				})										
			},
			error: function(data)
			{
				console.log(data);
			}
		});
	})
</script>	
@endsection
@endsection