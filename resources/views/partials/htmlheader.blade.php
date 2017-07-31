<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>@yield('title')</title>
<!-- Tell the browser to be responsive to screen width -->
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Bootstrap 3.3.7 -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<!-- Font Awesome -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
<!-- jvectormap -->
<link rel="stylesheet" href="{{ asset('css/jvectormap/jquery-jvectormap.css')}}">
<!-- Theme style -->
<link rel="stylesheet" href="{{ asset('css/AdminLTE.min.css')}}">
<!-- AdminLTE Skins. Choose a skin from the css/skins
     folder instead of downloading all of them to reduce the load. -->
<link rel="stylesheet" href="{{ asset('css/skins/_all-skins.min.css')}}">

<link rel="stylesheet" href="{{ asset('css/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
<link rel="stylesheet" href="{{ asset('css/font-awesome-animation.min.css')}}">
<link rel="stylesheet" href="{{ asset('css/dropzone.min.css')}}">
<link rel="stylesheet" href="{{ asset('css/fancybox.min.css')}}">
<link rel="stylesheet" href="{{ asset('css/custom.css')}}">
<!-- jQuery 3 -->
<script src="{{ asset('css/jquery/dist/jquery.min.js')}}"></script>
<script src="{{ asset('js/dropzone.js')}}"></script>
<script src="{{ asset('js/custom-dropzone.js')}}"></script>

<script type="text/javascript">

	Dropzone.options.imageUpload = {
        maxFilesize         :       10,
        acceptedFiles: ".jpeg,.jpg,.png,.gif,.mp4,.avi,.mov,.wmv",

    };

</script>

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<!-- Google Font -->
<link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

