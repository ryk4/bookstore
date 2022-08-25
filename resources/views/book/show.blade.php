@section('title')
    Book
@endsection
@extends('layouts.main')
@section('style')

@endsection
@section('rightbar-content')
    <div class="xp-contentbar">
        <div class="row mt-3 mb-2">
            <div class="col-6 offset-3 text-center">
                <h4>{{$book->title}}</h4>
            </div>
            @guest
            @else
                <div class="col-2 offset-1">
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#xp-varying-modal"
                            data-whatever="@mdo">Report
                    </button>
                </div>
            @endguest
        </div>
        <div class="modal fade" id="xp-varying-modal" tabindex="-1" role="dialog"
             aria-labelledby="xp-varying-modal-label" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="xp-varying-modal-label">Report book</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('books.report',$book)}}" method="POST">
                            @method('POST')
                            @csrf

                            <label class="col-form-label">We apologize you are unhappy or feel offended by this
                                particular book in any way.
                                Please provide as much information as you can, so we can take further action :)</label>
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">Message:</label>
                                <textarea class="form-control" id="message-text" name="complaint" required></textarea>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-danger">Send report</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
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
                            <h5 class="ml-5">
                                <span class="badge badge-success">€ {{$book->price_discounted()}}</span>
                                <span class="badge badge-secondary ms-2"><del>€ {{$book->price}}</del></span>
                            </h5>
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
                <img class="img-thumbnail" src="{{asset(''.$book->cover)}}"
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
                        <div class="my-5">
                            <ratings-index book_id="{{$book->id}}"></ratings-index>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container mb-4">
            <div class="row d-flex justify-content-center">
                <div class="col-md-12">
                    <comments-index book_id="{{$book->id}}"></comments-index>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('assets/plugins/jquery-bar-rating/jquery.barrating.min.js') }}"></script>
    <script src="{{ asset('assets/js/init/barrating-init.js') }}"></script>
@endsection

