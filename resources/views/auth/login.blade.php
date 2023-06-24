@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="login-box">
            <!-- /.login-logo -->
            <div class="card card-outline card-danger bg-transparent">
            <div class="card-header text-center">
            <a href="#" class="h1">Portal<br><b>EDUSTORE</b></a>
            </div>
            <div class="card-body">
            <p class="login-box-msg">Enter your username and password here!</p>
        
            <form action="{{ route('login') }}" method="POST">
                @csrf

                <div class="input-group mb-3">
                    <div class="input-group-append">
                        <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" style="background: transparent" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email" autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-append">
                        <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" style="background: transparent" name="password" required autocomplete="current-password" placeholder="Password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                
                </div>

                <div class="row">
                <div class="col-12">
                    <button type="submit" class="btn btn-outline-dark btn-block">Sign In</button>
                </div>
                <!-- /.col -->
                </div>
            </form>

            <hr>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
        </div>
        <!-- /.login-box -->
    </div>
</div>
@endsection
