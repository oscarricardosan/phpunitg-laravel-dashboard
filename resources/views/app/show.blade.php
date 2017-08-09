@extends('layouts.adminLte')
@section('pageTitle', 'PhpunitG Dashboard')
@section('header')
    @include('layouts.header.intranet_page_header')
@endsection
@section('sidebar')
    @include('layouts.sidebar.intranet_sidebar')
@endsection
@section('estateSidebar', '')
@php
    $totalTags= $totalTests= $totalMethods= 0;
@endphp
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
                                    @include('app.partials.steps')
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="box" style="{{ $appEntity->tags()->count()==0?'display:none;':'' }}">
                        <div class="box-header with-border">
                            <h3 class="box-title">Tests</h3>

                            <div class="box-tools pull-right">
                                <a type="button" class="btn btn-box-tool scanByTests" style="color: #354eb5;" href="{{ route('App.ScanTests', $appEntity) }}">
                                    <i class="fa fa-refresh"></i>
                                    <span class="text">Scan by tests</span>
                                </a>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <h4>Tags</h4>
                                </div>
                                <div class="col-md-8">
                                    <h4>Tests</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div>
                                        <button type="button" class="list-group-item active"
                                            href="#tab_app_0" data-toggle="tab"
                                            style="margin-bottom: 0.5em;"
                                        >
                                            <span class="badge">Tests: <span class="allTags"></span></span>
                                            ALL TAGS
                                        </button>
                                        @foreach($appEntity->tags->sortBy('name') as $key=> $tag)
                                            <button type="button" class="list-group-item "
                                                    href="#tab_app_{{$key +1 }}" data-toggle="tab" >
                                                <span class="badge">Tests: {{ $tag->tests->count()}}</span>
                                                {{ $tag->name}}
                                            </button>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab_app_0">
                                            <table class="table table-bordered">
                                                <thead>
                                                <tr>
                                                    <th>Class</th>
                                                    <th>Methods</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($appEntity->tags->sortBy('name') as $key=> $tag)
                                                    @php $totalTags++ @endphp
                                                    @foreach($tag->tests as $test)
                                                        @php $totalTests++ @endphp
                                                        @include('app.partials.test_tr', [
                                                            'tag'=> $tag,
                                                            'test'=> $test,
                                                        ])
                                                        @foreach($test->methods as $method)
                                                            @php $totalMethods++ @endphp
                                                        @endforeach
                                                    @endforeach
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        @foreach($appEntity->tags->sortBy('name') as $key=> $tag)
                                            <div class="tab-pane" id="tab_app_{{$key +1 }}">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Class</th>
                                                            <th>Methods</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($tag->tests as $test)
                                                            @include('app.partials.test_tr', [
                                                               'tag'=> $tag,
                                                               'test'=> $test,
                                                            ])
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <div class="row">
                                <div class="col-sm-4 col-xs-6">
                                    <div class="description-block border-right">
                                        <span class="description-percentage text-green"><i class="fa fa-object-group fa-2x"></i></span>
                                        <h5 class="description-header">{{ $totalTags }}</h5>
                                        <span class="description-text">TOTAL TAGS</span>
                                    </div>
                                </div>
                                <div class="col-sm-4 col-xs-6">
                                    <div class="description-block border-right">
                                        <span class="description-percentage text-yellow"><i class="fa fa-object-ungroup fa-2x"></i></span>
                                        <h5 class="description-header">{{ $totalTests }}</h5>
                                        <span class="description-text">TOTAL TESTS</span>
                                    </div>
                                </div>
                                <div class="col-sm-4 col-xs-6">
                                    <div class="description-block border-right">
                                        <span class="description-percentage text-green"><i class="fa fa-puzzle-piece fa-2x"></i></span>
                                        <h5 class="description-header">{{ $totalMethods }}</h5>
                                        <span class="description-text">TOTAL METHODS</span>
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
            $('.list-group-item a').click(function(event) {
                event.preventDefault();
            });
            $('.list-group-item').click(function(event){
                event.preventDefault();
                $('.list-group-item ').removeClass('active');
                $(this).addClass('active');
            });
            @if($appEntity->tags()->count()==0)
                $('[data-parent="#accordion"]').click()
            @endif
            $('.allTags').html({{$totalTests}});

            $('.scanByTests').click(function () {
                $('.scanByTests .text').loading();
            });
        });
    </script>
@endsection
@section('endBodyExtras')
@endsection
