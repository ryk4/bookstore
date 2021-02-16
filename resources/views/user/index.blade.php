@section('title')
    Booster - Starter
@endsection
@extends('layouts.main')
@section('style')

@endsection
@section('rightbar-content')
    <!-- Start XP Contentbar -->
    <div class="xp-contentbar">
        <!-- Write page content code here -->
        <!-- Start XP Row -->
        <div class="row">
            <!-- Start XP Col -->
            <div class="col-md-12 col-lg-12 col-xl-12">
                <div class="text-center mt-3 mb-5">
                    <h4>Modify personal information</h4>
                </div>

                <div class="d-flex justify-content-center">
                    <div class="col-10">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{route('user.update',$user)}}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <label for="name_field">Fullname</label>
                                <input class="form-control" id="name_field" name="name" placeholder="Enter fullname"
                                       value="{{$user->name}}">
                            </div>

                            <div class="form-group">
                                <label for="email_field">Email address</label>
                                <input class="form-control" id="email_field" name="email" placeholder="Enter email"
                                       value="{{$user->email}}">
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="password_field">Password</label>
                                    <input class="form-control" type="password" id="password_field" name="password" placeholder="Enter password"
                                           autocomplete="new-password">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="password-confirm">Confirm Password</label>
                                    <input id="password-confirm" type="password" class="form-control"
                                               name="password_confirmation"
                                               autocomplete="new-password" placeholder="Confirm password">
                                </div>
                            </div>

                            <div class="d-flex justify-content-center my-4">
                                <button class="btn btn-outline-success m-2 my-sm-0 " type="submit">Update</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <!-- End XP Col -->
        </div>
        <!-- End XP Row -->
    </div>
    <!-- End XP Contentbar -->
@endsection
@section('script')

@endsection
