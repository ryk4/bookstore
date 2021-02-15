@section('title')
    Booster - Forgot Password
@endsection
@extends('layouts.main_auth')
@section('style')

@endsection
<div class="xp-authenticate-bg"></div>
<!-- Start XP Container -->
<div id="xp-container" class="xp-container">
    <!-- Start Container -->
    <div class="container">
        <!-- Start XP Row -->
        <div class="row vh-100 align-items-center">
            <!-- Start XP Col -->
            <div class="col-lg-12 ">
                <!-- Start XP Auth Box -->
                <div class="xp-auth-box">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="text-center mt-0 m-b-15">
                                <a href="/" class="xp-web-logo"><img src="assets/images/logo.png" height="40"
                                                                     alt="logo"></a>
                            </h3>
                            <div class="p-3">
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif

                                <form method="POST" action="{{ route('password.email') }}">
                                    @csrf
                                    <div class="text-center mb-3">
                                        <h4 class="text-black">Forgot Password</h4>
                                        <p class="text-muted">Remember Password? <a href="{{ route('login') }}">Sign
                                                In</a> Here</p>

                                    </div>
                                    <p class="text-muted text-center m-b-30">We’ll send you instructions via email to
                                        help you reset your password.</p>
                                    <div class="form-group">

                                        <input id="email" type="email"
                                               class="form-control @error('email') is-invalid @enderror" name="email"
                                               value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email address">

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-rounded btn-lg btn-block">Send
                                        Email
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End XP Auth Box -->
            </div>
            <!-- End XP Col -->
        </div>
        <!-- End XP Row -->
    </div>
    <!-- End Container -->
</div>
<!-- End XP Container -->
@section('script')

@endsection
