@extends('layouts.admin')

@section('body')
    <div class="table-responsive">
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    <li>{!! print_r($errors->all()) !!}</li>
                </ul>
            </div>
        @endif
        <form action="/admin/updateProduct/{{$product->id}}" method="post">
            @csrf
            <div class="form-group"><label for="name">Name</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Product Name"
                       value="{{$product->name}}" required>
            </div>
            <div class="form-group"><label for="description">Description</label>
                <input type="text" class="form-control" name="description" id="description"
                       placeholder="Product Description"
                       value="{{$product->description}}" required>
            </div>
            <div class="form-group"><label for="type">Type</label>
                <input type="text" class="form-control" name="type" id="type" placeholder="Product Type"
                       value="{{$product->type}}" required>
            </div>
            <div class="form-group"><label for="price">Price</label>
                <input type="text" class="form-control" name="price" id="price" placeholder="Product Price"
                       value="{{$product->price}}" required>
            </div>
            <button type="submit" name="submit" class="btn btn-default">Submit</button>
        </form>
    </div>
@endsection