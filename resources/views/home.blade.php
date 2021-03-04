@section('title')
    BookStore.lt
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

                    <div class="text-center col-6 offset-3 mt-3 mb-5">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                    </div>

                    @isset($books)
                        <div class="row">
                            @foreach($books as $book)
                                <div class="col-md-6 col-lg-6 col-xl-2dot4">
                                    <div class="card m-b-30">
                                        <div class="card-img-overlay" style="height: 100px;">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    @if($book->discount != 0)
                                                        <h5><span
                                                                class="badge badge-success">€ {{$book->price_discounted()}}</span>
                                                        </h5>
                                                        <h5><span class="badge badge-secondary"><del>€ {{$book->price}}</del></span>
                                                        </h5>
                                                    @else
                                                        <h5><span
                                                                class="badge badge-success">€ {{$book->price_discounted()}}</span>
                                                        </h5>
                                                    @endif

                                                </div>
                                                <div class="col-md-4 offset-4">

                                                    @if($book->isAddedThisWeek())
                                                        <h5><span class="badge badge-danger">New</span></h5>
                                                    @endisset

                                                </div>
                                            </div>
                                        </div>

                                        <img class="card-img-top img-fluid p-2"
                                             src="{{asset($book->cover)}}"
                                             alt="Card image cap" style="height:300px;width:300px;object-fit: cover ;">

                                        <div class="card-body">
                                            <h5 class="card-title"><a
                                                    href="{{route('book.show',$book->id)}}">{{$book->title}}</a></h5>
                                            <p class="card-text">{{ \Illuminate\Support\Str::limit($book->description, 70, $end='...') }}
                                            </p>
                                        </div>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">
                                                @foreach ($book->authors as $author)
                                                    <a href="#"><span
                                                            class="mdi mdi-account">{{$author->fullname}}</span></a>
                                                @endforeach
                                            </li>
                                        </ul>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">
                                                @foreach ($book->genres as $genre)
                                                    <a href="#"><span
                                                            class="mdi mdi-book-variant">{{$genre->name}}</span></a>
                                                @endforeach
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                        <nav class="d-flex justify-content-center" aria-label="Page navigation example">
                            {{ $books->links() }}
                        </nav>
                    @else
                        <h2>No books to show.</h2>
                    @endisset
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
