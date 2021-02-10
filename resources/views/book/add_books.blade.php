@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-center">
        <div class="col-8">
            <h2>Add Book</h2>

            <form>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Title</label>
                    <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Example textarea</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="exampleFormControlInput1">Price</label>
                        <input type="email" class="form-control" id="exampleFormControlInput1" >
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleFormControlInput1">Discount (in %)</label>
                        <input type="email" class="form-control" id="exampleFormControlInput1" >
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleFormControlInput1">Authors (separated by comma)</label>
                        <input type="email" class="form-control" id="exampleFormControlInput1" >
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleFormControlInput1">Genres (separated by comma)</label>
                        <input type="email" class="form-control" id="exampleFormControlInput1" >
                    </div>
                </div>

                <div class="form-group">
                    <label for="exampleFormControlFile1">Example file input</label>
                    <input type="file" class="form-control-file" id="exampleFormControlFile1">
                </div>
                <div class="d-flex justify-content-center my-4">
                    <button class="btn btn-outline-success m-2 my-sm-0 " type="submit">Create</button>
                    <button class="btn btn-outline-warning m-2 my-sm-0 " type="submit">Cancel</button>
                </div>

            </form>
        </div>
    </div>
@endsection
