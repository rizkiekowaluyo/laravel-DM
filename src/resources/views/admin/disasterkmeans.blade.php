@extends('layouts.master')

@section('title','Disaster K-Means | Aplikasi K-Means')

@section('content')
<div class="main">
    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="container-fluid">            
            <div class="row">
                <div class="col-md-4">
                    <div class="panel">
                        <div class="panel-heading">
							<h3 class="panel-title">Masukkan Pusat Kluster</h3>
                        </div>
                        <div class="panel-body">
                            <form action="/disasterkmeansdata"> 
                                @method("post")
                                @csrf                                             
                                @for ($i = 0; $i < $count = 3 ; $i++)
                                <select class="form-control" name='data'>
                                    <option value="option_select" disabled selected>---</option>
                                    @foreach ($disasterkmean as $dstk)                                
                                    <option value="{{$dstk->id}}" data-namawilayah="{{$dstk->namawilayah}}" data-jumlahkejadian="{{$dstk->jumlahkejadian}}" data-jumlahkorban="{{$dstk->jumlahkorban}}" data-jumlahkerusakan="{{$dstk->jumlahkerusakan}}">{{$dstk->namawilayah}}</option>
                                    @endforeach 
                                </select>
                                <br>
                                @endfor            
                                <div class="input-group">                                
                                    <button class="btn btn-primary" type="submit">Submit</button></span>
                                </div>
                            </form>                                                        
                        </div>                        
                    </div>
                </div>
                <div class="col-md-12">
                    <!-- BORDERED TABLE -->                
					<div class="panel">
						<div class="panel-heading">
							<h3 class="panel-title">K-Means</h3>
                        </div>                    
						<div class="panel-body">
							<table id="datatable" class="table table-bordered">
								<thead>
									<tr>
										<th>#</th>
										<th>Nama Wilayah</th>
										<th>Jumlah Kejadian</th>
										<th>Jumlah Korban Jiwa</th>
										<th>Jumlah Kerusakan</th>
										<th>Centroid</th>
										<th>Centroid</th>
										<th>Centroid</th>
										<th>Cluster 1</th>
										<th>Cluster 2</th>
										<th>Cluster 3</th>
									</tr>
                                </thead>
                                @php
                                    $c1a_b=$c1b_b=$c1c_b = 0;
                                    
                                    $c2a_b=$c2b_b=$c2c_b = 0;
                                    
                                    $c3a_b=$c3b_b=$c3c_b = "";

                                    $hc1=$hc2=$hc3=0;
                                @endphp
								<tbody class="body"> 
                                    @foreach ($disasterkmean as $dstk)                                                                                                         
									<tr>
                                        <td scope="row"></td>
										<td>{{$dstk->namawilayah}}</td>
										<td>{{$dstk->jumlahkejadian}}</td>
										<td>{{$dstk->jumlahkorban}}</td>
										<td>{{$dstk->jumlahkerusakan}}</td>										
										<td>{{sqrt(pow(($dstk->jumlahkejadian-200),2)+pow(($dstk->jumlahkorban-3202),2)+pow(($dstk->jumlahkerusakan-1203),2))}}</td>										
										<td>{{sqrt(pow(($dstk->jumlahkejadian-124),2)+pow(($dstk->jumlahkorban-124),2)+pow(($dstk->jumlahkerusakan-1234),2))}}</td>										
										<td>{{sqrt(pow(($dstk->jumlahkejadian-23),2)+pow(($dstk->jumlahkorban-242),2)+pow(($dstk->jumlahkerusakan-123),2))}}</td>										
										<td></td>										
										<td></td>										
										<td></td>										
                                    </tr>
                                    @endforeach                    
								</tbody>
							</table>
                        </div>                        
					</div>
					<!-- END BORDERED TABLE -->
                </div>                
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT -->
</div>    
@endsection