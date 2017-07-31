@extends('layouts.auth')

@section('title')
    Log In
@endsection

@section('content')
<body class="hold-transition login-page">
    <img src="{{asset('images/cemos_logo.png')}}" class="img-responsive" style="margin-left: 100px;margin-top: 50px;">
    <div class="login-box">
        <div class="login-logo">
            <a href="../../index2.html"><b>Cemos</b>Supplier</a>
        </div>
            @if (session('status')) 
                {{ session('status') }}  
                <hr>    
            @endif
            <div class="login-box-body">
            <p class="login-box-msg">Sign in to start your session</p>
            <form action="{{url('login')}}" method="post">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="form-group has-feedback">
                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-8">
                      
                    </div>
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                    </div>
                </div>
            </form>
            <a href="#">I forgot my password</a><br>
        </div>
    </div>

@include('partials.scripts')

</body>
@endsection
