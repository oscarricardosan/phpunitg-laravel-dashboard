<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>@yield('pageTitle', 'PhpunitG')</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <style>
            .error_message{
                color: red!important;
            }
            .select2.select2-container{
                width: 100%!important;
            }
            .fa{
                padding-right: 0.2em;
            }
            .sidebar-menu .treeview-menu>li>a{
                white-space: initial;
            }
            .numeric{
                text-align: right;
            }
        </style>


        <!-- Scripts -->
        <script>
            window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
            ]); ?>
        </script>

        @yield('extrasHeadStart')
        <!-- Bootstrap 3.3.6 -->
        <link href="{{ asset("/bower_components/AdminLTE/bootstrap/css/bootstrap.min.css") }}" rel="stylesheet" type="text/css" />
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ asset("/packages/font-awesome-4.7.0//css/font-awesome.min.css") }}">
        <!-- Ionicons -->
        <link rel="stylesheet" href="{{ asset("/packages/ionicons-2.0.1/css/ionicons.min.css") }}">
        <!-- Select2 -->
        <link rel="stylesheet" href="{{ asset ("/bower_components/AdminLTE/plugins/select2/select2.min.css") }}" rel="stylesheet" type="text/css">
        <!-- Theme style -->
        <link href="{{ asset("/bower_components/AdminLTE/dist/css/AdminLTE.min.css")}}" rel="stylesheet" type="text/css" />
        <!-- Bootstrap 3.3.6 -->
        <link rel="stylesheet" href="{{ asset("/bower_components/AdminLTE/bootstrap/css/bootstrap.min.css") }}">
        <!-- Ion Slider -->
        <link rel="stylesheet" href="{{ asset("/bower_components/AdminLTE/plugins/ionslider/ion.rangeSlider.css") }}">
        <!-- Toastrjs -->
        <link rel="stylesheet" href="{{ asset("/bower_components/toastr/toastr.css") }}">
        <!-- bootstrap datepicker -->
        <link rel="stylesheet" href="{{ asset("/bower_components/AdminLTE/plugins/datepicker/datepicker3.css") }}">
        <!-- Bootstrap time Picker -->
        <link rel="stylesheet" href="{{ asset("/bower_components/AdminLTE/plugins/timepicker/bootstrap-timepicker.min.css") }}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset("/bower_components/AdminLTE/dist/css/AdminLTE.min.css") }}">
        <!-- DataTables -->
        <link rel="stylesheet" href="{{ asset("/bower_components/AdminLTE/plugins/datatables/dataTables.bootstrap.css") }}">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="{{ asset("/bower_components/AdminLTE/dist/css/skins/_all-skins.min.css") }}">
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <!-- jQuery 2.1.3 -->
        <script src="{{ asset ("/bower_components/AdminLTE/plugins/jQuery/jquery-2.2.3.min.js") }}"></script>
        <!-- UnderscoreJs -->
        <script src='{{ asset ("/bower_components/underscore/underscore.js") }}'></script>
        <!-- MomentJS -->
        <script src='{{ asset ("/bower_components/moment/moment.js") }}'></script>
        <!-- AccountingJS -->
        <script src='{{ asset ("/bower_components/accounting/accounting.js") }}'></script>
        <!-- Select2 -->
        <script src="{{ asset ("/bower_components/AdminLTE/plugins/select2/select2.full.js") }}"></script>
        <!-- Vuejs 2.0 -->
        <script src="{{ asset ("/bower_components/vue/dist/vue.js") }}"></script>
        <!-- Vuejs Resources -->
        <script src="{{ asset ("/bower_components/vue-resource/dist/vue-resource.js") }}"></script>
        <!-- ToasterJs -->
        <script src="{{ asset ("/bower_components/toastr/toastr.js") }}"></script>
        <!-- Utilities -->
        <script src="{{ asset ("/js/utilities.js") }}?{{\Carbon\Carbon::now()->toDateTimeString()}}"></script>
        <!-- REQUIRED JS SCRIPTS -->
        <!-- Bootstrap 3.3.2 JS -->
        <script src="{{ asset ("/bower_components/AdminLTE/bootstrap/js/bootstrap.min.js") }}" type="text/javascript"></script>
        <!-- SlimScroll -->
        <script src="{{ asset("/bower_components/AdminLTE/plugins/slimScroll/jquery.slimscroll.min.js") }}"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset ("/bower_components/AdminLTE/dist/js/app.min.js") }}" type="text/javascript"></script>
        <!-- bootstrap datepicker -->
        <script src="{{ asset("/bower_components/AdminLTE/plugins/datepicker/bootstrap-datepicker.js") }}"></script>
        <!-- bootstrap time picker -->
        <script src="{{ asset("/bower_components/AdminLTE/plugins/timepicker/bootstrap-timepicker.min.js") }}"></script>
        <!-- DataTables -->
        <script src="{{ asset("/bower_components/AdminLTE/plugins/datatables/jquery.dataTables.min.js") }}"></script>
        <script src="{{ asset("/bower_components/AdminLTE/plugins/datatables/dataTables.bootstrap.min.js") }}"></script>
        <!-- Optionally, you can add Slimscroll and FastClick plugins.
              Both of these plugins are recommended to enhance the
              user experience -->
        <!-- Own utilities -->
        <link rel="stylesheet" href="{{ asset("/css/utilities.css") }}?{{\Carbon\Carbon::now()->toDateTimeString()}}">
        @yield('extrasHeadEnd')
    </head>
    <body class="skin-black sidebar-mini @yield('estateSidebar')">
        <div class="wrapper" style="height: auto;">
            @yield('header')
            @yield('sidebar')
            @yield('content')
            @yield('footer')
        </div>
        @yield('endBodyExtras')

        @stack('endBodyExtras')

        <script>
            $(".select2").select2();

            var elementLoading= '<i class="fa fa-spinner fa-pulse fa-3x fa-fw SpriteLoading" style="font-size: 22px;"></i>';

            $('form').submit(function(){
                buttons= $(this).find('[type="submit"]');
                buttons.each(function(){
                    $(this).prepend(
                        '<i class="fa fa-spinner fa-pulse fa-3x fa-fw SpriteLoading" style="font-size: 22px;"></i>'
                    );
                });
                setTimeout(function() { $('.SpriteLoading').remove(); }, 4000);
            });

            $(document).ajaxStart(function(){$('[type="submit"]').prepend(elementLoading);});
            $(document).ajaxSuccess(function(){$('.SpriteLoading').remove();});
            $(document).ajaxError(function(){$('.SpriteLoading').remove();});
            $(document).ajaxStop(function(){$('.SpriteLoading').remove();});

            //Date picker
            $('.datepicker').datepicker({
                autoclose: true,
                format: 'yyyy-mm-dd'
            });
            //Timepicker
            $(".timepicker").timepicker({
                showInputs: false,
                showMeridian: false,
            });



            // Set active state on menu element
            var current_url = "{{ Request::url() }}";
            $("ul.sidebar-menu li a").each(function() {
                if ($(this).attr('href') == current_url)
                    $(this).parents('li').addClass('active');
            });

            $('#searchTagSidebar').keyup(function(){
                var search= $(this).val();
                $('.sidebar-menu.tags li.tag').css('display', 'none');
                $('.sidebar-menu.tags li.tag:icontains('+search+')').each(function(){
                    $(this).css('display', 'block');
                });
            });
        </script>
    </body>
</html>