@extends('layouts.adminLte')
@section('pageTitle', 'PhpunitG Dashboard')
@section('header')
    @include('layouts.header.intranet_page_header')
@endsection
@section('sidebar')
    @include('layouts.sidebar.intranet_sidebar')
@endsection
@section('estateSidebar', '')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                App
                <a href="{{ route('App.Show', $appEntity) }}">
                    {{ $appEntity->name }}
                </a>
                <small>{{ $appEntity->url }}</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li class="active">{{ $appEntity->name }}</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box-group" id="accordion">
                        <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                        <div class="panel box box-warning">
                            <div class="box-header with-border" style="padding: 0.2em 0.5em;">
                                <h4 class="box-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" class="collapsed" style="font-size: 14px">
                                        <i class="fa fa-question-circle"></i> How run in your app?
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                <div class="box-body">
                                    <ol>
                                        <li>Go to your app</li>
                                        <li>
                                            Exec
                                            <kbd class="code">
                                                composer require --dev oscarricardosan/phpunitg_laravel
                                            </kbd>
                                        </li>
                                        <li>
                                            Put in .env
                                            <kbd class="code">
                                                PHPUNITG_TOKEN={{$appEntity->token}}
                                            </kbd>
                                        </li>
                                        <li>
                                            Exec
                                            <kbd class="code">
                                                php artisan vendor:publish
                                            </kbd>
                                        </li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Tests</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" style="color: #354eb5;">
                                    <i class="fa fa-refresh"></i>
                                    Scan by tests
                                </button>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <h4>Folders</h4>
                                </div>
                                <div class="col-md-8">
                                    <h4>Classes with phpunitg tests</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div>{{--
                                        @foreach($appEntity->folders as $key=> $folder)
                                            <button type="button" class="list-group-item {{ $key==0?'active':'' }}"
                                                    href="#tab_app_{{$key}}" data-toggle="tab" >
                                                <span class="badge">14</span>
                                                {{ $folder->directory }}
                                            </button>
                                        @endforeach--}}
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="tab-content">{{--
                                        @foreach($appEntity->folders as $key=> $folder)
                                            <div class="tab-pane {{ $key==0?'active':'' }}" id="tab_app_{{$key}}">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Class</th>
                                                            <th>Tests</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>{{ $key }}- 1</td>
                                                            <td>1</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        @endforeach--}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <div class="row">
                                <div class="col-sm-3 col-xs-6">
                                    <div class="description-block border-right">
                                        <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 17%</span>
                                        <h5 class="description-header">$35,210.43</h5>
                                        <span class="description-text">TOTAL REVENUE</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-3 col-xs-6">
                                    <div class="description-block border-right">
                                        <span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i> 0%</span>
                                        <h5 class="description-header">$10,390.90</h5>
                                        <span class="description-text">TOTAL COST</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-3 col-xs-6">
                                    <div class="description-block border-right">
                                        <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 20%</span>
                                        <h5 class="description-header">$24,813.53</h5>
                                        <span class="description-text">TOTAL PROFIT</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-3 col-xs-6">
                                    <div class="description-block">
                                        <span class="description-percentage text-red"><i class="fa fa-caret-down"></i> 18%</span>
                                        <h5 class="description-header">1200</h5>
                                        <span class="description-text">GOAL COMPLETIONS</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.box-footer -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
        </section>
    </div>
    <!-- App.Show -->

    <script>
        $(document).ready(function(){
            $('.list-group-item ').click(function(){
                $('.list-group-item ').removeClass('active');
                $(this).addClass('active');
            });
        });
    </script>
@endsection
@section('endBodyExtras')
@endsection
