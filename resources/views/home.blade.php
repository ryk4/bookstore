@extends('layouts.app')

@section('content')

    <div class="row flex-d justify-content-center">
        @if(isset($books))
            @foreach($books as $book)
                <div class="card m-3" style="width: 19rem;">
                    <span class="notify-badge">NEW</span>

                    <img class="book img-thumbnail" src="{{asset('/storage/'.$book->cover)}}">

                    <div class="card-body">
                        <h5 class="card-price">€ {{$book->price}}</h5>
                        <a href="/book/{{$book->id}}"><h5 class="card-title">{{$book->title}}</h5></a>
                        <p class="card-text">{{$book->description}}</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            @foreach($book->genres as $genre)
                                <a class="mr-2" href="#">{{$genre->name}}</a>
                            @endforeach
                        </li>
                        <li class="list-group-item">
                            @foreach($book->authors as $authors)
                                <a class="mr-2" href="#">{{$authors->fullname}}</a>
                            @endforeach
                        </li>
                    </ul>

                    <div class="container">
                        <div class="row justify-content-md-center">
                            <div class="col-md-auto">
                                Average: 4.2 (10 votes)
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else

            <p>No books</p>
    @endif


@endsection
