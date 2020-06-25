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
                            <table id="datatable" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>                                
                                    <tr>
                                        <td scope="row"></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>		                                                                        
                                </tbody>
                            </table>	                                                
                                                                        
                        </div>
                    </div>
                    <!-- END BORDERED TABLE -->
                </div>

                <div class="col-md-5">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Akurasi K-Means</h3>
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
                                        <th>*</th>
                                        <th></th>
                                        <th></th>
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