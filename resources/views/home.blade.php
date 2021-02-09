@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            @if(isset($books))
                @foreach($books as $book)
                    <a href="#" class="col-lg-2dot4 mb-2">
                        <div class="individualBook border border-primary  p-1">
                            <div class="align-content-center m-1">
                                <img class="img-fluid" src="{{asset('/images/'.$book->cover.'.jpg')}}">
                            </div>
                            <div class="d-flex justify-content-center">
                                <h5>{{$book->title}}</h5>
                            </div>
                            <div>
                                <span>J.K Rowling</span>
                            </div>
                            <div class="d-flex justify-content-center mt-2">
                                <h3>€{{$book->price}}</h3>
                            </div>
                        </div>
                    </a>
                @endforeach
            @else

                <p>No books</p>
            @endif



        </div>
    </div>
@endsection
