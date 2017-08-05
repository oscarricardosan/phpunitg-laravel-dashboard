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
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-sm-10 col-sm-offset-1" style="padding-top: 3em;">
                    <div class="callout callout-info" style="background: #3b636d !important;">
                        <ol style="font-size: 1.3em;">
                            <li style="padding-bottom: 1em;">
                                <a href="#" data-toggle="modal" data-target="#register_app">Register your app.</a>
                            </li>
                            <li style="padding-bottom: 1em;">
                                In your app install our package
                                <kbd class="code">
                                    composer require --dev oscarricardosan/phpunitg_laravel
                                </kbd>
                            </li>
                            <li style="padding-bottom: 1em;">Set up your app.</li>
                            <li style="padding-bottom: 1em;">Enjoy your dashboard for the tests of your app.</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Dashboard.Index -->
@endsection
@section('endBodyExtras')
@endsection
