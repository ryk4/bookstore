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
                <div class="row">
                    <div class="col-md-3 text-center">
                        <a class="btn btn-outline-success" href='{{route('book.create')}}'>Insert<i class="mdi mdi-plus ml-2"></i></a>
                    </div>
                    <div class="col-md-5 text-center">
                        <h3 class="">Manage Books</h3>
                    </div>
                    <div class="col-4">
                    </div>


                    <div class="col-md-12 col-lg-12 col-xl-12 py-4 ">
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
                                                    <button type="button" class="btn btn-outline-warning mx-2">Edit<i class="mdi mdi-upload ml-2"></i></button>
                                                </form>


                                                <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#exampleStandardModal">Delete
                                                    <i class="mdi mdi-delete-sweep ml-2"></i>
                                                </button>

                                                <div class="modal fade" id="exampleStandardModal" tabindex="-1" role="dialog"
                                                     aria-labelledby="exampleStandardModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleStandardModalLabel">Deleting a book</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p class="text-muted">Are you sure you want to delete this book? There is no
                                                                way to restore it.</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <form action="{{route('book.destroy',$book->id)}}" method="POST">
                                                                    @method('DELETE')
                                                                    @csrf
                                                                    <button type="submit" class="btn btn-danger">Confirm</button>
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

                    </div>
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
