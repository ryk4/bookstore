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
                <div class="text-center mt-3 mb-5">
                    <h4>Approve books</h4>
                </div>

                @isset($books)
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th scope="col">Title</th>
                            <th scope="col">Price</th>
                            <th scope="col">Date created</th>
                            <th scope="col">URL</th>
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
                                <td>
                                    <a href="#">Book Url</a>
                                </td>
                                <td>Rytis Klimavicius</td>
                                <td>
                                    <div class="row">
                                        <form action="{{route('approveBook',$book)}}" method="POST">
                                            @method('PUT')
                                            @csrf
                                            <input name="validate" value="1" hidden>
                                            <button type="submit" class="btn btn-outline-success mx-2">Approve<i class="mdi mdi-plus ml-2"></i></button>
                                        </form>
                                        <form action="{{route('approveBook',$book)}}" method="POST">
                                            @method('PUT')
                                            @csrf
                                            <input name="validate" value="2" hidden>
                                            <button type="submit" class="btn btn-outline-danger mx-2">Remove<i class="mdi mdi-delete-sweep ml-2"></i></button>
                                        </form>


                                    </div>
                                </td>

                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                @endisset
            </div>
            <!-- End XP Col -->
        </div>
        <!-- End XP Row -->
    </div>
    <!-- End XP Contentbar -->
@endsection
@section('script')

@endsection
