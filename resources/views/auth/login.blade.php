@extends( $appAuthTemplate )

@section('css-library')

@endsection

@section('css')
    
@endsection

@section('content')
<div class="row h-100">
    <div class="col-lg-6 col-12">
        <div id="auth-left">
            <h1 class="auth-title">Login</h1>
            <form action="{{ url("login-proses") }}" method="POST">
                @csrf
                <div class="form-group position-relative has-icon-left mb-2">
                    <input type="text" class="form-control form-control-xl" name="username" placeholder="Username" required autofocus>
                    <div class="form-control-icon">
                        <i class="bi bi-person"></i>
                    </div>
                </div>
                <div class="form-group position-relative has-icon-left mb-2">
                    <input type="password" class="form-control form-control-xl" name="password" placeholder="Password" required>
                    <div class="form-control-icon">
                        <i class="bi bi-shield-lock"></i>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-3">Login</button>
            </form>
            <div class="text-center mt-5 text-lg fs-5">
                <p><a class="font-bold" href="auth-forgot-password.html">Forgot password?</a></p>
            </div>
        </div>
    </div>
    <div class="col-lg-6 d-none d-lg-block">
        <div id="auth-right">

        </div>
    </div>
</div>
@endsection

@section('js-library')

@endsection

@section('js')

@endsection