@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <a href="#" class="col-md-2dot4 mb-2">
                <div class="individualBook border border-primary p-1">
                    <div class="align-content-center m-1">
                        <img class="img-fluid" src="{{asset('/images/harry1.jpg')}}">

                    </div>
                    <div class="d-flex justify-content-center">
                        <h5>Harry Potter and Poopy
                        </h5>
                    </div>
                    <div>
                        <span>J.K Rowling</span>
                    </div>
                    <div class="d-flex justify-content-center mt-2">
                        <h3>£10.50</h3>
                    </div>
                </div>
            </a>
            <a href="#" class="col-md-2dot4 mb-2">
                <div class="individualBook border border-primary p-1">
                    <div class="align-content-center m-1">
                        <img class="img-fluid" src="{{asset('/images/harry1.jpg')}}">
                    </div>
                    <div class="d-flex justify-content-center">
                        <h5>Harry Potter and Poopy</h5>
                    </div>
                    <div>
                        <span>J.K Rowling</span>
                    </div>
                    <div class="d-flex justify-content-center mt-2">
                        <h3>£10.50</h3>
                    </div>
                </div>
            </a>
        </div>
    </div>
@endsection
