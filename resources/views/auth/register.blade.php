@section('title')
    Register
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
                                <a href="/" class="xp-web-logo"><img src="assets/images/logo.png" height="40" alt="logo"></a>
                            </h3>
                            <div class="">
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf

                                    <div class="text-center">
                                        <h4 class="text-black">Sign Up !</h4>
                                        <p class="text-muted">Already have an account? <a href="{{ route('login') }}">Sign in</a> Here</p>
                                    </div>

                                    <div class="form-group">
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"
                                               required autocomplete="name" autofocus placeholder="Full name">

                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"
                                               required autocomplete="email" placeholder="Email address">

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                                               required autocomplete="new-password" placeholder="Password">

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror

                                    </div>

                                    <div class="form-group">

                                        <div class="">
                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
                                                   autocomplete="new-password" placeholder="Confirm password">

                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="password-confirm" class="col-md-3 col-form-label text-md-right">{{ __('Date of Birth') }}</label>

                                        <div class="col-md-9">
                                            <input id="dob" type="date" class="form-control @error('dob')
                                                is-invalid @enderror" name="dob" value="{{ old('dob') }}" required>

                                            @error('dob')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="terms">
                                            <label class="custom-control-label" for="terms">I Agree to Terms & Conditions</label>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-rounded btn-lg btn-block">Create an Account</button>
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
