@extends('layouts.master')

@section('title','Dashboard | Aplikasi K-Means')
    
@section('content')
<div class="main">
    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="container-fluid">            
            <div class="row">
                <div class="col-md-12">
                    <!-- PANEL HEADLINE -->
                    <div class="panel panel-headline">
                        <div class="panel-heading">
                            <h3 class="panel-title">Aplikasi K-Means</h3>
                            <p class="panel-subtitle">This is Dashboard</p>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="metric">
                                        <span class="icon"><i class="fa fa-bar-chart"></i></span>
                                        <p>
											<span class="number">{{disasterTotal()}}</span>
											<span class="title">Disaster Data</span>
										</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="metric">
                                        <span class="icon"><i class="fa fa-bar-chart"></i></span>
                                        <p>
                                            <span class="number">{{geoTotal()}}</span>
											<span class="title">Geographic Data</span>
										</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="metric">
                                        <span class="icon"><i class="fa fa-bar-chart"></i></span>
                                        @foreach (correlationGet() as $key => $item)
                                        <p>
                                            <span class="number">{{['ratiopearson']}}</span>
											<span class="title">Nilai Kkorelassional</span>
										</p>    
                                        @endforeach                                                                                
                                    </div>
                                </div>
                            </div>                            
						</div>						                  
                    </div>
					<!-- END PANEL HEADLINE -->				
                    
                </div>
                
				<div class="col-md-6">
                    <div class="panel">                            
                        <div id="cluster"></div>
                    </div>
                </div>

				<div class="col-md-6">
                    <div class="panel">
                        <div id="geocluster"></div>
                    </div>
				</div>                
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT -->
</div>
@endsection

@section('script')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script>    
    let disasterchart = Highcharts.chart('cluster', {
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

    let geochart = Highcharts.chart('geocluster', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Geo Cluster'
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
                var query =  <?php echo json_encode(geoclusterGet()) ?>;
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
