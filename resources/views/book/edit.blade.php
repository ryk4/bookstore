@section('title')
    Booster - Starter
@endsection
@extends('layouts.main')
@section('style')
    <!-- Select2 CSS -->
    <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css"/>
    <!-- Tagsinput CSS -->
    <link href="{{ asset('assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput-typeahead.css') }}" rel="stylesheet"
          type="text/css"/>
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
                    <h4>Edit book</h4>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="d-flex justify-content-center">
                    <div class="col-10">
                        <form action="{{route('book.update',$book)}}" method="POST" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <label for="title_field">Title</label>
                                <input type="text" class="form-control" id="title_field" name="title"
                                       placeholder="Book title" value="{{$book->title}}">
                            </div>
                            <div class="form-group">
                                <label for="description_field">Description</label>
                                <textarea type="text" class="form-control" id="description_field" name="description"
                                          rows="3" placeholder="Book description">{{$book->description}}</textarea>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="price_field">Price (in €)</label>
                                    <input class="form-control" id="price_field" name="price" placeholder="Book price"
                                           value="{{$book->price}}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="dicount_field">Discount (in %)</label>
                                    <input class="form-control" id="dicount_field" name="discount" placeholder="e.g 10"
                                           value="{{$book->discount}}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="authors_field">Authors (separated by comma)</label>
                                    <input class="form-control" id="authors_field" name="authors"
                                           placeholder="John Smith, J.K Rowling"
                                           value="{{$book->authors_readable()}}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="genres_field">Genres: </label>
                                    <select class="xp-select2-multi-select form-control" id="genres_field"
                                            name="genres[]" multiple>
                                        @foreach($available_genres as $genre)
                                            @if($book->genres->pluck('name')->contains($genre->name))
                                                <option selected>{{$genre->name}}</option>
                                            @else
                                                <option>{{$genre->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>

                                </div>
                            </div>

                            <div class="d-flex justify-content-center my-4">
                                <button class="btn btn-outline-success m-2 my-sm-0 " type="submit">Update</button>
                                <a class="btn btn-outline-warning m-2 my-sm-0" href="{{route('booksManageMenu')}}">Cancel</a>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
            <!-- End XP Col -->
        </div>
        <!-- End XP Row -->
    </div>
    <!-- End XP Contentbar -->
@endsection
@section('script')
    <!-- Select2 JS -->
    <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/init/form-select-init.js') }}"></script>
    <!-- Tagsinput JS -->
    <script src="{{ asset('assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-tagsinput/typeahead.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/init/form-select-init.js') }}"></script>
@endsection

