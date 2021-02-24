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
                    <h4>Api tokens</h4>
                </div>

                <div class="text-center mt-3 mb-5">

                    @if(count(Auth()->user()->tokens) == 0)
                        <p>You dont have any generated tokens.</p>
                    @else
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th scope="col">id</th>
                                <th scope="col">name</th>
                                <th scope="col">Last used at</th>
                                <th scope="col">Created at</th>
                                <th scope="col">Updated at</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach(Auth()->user()->tokens as $token)
                                <tr>
                                    <td>{{$token->id}}</td>
                                    <td>{{$token->name}}</td>
                                    <td>{{$token->last_used_at}}</td>
                                    <td>{{$token->created_at}}</td>
                                    <td>{{$token->updated_at}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
                <form id="generate-token-form" action="{{ route('api.store') }}" method="POST">
                    @csrf


                    <div class="form-group col-md-6 offset-3">
                        <label for="token_field">Token name</label>
                        <input class="form-control" id="token_field" name="token_name"
                               value="{{ old('price') }}" placeholder="Enter token name">
                    </div>
                    <div class="d-flex justify-content-center my-4">

                        <button class="btn btn-outline-success " type="submit">Create token</button>
                    </div>

                </form>
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
