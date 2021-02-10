@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row m-4">
            <div class="col-md-3 text-center">
                <a class="btn btn-success" href='{{route('book.create')}}'>Add Book</a>
            </div>
            <div class="col-md-5 text-center">
                <h3 class="">Manage Books</h3>
            </div>

            <div class="py-4">
            @isset($books)
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th scope="col">Title</th>
                        <th scope="col">Price</th>
                        <th scope="col">Date created</th>
                        <th scope="col">Status</th>
                        <th scope="col">Create by</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach ($books as $book)
                        <tr>
                            <td>{{$book->title}}</td>
                            <td>€ {{$book->price}}</td>
                            <td>{{$book->created_at}}</td>
                            <td @if($book->status == 1)
                                    class="badge-warning">
                                @else
                                    class="badge-success">
                                @endif
                                {{$book->getBookStatus()}}</td>
                            <td>Rytis Klimavicius</td>
                            <td>
                                <div class="row">
                                    <form action="{{route('book.edit',$book->id)}}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-warning mx-2">Edit</button>
                                    </form>

                                    <form action="{{route('book.destroy',$book->id)}}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger mx-2" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </div>
                            </td>

                        </tr>
                    @endforeach
                    </tbody>

                </table>

            </div>

        </div>

        @endisset

    </div>
@endsection
