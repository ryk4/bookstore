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

                @isset($secret_api)
                    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="myModal">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleSmallModalLabel">Token API key</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p class="text-muted"><b>Warning: </b>This token will be displayed this one time only. There is no way to view it at any time later.
                                    Please make a note of it, so you can use it for your API requests. If you forget this api key, you will have to create a brand new
                                    one.</p>
                                </div>
                                <div class="modal-body">
                                <p class="text-muted">Bearer <b>{{$secret_api}}</b></p>
                            </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">I noted it!</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endisset

                <div class="text-center mt-3 mb-5">

                    @if(count(Auth()->user()->tokens) == 0)
                        <p>You dont have any generated tokens.</p>
                    @else
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th scope="col">name</th>
                                <th scope="col">Last used at</th>
                                <th scope="col">Created at</th>
                                <th scope="col">Updated at</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach(Auth()->user()->tokens as $token)
                                <tr>
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
                <div class="text-center mt-5 mb-5">
                    <h5>Create API Key</h5>
                <form id="generate-token-form" action="{{ route('api.store') }}" method="POST">
                    @csrf


                    <div class="form-group col-lg-6 offset-3 my-3">
                        <input class="form-control" id="token_field" name="token_name"
                               value="{{ old('price') }}" placeholder="Enter token name">
                    </div>
                    <div class="d-flex justify-content-center my-4">

                        <button class="btn btn-outline-success " type="submit">Create token</button>
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

    <script type="text/javascript">
        $(window).on('load', function () {
            $('#myModal').modal('show');
        });
    </script>

@endsection
