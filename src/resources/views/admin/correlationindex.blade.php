@extends('layouts.master')

@section('title','Correlation | Aplikasi K-Means')

@section('content')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            {{-- <h3 class="page-title">Manage Data</h3> --}}
            <div class="row">
                <div class="col-md-12">
                    <!-- BORDERED TABLE -->
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Korelasi</h3>
                        </div>
                        <div class="panel-body">
                            <div class="scrollable">
                                <table id="datatable" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nama Wilayah</th>
                                            <th scope="col">Pow1</th>
                                            <th scope="col">Pow2</th>
                                            <th scope="col">Pow3</th>
                                            <th scope="col">Pow4</th>
                                            <th scope="col">Pow5</th>
                                            <th scope="col">Pow6</th>
                                            <th scope="col">Pow7</th>
                                            <th scope="col">Pow8</th>
                                        </tr>
                                    </thead>
                                    <tbody class="body">
                                        @foreach ($resulted as $key => $valuedata)                                                                                                                  
                                        <tr>
                                            <td scope="row">{{ $key+1 }}</td>
                                            <td>{{$name[$key]}}</td>
                                            <td>{{$valuedata['pow1']}}</td>
                                            <td>{{$valuedata['pow2']}}</td>
                                            <td>{{$valuedata['pow3']}}</td>                                            
                                            <td>{{$valuedata['pow4']}}</td>
                                            <td>{{$valuedata['pow5']}}</td>
                                            <td>{{$valuedata['pow6']}}</td>                                                                                    
                                            <td>{{$valuedata['pow7']}}</td>                                                                                    
                                            <td>{{$valuedata['pow8']}}</td>                                                                                    
                                        </tr>
                                        @endforeach                                                                                 
                                    </tbody>
                                </table>
                            </div>                                                                                                                                        	                                                                                                                        
                        </div>
                    </div>
                    <!-- END BORDERED TABLE -->
                </div>

                <div class="col-md-5">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Pearson Correlation</h3>
                        </div>
                        <div class="panel-body">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th>#</th>
                                        <td>Ratio Korelasi Pearson</td>
                                        <td>Keterangan</td>
                                    </tr>
                                    <tr>
                                        <th></th>
                                        <th>{{$resultpearson}}</th>
                                        @if ($resultpearson > 0)
                                        <th> Positive</th>    
                                        @else
                                        <th> Negative</th>
                                        @endif                                        
                                    </tr>
                                </tbody>
                            </table>                            
                                                       
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection