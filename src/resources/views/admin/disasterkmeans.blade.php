@extends('layouts.master')

@section('title','Disaster K-Means | Aplikasi K-Means')

@section('content')
<div class="main">
    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="container-fluid">            
            <div class="row">
                
                <div class="col-md-6">
                    <div class="panel">
                        <div class="panel-heading">
							<h3 class="panel-title">Inisialisasi Awal</h3>
                        </div>
                        <div class="panel-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>                                                                                
                                        <th>Jumlah Kejadian</th>
                                        <th>Jumlah Korban</th>
                                        <th>Jumlah Kerusakan</th>
                                    </tr>
                                </thead>
                                <tbody class="body">
                                    @foreach ($centroid[0] as $key_centroid => $value_centroid)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>                                        
                                        <td>{{$value_centroid[0]}}</td>                                        
                                        <td>{{$value_centroid[1]}}</td>                                        
                                        <td>{{$value_centroid[2]}}</td>                                                                                
                                    </tr>    
                                    @endforeach                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Akurasi K-Means</h3>
                        </div>
                        <div class="panel-body">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th>#</th>
                                        <td>Hasil DBI</td>
                                        <td>Hasil Purity</td>
                                    </tr>
                                    <tr>
                                        <th>Hasil</th>
                                        <th>{{$ratio}}</th>
                                        <th>{{$purity}}</th>
                                    </tr>
                                </tbody>
                            </table>                            
                                                       
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    @foreach ($hasil_iterasi as $key => $value)
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Iterasi {{$key+1}}</h3>
                            <div class="right">
                                <button type="button" data-toggle="collapse" data-target="#collapse{{$key}}"><i class="lnr lnr-chevron-down"></i></button>
                            </div>                            
                        </div>                    
                        <div class="panel-body">
                            <div id="collapse{{$key}}" class="collapse">
                                <table class="table table-bordered table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th rowspan="2" class="text-center">#</th>
                                            <th rowspan="2" class="text-center">Nama Wilayah</th>
                                            <th rowspan="2" class="text-center">Jumlah Kejadian</th>
                                            <th rowspan="2" class="text-center">Jumlah Korban Jiwa</th>
                                            <th rowspan="2" class="text-center">Jumlah Kerusakan</th>
                                            <th rowspan="1" class="text-center" colspan="{{ $cluster }}">Jarak ke Centroid</th>										
                                            <th rowspan="2" class="text-center">Jarak Terdekat</th>
                                            <th rowspan="2" class="text-center">Cluster</th>										
                                        </tr>
                                        <tr>
                                            @for ($i=1; $i <=$cluster ; $i++) <th rowspan="1" class="text-center">
                                                {{ $i }}
                                            </th>
                                            @endfor
                                        </tr>
                                    </thead>                            
                                    <tbody class="body"> 
                                        @foreach ($value as $key_data => $value_data)                                                                                 
                                        <tr>
                                            <td class="text-center" scope="row">{{ $key_data+1 }}</td>
                                            <td class="text-center">{{$name[$key_data]}}</td>
                                            <td class="text-center">{{$value_data['data'][0]}}</td>
                                            <td class="text-center">{{$value_data['data'][1]}}</td>
                                            <td class="text-center">{{$value_data['data'][2]}}</td>
                                            @foreach ($value_data['jarak_ke_centroid'] as $key_jc => $value_jarak)
                                            <td class="text-center">{{$value_jarak}}</td>
                                            @endforeach                                        										                                        										
                                            <td>{{ $value_data['jarak_terdekat']['value'] }}</td>										
                                            <td>{{ $value_data['jarak_terdekat']['cluster'] }}</td>																														
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @endforeach                     
                </div>                                                           
                                
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT -->
</div>    
@endsection