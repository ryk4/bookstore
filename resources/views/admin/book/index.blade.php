@section('title')
    Booster - Starter
@endsection
@extends('layouts.main')
@section('style')

@endsection
@section('rightbar-content')
    <div class="xp-contentbar">
        <div class="row">
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
                                    <a href="{{route('books.show',$book)}}">Preview book</a>
                                </td>
                                <td>{{$book->user->name}}</td>
                                <td>
                                    <div class="row">
                                        @if(! $book->isActive())
                                            <form action="{{route('admin.books.approve',$book)}}" method="POST">
                                                @method('POST')
                                                @csrf

                                                <button type="submit" class="btn btn-outline-success mx-2">Approve<i
                                                        class="mdi mdi-plus ml-2"></i></button>
                                            </form>
                                        @endif
                                        <a class="btn btn-outline-warning mx-2"
                                           href="{{route('books.edit', $book->id)}}">Edit</a>
                                        <button type="button" class="btn btn-outline-danger" data-toggle="modal"
                                                data-target="#confirmRemoveBookModal-{{$book->id}}">Delete
                                            <i class="mdi mdi-delete-sweep ml-2"></i>
                                        </button>
                                        <div class="modal fade" id="confirmRemoveBookModal-{{$book->id}}" tabindex="-1"
                                             role="dialog"
                                             aria-labelledby="confirmRemoveBookModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="confirmRemoveBookModalLabel">
                                                            Deleting a book</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p class="text-muted">Are you sure you want to delete
                                                            this book? There is no
                                                            way to restore it.</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Close
                                                        </button>
                                                        <form action="{{route('books.destroy',$book)}}"
                                                              method="POST">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="submit" class="btn btn-danger">
                                                                Confirm
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                @endif
            </div>
        </div>
    </div>
@endsection
@section('script')

@endsection
