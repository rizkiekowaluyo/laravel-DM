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
							<h3 class="panel-title">Data Bencana</h3>
						</div>
						<div class="panel-body">
                            <p class="button">
								<button  type="button" class="btn btn-primary" id="add-disaster" name="add-disaster"><i class="fa fa-plus-square"></i> Add Data </button>
								<!-- Button trigger modal -->								
								{{-- <a href="{{ route('disasters.export') }}" class="col-6 btn btn-default"><i class="fa fa-file-export"></i> Export Data </a> --}}
                                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#importDisaster"><i class="fa fa-file-import"></i> Import Data </button>
							</p>
													

							@include('admin.disasteradd')							
												
							<table id="datatable" class="table table-bordered">
								<thead>
									<tr>
										<th>#</th>
										<th>Nama Wilayah</th>
										<th>Jumlah Kejadian</th>
										<th>Jumlah Korban Jiwa</th>
										<th>Jumlah Kerusakan</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
                                    @foreach ($disasters as $dst)
									<tr>
                                        <td scope="row">{{$loop->iteration}}</td>
										<td>{{$dst->namawilayah}}</td>
										<td>{{$dst->jumlahkejadian}}</td>
										<td>{{$dst->jumlahkorban}}</td>
										<td>{{$dst->jumlahkerusakan}}</td>
										<td>   
											{{-- UPDATE BUTTON --}}
											<a class="label label-success edit-modal" value="{{$dst->id}}" data-id="{{$dst->id}}"
												data-namawilayah="{{$dst->namawilayah}}" data-jumlahkejadian="{{$dst->jumlahkejadian}}" data-jumlahkorban="{{$dst->jumlahkorban}}" data-jumlahkerusakan="{{$dst->jumlahkerusakan}}" >Edit</a>											
											{{-- DELETE BUTTON --}}											
											<a class="label label-danger delete-confirm" data-id="{{$dst->id}}" data-namawilayah="{{$dst->namawilayah}}">Delete</a>											
                                        </td>
									</tr>		                                        
                                    @endforeach					
								</tbody>
							</table>	
							{{$disasters->links()}}	
							
							<!-- Modal Import Excel-->
							<div class="modal fade" id="importDisaster" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog" role="document">
								<form method="post" action="{{ route('disasters.import') }}" id="frmImport" enctype="multipart/form-data">								
								<div class="modal-content">
									<div class="modal-header">
									<h3 class="modal-title" id="exampleModalLabel">Import Data</h3>									
									</div>
									<div class="modal-body">
									@csrf									
										<div class="form-group @if ($errors->has('file')) has-error @endif">
											<input type="file" id="file" name="file"/>
											@error('file')
												<span class="help-block text-danger">{{ $message }}</span>
											@enderror
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
							
							@include('admin.disasteredit')							
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
<script src="{{asset('admin/assets/js/disaster.js')}}"></script>
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
    $('#add-disaster').click(function(){
        $('#frmAddDisaster').trigger("reset");
        $('#addModal').modal('show');
    });

     //display modal form for EDIT and pass to route ***************************
     $('body').on('click','.edit-modal',function(e){
        var id = $(this).data('id');    
        // Populate Data in Edit Modal Form
        $.get("{{ route('disasters.index') }}" +'/' + id +'/edit',function (data) {
                console.log(data);
                $('#id').val(data.id);
                $('.modal-body #namawilayah').val(data.namawilayah);
                $('.modal-body #jumlahkejadian').val(data.jumlahkejadian);                
                $('.modal-body #jumlahkorban').val(data.jumlahkorban);                
                $('.modal-body #jumlahkerusakan').val(data.jumlahkerusakan);                
                $('#editModal').modal('show');
		});
	});

	//call class delete-confirm in body ***************************
	$('body').on('click', '.delete-confirm', function () {
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
						window.location= "disasters/"+id+"/destroy";
					})
				}
			})
		});
	});

	//call submit button form modal id frmAddDisaster ***************************
	$('#frmAddDisaster').on('submit',function(event){
			//header token CSRF ***************************
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
				}
			})
			event.preventDefault();
			//header token CSRF ***************************
			$.ajax({
				data: $('#frmAddDisaster').serialize(),
				url: "/disasters",
				type: "POST",
				success: function(response){
					$('#addModal').modal('hide')
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


	$('#frmImport').on('sumbmit',function(){
		//header token CSRF ***************************
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
			}
		})
		event.preventDefault();
		var formData = new FormData();
		$.ajax({
			url: '{{ route('disasters.import') }}',
			type: 'POST',              
			data: formData,
			success: function(response){
				$('#importDisaster').modal('hide')
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