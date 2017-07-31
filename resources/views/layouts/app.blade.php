<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>

    @section('htmlheader')
        @include('partials.htmlheader')
    @show

</head>

<body class="skin-blue sidebar-mini">
    <div id="app">
        <div class="wrapper">

        @include('partials.header')

        @include('partials.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            @include('partials.contenthead')

            <!-- Main content -->
            <section class="content">
                <!-- Your Page Content Here -->
                @yield('main-content')
            </section><!-- /.content -->
        </div><!-- /.content-wrapper -->

        @include('partials.controlsidebar')

        @include('partials.footer')

    </div><!-- ./wrapper -->
</div>
@section('scripts')
    @include('partials.scripts')
@show
<!-- ./wrapper -->

</body>>
</html>

