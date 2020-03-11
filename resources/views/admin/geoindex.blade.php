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
								<button  type="button" class="btn btn-primary" data-toggle="modal" data-target="#addGeoModal"><i class="fa fa-plus-square"></i> Add Data </button>
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
											<a class="label label-success edit" data-toggle="modal" data-target="#editGeoModal">Edit</a>											
											{{-- DELETE BUTTON --}}											
											<a class="label label-danger delete-geo" data-id="{{$geo->id}}" data-namawilayah="{{$geo->namawilayah}}">Delete</a>
                                        </td>
									</tr>		                                        
                                    @endforeach					
								</tbody>
							</table>	
							{{$geographics->links()}}	
							
							<!-- Modal Import Excel-->
							<div class="modal fade" id="importGeographic" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog" role="document">
								<form method="post" action="{{ route('geographics.import') }}" enctype="multipart/form-data">								
								<div class="modal-content">
									<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLabel">Import Data Excel Geographics</h5>									
									</div>
									<div class="modal-body">
									@csrf
									{{-- {!! Form::open(['route'=> 'disasters.import', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}
									{!! Form::file('data_disasters') !!} --}}
										<div class="form-group">
											<input type="file" name="file" required="required">
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>									
										<input type="submit" class="btn btn-primary" value="import">
										{{-- </form> --}}
									</div>
								</div>
								</form>
								</div>
							</div>

							@include('admin.disasteredit')																				
							{{-- @include('admin.disasterdelete')																				 --}}
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
<script>
	$(document).ready(function(){		
		$('#editModal').on('show.bs.modal',function(event){
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
				}
			})
			var repo = $(event.relatedTarget)
            var id = repo.data('id')
            var namawilayah = repo.data('namawilayah')
            var kemiringanlereng = repo.data('kemiringanlereng')
            var jenistanah = repo.data('jenistanah')
			var curahhujan = repo.data('curahhujan')
			
			var modal = $(this)
			
            modal.find('.modal-title').text('Edit Data')
            modal.find('.modal-body #namawilayah').val(namawilayah)
            modal.find('.modal-body #kemiringanlereng').val(kemiringanlereng)
            modal.find('.modal-body #jenistanah').val(jenistanah)
            modal.find('.modal-body #curahhujan').val(curahhujan)            
            modal.find('.modal-body #id').val(id)            
		});	

		$('.delete-geo').click(function(){
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
				}
			})
			event.preventDefault();		
			var id = $(this).attr('data-id');
			// var id = dst
			// var url =$(this).attr('action',"disasters/"+this.id)
			var namawilayah = $(this).attr('data-namawilayah');		
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
						window.location= "geographics/"+id+"/destroy";
						Swal.fire(
						'Deleted!',
						'Your file has been deleted.',
						'success'
						)
					}
				})
		});	
	});
</script>	
@endsection
@endsection