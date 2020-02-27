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
								<button  type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal"><i class="fa fa-plus-square"></i> Add Data </button>
								<!-- Button trigger modal -->								
								<a href="{{ route('disasters.export') }}" class="col-6 btn btn-default"><i class="fa fa-file-export"></i> Export Data </a>
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
											<a class="label label-success edit" data-toggle="modal" data-target="#editModal" data-id="{{$dst->id}}"
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
								<form method="post" action="{{ route('disasters.import') }}" enctype="multipart/form-data">								
								<div class="modal-content">
									<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
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
            var jumlahkejadian = repo.data('jumlahkejadian')
            var jumlahkorban = repo.data('jumlahkorban')
			var jumlahkerusakan = repo.data('jumlahkerusakan')
			
			var modal = $(this)
			
            modal.find('.modal-title').text('Edit Data')
            modal.find('.modal-body #namawilayah').val(namawilayah)
            modal.find('.modal-body #jumlahkejadian').val(jumlahkejadian)
            modal.find('.modal-body #jumlahkorban').val(jumlahkorban)
            modal.find('.modal-body #jumlahkerusakan').val(jumlahkerusakan)            
            modal.find('.modal-body #id').val(id)            
		});	

		$('.delete-confirm').click(function(){
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
						window.location= "disasters/"+id+"/destroy";
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