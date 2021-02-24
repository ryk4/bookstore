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

                @if($books->count() > 0)
                    <div class="text-center mt-3 mb-5">
                        <h4>Approve books</h4>
                    </div>
                @else
                    <div class="text-center mt-3 mb-5">
                        <h4>No books to approve</h4>
                    </div>
                @endif

                <div class="text-center col-6 offset-3 mt-3 mb-5">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>

                @if($books->count() > 0)


                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th scope="col">Title</th>
                            <th scope="col">Price</th>
                            <th scope="col">Date created</th>
                            <th scope="col">URL</th>
                            <th scope="col">Created by</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach ($books as $book)
                            <tr>
                                <td>{{$book->title}}</td>
                                <td>€ {{$book->price}}</td>
                                <td>{{$book->created_at}}</td>
                                <td>
                                    <a href="{{route('book.show',$book)}}">Preview book</a>
                                </td>
                                <td>{{$book->user->name}}</td>
                                <td>
                                    <div class="row">
                                        <form action="{{route('admin.book.approve',$book)}}" method="POST">
                                            @method('PUT')
                                            @csrf
                                            <input name="validate" value="1" hidden>
                                            <button type="submit" class="btn btn-outline-success mx-2">Approve<i
                                                    class="mdi mdi-plus ml-2"></i></button>
                                        </form>
                                        <form action="{{route('admin.book.approve',$book)}}" method="POST">
                                            @method('PUT')
                                            @csrf
                                            <input name="validate" value="2" hidden>
                                            <button type="submit" class="btn btn-outline-danger mx-2">Remove<i
                                                    class="mdi mdi-delete-sweep ml-2"></i></button>
                                        </form>


                                    </div>
                                </td>

                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                    @endif
            </div>
            <!-- End XP Col -->
        </div>
        <!-- End XP Row -->
    </div>
    <!-- End XP Contentbar -->
@endsection
@section('script')

@endsection
