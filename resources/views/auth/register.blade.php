@extends('layouts.auth')

@section('title')
    Register
@endsection

@section('content')
<body class="hold-transition register-page">
    <img src="{{asset('images/cemos_logo.png')}}" class="img-responsive" style="margin-left: 100px;margin-top: 50px;">
    <div class="register-box">
        <div class="register-logo">
            <a href="../../index2.html"><b>Cemos</b>Supplier</a>
        </div>

        <div class="register-box-body">
            <p class="login-box-msg">Register a new membership</p>

            <form action="../../index.html" method="post">
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" placeholder="Full name">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="email" class="form-control" placeholder="Email">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" placeholder="Password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" placeholder="Retype password">
                    <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-8">  
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
                    </div>
                    <!-- /.col -->
              </div>
        </form>
      </div>
      <!-- /.form-box -->
    </div>

@include('partials.scripts')
</body>
@endsection
