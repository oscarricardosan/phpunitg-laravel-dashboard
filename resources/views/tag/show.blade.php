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
    $totalMethods= 0;
@endphp
@section('content')
    <style>
        .testGroup{
            color: blue;
            font-size: 1.1em;
        }
        #tableTests thead tr th:first-child,
        #tableTests tbody tr td:first-child,
        #tableTests tfoot tr th:first-child{
            text-align: center;
        }
        .tr_test .result{
            height: 10em;
            overflow: auto;
            word-break: break-all;
            -webkit-word-break: break-all;
            -mox-word-break: break-all;
        }
        .tr_test td{
            word-break: break-all;
            -webkit-word-break: break-all;
            -mox-word-break: break-all;
        }
        .tr_test.danger .fa-question-circle,
        .tr_test.danger .fa-check-circle{
            display: none;
        }
        .tr_test.active .fa-times-circle,
        .tr_test.active .fa-check-circle{
            display: none;
        }
        .tr_test.success .fa-times-circle,
        .tr_test.success .fa-question-circle{
            display: none;
        }
    </style>
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Tests of tag:
                <a href="{{ route('Tag.Show', $tagEntity) }}">
                    {{ $tagEntity->name }}
                </a>
                <small>{{ $tagEntity->app->url }}</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><a href="{{ route('App.Show', $tagEntity->app) }}"><i class="fa fa-star-o"></i> {{ $tagEntity->app->name }}</a></li>
                <li class="active">{{ $tagEntity->name }}</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-danger">
                        <div class="box-header with-border">
                            <h3 class="box-title">Tests</h3>

                            <div class="box-tools pull-right">
                                <a type="button"
                                    class="btn btn-box-tool runSelectedTests" style="color: #354eb5;" href="{{ route('App.ScanTests', $tagEntity) }}"

                                >
                                    <i class="fa fa-cogs" style="color: green;"></i>
                                    <span class="text" style="color: green;">Run selected tests</span>
                                </a>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <h4>Tests</h4>
                                </div>
                                <div class="col-md-8">
                                    <h4>Methods</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div  class="word-break">
                                        <button type="button" class="list-group-item active"
                                                href="#tab_app_0" data-toggle="tab"
                                                style="margin-bottom: 0.5em;"
                                        >
                                            <span class="badge"><span class="allMethods"></span></span>
                                            ALL METHODS
                                        </button>
                                        @foreach($tagEntity->tests->sortBy('name') as $key=> $test)
                                            <button type="button" class="list-group-item "
                                                    href="#tab_app_{{$key +1 }}" data-toggle="tab" >
                                                <span class="badge">{{ $test->methods->count()}}</span>
                                                {{ $test->class}}<br>

                                                <small class="bg-gray">
                                                    <b>Path: </b> {{ $test->path }}
                                                </small>
                                            </button>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab_app_0">
                                            <table class="table table-bordered tableTests">
                                                <thead>
                                                <tr>
                                                    <th style="width: 1%">
                                                        <input type="checkbox" class="selectAll">
                                                    </th>
                                                    <th style="width: 30%">Method</th>
                                                    <th style="width: 68%">Last execution</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($tagEntity->tests->sortBy('name') as $key=> $test)
                                                    @foreach($test->methods as $method)
                                                        @php $totalMethods++ @endphp
                                                        @include('tag.partials.tr_method', [
                                                            'test'=> $test,
                                                            'method'=> $method,
                                                        ])
                                                    @endforeach
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        @foreach($tagEntity->tests->sortBy('name') as $key=> $test)
                                            <div class="tab-pane" id="tab_app_{{$key +1 }}">
                                                <table class="table table-bordered tableTests">
                                                    <thead>
                                                    <tr>
                                                        <th style="width: 1%">
                                                            <input type="checkbox" class="selectAll">
                                                        </th>
                                                        <th style="width: 30%">Method</th>
                                                        <th style="width: 68%">Last execution</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($test->methods as $method)
                                                        @include('tag.partials.tr_method', [
                                                            'test'=> $test,
                                                            'method'=> $method,
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
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="phpunitResponse" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">PHPUNIT Response</h4>
                </div>
                <div class="modal-body word-break">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Tag.Show -->
    <script>
        $(document).ready(function(){
            var queue= [];
            $('.list-group-item a').click(function(event) {
                event.preventDefault();
            });
            $('.list-group-item').click(function(event){
                event.preventDefault();
                $('.list-group-item ').removeClass('active');
                $(this).addClass('active');
            });
            $('.allMethods').html({{$totalMethods}});

            $('.selectAll').click(function(){
                if($(this).is(':checked'))
                    $(this).closest('table').find('.testSelect').prop('checked', true);
                else
                    $(this).closest('table').find('.testSelect').prop('checked', false);
            });
            $('.runSelectedTests').click(function (event) {
                event.preventDefault();
                queue= $('.testSelect:checked');
                runTestPendingInQueue();
            });
            $('.seePhpunitResponse').click(function (event) {
                event.preventDefault();
                var response= $(this).closest('tr').find('.result').html();
                $('#phpunitResponse .modal-body').html(response);
            });
            function runTestPendingInQueue(){
                if(queue.length>0){
                    $(queue[0]).closest('tr').find('.runTest').click();
                    queue.splice(0, 1);
                }
            }
            $('.runTest').click(function(event){
                event.preventDefault();
                var tr= $(this).closest('tr');
                var method_id= tr.data('method-id');
                var method_trs= $('tr[data-method-id="'+method_id+'"]');
                var button= $(this);
                button.find('.text').loading();
                var request = $.ajax({
                    url: "{{  route('Method.Run', '?') }}".replace('?', method_id),
                    type: 'get',
                    dataType: "json"
                });
                request.done(function(respon){
                    method_trs.removeClass('active');
                    method_trs.removeClass('danger');
                    method_trs.removeClass('success');
                    if(respon.success){
                        method_trs.addClass('success');
                    }else{
                        method_trs.addClass('danger');
                    }
                    $('tr[data-method-id="'+method_id+'"] .result').html(respon.message);
                    button.find('.text').html('Run test');
                    runTestPendingInQueue();
                });
                request.fail(function(jqXHR, textStatus) {
                    utilities.errorPetitAjax(jqXHR, textStatus);
                });
            });

        });
    </script>
@endsection
@section('endBodyExtras')
@endsection
