<!DOCTYPE html>
<html lang="en">
<head>
  @include('head')
  <link rel="stylesheet" href="../../css/login.css">
</head>
<body class="hold-transition login-page">
    @section('header')
        <header>
            <a href="/" class="logo"><img src="../image/logo.jpg" alt=""></a>
            <ul>
                <li><a href="/entercode">Enter code</a></li>
                <li><a href="/users/login" class="signup">Sign in ></a></li>
            </ul>
        </header>
    @endsection

    @section('createnew')
        <form action="/users/login" method="post">
            <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="User name" name="username">
            <div class="input-group-append">
                <div class="input-group-text">
                <span class="fas fa-user"></span>
                </div>
            </div>
            </div>
            <div class="input-group mb-3">
                <input type="password" class="form-control" placeholder="Password" name="password">
                <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
                </div>
            </div>
            <div class="input-group mb-3">
                <input type="password" class="form-control" placeholder="Confirm password" name="confirmpassword">
                <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary btn-block">Create</button>
                </div> 
                <div class="col-12 d-flex justify-content-center mt-2">
                    <a href="/users/login" class="text-center"><small>Login</small></a>
                </div>
            </div>
            @csrf
        </form>
    @endsection

    @section('login')
        <form action="/users/login" method="post">
            <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="User name" name="username">
            <div class="input-group-append">
                <div class="input-group-text">
                <span class="fas fa-user"></span>
                </div>
            </div>
            </div>
            <div class="input-group mb-3">
                <input type="password" class="form-control" placeholder="Password" name="password">
                <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                </div> 
                <div class="col-12 d-flex justify-content-center mt-2">
                    <a href="/users/logincreatenew" class="text-center"><small>Create new an account</small></a>
                </div>
            </div>
            @csrf
        </form>
    @endsection

    @yield('header')

    <div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
        <a href="/" class="h1"><b>MQ</b>Choice</a>
        </div>
        <div class="card-body">
        <p class="login-box-msg">{{ $title }}</p>
        
        @if ($isnew)
            @yield('createnew')
        @else
            @yield('login')
        @endif
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
    </div>
    <!-- /.login-box -->
    @include('foot')
</body>
</html>
