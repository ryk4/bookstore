@extends('layouts.app')


@section('content')

    <link defer rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>


    <div class="d-flex justify-content-center">
        <div class="col-8">
            <h2>Add Book</h2>

            <form action="{{route('book.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
                <div class="form-group">
                    <label for="title_field">Title</label>
                    <input type="text" class="form-control" id="title_field" name="title" placeholder="Book title">
                </div>
                <div class="form-group">
                    <label for="description_field">Description</label>
                    <textarea type="text" class="form-control" id="description_field" name="description" rows="3" placeholder="Book description"></textarea>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="price_field">Price (in €)</label>
                        <input class="form-control" id="price_field" name="price" placeholder="Book price">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="dicount_field">Discount (in %)</label>
                        <input class="form-control" id="dicount_field" name="discount" placeholder="e.g 10">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="authors_field">Authors (separated by comma)</label>
                        <input class="form-control" id="authors_field" name="authors" placeholder="John Smith, J.K Rowling">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="genres_field">Genres</label>
                        <select class="form-control selectpicker" id="genres_field" name="genres[]" multiple>
                            <option>Fantasy</option>
                            <option>Drama</option>
                            <option>Clasic</option>
                            <option>Horror</option>
                            <option>Romance</option>
                        </select>

                    </div>
                </div>

                <div class="form-group">
                    <label for="cover_field">Example file input</label>
                    <input type="file" class="form-control-file" name="cover" id="cover_field">
                </div>
                <div class="d-flex justify-content-center my-4">
                    <button class="btn btn-outline-success m-2 my-sm-0 " type="submit">Create</button>
                    <a class="btn btn-outline-warning m-2 my-sm-0" href="{{route('booksManageMenu')}}">Cancel</a>
                </div>

            </form>
        </div>
    </div>

@endsection



