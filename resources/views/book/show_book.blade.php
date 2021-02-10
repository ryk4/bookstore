@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-center my-4">
        <div class="col-7 border rounded border-success">
            <h2 class="py-3">{{$book->title}}</h2>
            <div class="row">
                <div class="col-md-6">
                    <div class="align-content-center m-1 img-thumbnail">
                        <img class="img-fluid" src="{{asset('/images/'.$book->cover.'.jpg')}}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="container">
                        <div class="">
                            <div class="starrating risingstar d-flex flex-row-reverse justify-content-end mb-0">
                                <input type="radio" id="star5" name="rating" value="5" /><label for="star5" title="5 star"></label>
                                <input type="radio" id="star4" name="rating" value="4" /><label for="star4" title="4 star"></label>
                                <input type="radio" id="star3" name="rating" value="3" /><label for="star3" title="3 star"></label>
                                <input type="radio" id="star2" name="rating" value="2" /><label for="star2" title="2 star"></label>
                                <input type="radio" id="star1" name="rating" value="1" /><label for="star1" title="1 star"></label>
                            </div>
                            <span>Average: 4.2 (10 votes)</span>
                        </div>
                        <div class="pb-3 mt-5">
                            <h3>Full price: €{{$book->price}}</h3>
                        </div>
                        <div class="row pb-3">
                            @foreach($book->genres as $genre)
                                <button class="btn btn-outline-success my-2 my-sm-0 m-2" type="submit">{{$genre->name}}</button>
                            @endforeach
                        </div>
                        <div class="py-3">
                            <h3><b>Writen by:</b></h3>
                            @foreach($book->authors as $author)
                                <h3>{{$author->fullname}}</h3>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="container">
                <div class="row pb-2">
                    @foreach($book->reviews as $review)
                        <div class="col-md-4 pb-1">
                            <div class="card card-white post">
                                <div class="post-heading">

                                    <div class="float-left meta">
                                        <div class="title h5">
                                            <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                                            <b>{{$review->user->name}}</b>
                                            has commented.
                                        </div>
                                        <h6 class="text-muted time">{{$review->user->created_at}}</h6>
                                    </div>
                                </div>
                                <div class="post-description">
                                    <p>{{$review->actual_review}}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>


        </div>
    </div>
@endsection
