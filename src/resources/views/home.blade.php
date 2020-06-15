@extends('layouts.app')

@section('content')
<div class="container app-content">
    <div class="">
        <div class="jumbotron">
            <div class="container">
                <br><h1 class="display-4 text-center">KAWAL BENCANA</h1>
                <p class="lead m-0 text-center">Clustering & Correlation</p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
            <div class="card bg-danger img-card shadow">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="text-white">
                            <p class="text-white mb-0">Total Kejadian</p>
                            <h2 class="mb-0 number-font">---</h2>
                            <p class="text-white mb-0">Kali</p>
                        </div>
                        <div class="ml-auto"> 
                            <i class="em em-disappointed_relieved" aria-role="presentation" aria-label="DISAPPOINTED BUT RELIEVED FACE"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- COL END -->

        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
            <div class="card bg-info img-card shadow">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="text-white">
                            <p class="text-white mb-0">Jumlah Korban</p>
                            <h2 class="mb-0 number-font">----</h2>
                            <p class="text-white mb-0">Jiwa</p>
                        </div>
                        <div class="ml-auto"> 
                            <i class="em em-sob" aria-role="presentation" aria-label="LOUDLY CRYING FACE"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- COL END -->
    </div>

    <br><div class="col text-center"><h5><b>Data Hasil Cluster</b></h5></div><br>

    <div class="row">
        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
            <div class="panel shadow">                            
                <div id="hasilcluster"></div>
            </div>            
        </div>

        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Kabupaten/Kota</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover mb-0 text-nowrap">
                            <thead>
                                <tr>
                                    <th class="header">No.</th>
                                    <th class="header">Kabupaten/Kota</th>
                                    <th class="header">Jumlah Kejadian</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>Malang</td>
                                    <td>202</td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>Malang</td>
                                    <td>202</td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>Malang</td>
                                    <td>202</td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>Malang</td>
                                    <td>202</td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>Malang</td>
                                    <td>202</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script>
    let disasterchart = Highcharts.chart('hasilcluster', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Disaster Cluster'
        },        
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: false
                },
                showInLegend: true
            }
        },
        
        series:  [{
            name: 'Jumlah Anggota Cluster',
            colorByPoint: true,
            data: (function(){
                var query =  <?php echo json_encode(clusterGet()) ?>;
                // console.log(query);
				var data = [];
				let cluster = 'Cluster '
				for (var i = 0; i < query.length; i++) {
					data.push({
						name: cluster.concat(query[i].cluster),
						y: query[i].countcluster
					});
				}

				return data;
			}())		
        }]
    });
</script>
@endsection

    
