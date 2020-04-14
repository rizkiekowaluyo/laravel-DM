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
                                <div class="col-md-4">
                                    <div class="metric">
                                        <span class="icon"><i class="fa fa-bar-chart"></i></span>
                                        <p>
											<span class="number">35%</span>
											<span class="title">Disaster</span>
										</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="metric">
                                        <span class="icon"><i class="fa fa-bar-chart"></i></span>
                                        <p>
											<span class="number">35%</span>
											<span class="title">Geographic</span>
										</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="metric">
                                        <span class="icon"><i class="fa fa-bar-chart"></i></span>
                                        <p>
											<span class="number">35%</span>
											<span class="title">Korelasional</span>
										</p>
                                    </div>
                                </div>
                            </div>
                            <h4>Panel Content</h4>
                            <p>Objectively network visionary methodologies via best-of-breed users. Phosfluorescently initiate go forward leadership skills before an expanded array of infomediaries. Monotonectally incubate web-enabled communities rather than process-centric.</p>
                        </div>
                    </div>
                    <!-- END PANEL HEADLINE -->
                </div>                
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT -->
</div>
@endsection