<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
    @include('layout.header')
    @yield('style')

    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            <!-- Main Header -->
            @include('layout.nav')
            <!-- Left side column. contains the logo and sidebar -->
            @include('layout.aside')
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        @yield('page_title')
                        {{-- <small>Optional description</small> --}}
                    </h1>
                    {{-- <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
                        <li class="active">Here</li>
                    </ol> --}}
                </section>

                <section class="content container-fluid">

                    <!--------------------------
                    | Your Page Content Here |
                    -------------------------->
                    
                            @yield('content')


                </section>
            </div>

            @include('layout.footer')

            <!-- Control Sidebar -->
            {{-- @include('layout.aside2') --}}
            <!-- /.control-sidebar -->
            <!-- Add the sidebar's background. This div must be placed
  immediately after the control sidebar -->
            {{-- <div class="control-sidebar-bg"></div> --}}
        </div>

        <script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
        <script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
        <script src="{{ asset('bower_components/select2/dist/js/select2.full.min.js') }}"></script>
        <script src="{{ asset('bower_components/PACE/pace.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables/media/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables/media/js/dataTables.bootstrap.min.js') }}"></script>
        <script src="{{ asset('plugins/sweet-alert/sweetalert.min.js') }}"></script>
        <script src="{{ asset('plugins/jquery.repeater.js') }}"></script>
        <script src="{{ asset('js/linh.js') }}"></script>
        <script type="text/javascript" src="/js/ckfinder/ckfinder.js"></script>
        <script>CKFinder.config( { connectorPath: '/ckfinder/connector' } );</script>
        @include('ckfinder::setup')
        @yield('js')
    </body>

</html>
