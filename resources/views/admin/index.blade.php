@extends('layouts.admin')
@section('styles')
@endsection
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>Dashboard</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>

    <section class="content">
        
        <div class="row">

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="ionicons ion-social-usd"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total earnings</span>
                        <span class="info-box-number">{{$total_earnings}}<small>$</small></span>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-red"><i class="ionicons ion-ios-people-outline"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Members</span>
                        <span class="info-box-number">{{$total_members}}</span>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>
                    <div class="info-box-content">
                    <span class="info-box-text">New Members</span>
                    <span class="info-box-number">{{$new_members}}</span>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="fa fa-database"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Datasets</span>
                        <span class="info-box-number">{{$datasets_count}}</span>
                    </div>
                </div>
            </div>



        </div>
        
        <div class="row">
            <div class="col-md-8">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Latest Processes</h3>
        
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table no-margin">
                                <thead>
                                    <tr>
                                        <th>User</th>
                                        <th>Filename</th>
                                        <th>Dataset</th>
                                        <th>Rows</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($processes as $process)
                                    <tr>
                                        <td><a href="pages/examples/invoice.html">{{$process->user->f_name}} {{$process->user->l_name}}</a></td>
                                        <td>{{$process->filename}}</td>
                                        <td>@if(isset($process->mydataset->name)) {{$process->mydataset->name}} @endif</td>
                                        <td>{{$process->process_rows}}</td>
                                        <td><span class="label {{ $process->status==1 ? 'label-success' : 'label-danger' }}">{{ $process->status==1 ? 'completed' : 'pending' }}</span></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="box-footer clearfix">
                        <a href="javascript:void(0)" class="btn btn-sm btn-info btn-flat pull-left">Place New Process</a>
                        <a href="javascript:void(0)" class="btn btn-sm btn-default btn-flat pull-right">View All Processes</a>
                    </div>
                </div>
            </div>
        
            <div class="col-md-4">
                <div class="info-box bg-yellow">
                    <span class="info-box-icon"><i class="ion ion-ios-pricetag-outline"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total dataset amount</span>
                        <span class="info-box-number">{{$total_dataset_amount}}</span>
        
                        <div class="progress">
                            <div class="progress-bar" style="width: 50%"></div>
                        </div>
                        <span class="progress-description">
                            50% Increase in 30 Days
                        </span>
                    </div>
                </div>
                <div class="info-box bg-green">
                    <span class="info-box-icon"><i class="ion ion-ios-heart-outline"></i></span>
        
                    <div class="info-box-content">
                        <span class="info-box-text">Mentions</span>
                        <span class="info-box-number">92,050</span>
        
                        <div class="progress">
                            <div class="progress-bar" style="width: 20%"></div>
                        </div>
                        <span class="progress-description">
                            20% Increase in 30 Days
                        </span>
                    </div>
                </div>
                <div class="info-box bg-red">
                    <span class="info-box-icon"><i class="ion ion-ios-cloud-download-outline"></i></span>
        
                    <div class="info-box-content">
                        <span class="info-box-text">Downloads</span>
                        <span class="info-box-number">114,381</span>
        
                        <div class="progress">
                            <div class="progress-bar" style="width: 70%"></div>
                        </div>
                        <span class="progress-description">
                            70% Increase in 30 Days
                        </span>
                    </div>
                </div>
                <div class="info-box bg-aqua">
                    <span class="info-box-icon"><i class="ion-ios-chatbubble-outline"></i></span>
        
                    <div class="info-box-content">
                        <span class="info-box-text">Direct Messages</span>
                        <span class="info-box-number">163,921</span>
        
                        <div class="progress">
                            <div class="progress-bar" style="width: 40%"></div>
                        </div>
                        <span class="progress-description">
                            40% Increase in 30 Days
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@section('scripts')
@endsection