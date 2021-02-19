@section('title')
    Book
@endsection
@extends('layouts.main')
@section('style')

@endsection
@section('rightbar-content')

    <div class="xp-contentbar">

        <div class="text-center mt-3 mb-2">
            <h4>{{$book->title}}</h4>
        </div>

        <div class="text-center col-6 offset-3 mt-3 mb-5">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
        </div>

        <div class="row">
            <div class="col-lg-6 p-3 text-center">
                <div class="row">
                    <div class="col-md-5 offset-1">
                        @if($book->discount != 0)
                            <h5 class="ml-5"><span class="badge badge-success">€ {{$book->price_discounted()}}</span><span class="badge badge-secondary"><del>€ {{$book->price}}</del></span></h5>
                        @else
                            <h5>€ {{$book->price}}</h5>
                        @endif
                    </div>
                    <div class="col-md-5">
                        @if($book->isAddedThisWeek())
                            <h5><span class="badge badge-danger">New</span></h5>
                        @endisset
                    </div>
                </div>
                <img class="img-thumbnail" src="{{asset('/storage/'.$book->cover)}}"
                     style="max-height:500px;max-width:350px;object-fit: cover ;">
            </div>

            <div class="col-lg-5 p-3 my-4">
                <div class="container">
                    <p>{{$book->description}}</p>

                    <div class="pt-5">
                        <div class="row">
                            <div class="col-md-6">
                                @isset($book->authors)
                                    <h4>Writen by: </h4>
                                    @foreach($book->authors as $author)
                                        <h6><a href="#"><span class="mdi mdi-account">{{$author->fullname}}</span></a>
                                        </h6>
                                    @endforeach
                                @endisset
                            </div>
                            <div class="col-md-6">
                                @isset($book->genres)
                                    <h4>Genres: </h4>
                                    @foreach($book->genres as $genre)
                                        <a class="mx-1" href="#"><span
                                                class="mdi mdi-book-variant">{{$genre->name}}</span></a>
                                    @endforeach
                                @endisset
                            </div>
                        </div>
                        <div class="mx-2 my-5">
                            <form class="row" action="{{route('book.rating.store',$book)}}" method="POST" >
                                @csrf
                                <div class="pt-2">
                                    <select id="xp-rating-fontawesome" name="rating" autocomplete="off">
                                        <option value=1 selected>1</option>
                                        <option value=2>2</option>
                                        <option value=3>3</option>
                                        <option value=4>4</option>
                                        <option value=5>5</option>
                                    </select>
                                </div>
                                @guest
                                @else
                                    <div class="px-4">
                                        <button type="submit" class="btn btn-round btn-primary"><i class="mdi mdi-send"></i></button>
                                    </div>
                                @endguest
                            </form>

                            <p class="card-subtitle">Avg: {{$book->avg_rating()}} (Total {{$book->ratings->count()}})</p>
                            @guest
                            @else

                                @if($book->if_rating_left_by_user()!=null)
                                    <p class="card-subtitle py-1">Your: {{$book->rating_left_by_user()}} stars</p>
                                @else
                                    <p class="card-subtitle py-1">Your: Not rated...</p>
                                @endif
                            @endguest

                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="container mb-4">
            <div class="row d-flex justify-content-center">
                <div class="col-md-12">
                    <div class="headings d-flex justify-content-between align-items-center mb-3">
                        <h5>Comments ({{$book->comments->count()}})</h5>
                        <div class="buttons">
                            <div class="form-check form-switch"></div>
                        </div>
                    </div>
                    @isset($book->comments)
                        @foreach($book->comments->sortByDesc('created_at') as $comment)
                            <div class="card p-3 mt-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="user d-flex flex-row align-items-center">
                                        <img src="/assets/images/topbar/user.jpg" width="30"
                                             class="user-img rounded-circle mr-2"> <span>
                                            <small class="font-weight-bold text-primary">{{$comment->user->name}}</small>
                                            <small class="font-weight-bold">{{$comment->actual_comment}}</small></span>
                                    </div>
                                    <small>{{$comment->get_days_ago_readable()}}</small>
                                </div>
                                <div class="action d-flex justify-content-between mt-2 align-items-center">
                                    <div class="reply px-4"></div>
                                    <div class="icons align-items-center"><i
                                            class="fa fa-check-circle-o check-icon text-primary"></i></div>
                                </div>
                            </div>
                        @endforeach
                    @endisset
                    @guest
                    @else
                    <form action="{{route('book.comment.store',$book)}}" method="POST">
                        @csrf
                        <div class="card p-3 mt-2">
                            <div class="row justify-content-center">
                                <div class="col-9">
                                    <input class="form-control" id="comment_field" name="comment" placeholder="Enter your comment">
                                </div>
                                <div class="col-2">
                                    <input type="submit" class="btn btn-outline-primary"  placeholder="Enter your comment">
                                </div>
                            </div>
                        </div>
                    </form>
                    @endguest


                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('assets/plugins/jquery-bar-rating/jquery.barrating.min.js') }}"></script>
    <script src="{{ asset('assets/js/init/barrating-init.js') }}"></script>
@endsection

